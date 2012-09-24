<?php // File: /app/View/Objs/add.ctp ?>
<style>

input[type=text]{
	font-size:14pt;
	border-bottom:2px solid #888;
}
textarea{
	width:450px;
	height:450px;
	border:1px solid #006;
}
label { 
	vertical-align:top; 
}
.obj_selector, .add_tag{
	cursor:pointer;
}
</style>

<script>
var tags = {};
<?php
foreach($tags as $t)
{
	echo 'tags["'.$t['Tag']['name'].'"] = '.$t['Tag']['id'].';'."\n";
}
?>
</script>


<?php

$this->Html->script('jquery', array('inline' => false));
$this->Html->script('ao', array('inline' => false));

echo '<h1>New Object Form</h1>';

echo $this->Form->create('Obj', array('enctype' => "multipart/form-data"));
echo 'Title: <input type="text" name="data[Obj][title]" id="ObjTitle" />';

echo '<div id="form_specie">';
echo '<div id="obj_image" class="obj_selector">New Image</div> 
	<div id="form_fragment_image" class="form_fragment">';
	
echo $this->Form->file('image_file', array('label'=>'Image File: '));
echo $this->Form->input('image_description', array('label'=>'Description: ','rows' => '12'));
// echo $this->Form->end('Upload');

echo '</div>';


echo '<div id="obj_text" class="obj_selector">New Text</div>
	<div id="form_fragment_text" class="form_fragment">';
echo $this->Form->input('text_author');
echo $this->Form->input('text_content', array('label'=>'Content: ','rows' => '12'));
echo '</div>';
echo '</div>';


$taglist = '';

foreach($tags as $t)
{
	
	$taglist .= '
	<div class="tag">
		<span class="action_tag add_tag"> (+) </span>
		<span class="tag_value">'.$t['Tag']['name'].'</span>
	</div>'."\n";
}
echo '<div id="tag_box">
<h2>Etiquettes</h2>
<div><input type="text" id="new_tag_val" /><span id="new_tag">New tag</span></div>
<div id="selected_tag_box"></div>
<div id="select_tag_box">
'.$taglist.'
</div>
</div>';
//echo $this->Form->input('Tag.0.name', array('label'=>'Etiquette: '));


echo '<input type="hidden" name="data[Obj][obj_type]" id="obj_type" />';
echo $this->Form->end('Save');
?>