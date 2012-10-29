<?php // File: /app/View/Objs/add.ctp 

?>

<script>
$(document).ready(function(){
    $('#header').hide();
    });
var tags = {};
<?php
foreach($tags as $t)
{
	echo 'tags["'.$t['Tag']['tag_name'].'"] = '.$t['Tag']['id'].';'."\n";
}
?>
</script>


<?php

$this->Html->script('jquery', array('inline' => false));
$this->Html->script('jquery-ui-datepicker', array('inline' => false));
$this->Html->script('ao', array('inline' => false));

echo '
<h1 class="form-new-title">New Object Form</h1>
';

echo $this->Form->create('Obj', array('enctype' => "multipart/form-data"));
echo '
<div id="obj-title-box"><span id="ObjTitleLabel">Title: </span><input type="text" name="data[Obj][title]" id="ObjTitle" /></div>
<div><span id="ObjPubLabel">Pub Date: </span><input type="text" name="data[Obj][published]" id="ObjPublished" /></div>
';

echo '
<div id="form_specie">
';
echo '  
<div id="form-selector">
<div id="obj_image" class="obj_selector obj_selected">Image</div>
    <div id="obj_text" class="obj_selector">Text</div>
</div>
';

echo '
<div id="form_fragment_image" class="form_fragment">
<div id="form-image-input-block">
<span id="form-image-label">Select Image: </span>
';
echo $this->Form->file('image_file', array('label'=>'Image File: '));
echo '</div>
<div id="form-image-desc-label">Description</div>
';
echo $this->Form->input('image_description', array('label'=>''));
echo '
</div>
';


echo '  
<div id="form_fragment_text" class="form_fragment">
';
echo $this->Form->input('text_author', array('label'=>'Author'));
echo '
<div id="form-text-content-label">Content</div>
';
echo $this->Form->input('text_content', array('label'=>''));
echo '  
</div>';
echo '
</div>';


$taglist = '';

foreach($tags as $t)
{
	
	$taglist .= '
	
		<div class="tag_value">'.$t['Tag']['tag_name'].'</div>
	'."\n";
}
echo '<div id="tag_box">
<div id="labels_title">Etiquettes</div>
<div id="select_tag_box">
'.$taglist.'
</div>
<div><input type="text" id="new_tag_val" /><span id="new_tag">Add</span></div>
<div id="h_tags"></div>

';
//echo $this->Form->input('Tag.0.name', array('label'=>'Etiquette: '));


echo '<input type="hidden" name="data[Obj][obj_type]" id="obj_type" />';
echo $this->Form->end('Save Object',array('id'=>'save_button'));

?>

