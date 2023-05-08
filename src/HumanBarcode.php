<?php

namespace cccaimingjian\HumanBarcode;

use Picqer\Barcode\BarcodeGeneratorPNG;

class HumanBarcode
{
    protected string $font_path = __DIR__ . '/font/open_sans.ttf';
    protected int $code_height = 60;
    protected int $width_factor = 2;

    protected string $barcode_data;
    protected string $barcode_text;

    public function __construct(int $code_height = 60, int $width_factor = 2)
    {
        $this->code_height = $code_height;
        $this->width_factor = $width_factor;
    }

    /**
     * @param string $barcode_text the Code Text
     * @param string $code_type Type string defined at Picqer\Barcode\BarcodeGenerator
     * @return string
     */
    public function createHumanBarcode(string $barcode_text, string $code_type = 'C39'): string
    {
        $this->barcode_text = strtoupper($barcode_text);
        $generator = new BarcodeGeneratorPNG();
        $this->barcode_data = $generator->getBarcode($this->barcode_text, $code_type, $this->width_factor, $this->code_height);
        $this->drawBarcodeText();
        return $this->barcode_data;
    }

    public function drawBarcodeText()
    {
        $barcode = imagecreatefromstring($this->barcode_data);
        $width = imagesx($barcode);
        $height = imagesy($barcode);
        $image = imagecreate($width + 30, $height + 50);
        $color = imagecolorAllocate($image, 255, 255, 255);
        imagefill($image, 0, 0, $color);
        imagecopymerge($image, $barcode, 15, 15, 0, 0, $width, $height, 100);
        imagecolorallocate($image, 255, 255, 255);
        $box = imagettfbbox(18, 0, $this->font_path, $this->barcode_text);
        $x = intval(($width + 30 - $box[2] - $box[0]) / 2);
        imagettftext($image, 18,
            0, $x, $height + 40, 0xffffffff,
            $this->font_path, $this->barcode_text);
        ob_start();
        imagepng($image);
        $content = ob_get_contents();
        ob_clean();
        return $content;
    }

    /**
     * @return string
     */
    public function getBarcodeData(): string
    {
        return $this->barcode_data;
    }

    /**
     * @param string $barcode_data
     */
    public function setBarcodeData(string $barcode_data): void
    {
        $this->barcode_data = $barcode_data;
    }

    /**
     * @return string
     */
    public function getBarcodeText(): string
    {
        return $this->barcode_text;
    }

    /**
     * @param string $barcode_text
     */
    public function setBarcodeText(string $barcode_text): void
    {
        $this->barcode_text = $barcode_text;
    }
}

