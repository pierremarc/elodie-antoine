<!-- File: /app/View/Texts/add.ctp -->

<h1>Add Text</h1>
<?php
echo $this->Form->create('Text');
echo $this->Form->input('title');
echo $this->Form->input('author');
echo $this->Form->input('content', array('rows' => '32'));
echo $this->Form->end('Save Text');
?>