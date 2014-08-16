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
            Validator::extend('uniqueMail', 'UserController@checkEmailIsUnique');

            $data = Input::All();

            $validator = Validator::make(
                $data,
                array(
                    '_token' => 'required|min:5',
                    'firstname' => 'required|min:3',
                    'lastname' => 'required|min:5',
                    'email' => 'required|email|uniqueMail',
                    'password' => 'required|min:3|confirmed'
                ),
                array(
                    'unique_mail' => 'An account already is using <strong>"'.$data['email']. '"</strong> E-Mail address'
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

            var_dump($result,$result->results);

        }
        else
        {
            return View::make('user.registration');
        }


    }

    public function checkEmailIsUniqueAjax(){
        return 'asd123';
    }

    public function checkEmailIsUnique($attribute=null, $value=null, $parameters=null){

        if(is_null($attribute)){

            $email = Input::get('email');
            $attribute = 'email';
            $value = is_null(Input::get('email'))? 'abn@webit4.me' : $email;
            $isDirectRequest = true;
        }

        /** @var $restClient \Abn\Curl\CurlRestClient  */
        $restClient = App::make('restClient');

        $restClient->setUrl('http://service.planeonline.local/user');
        $result =$restClient->get(array($attribute=>$value));
        $result = !$restClient->get()->results[0]->metadata->count;

        if(isset($isDirectRequest)){

            $result = $result ? 'free' : 'taken';
        }

        return $result;
    }

}
