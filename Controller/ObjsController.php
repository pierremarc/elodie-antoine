<?php

define("TEXT_T", 'text_t');
define("IMAGE_T", 'image_t');

class ObjsController extends AppController 
{
	
	public $helpers = array('Html', 'Form', 'Session');

        
	public function index() 
	{
        if(isset($_GET['cc']))
        {
            clearCache();
        }
		$this->set('texts', $this->Obj->find('all', array( 'conditions' => array('obj_type' => TEXT_T))));
		$this->set('images', $this->Obj->find('all', array( 'conditions' => array('obj_type' => IMAGE_T))));
	}
	
	public function view($id = null) 
	{
        $this->helpers[] = 'Image';
        $this->helpers[] = 'Markdown';
		$this->Obj->id = $id;
		$this->Obj->read();
		
		$this->set('ref', array('url'=>'/objs/view/'.$id, 'name'=>$this->Obj->data['Obj']['title']));
		$this->set('page_title', $this->Obj->data['Obj']['title']);
		$obj = $this->Obj->data['Obj'];
		$this->set('tags', $this->Obj->data['Tag']);
		if($obj['obj_type'] == TEXT_T)
		{
            $this->set('text', $obj);
            $this->set('texts', $this->Obj->find('all', array('conditions' => array('obj_type'=>TEXT_T , 'id <>'=>$obj['id']))));
			$this->viewPath = 'Texts';
		}
		else
		{
			$this->set('image', $obj);
			$this->viewPath = 'Images';
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
				if($image)
				{
					$rw_obj['Obj']['image_file'] = $image;
					$isize = getimagesize(IMAGES.$image);
					$rw_obj['Obj']['image_width'] = $isize[0];
					$rw_obj['Obj']['image_height'] = $isize[1];
				}
			}
			
			$result = $this->Obj->saveAll($rw_obj);
			if($result) 
			{
				$this->Session->setFlash('Your Object has been saved.');
				$this->redirect(array('action' => 'index'));
			} 
			else 
			{
				$this->Session->setFlash('Unable to add your object.');
			}
		}
		else
		{
            $this->set('tags', $this->Tag->find('all',array('order'=> array('Tag.tag_name'))));
		}
	}
	
    public function edit($id = null) 
    {
        $this->Obj->id = $id;
        if ($this->request->is('get')) 
        {
            $this->loadModel('Tag');
            $this->set('Obj', $this->Obj->read());
            $this->set('tags', $this->Tag->find('all', array('order'=> array('Tag.tag_name'))));
        } 
        else 
        {
            $old_obj = $this->Obj->read();
            $rw_obj = $this->request->data;
            $img_obj = $rw_obj['Obj']['image_file'];
            $rw_obj['Obj']['image_file'] = '';
            
            if($rw_obj['Obj']['obj_type'] == IMAGE_T)
            {
                if($this->request->data['img_update'] == '1')
                {
                    $image = $this->save_image($img_obj);
                    if($image)
                    {
                        $rw_obj['Obj']['image_file'] = $image;
                        $isize = getimagesize(IMAGES.$image);
                        $rw_obj['Obj']['image_width'] = $isize[0];
                        $rw_obj['Obj']['image_height'] = $isize[1];
                    }
                }
                else
                {
                    $rw_obj['Obj']['image_file'] = $old_obj['Obj']['image_file'];
                    $rw_obj['Obj']['image_width'] = $old_obj['Obj']['image_width'];
                    $rw_obj['Obj']['image_height'] = $old_obj['Obj']['image_height'];
                }
            }
            $rw_obj['Obj']['id'] = $old_obj['Obj']['id'];
//             debug($rw_obj);
            $result = $this->Obj->save($rw_obj);
            if($result) 
            {
                $this->Session->setFlash('Your Object has been saved.');
                $this->redirect(array('action' => 'index'));
            } 
            else 
            {
                $this->Session->setFlash('Unable to add your object.');
            }
        }
    }
}