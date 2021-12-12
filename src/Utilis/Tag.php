<?php

namespace Prgayman\Zatca\Utilis;

class Tag
{

    /**
     * Tag
     * @var int
     */
    protected $tag;

    /**
     * Value
     * @var string
     */
    protected $value;

    public function __construct(int $tag, string $value)
    {
        $this->tag = $tag;
        $this->value = $value;
    }

    /**
     * Get tag
     * 
     * @return int
     */
    public function getTag(): int
    {
        return $this->tag;
    }


    /**
     * Get Value
     * 
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Get length value
     *
     * @return int
     */
    public function getLength(): int
    {
        return strlen($this->value);
    }

    /**
     * To convert the string value to hex.
     *
     * @param $value
     *
     * @return false|string
     */
    protected function toHex($value)
    {
        return pack("H*", sprintf("%02X", $value));
    }

    /**
     * Representing the encoded TLV data structure.
     * 
     * @return string
     */
    public function toTLV(): string
    {
        return $this->toHex($this->getTag()) . $this->toHex($this->getLength()) . $this->getValue();
    }

    /**
     * Returns a string representing the encoded TLV data structure.
     * 
     * @return string 
     */
    public function __toString()
    {
        return $this->toTLV();
    }
}
