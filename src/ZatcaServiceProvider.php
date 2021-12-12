<?php

namespace Prgayman\Zatca;

use Illuminate\Support\ServiceProvider;
use Prgayman\Zatca\Utilis\QrCodeOptions;

class ZatcaServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('zatca', Zatca::class);
        $this->app->bind('qrcode.options', QrCodeOptions::class);
    }
}
