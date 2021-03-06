<?php // File: /app/View/Objs/index.ctp ?>
<script>
$(document).ready(function(){
    $('#header').hide();
    });
</script>
<style>

th{
	min-width:200px;
	border-bottom:1px solid black;
}
td{
	
	text-align:center;
}

table{
	margin-left:32px;
}

.thumbnail{
/* 	width:200px; */
}
</style>

<h1>Objects</h1>


<h2><a href="/objs/add">Add a new Object to the database</a></h2>

<h4>Images</h4>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Created</th>
        <th>Tags</th>
        <th>Thumbnail</th>
    </tr>

    <!-- Here is where we loop through our $texts array, printing out text info -->

    
    <?php 
    foreach ($images as $image): 
// 	    debug($image);
	?>
    <tr>
        <td><?php 
//         echo $image['Obj']['id']; 
        echo $this->Html->link($image['Obj']['id'], array('controller' => 'objs', 'action' => 'edit', $image['Obj']['id']));
        ?></td>
        <td>
            <?php echo $this->Html->link($image['Obj']['title'], array('controller' => 'objs', 'action' => 'view', $image['Obj']['id'])); ?>
        </td>
        <td><?php echo $image['Obj']['published']; ?></td>
             <td>
        <?php
		$sep = ''; 
		foreach($image['Tag'] as $tag)
		{
            echo $sep.'<span class="tag"><a href="/tags/view/'.$tag['id'].'">'.$tag['tag_name'].'</a></span> ';
			$sep = ', ';
		}
        ?>
        </td>
        <td>
        <?php 
        //<img class="thumbnail" ... echo IMAGES_URL.$image['Obj']['image_file']
        {
            $width = 140;
            $height = 140;
            if($image['Obj']['image_height'])
            {
                $height = floor($image['Obj']['image_height'] * $width / $image['Obj']['image_width']);
                }
                $src_image = $this->Image->resize($image['Obj']['image_file'], $width, $height, true, 
                array('alt'=>'Picture of '.$image['Obj']['title'], 
                'title'=>$image['Obj']['title'], 
                'class'=>'thumbnail',
                'width'=>$width,
                'height'=>$height));
                
                echo  $src_image;
                }
        ?>
        </td>
    </tr>
    <?php endforeach; ?>
    

</table>

<h4>Texts</h4>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Created</th>
        <th>Tags</th>
    </tr>

    <!-- Here is where we loop through our $texts array, printing out text info -->

    
    <?php 
    foreach ($texts as $text): 
	?>
    <tr>
        <td><?php 
        //         echo $text['Obj']['id']; 
        echo $this->Html->link($text['Obj']['id'], array('controller' => 'objs', 'action' => 'edit', $text['Obj']['id']));
        ?></td>
        <td>
            <?php echo $this->Html->link($text['Obj']['title'], array('controller' => 'objs', 'action' => 'view', $text['Obj']['id'])); ?>
        </td>
        <td><?php echo $text['Obj']['published']; ?></td>
        <td>
        <?php
		$sep = ''; 
		foreach($text['Tag'] as $tag)
		{
            echo $sep.'<span class="tag"><a href="/tags/view/'.$tag['id'].'">'.$tag['tag_name'].'</a></span> ';
			$sep = ', ';
		}
        ?>
        </td>
    </tr>
    <?php endforeach; ?>
    

</table>