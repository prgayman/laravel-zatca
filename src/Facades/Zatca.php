<?php

namespace Prgayman\Zatca\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static $this sellerName(string $value)
 * @method static $this vatRegistrationNumber(string $value)
 * @method static $this timestamp(string $value)
 * @method static $this totalWithVat(string $value)
 * @method static $this vatTotal(string $value)
 * @method static string toTLV()
 * @method static string toBase64()
 * @method static string toQrCode()
 * 
 * @see \Prgayman\Zatca\Zatca
 */

class Zatca extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Prgayman\Zatca\Zatca::class;
    }
}
