<?php

namespace Prgayman\Zatca\Utilis;

class QrCodeOptions
{

    /**
     * Holds the size of the QrCode in pixels.
     *
     * @var int
     */
    protected $pixels = 100;

    /**
     * Holds the margin size of the QrCode.
     *
     * @var int
     */
    protected $margin = 0;

    /**
     * Holds the selected formatter.
     *
     * @var string
     */
    protected $format = 'svg';

    /**
     * The foreground color of the QrCode.
     *
     * @var array|null
     */
    protected $color = null;

    /**
     * The background color of the QrCode.
     *
     * @var array|null
     */
    protected $backgroundColor = null;

    /**
     * The style of the blocks within the QrCode.
     * Possible values are square, dot, and round.
     *
     * @var string
     */
    protected $style = 'square';

    /**
     * The size of the selected style between 0 and 1.
     * This only applies to dot and round.
     *
     * @var float|null
     */
    protected $styleSize = null;

    /**
     * The style to apply to the eye.
     * Possible values are circle and square.
     *
     * @var string|null
     */
    protected $eyeStyle = null;

    /**
     * Sets the size of the QrCode.
     *
     * @param int $pixels
     * @return QrCodeOptions
     */
    public function size(int $pixels): self
    {
        $this->pixels = $pixels;

        return $this;
    }

    /**
     * Sets the margin of the QrCode.
     *
     * @param int $margin
     * @return QrCodeOptions
     */
    public function margin(int $margin): self
    {
        $this->margin = $margin;

        return $this;
    }

    /**
     * Sets the format of the QrCode.
     *
     * @param string $format
     * @return QrCodeOptions
     */
    public function format(string $format): self
    {
        $this->format = $format;

        return $this;
    }


    /**
     * Sets the foreground color of the QrCode.
     *
     * @param int $red
     * @param int $green
     * @param int $blue
     * @param null|int $alpha
     * 
     * @return QrCodeOptions
     */
    public function color(int $red, int $green, int $blue, ?int $alpha = null): self
    {
        $this->color = [$red, $green, $blue, $alpha];

        return $this;
    }

    /**
     * Sets the background color of the QrCode.
     *
     * @param int $red
     * @param int $green
     * @param int $blue
     * @param null|int $alpha
     * 
     * @return QrCodeOptions
     */
    public function backgroundColor(int $red, int $green, int $blue, ?int $alpha = null): self
    {
        $this->backgroundColor = [$red, $green, $blue, $alpha];

        return $this;
    }

    /**
     * Sets the style of the blocks for the QrCode.
     *
     * @param string $style
     * @param float $size
     * 
     * @return QrCodeOptions
     */
    public function style(string $style, float $size = 0.5): self
    {
        $this->style = $style;
        $this->styleSize = $size;

        return $this;
    }

    /**
     * Sets the eye style.
     *
     * @param string $style
     * @return QrCodeOptions
     */
    public function eye(string $style): self
    {
        $this->eyeStyle = $style;

        return $this;
    }

    /**
     * Fetches the size.
     *   
     * @return int
     */
    public function getSize(): int
    {
        return $this->pixels;
    }

    /**
     * Fetches the margin.
     * 
     * @return int
     */
    public function getMargin(): int
    {
        return $this->margin;
    }

    /**
     * Fetches the format.
     * 
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * Fetches the foreground color.
     * 
     * @return array|null
     */
    public function getColor()
    {
        return  $this->color;
    }

    /**
     * Fetches the background color.
     * 
     * @return array|null
     */
    public function getBackgroundColor()
    {
        return  $this->backgroundColor;
    }

    /**
     * Fetches the style.
     * 
     * @return string
     */
    public function getStyle(): string
    {
        return $this->style;
    }

    /**
     * Fetches the style size.
     * 
     * @return float|null
     */
    public function getStyleSize()
    {
        return  $this->styleSize;
    }

    /**
     * Fetches the eye style.
     *
     * @return string|null
     */
    public function getEye()
    {
        return $this->eyeStyle;
    }
}
