<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
        session_start();
        if (!isset($_SESSION['history'])) 
        {
            $_SESSION['history'] = array($ref);
        }
        echo $this->Html->css('fistuline');
        
        $this->Html->script('jquery', array('inline' => false));
        $this->Html->script('geom', array('inline' => false));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
<div id="header">
    <div id="name-box">
        <a class="name-link" href="contact.html">Elodie Antoine</a>
    </div>
    <div id="navig-box">
    <?php 
    $h_len = min(5, count($_SESSION['history']));
    for($i = 0; $i < $h_len; $i++)
    {
        echo '<a class="navig-link" href="'
            .$_SESSION['history'][$i]['url'].'">'
            .$_SESSION['history'][$i]['name'].' → 
            </a>';
    }

    ?>
    </div>
</div>
	<?php echo $this->fetch('content'); ?>
</body>
</html>

<?php
if(isset($href))
{
    if(count($_SESSION['history']) == 0)
        array_unshift($_SESSION['history'], $ref);
    else
    {
        $insert = true;
            foreach($_SESSION['history'] as $h)
            {
                if($h['url'] === $ref['url'])
                {
                    $insert = false;
                    break;
                }
            }
            if($insert)
                array_unshift($_SESSION['history'], $ref);
        
    }
}
?>
