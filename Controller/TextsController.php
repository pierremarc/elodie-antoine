<?php

class TextsController extends AppController 
{
	public $helpers = array('Html', 'Form', 'Session');
	public $components = array('Session');
	
	public function index() 
	{
		$this->set('texts', $this->Text->find('all'));
	}
	
	public function view($id = null) 
	{
		$this->Text->id = $id;
		$this->set('text', $this->Text->read());
	}
	
	 public function add() 
	 {
		if($this->request->is('post')) 
		{
			if($this->Text->save($this->request->data)) 
			{
				$this->Session->setFlash('Your text has been saved.');
				$this->redirect(array('action' => 'index'));
			} 
			else 
			{
				$this->Session->setFlash('Unable to add your text.');
			}
		}
	}
}