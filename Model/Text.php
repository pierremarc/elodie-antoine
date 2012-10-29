<?php


class Text extends AppModel 
{
	public $hasMany = array(
			'Tag' => array(
			'className'  => 'Tag',
			'order'      => 'Tag.tag_name DESC'
			)
		);
}