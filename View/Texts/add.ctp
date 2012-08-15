<!-- File: /app/View/Texts/add.ctp -->

<h1>Add Text</h1>
<?php
echo $this->Form->create('Text');
echo $this->Form->input('title');
echo $this->Form->input('author');
echo $this->Form->input('content', array('label'=>'Content','rows' => '12'));
echo $this->Form->input('Tag.0.name', array('label'=>'Etiquette'));
echo $this->Form->end('Save Text');
?>