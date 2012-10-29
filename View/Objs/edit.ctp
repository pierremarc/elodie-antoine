<?php // File: /app/View/Objs/edit.ctp ?>

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
<h1 class="form-new-title">Edit Object Form</h1>
';

echo $this->Form->create('Obj', array('enctype' => "multipart/form-data"));
echo '
<div id="obj-title-box"><span id="ObjTitleLabel">Title: </span><input type="text" name="data[Obj][title]" id="ObjTitle" value="'.$Obj['Obj']['title'].'" /></div>
<div><span id="ObjPubLabel">Pub Date: </span><input type="text" name="data[Obj][published]" id="ObjPublished" value="'.$Obj['Obj']['published'].'" /></div>
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
<img width="132" src="/'.IMAGES_URL.$Obj['Obj']['image_file'].'" style="float:right" />
<div id="form-image-input-block">
<span id="form-image-label">Select Image: </span>
';
echo $this->Form->file('image_file', array('label'=>'Image File: '));
echo '</div>
<div id="form-image-desc-label">Description</div>
';
echo $this->Form->input('image_description', array('label'=>'', 'default'=>$Obj['Obj']['image_description']));
echo '
</div>
';


echo '  
<div id="form_fragment_text" class="form_fragment">
';
echo $this->Form->input('text_author', array('label'=>'Author', 'default'=>$Obj['Obj']['text_author']));
echo '
<div id="form-text-content-label">Content</div>
';
echo $this->Form->input('text_content', array('label'=>'', 'default'=>$Obj['Obj']['text_content']));
echo '  
</div>';
echo '
</div>';


$taglist = '';
$h_tags = array();

foreach($tags as $t)
{
    $tid = $t['Tag']['id'];
    $attached = false;
    foreach($Obj['Tag'] as $ot)
    {
        if($ot['id'] == $tid)
        {
            $attached = true;
            break;
        }
    }
    if($attached)
    {
        $taglist .= '
        <div class="tag_value tag_selected">'.$t['Tag']['tag_name'].'</div>
        ';
        $htag = '<input class="input_tag_selected"  type="hidden" name="data[Tag][Tag]['.count($h_tags).']" value="'.$tid.'" />';
        array_push($h_tags, $htag);
    }
    else
    {
        $taglist .= '
            <div class="tag_value">'.$t['Tag']['tag_name'].'</div>
        ';
	}
}



echo '<div id="tag_box">
<div id="labels_title">Etiquettes</div>
<div id="select_tag_box">
'.$taglist.'
</div>
<div><input type="text" id="new_tag_val" /><span id="new_tag">Add</span></div>
<div id="h_tags">'.implode('',$h_tags).'</div>

';
//echo $this->Form->input('Tag.0.name', array('label'=>'Etiquette: '));


echo '<input type="hidden" name="data[Obj][obj_type]" id="obj_type" value="'.$Obj['Obj']['obj_type'].'"/>';
echo $this->Form->end('Save Object',array('id'=>'save_button'));

?>

