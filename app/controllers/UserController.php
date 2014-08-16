<?php

class UserController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function indexAction()
	{
		return View::make('user.index');
	}

    public function registrationAction(){


        if(Input::get())
        {

            $data = Input::All();

            $validator = Validator::make(
                $data,
                array(
                    '_token' => 'required|min:5',
                    'firstname' => 'required|min:3',
                    'lastname' => 'required|min:5',
                    'email' => 'required|email',
                    'password' => 'required|min:3|confirmed'
                )
            );

            if ($validator->fails())
            {

                $failedFields = array_keys($validator->failed());

                return View::make('user.registration')->withErrors($validator)
                    ->with('failedFields',$failedFields)
                    ->with('data',$data);
            }

            /** @var $restClient \Abn\Curl\CurlRestClient  */
            $restClient = App::make('restClient');
            $restClient->setUrl('http://service.planeonline.local/user');

            $postData = Input::except('_token','password_confirmation');
            $postData['status']= 1;
            $postData['description']= 'User registration comming from same system\'s presentation layer';
            $postRwBody = json_encode(array($postData));

            $result =$restClient->post($postRwBody);

//            var_dump($result);
            var_dump($result,$result->results);

        }
        else
        {
            return View::make('user.registration');
        }
//        return View::make('user.index');

    }

}
