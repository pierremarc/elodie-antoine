<?php

class TagsController extends AppController 
{
	public $helpers = array('Html', 'Form');
	public $components = array('RequestHandler');

	public function index() 
	{
		$this->set('tags', $this->Tag->find('all'));
// 		$this->set('_serialize', array('tags'));
	}
	
	public function view($id = null) 
	{
		$this->Tag->id = $id;
		$this->set('tag', $this->Tag->read());
	}
	
	public function add() 
	{
		$this->layout = 'ajax';
		if($this->request->is('post')) 
		{
			$t = $this->Tag->findByName($this->request->data['Tag']['name'], array('id','name'));
			if($t == false)
			{
				$result = $this->Tag->saveAll($this->request->data);
				if($result)
				{
					$this->Session->setFlash('Your Tag has been saved.');
					$this->set('tag', array('result'=>true, 
								'tag' => array('id' => $this->Tag->id,
										'name' => $this->Tag->name )));
					
				} 
				else 
				{
					$this->Session->setFlash('Unable to add your object.');
					$this->set('tag', array('result'=>false, 
							'error'=>'Could not save Tag('.$this->request->data['Tag']['name'].')'));
				}
			}
			else
			{
				$this->set('tag', array('result' => false,
							'error'=>'Tag('.$this->request->data['Tag']['name'].') already registered'));
			}
		}
		
	}
}