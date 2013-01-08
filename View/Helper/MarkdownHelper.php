<?php 

App::uses('Helper', 'View');
App::uses('MarkdownParser', 'Lib');

class MarkdownHelper extends Helper { 
    
    public $helpers = array('Html'); 
    public function __construct()
    {
        $this->parser = new MarkdownParser();
    }
    public function tr($txt)
    {
        return $this->parser->transform($txt);
    }
} 
?> 