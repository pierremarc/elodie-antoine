<?php
// View/Tags/index.ctp

// debug($tags);
// return;
$ot = array();
foreach($tags as $t)
{
    if(!isset($t['Tag']['tag_name'][0]))
        continue;
        
    $fl = strtoupper($t['Tag']['tag_name'][0]);
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


?>


<div id="tags-index-box">

<?php
$col_count = 4;
$g_count = count($ot);
$per_col = ceil($g_count / $col_count);
$count = 0;
$icount = 0;
$cols = array();
for($i = 0; $i < $col_count; $i++)
{
    $cols[$i] = array();
}
foreach($ot as $tl=>$ta)
{
//     echo '<div class="list-letter">'.(intval($tl) > 0 ? '' : $tl).'</div>';
    if($icount >= $per_col)
    {
        $icount = 0;
        $count += 1;
    }
    
    $cols[$count][] = '<div class="list-letter">'.(intval($tl) > 0 ? '' : $tl).'</div>';
    foreach($ta as $t)
    {
        $cols[$count][] = '<div class="tag-box"><a href="/tags/view/'.$t['id'].'"> '.$t['tag_name'].' </a></div>';
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