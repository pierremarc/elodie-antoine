<?php

class TagsController extends AppController 
{
	public $helpers = array('Html', 'Form');
	public $components = array('RequestHandler');

	public function index() 
	{
		$this->set('tags', $this->Tag->find('all'));
	}
	
	public function tag($t_name = null)
	{
        if(!$t_name)
        {
            $this->index();
            return;
        }
        $tag = $this->Tag->findByTagName($t_name);
        if($tag)
        {
            $this->view($tag['Tag']['id']);
            $this->render('view');
        }
        else
        {
            $this->index();
            return;
        }
	}
	
	public function view($id = null) 
	{
        $this->helpers[] = 'Image';
        $this->helpers[] = 'Markdown';
		$this->Tag->id = $id;
		$tag = $this->Tag->read();
		$this->loadModel('Obj');
		
		$this->set('ref', array('ip' => $this->request->url, 'mark' => true, 'url'=>'/tags/view/'.$id, 'name'=>$tag['Tag']['tag_name']));
		
		$tag_name = $tag['Tag']['tag_name'];
        $this->set('page_title', $tag_name);
        
		$this->set('Tag', $tag['Tag']);
		$sort_objs = Set::sort($tag['Obj'], '{n}.published', 'desc');
		$this->set('Objs', $sort_objs);
		$tags = array();
		foreach($tag['Obj'] as $o)
		{
            $oo = $this->Obj->read(null, $o['id']);
//             debug($oo);
            foreach($oo['Tag'] as $trel)
            {
                $tid = $trel['id'];
                if(!array_key_exists($tid, $tags))
                {
                    $ot = $this->Tag->read(null, $tid);
//                     debug($ot ? $ot : $tid);
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
	
	public function remove($id)
	{
        $this->Tag->delete($id);
        $this->autoRender = false;
    }
}