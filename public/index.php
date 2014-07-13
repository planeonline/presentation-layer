<?php
/**
 * Created by PhpStorm.
 * User: ABN
 * Date: 13/07/2014
 * Time: 17:09
 */

try {

    $consumer_key = 'key';
    $consumer_secret = 'secret';
    $url = 'http://service.planeonline.local/oauth/request_token';

    $oauth = new OAuth($consumer_key, $consumer_secret, OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_URI);

    $request_token_info = $oauth->getAccessToken($url, 'http://service.planeonline.local/');

    $request_token_info = array_keys($request_token_info);


    if (!empty($request_token_info)) {
        print_r(bin2hex($request_token_info[0]));
        //print_r($oauth->getLastResponse());
    } else {
        print "Failed fetching request token, response was: " . $oauth->getLastResponse();
    }

} catch (Exception $e) {
    var_dump($e);
}