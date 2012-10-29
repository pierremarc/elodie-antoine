<?php

class TextsController extends AppController 
{
	public $helpers = array('Html', 'Form');
	
	public function index() 
	{
		$this->set('texts', $this->Text->find('all'));
	}
	
	public function view($id = null) 
	{
		$this->Text->id = $id;
		$this->set('text', $this->Text->read());
	}
}