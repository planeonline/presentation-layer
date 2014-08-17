<?php

class UserController extends BaseController {


    const USER_STATUS_DELETED = 0;
    const USER_STATUS_PENDING = 1;
    const USER_STATUS_ACTIVE = 2;

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
        $result =$restClient->get(array($attribute=>$value,'status' => self::USER_STATUS_ACTIVE));
        $result = !$restClient->get()->results[0]->metadata->count;

        if(isset($isDirectRequest)){

            $result = $result ? 'true' : 'false';
        }

        return $result;
    }

}
