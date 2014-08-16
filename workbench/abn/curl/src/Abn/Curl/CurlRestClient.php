<?php
/**
 * Created by PhpStorm.
 * User: ABN
 * Date: 09/08/2014
 * Time: 17:41
 */

namespace Abn\Curl;


class CurlRestClient
{

    protected $resource;

    protected $url;

    protected $defaultOptions = array(
        'CURLOPT_RETURNTRANSFER'=>1,
        //'CURLOPT_HEADER' => 1
    );


    public function __construct($url = null)
    {

        $this->url = $url;

        $this->resource = curl_init($this->url);

        $this->setOptions();


    }

    public function setOptions($options=null)
    {

        if(is_null($options) OR !is_array($options)){
            $options = $this->defaultOptions;
        }

        foreach($options as $option => $value){
            curl_setopt($this->getResource(),constant($option),$value);
        }

    }

    /**
     * @return resource
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * To set the call's target URL
     *
     * @param $url string
     */
    public function setUrl($url)
    {

        $this->url = $url;
        curl_setopt($this->resource, CURLOPT_URL, $this->url);
    }

    public function get($params = array(),$url=null)
    {

        if(!is_null($url)){
            $this->setUrl($url);
        }

        if(!empty($params)){
            $this->url .= "?" . http_build_query($params);
            $this->setUrl($this->url);
        }


        $result = curl_exec($this->getResource());

        return $this->format($result);
    }

    public function post($params, $url=null)
    {

        if(!is_null($url)){
            $this->setUrl($url);
        }

        $postFields = is_array($params) || is_object($params) ? http_build_query($params) : $params;

        curl_setopt($this->getResource(),CURLOPT_POST, true);
        curl_setopt($this->getResource(),CURLOPT_POSTFIELDS, $postFields);

        $result = curl_exec($this->getResource());

        return $this->format($result);
    }

    public function getInfo($key=null){

        $info = curl_getinfo($this->resource);

        return is_null($key)? $info : $info[$key];
    }

    protected function format(&$result, $format=null){

        if(is_null($format)){
            $format = $this->getInfo('content_type');
        }

        switch ($format){
            case 'application/json':
                $result = json_decode($result);
            break;
            default:
                $resutl = $result;
        }

        return $result;
    }
} 