<!-- File: /app/View/Texts/index.ctp -->

<?php
// echo '<pre>';
// print_r($text);
// echo '</pre>';
?>


<div id ="all-text-box">
    <div id="titre-box">
        <h1 class="text-title"><?php echo $text['title'] ?></h1>

            <div class="text-author"><?php echo $text['text_author']; ?></div>

            <span class="text-created"><?php echo $text['published']; ?></span>

    </div>

    <div id="text-box">
        <div class="text-content"><?php echo $text['text_content']; ?></div>
    </div>
</div>

<div id="etiquettes">
    <div class="words">
<?php

foreach($tags as $tag)
{
    echo '<div class="text-tag-item">'.$tag['tag_name'].'</div>';
}

?>
</div>
</div>