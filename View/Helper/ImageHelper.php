<?php 

App::uses('Helper', 'View');

class ImageHelper extends Helper { 
    
    public $helpers = array('Html'); 
    public $cacheDir = 'cache'; // relative to IMAGES_URL path 
    
    /** 
     * Automatically resizes an image and returns formatted IMG tag 
     * 
     * @param string $path Path to the image file, relative to the webroot/img/ directory. 
     * @param integer $width Image of returned image 
     * @param integer $height Height of returned image 
     * @param boolean $aspect Maintain aspect ratio (default: true) 
     * @param array    $htmlAttributes Array of HTML attributes. 
     * @param boolean $return Wheter this method should return a value or output it. This overrides AUTO_OUTPUT. 
     * @param boolean $urlonly Restituisce solamente l'url invece dell'immagine completa 
     * @return mixed    Either string or echos the value, depends on AUTO_OUTPUT and $return. 
     * @access public 
     */ 
    function resize($path, $width, $height, $aspect = true, $htmlAttributes = array(), $return = true, $urlonly = false) { 
        $dir = "{$width}x{$height}"; 
        
        $types = array(1 => "gif", "jpeg", "png", "swf", "psd", "wbmp"); // used to determine image type 
        if(empty($htmlAttributes['alt'])) $htmlAttributes['alt'] = basename($path);  // Ponemos alt default 

        $fullpath = ROOT.DS.APP_DIR.DS.WEBROOT_DIR.DS.$this->themeWeb.IMAGES_URL; 
        if(!is_dir($fullpath.$this->cacheDir.DS.$dir)) 
        { 
            $percorso = str_replace(array('/', '\\'), DS, $fullpath.$this->cacheDir.DS.$dir); 
            
            mkdir($percorso, 0777, true); 
        } 

        $url = $fullpath.$path; 

        if (!($size = getimagesize($url))) 
            return; // image doesn't exist 
            
            if ($aspect) { // adjust to aspect. 
        if (($size[1]/$height) > ($size[0]/$width))  // $size[0]:width, [1]:height, [2]:type 
        $width = ceil(($size[0]/$size[1]) * $height); 
            else 
                $height = ceil($width / ($size[0]/$size[1])); 
        } 

        $relfile = $this->webroot.$this->themeWeb.IMAGES_URL.$this->cacheDir.'/'.$dir.'/'.basename($path); // relative file 
        $cachefile = $fullpath.$this->cacheDir.DS.$dir.DS.basename($path);  // location on server 

        if (file_exists($cachefile)) { 
            $csize = getimagesize($cachefile); 
            $cached = ($csize[0] == $width && $csize[1] == $height); // image is cached 
            if (@filemtime($cachefile) < @filemtime($url)) // check if up to date 
        $cached = false; 
        } else { 
            $cached = false; 
        } 

        if (!$cached) { 
                $resize = ($size[0] > $width || $size[1] > $height) || ($size[0] < $width || $size[1] < $height); 
        } else { 
            $resize = false; 
        } 

        if ($resize) { 
                $image = call_user_func('imagecreatefrom'.$types[$size[2]], $url); 
            if (function_exists("imagecreatetruecolor") && ($temp = imagecreatetruecolor ($width, $height))) { 
                imagecopyresampled ($temp, $image, 0, 0, 0, 0, $width, $height, $size[0], $size[1]); 
            } else { 
                $temp = imagecreate ($width, $height); 
                imagecopyresized ($temp, $image, 0, 0, 0, 0, $width, $height, $size[0], $size[1]); 
            } 
            call_user_func("image".$types[$size[2]], $temp, $cachefile); 
            imagedestroy ($image); 
            imagedestroy ($temp); 
        } 

        if ($urlonly != true) 
        { 
            $img_str = $this->Html->image($relfile, $htmlAttributes);
            return $this->output($img_str, $return); 
        } else { 
            return $relfile; 
        } 
    } 
} 
?> 