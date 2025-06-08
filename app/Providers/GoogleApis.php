<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Google\Client;
use Google\Service;

class GoogleApis extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Client::class, function (Application $app) {
            $client = new Client();
            $client->setApplicationName(env("G_SSO_NAME"));
            $client->setClientId(env("G_SSO_CLIENT_ID"));
            $client->setClientSecret(env("G_SSO_CLIENT_SECRET"));
            $client->setRedirectUri(env("G_SSO_REDIRECT_URI"));
            $client->addScope([
                Service\Oauth2::USERINFO_EMAIL,
                Service\Oauth2::USERINFO_PROFILE
            ]);
            $client->setAccessType('offline');
            $client->setLoginHint('your_email@gmail.com');

            return $client;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
