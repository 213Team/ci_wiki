<?php 
class Captcha extends CI_Controller {

    function index(){
		$type = 'png';
    	header("Content-type: image/".$type);  
    
    	$num = 4;
    	$randval = $this->_randStr($num); 
    	$width= 20 + 25 * $num;      //图片大小，每个字符占25个像素，左右各预留出10个像素
    	$height= 36; 
    
    	if($type!='gif' && function_exists('imagecreatetruecolor')){ 
        	$im = @imagecreatetruecolor($width,$height); 
    	}else{ 
        	$im = @imagecreate($width,$height); 
    	} 
    
    	$br = mt_rand(127,255);            //backgrand-R            背景色应该是浅色调的，字符的颜色为深色调
    	$bg = mt_rand(127,255);            //backgrand-G
    	$bb = mt_rand(127,255);            //backgrand-B
    
    	$backColor = ImageColorAllocate($im, $br, $bg, $bb);    //背景色 
    	$borderColor = ImageColorAllocate($im, 0, 0, 0);    //边框色 
    	$pointColor = ImageColorAllocate($im, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));    //点颜色 
    	$stringColor = ImageColorAllocate($im, $br - 90 - mt_rand(0,37), $bg - 90 - mt_rand(0,37), $bb - 90 - mt_rand(0,37));
                                    //其实这里的意思就是$br - 127,但是这样的话就没有了随机的效果。。。于是。。。
    
    	@imagefilledrectangle($im, 0, 0, $width - 1, $height - 1, $backColor);//背景位置 
    	@imagerectangle($im, 0, 0, $width-1, $height-1, $borderColor);     //边框位置 

    
    
    	for($i = 0; $i <= 100; $i++){    //画干扰点
        	$pointX = mt_rand(2, $width - 2); 
        	$pointY = mt_rand(2, $height - 2); 
        	@imagesetpixel($im, $pointX, $pointY, $pointColor); 
    	} 
    
    	$fontttf = "Arial.ttf";            //需要arial.ttf文件
    
    	for ($i = 0; $i < $num; $i++)
        	@imagettftext($im, 24, mt_rand(-30,30), ($width - 20) / $num * $i + 10, $height - 8, $stringColor, $fontttf, $randval[$i]); 
                                                        //随机旋转-30~+30度。需要注意的是传进这个函数的x和y是左下角的坐标

    	for ($i = 0; $i < 2; $i++){    //随机画两条线
        	$pointX = mt_rand(0, $width / 4);    //起点在左侧1/4内，终点在右侧1/4内
        	$pointY = mt_rand(0, $height);
        	$pointX2 = mt_rand($width / 4 * 3, $width);
        	$pointY2 = mt_rand(0, $height);
        	@imageline($im, $pointX, $pointY, $pointX2, $pointY2, $pointColor);    
    	}
  		@imageellipse($im, mt_rand(0,$width), mt_rand(0,$height), mt_rand($width / 2, $width * 2), mt_rand($height / 2, $height), $pointColor);
                //随机画个椭圆
                
    	$ImageFun='Image'.$type; 
    	$ImageFun($im); 
    
    	@ImageDestroy($im); 
    	$this->session->set_userdata('captcha', $randval);  
    }
    
    function _randStr($len, $format="") { 
        switch($format) {
            case 'CHAR':         
                $chars='ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz';
                break; 
            case 'NUMBER': 
                $chars='123456789'; 
                break; 
            default : 
                $chars='ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz123456789'; 
                break; 
        }         
        $string=""; 
        while(strlen($string) < $len) {
            $string.=substr($chars,(mt_rand()%strlen($chars)), 1); 
        }
        return $string; 
    } 
}
?>
