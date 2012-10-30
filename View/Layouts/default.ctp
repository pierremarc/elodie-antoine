<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
        session_start();
//         debug($_SESSION['history']);
        if (!isset($_SESSION['history']) /*|| (isset($_GET['ch']) && $_GET['ch'] == '1')*/) 
        {
            $_SESSION['history'] = array();
        }
        if(isset($ref))
        {
            array_unshift($_SESSION['history'], $ref);
        }
        echo $this->Html->css('fistuline');
        echo $this->Html->css('date-picker');
        
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
    <span>
    <?php 
    $h_len = count($_SESSION['history']);
    for($i = 0; $i < $h_len; $i++)
    {
        echo '<a class="navig-link" href="'
            .$_SESSION['history'][$i]['url'].'">'
            .$_SESSION['history'][$i]['name'].' → 
            </a>';
    }
    ?>
    </span>
    </div>
</div>
	<?php echo $this->fetch('content'); ?>
</body>
</html>

<?php
// debug($ref);
// if(isset($ref))
// {
// //     if(count($_SESSION['history']) == 0)
// //         array_unshift($_SESSION['history'], $ref);
// //     else
//     {
//         $insert = true;
// //         foreach($_SESSION['history'] as $h)
// //         {
// //             if($h['url'] === $ref['url'])
// //             {
// //                 $insert = false;
// //                 break;
// //             }
// //         }
// //         debug($insert);
//         if($insert)
//             array_unshift($_SESSION['history'], $ref);
//         
//     }
// }
?>
