<?php
namespace phpImageWatermark;

class watermarkMaker {
    protected $w_interval   = 50;
    protected $h_interval   = 50;
    protected $str_angel    = 15;
    protected $color        = 0x30BEBEBE;
    protected $pic_w        = 0;
    protected $pic_h        = 0;
    protected $image        = null;
    protected $font_path    = './font/SourceHanSerifSC-Medium.otf';
    public $file_path       = '';
    public $string          = 'watermark';
    public $font_size       = 10;

    public function __construct($original_path = '')
    {
        if ($original_path){
            $this->file_path = $original_path;
        }
    }

    /**
     * Set the image path (Original image)
     * 设置你要添加水印的那张图片的路径（原图）
     * @param $path
     * The File you want to add watermark
     */
    public function setInputFilePath($path){
        $this->file_path = $path;
    }

    /**
     * Set the angle of the watermark string
     * 设置水印字符的角度
     * @param $angle
     * The angle in degrees, with 0 degrees being left-to-right reading text.
     * Higher values represent a counter-clockwise rotation.
     * For example, a value of 90 would result in bottom-to-top reading text.
     */
    public function setAngle($angle){
        $this->str_angel = $angle;
    }

    /**
     * Set the font size of the watermark string
     * 设置水印字体大小
     * @param $size
     * The font size. Depending on your version of GD, this should be specified as the pixel size (GD1) or point size (GD2).
     */
    public function setFontSize($size){
        $this->font_size = $size;
    }

    /**
     * Set the watermark string
     * 设置水印的内容
     * @param $string
     * the string you want to add
     *
     */
    public function setWatermarkString($string){
        $this->string = $string;
    }

    /**
     * Set the color of the watermark string
     * 设置水印内容的颜色
     * @param $color
     * The color index. Using the negative of a color index has the effect of turning off antialiasing. See imagecolorallocate.
     */
    public function setWatermarkColor($color){
        $this->color = $color;
    }

    /**
     * Set the interval of width
     * 设置水印横向的间隔
     * @param $interval int
     * the pixel between watermark's START in horizontal direction
     * 注意是开头的间隔，间隔大小请根据水印的字符长度合理设置
     */
    public function setWatermarkWidthInterval($interval){
        $this->w_interval = $interval;
    }

    /**
     * Set the interval of height
     * 设置水印纵向的间隔
     * @param $interval
     * the pixel between watermark in vertical direction
     */
    public function setWatermarkHeightInterval($interval){
        $this->h_interval = $interval;
    }

    /**
     * Set the font path
     * 设置水印字体文件
     * @param $font_path
     * the font file path
     */
    public function setWatermarkFont($font_path){
        $this->font_path = $font_path;
    }

    /**
     * draw watermark
     * 画水印
     * @throws Exception
     */
    public function drawWatermark(){
        if (!$this->image){
            $this->loadPicture();
        }
        for ($i = 0; $i<=$this->pic_w; $i = $i + $this->w_interval){
            for ($j = 0; $j<=$this->pic_h; $j = $j + $this->h_interval){
                imagettftext($this->image,
                    $this->font_size,
                    $this->str_angel,
                    $i,$j,
                    $this->color,
                    $this->font_path,$this->string);
            }
        }
    }

    /**
     * encode the image to JPG
     * @param string $file_name [optional]
     * The path to save the file to. If not set or null, return the image content.
     * @return bool|string
     */
    public function encodeToJPG($file_name = ''){
        if (!$file_name){
            ob_start();
            imagejpeg($this->image);
            return ob_get_clean();
        }
        return imagejpeg($this->image,$file_name);
    }

    /**
     * encode the image to PNG
     * @param string $file_name
     * @return bool|string
     */
    public function encodeToPNG($file_name = ''){
        if (!$file_name){
            ob_start();
            imagepng($this->image);
            return ob_get_clean();
        }
        return imagepng($this->image,$file_name);
    }

    /**
     * @return null|GdImage
     */
    public function getGdImage(){
        return $this->image;
    }

    /**
     * Load the image into Memory
     * 读取图片
     * @return bool
     * @throws Exception
     */
    protected function loadPicture()
    {
        if (!file_exists($this->file_path)){
            throw new Exception('File: "'.$this->file_path.'" does not exist');
        }
        $image_data = file_get_contents($this->file_path);
        if (!$image_data){
            throw new Exception('file_get_contents() can NOT get the file:"'.$this->file_path.'"');
        }
        $this->image = imagecreatefromstring($image_data);
        if (!$this->image){
            throw new Exception('Can NOT Load the file:"'.$this->file_path.'", please confirm the file is an image');
        }
        $this->pic_w = imagesx($this->image);
        $this->pic_h = imagesy($this->image);
        return true;
    }
}