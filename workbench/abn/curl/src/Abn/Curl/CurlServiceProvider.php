<?php namespace Abn\Curl;

use Illuminate\Support\ServiceProvider;

class CurlServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind('restClient', function () {
            return new CurlRestClient();
        });
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('abn.curl');
    }

}
