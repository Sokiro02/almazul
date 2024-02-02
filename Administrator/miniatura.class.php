<?php
/**
 * @author Pablo Contramaestre
 * @copyright 2018
 */
    class thumbnail 
    { 
        var $image; 
        var $size_x; 
        var $size_y; 
        function thumbnail($url) {$this->image=$url;} 
        function size($size_x,$size_y) {$this->size_x=$size_x;$this->size_y=$size_y;} 
        function show() 
        { 
            header("Content-type: image/jpeg");                
            $imageinfo=getimagesize ($this->image); 
            $x=$imageinfo[0]; 
            $y=$imageinfo[1]; 
            if($imageinfo[2]==1)    $original_image=imagecreatefromgif($this->image); 
            if($imageinfo[2]==2)    $original_image=imagecreatefromjpeg($this->image); 
            if($imageinfo[2]==3)    $original_image=imagecreatefrompng($this->image); 
            if($imageinfo[2]>3)        die('Image format not supported'); 
            $resize_x=$this->size_x/$x; 
            $resize_y=$this->size_y/$y; 
            if($resize_x<$resize_y) $resize=$resize_x; 
            else $resize=$resize_y; 
            $im = imagecreatetruecolor(ceil($x*$resize),ceil($y*$resize)); 
            imagecopyresampled($im,$original_image,0,0,0,0,ceil($x*$resize),ceil($y*$resize),$x,$y); 
              imagejpeg($im, NULL, 50);  //ULTIMO PARAMETROS ES PARA LA CALIDAD DE LA IMAGEN 
               imagedestroy($im); 
        } 
    } 
?>