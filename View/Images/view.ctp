<?php ?>
<!-- File: /app/View/Images.ctp -->
<script>
$(document).ready(function()
{
    var canvas = $('#canvas');
    var ctx =  canvas.get(0).getContext('2d');
   
    
    function showImage(undefined){
        var ww = $(window).width();
        var wh = $(window).height();
        canvas.attr({ width:ww, height:wh, });
//         var that = $(this);
        var rr = new Geom.Rect(0,0, this.naturalWidth, this.naturalHeight);
        var wr = new Geom.Rect(0,0,ww, wh);
        rr.fitRect(wr, true);
        ctx.drawImage(this, rr.left(), rr.top(), rr.width(), rr.height());
    }
    
    var image = $('<img />');
    image.on('load', function(e){
        showImage.apply(image[0], []);
        $(window).on('resize', function(evt){
                showImage.apply(image[0], []);
            });
    });
    image.attr('src', '/<?php echo IMAGES_URL.$image['image_file']; ?>');
});
</script>

<canvas id="canvas" style="position:absolute;top:0;left:0;" ></canvas>
<div id="image-info-box">
<div id="image-info-title"><?php echo $image['title'] ?></div>
<div id="image-info-published"><?php echo $image['published']; ?></div>
<div id="image-info-description-box">
    <div id="image-info-description"><?php echo $image['image_description']; ?></div>
<!--     <div id="image-info-description-close"></div> -->
</div>
</div>
<!-- <div id="image"><img src="/<?php echo IMAGES_URL.$image['image_file']; ?>" /></div> -->

<div id="etiquettes">
    <div class="words">
<?php

foreach($tags as $tag)
{
	echo '
	<li>
        <a href="/tags/view/'.$tag['id'].'">
            '.$tag['tag_name'].'
        </a>
    </li>';
}

?>
</div>
</div>