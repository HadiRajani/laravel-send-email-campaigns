<?php

namespace VendorAliHadi\EmailCampaign;

use Illuminate\Support\ServiceProvider;

class EmailCampaignServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->publishes([
            __DIR__.'/../config/email-campaign.php' => config_path('email-campaign.php'),
        ]);
    }

    public function register()
    {
        //
    }
}
