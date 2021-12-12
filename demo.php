<?php

use phpImageWatermark\watermarkMaker;

include 'watermarkMaker.php';
$maker = new watermarkMaker();
$maker->setInputFilePath('./demo/original.jpg');
$maker->setFontSize(12);
$maker->setAngle(30);
$maker->setWatermarkString('https://github.com/cccaimingjian');
$maker->setWatermarkColor(0x40555555);
$maker->setWatermarkHeightInterval(75);
$maker->setWatermarkWidthInterval(80);
$maker->drawWatermark();
$maker->encodeToJPG('./demo/watermarked.jpg');
