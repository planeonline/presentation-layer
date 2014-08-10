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

        $restClient->setUrl('http://service.planeonline.local/plane');
//        $result =$restClient->get(array('id'=>3));
        $result =$restClient->get();


		return View::make('plane.index')->with('planes',$result->results[0]->result);
	}

}
