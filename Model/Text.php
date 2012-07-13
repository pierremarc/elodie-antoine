<?php


class Text extends AppModel 
{
	public $hasMany = array(
			'Tag' => array(
			'className'  => 'Tag',
			'order'      => 'Tag.name DESC'
			)
		);
}