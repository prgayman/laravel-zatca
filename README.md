# Laravel ZATCA E-invoicing


## Introduction
Laravel package a helper to Generate the QR code and signed it for ZATCA E-invoicing

## Installation

To get the latest version of laravel-zatca on your project, require it from "composer":

    $ composer require prgayman/laravel-zatca

Or you can add it directly in your composer.json file:

```json
{
  "require": {
    "prgayman/laravel-zatca": "1.0.0"
  }
}
```

### Laravel

Register the provider directly in your app configuration file config/app.php `config/app.php`:

Laravel >= 5.5 provides package auto-discovery, thanks to rasmuscnielsen and luiztessadri who help to implement this feature in LaraFcm, the registration of the provider and the facades should not be necessary anymore.

```php
'providers' => [
    Prgayman\Zatca\Zatca::class,
]
```

Add the facade aliases in the same file:

```php
'aliases' => [

  'Zatca' => Prgayman\Zatca\Facades\Zatca::class,

]
```

### Lumen

Register the provider in your bootstrap app file `boostrap/app.php`

Add the following line in the "Register Service Providers" section at the bottom of the file.

```php
$app->register(Prgayman\Zatca\Zatca::class);
```

For facades, add the following lines in the section "Create The Application" .

```php
class_alias(\Prgayman\Zatca\Facades\Zatca::class, 'Zatca');
```

## Usage

### Generate Base64
```php
use Prgayman\Zatca\Facades\Zatca;

$base64 = Zatca::sellerName('Zatca')
            ->vatRegistrationNumber("123456789123456")
            ->timestamp("2021-12-01T14:00:09Z")
            ->totalWithVat('100.00')
            ->vatTotal('15.00')
            ->toBase64();
// Output
// AQVaYXRjYQIPMTIzNDU2Nzg5MTIzNDU2AxQyMDIxLTEyLTAxVDE0OjAwOjA5WgQGMTAwLjAwBQUxNS4wMA==
```

### Generate Plain
```php
use Prgayman\Zatca\Facades\Zatca;

$tlv = Zatca::sellerName('Zatca')
            ->vatRegistrationNumber("123456789123456")
            ->timestamp("2021-12-01T14:00:09Z")
            ->totalWithVat('100.00')
            ->vatTotal('15.00')
            ->toTLV();
```

### Render A QR Code Image
```php
use Prgayman\Zatca\Facades\Zatca;
use Prgayman\Zatca\Utilis\QrCodeOptions; // Optional

// Optional
$qrCodeOptions = new QrCodeOptions;

// Format (png,svg,eps)
$qrCodeOptions->format("svg");

// Color 
$qrCodeOptions->color(255,0,0,1);

// Background Color 
$qrCodeOptions->backgroundColor(0,0,0);

// Size
$qrCodeOptions->size(100);

// Margin 
$qrCodeOptions->margin(0);

// Style (square,dot,round)
$qrCodeOptions->style('square',0.5);

// Eye (square,circle)
$qrCodeOptions->eye('square');

$qrCode = Zatca::sellerName('Zatca')
            ->vatRegistrationNumber("123456789123456")
            ->timestamp("2021-12-01T14:00:09Z")
            ->totalWithVat('100.00')
            ->vatTotal('15.00')
            ->toQrCode($qrCodeOptions);
```

### Generate Base64 Using Function
```php

$base64 = zatca()
            ->sellerName('Zatca')
            ->vatRegistrationNumber("123456789123456")
            ->timestamp("2021-12-01T14:00:09Z")
            ->totalWithVat('100.00')
            ->vatTotal('15.00')
            ->toBase64();
// Output
// AQVaYXRjYQIPMTIzNDU2Nzg5MTIzNDU2AxQyMDIxLTEyLTAxVDE0OjAwOjA5WgQGMTAwLjAwBQUxNS4wMA==
```

### Generate Plain Using Function
```php

$tlv = zatca()
            ->sellerName('Zatca')
            ->vatRegistrationNumber("123456789123456")
            ->timestamp("2021-12-01T14:00:09Z")
            ->totalWithVat('100.00')
            ->vatTotal('15.00')
            ->toTLV();
```

### Render A QR Code Image Using Function
```php
$qrCode = zatca()
            ->sellerName('Zatca')
            ->vatRegistrationNumber("123456789123456")
            ->timestamp("2021-12-01T14:00:09Z")
            ->totalWithVat('100.00')
            ->vatTotal('15.00')
            ->toQrCode(
              qrCodeOptions()
                ->format("svg")
                ->color(255,0,0,1)
                ->size(300)
            );
```

## Testing

```bash
composer test
```

## Licence

This library is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).