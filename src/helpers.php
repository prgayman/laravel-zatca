<?php

if (!function_exists('zatca')) {
    function zatca(): \Prgayman\Zatca\Zatca
    {
        return app('zatca');
    }
}

if (!function_exists('qrCodeOptions')) {
    function qrCodeOptions(): \Prgayman\Zatca\Utilis\QrCodeOptions
    {
        return app('qrcode.options');
    }
}
