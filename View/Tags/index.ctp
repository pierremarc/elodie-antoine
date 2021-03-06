<?php
// View/Tags/index.ctp

// debug($tags);
// return;
$ot = array();
$yt = array();
foreach($tags as $t)
{
    if(!isset($t['Tag']['tag_name'][0]))
        continue;
        
    $fl = mb_strtoupper(mb_substr($t['Tag']['tag_name'], 0, 1));
//     echo '<pre>=> '.$fl.'</pre>' ;
    $fl = str_replace(array('É','À'), array('E','A'), $fl);
//     echo '<pre>=> '.$fl.'</pre>' ;
    if($fl === '2')
    {
        $yt[] =  $t['Tag'];
        continue;
    }
    
    if(!isset($ot[$fl]))
    {
        $ot[$fl] = array();
    }
    $ot[$fl][] = $t['Tag'];
}
ksort($ot);
// debug($ot);
function sort_tags($a, $b)
{
    return strcmp($a["tag_name"], $b["tag_name"]);
}

foreach($ot as $k => $v)
{
    usort($ot[$k], "sort_tags");
}

usort($yt, "sort_tags");

// array_unshift($ot, array('years' => $yt));

$ott = array();
$ott[] = array('',  $yt );
foreach($ot as $tl=>$ta)
{
    $ott[] = array($tl, $ta);
    error_log('O ['.$tl.']['.count($ta).']');
}
// debug($ott);
?>


<div id="tags-index-box">

<?php
$col_count = 6;
$g_count = count($ot);
$per_col = ceil($g_count / $col_count);
$count = 0;
$icount = 0;
$cols = array();
for($i = 0; $i < $col_count; $i++)
{
    $cols[$i] = array();
}
foreach($ott as $group)
{
    $tl= $group[0];
    $ta= $group[1];
//     echo '<div class="list-letter">'.(intval($tl) > 0 ? '' : $tl).'</div>';
    if($icount >= $per_col)
    {
        $icount = 0;
        $count += 1;
    }
    
    $cols[$count][] = '<div class="list-letter">'.(intval($tl) > 0 ? '' : $tl).'</div>';
    foreach($ta as $t)
    {
        if(isset($t['id']))
        {
            if($loggedIn)
            {
                $cols[$count][] = '
                <div class="tag-box">
                <a href="/tags/view/'.$t['id'].'"> '.$t['tag_name'].' </a>
                <span class="tag-remove" data-tid="'.$t['id'].'">[del]</span>
                </div>';
            }
            else
            {
                $cols[$count][] = '<div class="tag-box"><a href="/tags/view/'.$t['id'].'"> '.$t['tag_name'].' </a></div>';
            }
        }
    }
    $icount += 1;
//     echo '</div>';
}
foreach($cols as $c)
{
    echo '<div class="tags-col">'.implode($c).'</div>';
}
?>

</div>

<script>
$(document).ready(function(){
    $('.tag-remove').on('click', function(evt){
        var self = $(this);
        var tid = self.attr('data-tid');
        $.get('/tags/remove/'+tid, function(){
            self.parent().remove();
        });
    });
});
</script>