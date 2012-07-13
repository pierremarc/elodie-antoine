<?php

class TagsController extends AppController 
{
	public $helpers = array('Html', 'Form');

	public function index() 
	{
		$this->set('tags', $this->Tag->find('all'));
	}
	
	public function view($id = null) 
	{
		$this->Tag->id = $id;
		$this->set('tag', $this->Tag->read());
	}
}