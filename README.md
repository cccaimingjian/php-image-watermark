# php-image-watermark
PHP Image Watermark Maker  
Watermark the full image ，整张图片加满水印  
## See the effect directly
直接看效果  
![alt Before](/demo/original.jpg)  
![alt After](/demo/watermarked.jpg)  

## Usage 用法

### No.1  
Copy the watermarkMaker.php to your project, and set the namespace if necessary  
将 watermarkMaker.php 复制到您的项目中，并根据需要设置命名空间
```
$maker = new watermarkMaker();
$maker->setInputFilePath('PATH_TO_YOUR_IMAGE');
```
or 或者一步到位  
```
$maker = new watermarkMaker('PATH_TO_YOUR_IMAGE');
``` 
### No.2  
Set the watermark characters you want to add,and font file you want to use  
然后，设置你要添加的水印字符,并且指定字体文件
```
$maker->setWatermarkString('WATERMARK_STRING_HERE');
$maker->setWatermarkFont('PATH_TO_YOUR_FONT_FILE');
```
### No.3
Set the watermark style  
设置水印样式  
+ Set angle, defult 15 degrees  
  设置角度  
```
$maker->setAngle(10); 
```  
+ Set font size, defult 10  
  设置字体大小  
``` 
$maker->setFontSize(50); 
```  
+ Set watermark color  
  设置水印颜色  
```
$maker->setWatermarkColor(0xFF0000);
```
+ Set the interval  
  设置间隔  
When setting the horizontal interval, please evaluate the length of the watermark content  
When setting the vertical interval, please evaluate the angle of the watermark content  
在设置横向间隔的时候，请评估水印内容的长度  
在设置纵向间隔的时候，请评估水印内容的角度
```
$maker->setWatermarkWidthInterval(100);
$maker->setWatermarkHeightInterval(50);
```
### No.4
Draw watermark  
画水印
```
$maker->drawWatermark();
```
### No.5
Get the watermarked image  
获取画了水印的图片
+ Get the watermarked image data directly  
  直接获取打了水印的图片

Get the watermarked image data content, JPG format  
获取带水印的图片数据内容，JPG格式  
`$content = $maker->encodeToJPG();`  

Get the watermarked image data content, PNG format  
获取带水印的图片数据内容，PNG格式  
`$content = $maker->encodeToPNG();`

Save the watermarked image  
保存图片到指定路径  
`$content = $maker->encodeToJPG('PATH_TO_SAVE');`  
`$content = $maker->encodeToPNG('PATH_TO_SAVE');`  

Get the watermarked image before GD's function imageXXX()  
You can encode into other formats or perform other operations by yourself  
获取GD imageXXX()之前的资源，你可以自己编码成其他格式或进行其他操作
```
$image   = $maker->getGdImage();
imagebmp($image,'PATH');  //encode to bmp.
...
```

