<?php

namespace Prgayman\Zatca;

use InvalidArgumentException;
use Prgayman\Zatca\Utilis\QrCodeOptions;
use Prgayman\Zatca\Utilis\Tag;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Zatca
{

    /**
     * Seller Name
     * 
     * @var Prgayman\Zatca\Utilis\Tag;
     */
    protected $sellerName;

    /**
     * Vat Registration Number
     * 
     * @var Prgayman\Zatca\Utilis\Tag;
     */
    protected $vatRegistrationNumber;

    /**
     * Invoice date timestamp
     * 
     * @var Prgayman\Zatca\Utilis\Tag;
     */
    protected $timestamp;

    /**
     * Invoice total with vat 
     * 
     * @var Prgayman\Zatca\Utilis\Tag;
     */
    protected $totalWithVat;

    /**
     * Invoice vat total 
     * 
     * @var Prgayman\Zatca\Utilis\Tag;
     */
    protected $vatTotal;

    /**
     * Set Seller name
     * 
     * @return self
     */
    public function sellerName(string $value): self
    {
        $this->sellerName = new Tag(1, $value);
        return $this;
    }

    /**
     * Set Vat Registration Number
     * 
     * @return self
     */
    public function vatRegistrationNumber(string $value): self
    {
        if (strlen($value) != 15) {
            throw new InvalidArgumentException('Vat Registration Number must be 15 number');
        }

        $this->vatRegistrationNumber = new Tag(2, $value);
        return $this;
    }

    /**
     * Set invoice date (timestamp)
     * 
     * @return self
     */
    public function timestamp(string $value): self
    {
        $this->timestamp = new Tag(3, date("Y-m-d\TH:i:s\Z", strtotime($value)));
        return $this;
    }

    /**
     * Set invoice total with vat
     * 
     * @return self
     */
    public function totalWithVat($value): self
    {
        $this->totalWithVat = new Tag(4, $value);
        return $this;
    }

    /**
     * Set vat total 
     * 
     * @return self
     */
    public function vatTotal($value): self
    {
        $this->vatTotal = new Tag(5, $value);
        return $this;
    }

    /**
     * Representing the encoded TLV data structure.
     *
     * @return string 
     */
    public function toTLV(): string
    {
        return implode('', array_map(function ($tag) {
            return (string) $tag;
        }, $this->toArray()));
    }

    /**
     * Encodes an TLV as base64
     *
     * @return string 
     */
    public function toBase64(): string
    {
        return base64_encode($this->toTLV());
    }

    /**
     * Generate QrCode
     * 
     * @return string
     */
    public function toQrCode(QrCodeOptions $qrCodeOptions = null): string
    {
        $qrCodeOptions = $qrCodeOptions ?? new QrCodeOptions();
        $color = $qrCodeOptions->getColor();
        $backgroundColor = $qrCodeOptions->getBackgroundColor();

        $qrCode =  QrCode::size($qrCodeOptions->getSize())
            ->margin($qrCodeOptions->getMargin())
            ->format($qrCodeOptions->getFormat());

        if (!is_null($color)) {
            $qrCode = $qrCode->color(
                $color[0],
                $color[1],
                $color[2],
                $color[3]
            );
        }

        if (!is_null($backgroundColor)) {
            $qrCode = $qrCode->backgroundColor(
                $backgroundColor[0],
                $backgroundColor[1],
                $backgroundColor[2],
                $backgroundColor[3]
            );
        }

        if (!is_null($qrCodeOptions->getStyleSize())) {
            $qrCode = $qrCode->style($qrCodeOptions->getStyle(), $qrCodeOptions->getStyleSize());
        }

        if (!is_null($qrCodeOptions->getEye())) {
            $qrCode = $qrCode->eye($qrCodeOptions->getEye());
        }

        return  $qrCode->generate($this->toBase64());
    }

    public function toArray()
    {
        $data = array_filter([
            $this->sellerName,
            $this->vatRegistrationNumber,
            $this->timestamp,
            $this->totalWithVat,
            $this->vatTotal,
        ]);

        if (count($data) != 5) {
            throw new InvalidArgumentException('Malformed data structure');
        }
        return $data;
    }
}
