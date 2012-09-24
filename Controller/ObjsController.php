<?php

define("TEXT_T", 'text_t');
define("IMAGE_T", 'image_t');

class ObjsController extends AppController 
{
	
	public $helpers = array('Html', 'Form', 'Session');
	public $components = array('Session');
	
	public function index() 
	{
		$this->set('texts', $this->Obj->find('all', array( 'conditions' => array('obj_type' => TEXT_T))));
		$this->set('images', $this->Obj->find('all', array( 'conditions' => array('obj_type' => IMAGE_T))));
	}
	
	public function view($id = null) 
	{
		$this->Obj->id = $id;
		$obj = $this->Obj->read();
		if($obj->obj_type == text_t)
		{
			$this->set('text', $obj);
			$this -> viewPath = 'Texts';
// 			$this -> render('view');
		}
		else
		{
			$this->set('image', $obj);
			$this -> viewPath = 'Images';
		}
	}
	
	
	public function save_image($file)
	{
		if($file['error'] == '0')
		{
// 			debug('Trying to move_uploaded_file to ['.IMAGES.$file['name'].']');
			if(move_uploaded_file($file['tmp_name'], IMAGES.$file['name']))
				return $file['name'];
		}
		
		return false;
	}
		
	
	public function add() 
	{
		$this->loadModel('Tag');
		if($this->request->is('post')) 
		{
			$rw_obj = $this->data;
			$img_obj = $rw_obj['Obj']['image_file'];
			$rw_obj['Obj']['image_file'] = '';
			
			if($rw_obj['Obj']['obj_type'] == IMAGE_T)
			{
				$image = $this->save_image($img_obj);
// 				debug(var_dump($image));
				if($image)
				{
// 					debug('<div>MOVED FILE TO '.IMAGES.$image.'</div>');
					$rw_obj['Obj']['image_file'] = $image;
				}
				else
				{
// 					debug('<div>COULD NOT MOVE FILE</div>');
				}
			}
			
			debug($rw_obj);
			$result = $this->Obj->saveAll($rw_obj);
			if($result) 
			{
// 				if($rw_obj['Tag'] && count($rw_obj['Tag']) > 0)
// 				{
// 					$this->Obj.
// 				}
				$this->Session->setFlash('Your Object has been saved.');
// 				$this->redirect(array('action' => 'index'));
			} 
			else 
			{
				$this->Session->setFlash('Unable to add your object.');
			}
		}
		else
		{
			$this->set('tags', $this->Tag->find('all'));
		}
	}
}