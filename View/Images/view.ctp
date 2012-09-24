<!-- File: /app/View/Texts/index.ctp -->

<?php
// echo '<pre>';
// print_r($image);
// echo '</pre>';
?>

<h1><?php echo $image['Text']['title'] ?></h1>

<div class="text-author"><?php echo $image['Text']['author']; ?></div>

<div class="text-created"><?php echo $image['Text']['created']; ?></div>

<div class="text-content"><?php echo $image['Text']['content']; ?></div>

<div class="text-tags">
<?php

foreach($image['Tag'] as $tag)
{
	echo '<div class="text-tag-item">'.$tag['name'].'</div>';
}

?>
</div>