<!-- File: /app/View/Texts/index.ctp -->

<?php
// echo '<pre>';
// print_r($text);
// echo '</pre>';
?>


<div id ="all-text-box">
    <div id="titre-box-main">
            <h1 class="text-title"><?php echo $text['title'] ?></h1>
            <div class="text-author"><?php echo $text['text_author']; ?></div>
            <span class="text-created"><?php echo $text['published']; ?></span>
    </div>
    <?php
//     debug($texts);
    foreach($texts as $t)
    {
        echo '
        <div class="titre-box">
        <h1 class="text-title"><a href="/objs/view/'.$t['Obj']['id'].'">'.$t['Obj']['title'].'</a></h1>
        <div class="text-author">'.$t['Obj']['text_author'].'</div>
        <span class="text-created">'.$t['Obj']['published'].'</span>
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