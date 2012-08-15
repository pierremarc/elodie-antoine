<!-- File: /app/View/Texts/index.ctp -->

<?php
// echo '<pre>';
// print_r($text);
// echo '</pre>';
?>

<h1><?php echo $text['Text']['title'] ?></h1>

<div class="text-author"><?php echo $text['Text']['author']; ?></div>

<div class="text-created"><?php echo $text['Text']['created']; ?></div>

<div class="text-content"><?php echo $text['Text']['content']; ?></div>

<div class="text-tags">
<?php

foreach($text['Tag'] as $tag)
{
	echo '<div class="text-tag-item">'.$tag['name'].'</div>';
}

?>
</div>