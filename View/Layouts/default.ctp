<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	
	<title>
		<?php 
		$meta_page_title = $title_for_layout;
		if(isset($page_title))
        {
            $meta_page_title = $page_title;
        }
        echo $meta_page_title;
        ?>
	</title>
	
	<meta property="og:title" content="<?php echo $meta_page_title; ?>" />
	<meta property="og:type" content="design" />
	<?php
	if(isset($image))
    {
        $meta_og_image = $this->Image->resize($image['image_file'], 300, 300, true, array(), true, true);
        echo '<meta property="og:image" content="http://elodieantoine.be'.$meta_og_image.'" />';
    }
	?>
	<meta property="og:site_name" content="Elodie Antoine" />
	<meta property="fb:admins" content="100000916811655" />
	
	<?php
        session_start();
//         debug($_SESSION['history']);
        if (!isset($_SESSION['history']) || isset($_GET['ch']))
        {
            $_SESSION['history'] = array();
        }
        if(isset($ref))
        {
//             array_unshift($_SESSION['history'], $ref);
            $_SESSION['history'][] = $ref;
            echo '
            <meta property="og:url" content="http://elodieantoine.be'.$ref['url'].'" />
            ';
            
        }
        if(count($_SESSION['history']) > 4)
        {
            array_shift($_SESSION['history']);
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
        <a class="name-link" href="/">Elodie Antoine</a>
    </div>
    <div id="info-box">
        <a id="infos-link" href="/">Infos</a>
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
	
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
             js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1&appId=468664809842172";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
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
