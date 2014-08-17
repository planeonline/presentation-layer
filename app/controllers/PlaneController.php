<?php

class PlaneController extends BaseController {

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

        /** @var $restClient \Abn\Curl\CurlRestClient  */
        $restClient = App::make('restClient');

        $restClient->setUrl('http://service.planeonline.local/user');
        $result =$restClient->get(array('email'=>'abn@webit42.me'));
        $result =$restClient->get();

        var_dump($result->results[0]->metadata->count);
        die();

		return View::make('plane.index')->with('planes',$result->results[0]->result);
	}

}
