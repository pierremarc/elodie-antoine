<?php // File: /app/View/Tags/view.ctp ?>
<script>

$(document).ready(function(evt){
    function layout_pieces(){
        var piece = $('#pieces');
        var pw = piece.width();
//         console.log('PW '+pw);
    //     var ph = piece.height();
        var cur_x = piece.offset().left;
        var cur_y = new Array();
        var right = pw + cur_x;
//         console.log('R '+right);
        cur_y.push(piece.offset().top);
        var blocks = $('.piece-block');
        var bcount = blocks.length;
        var cur_col = -1;
        var gap = 15;
        blocks.each(function(idx, elem){
            var e = $(elem);
            if((cur_x + e.outerWidth() + gap) > right)
            {
                cur_x = piece.offset().left;
                cur_col = 0;
            }
            else 
            {
                cur_col += 1;
                if(cur_col > cur_y.length - 1)
                {
                    cur_y.push(piece.offset().top);
                }
            }
//             console.log('C '+cur_col +'; Y '+cur_y[cur_col] + '; H '+e.outerHeight() );
            e.css({
                top:(cur_y[cur_col] + gap) + 'px',
                left:(cur_x + gap) +'px'
            });
            cur_y[cur_col] = cur_y[cur_col] + gap + e.outerHeight();
            cur_x = cur_x + gap + e.outerWidth();
//             console.log('=> Y '+cur_y[cur_col] );
        });
    }
    $(window).on('resize', layout_pieces);
    layout_pieces();
});
</script>


<div id="pieces">
<?php

foreach($Objs as $obj)
{
    $type = $obj['obj_type'];
    if($type === 'text_t')
    {
        $author = strlen(trim($obj['text_author'])) > 0 ? $obj['text_author'] . ', ' : '';
        echo '
        <div id="o_'.$obj['id'].'" class="text-collection-box piece-block" style="background-color:#'.$obj['text_color'].'">
        <h1 class="text-title"><a href="/objs/view/'.$obj['id'].'">'.$obj['title'].'</a></h1>
        <div class="text-author"> '.$author.$obj['published'].'</div>
        <div class="text-content-collec">'.$obj['text_content'].'</div>
        </div>';
    }
    else
    {
        $width = 320;
        $height = 300;
        if($obj['image_height'])
        {
            $height = floor($obj['image_height'] * $width / $obj['image_width']);
        }
        $src_image = $this->Image->resize($obj['image_file'], $width, $height, true, 
        array('alt'=>'Picture of '.$obj['title'], 
            'title'=>$obj['title'], 
            'class'=>'pict-img',
            'width'=>$width,
            'height'=>$height));
        echo '
        <div id="o_'.$obj['id'].'" class="pict-box piece-block">
        <a href="/objs/view/'.$obj['id'].'">
        '.$src_image.'
            <span class="pict-cartel">'.$obj['title'].'</span>
        </a>
        </div>';
    }
}

?>
</div>


<div id="all-etiquettes"><a href="/tags" class="words">Index</a></div>
<div id="etiquettes">
<div class="high-word">
<a href="" class="high-word" href="/tags/view/<?php echo $Tag['id'] ?>"><?php echo $Tag['tag_name'] ?></a>
</div>

<ul class="words">
<?php

// print_r($Tags);
foreach($Tags as $t)
{
    echo '<li><a href="/tags/view/'.$t['id'].'">'.$t['tag_name'].'</a></li>';
}
?>
</ul>

</div>
