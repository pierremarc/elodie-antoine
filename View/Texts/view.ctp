<!-- File: /app/View/Texts/index.ctp -->

<?php
// echo '<pre>';
// print_r($text);
// echo '</pre>';
?>

<div id="header">
    <div id="name-box">
        <a class="name-link" href="contact.html">Elodie Antoine</a>
    </div>
    <div id="navig-box">
        <a class="navig-link" href="http://fr.wikipedia.org/wiki/Fistuline_h%C3%A9patique">←     contagion → metaux-lourds.jpg → corpus → Masculin caillou.txt → animal      →</a>
    </div>
    </div>
</div>

<div id ="all-text-box">
    <div id="titre-box">
        <h1 class="text-title"><?php echo $text['Text']['title'] ?></h1>

            <div class="text-author"><?php echo $text['Text']['author']; ?></div>

            <span class="text-created"><?php echo $text['Text']['created']; ?></span>

    </div>

    <div id="text-box">
        <div class="text-content"><?php echo $text['Text']['content']; ?></div>
    </div>
</div>

<div id="etiquettes">
    <div class="words">
<?php

foreach($text['Tag'] as $tag)
{
	echo '<div class="text-tag-item">'.$tag['name'].'</div>';
}

?>
</div>
</div>