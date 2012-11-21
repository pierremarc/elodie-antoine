<?php ?>
<!-- File: /app/View/Images.ctp -->
<script>
$(document).ready(function()
{
    var canvas = $('#canvas');
    var ctx =  canvas.get(0).getContext('2d');
    
    var image_min = {x:0, y:0};
    var image_offset = {x:0, y:0};
    function showImage(undefined){
        var ww = $(window).width();
        var wh = $(window).height();
        canvas.attr({ width:ww, height:wh, });
//         var that = $(this);
        var rr = new Geom.Rect(0,0, this.naturalWidth, this.naturalHeight);
        var wr = new Geom.Rect(0,0,ww, wh);
        rr.fitRect(wr, true);
        
        image_min.x = rr.width() - ww;
        image_min.y = rr.height() - wh;
        
        ctx.drawImage(this, rr.left(), rr.top(), rr.width(), rr.height());
        image_offset.x = rr.left();
        image_offset.y = rr.top();
    }
    var m_start_point = null;
    var image = $('<img />');
    image.on('load', function(e){
        showImage.apply(image[0], []);
        $(window).on('resize', function(evt){
                showImage.apply(image[0], []);
            });
            
            canvas.on('mousedown', function(evt){m_start_point = {x:evt.pageX, y:evt.pageY};});
            canvas.on('mouseup', function(evt){m_start_point = null;});
            canvas.on('mouseleave', function(evt){m_start_point = null;});
            canvas.on('mousemove', function(evt){
                if(m_start_point == null)
                {
                    return;
                }
                var deltaX = evt.pageX - m_start_point.x;
                var deltaY = evt.pageY - m_start_point.y;
                
                var img = image.get(0);
                var ww = $(window).width();
                var wh = $(window).height();
                var rr = new Geom.Rect(0,0, img.naturalWidth, img.naturalHeight);
                var wr = new Geom.Rect(0,0,ww, wh);
                rr.fitRect(wr, true);
                
                // limit movement to visible image
                image_offset.x = Math.min(image_offset.x + deltaX, 0);
                image_offset.x = Math.max(image_offset.x, ww - rr.width());
                image_offset.y = Math.min(image_offset.y + deltaY, 0);
                image_offset.y = Math.max(image_offset.y + deltaY, wh - rr.height());
                
                // clear surface
                ctx.clearRect(0,0,ww,wh);
                
                ctx.drawImage(img, image_offset.x, image_offset.y, rr.width(), rr.height());
                m_start_point = {x:evt.pageX, y:evt.pageY};
            });
    });
    image.attr('src', '/<?php echo IMAGES_URL.$image['image_file']; ?>');
});
</script>

<?php

$pub_date = new DateTime($image['published']);
$pdm =  $pub_date->format('m');
$pdd =  $pub_date->format('d');

$pub_date_str = $pub_date->format('d/m/Y');
if($pdm === '01' && $pdd === '01')
{
    $pub_date_str = $pub_date->format('Y');
}

?>

<canvas id="canvas" style="position:absolute;top:0;left:0;" ></canvas>
<div id="image-info-box">
<div id="image-info-title"><?php echo $image['title'] ?></div>
<div id="image-info-published"><?php echo $pub_date_str ?></div>
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