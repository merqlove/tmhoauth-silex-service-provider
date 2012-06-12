<?php

namespace Kud\Silex\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Themattharris\TmhOAuth;
use Themattharris\TmhUtilities;

class TmhOAuthServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        if (!isset($app['tmhoauth.config']['consumer_key'], $app['tmhoauth.config']['consumer_secret'])) {
            throw \new RuntimeException('Config must include consumer_key and consumer_secret');
        }

        $app['tmhoauth'] = $app->share(function () use ($app) {
            return new TmhOAuth($app['tmhoauth.config']);
        });

        $app['tmhoauth.utils'] = $app->share(function () {
            return new TmhUtilities();
        });
    }

    public function boot(Application $app)
    {
    }
}
