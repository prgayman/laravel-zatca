<?php

namespace Prgayman\Zatca\Test\Unit;

use Prgayman\Zatca\Zatca;
use Prgayman\Zatca\Test\TestCase;

class ZatcaTest extends TestCase
{
    /** 
     * @test 
     * */
    public function shouldBase64()
    {
        $base64 = (new Zatca)->sellerName('Zatca')
            ->vatRegistrationNumber("123456789123456")
            ->timestamp("2021-12-01T14:00:09Z")
            ->totalWithVat('100.00')
            ->vatTotal('15.00')
            ->toBase64();

        $this->assertEquals('AQVaYXRjYQIPMTIzNDU2Nzg5MTIzNDU2AxQyMDIxLTEyLTAxVDE0OjAwOjA5WgQGMTAwLjAwBQUxNS4wMA==', $base64);
    }

    /** 
     * @test 
     * */
    public function shouldBase64eAsArabic()
    {
        $base64 = (new Zatca)->sellerName('ايمن')
            ->vatRegistrationNumber("123456789123456")
            ->timestamp("2021-12-01T14:00:09Z")
            ->totalWithVat('100.00')
            ->vatTotal('15.00')
            ->toBase64();

        $this->assertEquals(
            'AQjYp9mK2YXZhgIPMTIzNDU2Nzg5MTIzNDU2AxQyMDIxLTEyLTAxVDE0OjAwOjA5WgQGMTAwLjAwBQUxNS4wMA==',
            $base64
        );
    }

    /** 
     * @test 
     * */
    public function shouldTLV()
    {
        $tlv = (new Zatca)->sellerName('Zatca')
            ->vatRegistrationNumber("123456789123456")
            ->timestamp("2021-12-01T14:00:09Z")
            ->totalWithVat('100.00')
            ->vatTotal('15.00')
            ->toTLV();

        $this->assertEquals(
            'AQVaYXRjYQIPMTIzNDU2Nzg5MTIzNDU2AxQyMDIxLTEyLTAxVDE0OjAwOjA5WgQGMTAwLjAwBQUxNS4wMA==',
            base64_encode($tlv)
        );
    }

    /**
     * @test
     */
    public function shouldThrowExpectionWithWrongData()
    {
        $this->expectException(\InvalidArgumentException::class);

        (new Zatca)->sellerName('Zatca')
            ->vatRegistrationNumber("123456789123456")
            ->toBase64();
    }
}
