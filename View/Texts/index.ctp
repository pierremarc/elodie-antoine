<!-- File: /app/View/Texts/index.ctp -->

<h1>Texts</h1>
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
        <td><?php echo $text['Text']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($text['Text']['title'], array('controller' => 'texts', 'action' => 'view', $text['Text']['id'])); ?>
        </td>
        <td><?php echo $text['Text']['created']; ?></td>
    </tr>
    <?php endforeach; ?>
    
    <a href="/texts/add">Add a text</a>

</table>