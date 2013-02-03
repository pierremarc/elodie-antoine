<?php session_start();?><!DOCTYPE html>
<html>
<head>
	<?php 
	echo $this->Html->charset(); 
	echo $this->Html->meta('icon',$this->webroot.'favicon.png', array('type' => 'icon'));
	?>
	
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
//         debug($_SESSION);
        if (!isset($_SESSION['history']) || isset($_GET['ch']))
        {
            $_SESSION['history'] = array();
        }
//         error_log('H => '.(count($_SESSION['history'])).' ['.$ref['ip'].']');
        if(isset($ref) && $ref['mark'])
        {
            $mark_it = true;
            foreach($_SESSION['history'] as $sh)
            {
                if($sh['url'] === $ref['url'])
                {
                    $mark_it = false;
                    break;
                }
            }
            if($mark_it)
            {
                array_push($_SESSION['history'], array('url'=>$ref['url'], 'name' => $ref['name']));
            }
            echo '
            <meta property="og:url" content="http://elodieantoine.be'.$ref['url'].'" />
            ';
            
        }
        if(count($_SESSION['history']) > 4)
        {
            array_shift($_SESSION['history']);
        }
        echo $this->Html->css('fistuline');
        if(isset($is_admin) && $is_admin)
        {
            echo $this->Html->css('date-picker');
            echo $this->Html->css('colorpicker');
            echo $this->Html->css('/js/markitup/skins/simple/style');
            echo $this->Html->css('/js/markitup/sets/markdown/style');
        }
        
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
        <div id="info-box">
        <a id="infos-link" href="/infos.html">Infos</a>
        </div>
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
