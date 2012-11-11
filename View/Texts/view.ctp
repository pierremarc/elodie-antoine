<!-- File: /app/View/Texts/index.ctp -->

<?php
// echo '<pre>';
// print_r($text);
// echo '</pre>';
$pub_date = new DateTime($text['published']);
$pdm =  $pub_date->format('m');
$pdd =  $pub_date->format('d');

$pub_date_str = $pub_date->format('d/m/Y');
if($pdm === '01' && $pdd === '01')
{
    $pub_date_str = $pub_date->format('Y');
    }

?>



<div id ="all-text-box">
    <div id="titre-box-main">
            <h1 class="text-title"><?php echo $text['title'] ?></h1>
            <div class="text-author"><?php echo $text['text_author']; ?>, <span class="text-created"><?php echo $pub_date_str; ?></span></div>
            
    </div>
    <?php
//     debug($texts);
    foreach($texts as $t)
    {
        $pub_date = new DateTime($t['Obj']['published']);
        $pdm =  $pub_date->format('m');
        $pdd =  $pub_date->format('d');
        
        $pub_date_str = $pub_date->format('d/m/Y');
        if($pdm === '01' && $pdd === '01')
        {
            $pub_date_str = $pub_date->format('Y');
        }
            
        echo '
        <div class="titre-box">
        <h1 class="text-title"><a href="/objs/view/'.$t['Obj']['id'].'">'.$t['Obj']['title'].'</a></h1>
        <div class="text-author">'.$t['Obj']['text_author'].', <span class="text-created">'.$pub_date_str.'</span></div>
        
        </div>
        ';
    }
    ?>

    <div id="text-box">
        <div class="text-content"><?php echo $text['text_content']; ?></div>
    </div>
</div>

<div id="etiquettes">
    <div class="words">
<?php

foreach($tags as $tag)
{
    echo '<li><a href="/tags/view/'.$tag['id'].'">'.$tag['tag_name'].'</a></li>';
}

?>
</div>
</div>