<?php // File: /app/View/Thumbnail/view.ctp 

$width = $thumbnail_size[0];
$height = $thumbnail_size[1];

$src_image = $this->Image->resize($thumbnail['Obj']['image_file'], $width, $height, true, array(), true, true);
$url_components = explode('/',$src_image);
$filename = array_pop($url_components);
$url_components[] = rawurlencode($filename);
echo json_encode(array('url'=>implode('/', $url_components), 'width'=>$width, 'height'=>$height));

?>

