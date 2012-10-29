<?php

class TagsController extends AppController 
{
	public $helpers = array('Html', 'Form');
	public $components = array('RequestHandler');

	public function index() 
	{
		$this->set('tags', $this->Tag->find('all'));
	}
	
	public function view($id = null) 
	{
		$this->Tag->id = $id;
		$tag = $this->Tag->read();
		
		$this->set('ref', array('url'=>'/tags/view/'.$id, 'name'=>$tag['Tag']['tag_name']));
		
		$tag_name = $tag['Tag']['tag_name'];
		$this->set('Tag', $tag['Tag']);
// 		debug($tag);
		$this->set('Objs', $tag['Obj']);
		$tags = array();
		foreach($tag['Obj'] as $o)
		{
//             $o = $vo->read();
            foreach($o['ObjsTag'] as $tid)
            {
                if(!array_key_exists($tid, $tags))
                {
                    $this->Tag->id = $tid;
                    $ot = $this->Tag->read();
                    if($ot['Tag']['tag_name'] !== $tag_name)
                        $tags[$tid] = $ot['Tag'];
                }
                else
                {
//                     $tags[$tid] += 1;
                }
            }
		}
		$this->set('Tags', $tags);
	}
	
	public function add() 
	{
		$this->layout = 'ajax';
		if($this->request->is('post')) 
		{
            $t = $this->Tag->findByTagName($this->request->data['Tag']['tag_name'], array('id','tag_name'));
//             $tag = $this->Tag->read();
			if($t == false)
			{
				$result = $this->Tag->saveAll($this->request->data);
				if($result)
				{
					$this->Session->setFlash('Your Tag has been saved.');
// 					print_r();
					$this->set('tag', array('result'=>true, 
								'tag' => array('id' => $this->Tag->id,
								'tag_name' => $this->request->data['Tag']['tag_name'] )));
					
				} 
				else 
				{
					$this->Session->setFlash('Unable to add your object.');
					$this->set('tag', array('result'=>false, 
					'error'=>'Could not save Tag('.$this->request->data['Tag']['tag_name'].')'));
				}
			}
			else
			{
				$this->set('tag', array('result' => false,
				'error'=>'Tag('.$this->request->data['Tag']['tag_name'].') already registered'));
			}
		}
		
	}
}