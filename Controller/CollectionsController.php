<?php

class ImagesController extends AppController 
{
	public $helpers = array('Html', 'Form');

	public function index() 
	{
		$this->set('images', $this->Image->find('all'));
	}
	
		
	public function view($id = null) 
	{
		$this->Image->id = $id;
		$this->set('image', $this->Image->read());
	}
}
