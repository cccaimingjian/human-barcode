# human-barcode
Generate more human-readable barcodes. 生成更便于人类阅读的条码。  
THIS PROJECT require picqer/php-barcode-generator  
## Just BARCODE  
![just-barcode.png](demo%2Fjust-barcode.png)
## human-readable BARCODE  
#### with content text and a Line in the middle of the barcode and text content
![human-barcode.png](demo%2Fhuman-barcode.png)
## Line Left side Detail
#### with a short vertical lines
![left.png](demo%2Fleft.png)
## Line Right side Detail
#### with a short vertical lines
![right.png](demo%2Fright.png)
The line in the middle of the barcode and text content is used to confirm whether the barcode is correct after printing. If it is broken, or the vertical lines at both ends are not there, it shows that there is a problem with the printer and the barcode may not be recognized correctly.  
条码与文字内容中间的线，是用来确认打印后条码是否正确的。如果断了,或者两端的竖线没有，则显示说明打印机有问题，条码不一定能被正确识别。


### Here is simple USAGE
```php
$human_barcode = new \cccaimingjian\HumanBarcode\HumanBarcode();
$barcode_image_content = $human_barcode->createHumanBarcode('A-B-C-D-1-2-3456789');
$barcode_image_base64 = base64_encode($barcode_image_content);
```
### Mix Usage
```php

$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
//...
$barcode_text = 'TYPE-CODE-128';
$barcode_image_content_WITHOUT_TEXT =  $generator->getBarcode($barcode_text, $generator::TYPE_CODE_128);
$human_barcode = new \cccaimingjian\HumanBarcode\HumanBarcode();
$human_barcode->setBarcodeData($barcode_image_WITHOUT_TEXT);
$human_barcode->setBarcodeText($barcode_text);
$barcode_image_content = $human_barcode->drawBarcodeText();
$barcode_image_base64 = base64_encode($barcode_image_content);
```
```php
//Save
file_put_contents('PATH',$barcode_image_content);
```
```html
<!--blade-->
<img src="data:image/png;base64,{{$barcode_image_base64}}" height="50" alt="">
```

## For ALL USAGE, Please read picqer/php-barcode-generator's document.
