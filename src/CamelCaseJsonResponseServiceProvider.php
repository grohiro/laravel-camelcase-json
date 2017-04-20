<?php
namespace Grohiro\LaravelCamelCaseJson;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;

class CamelCaseJsonResponseServiceProvider extends ServiceProvider
{
    /**
     * register()
     */
    public function register()
    {
        $view = $this->app->make('view');
        $redirect = $this->app->make('redirect');
        $this->app->singleton(ResponseFactory::class, function () use ($view, $redirect) {
            return new CamelCaseJsonResponseFactory($view, $redirect);
        });
    }
}
