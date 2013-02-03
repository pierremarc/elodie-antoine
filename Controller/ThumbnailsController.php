<?php

class ThumbnailsController extends AppController 
{
	public $helpers = array('Image');
	public $components = array('RequestHandler');
	
	public function view($id = null) 
	{
        $this->loadModel('Obj');
        $image = $this->Obj->read(null, $id);
        $this->set('thumbnail', $image);
        $this->set('thumbnail_size', array(intval($_GET['w']),intval($_GET['h'])));
	}
}
