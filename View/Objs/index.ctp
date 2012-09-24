<?php // File: /app/View/Objs/index.ctp ?>

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
	width:200px;
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
        <th>Thumbnail</th>
    </tr>

    <!-- Here is where we loop through our $texts array, printing out text info -->

    
    <?php 
    foreach ($images as $image): 
// 	    var_dump($image);
	?>
    <tr>
        <td><?php echo $image['Obj']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($image['Obj']['title'], array('controller' => '$image', 'action' => 'view', $image['Obj']['id'])); ?>
        </td>
        <td><?php echo $image['Obj']['published']; ?></td>
        <td><img class="thumbnail" src="<?php echo IMAGES_URL.$image['Obj']['image_file']; ?>" /></td>
    </tr>
    <?php endforeach; ?>
    

</table>

<h4>Texts</h4>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Created</th>
    </tr>

    <!-- Here is where we loop through our $texts array, printing out text info -->

    
    <?php 
    foreach ($texts as $text): 
	?>
    <tr>
        <td><?php echo $text['Obj']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($text['Obj']['title'], array('controller' => 'texts', 'action' => 'view', $text['Obj']['id'])); ?>
        </td>
        <td><?php echo $text['Obj']['published']; ?></td>
    </tr>
    <?php endforeach; ?>
    

</table>