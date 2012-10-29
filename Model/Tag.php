<?php


class Tag extends AppModel 
{
	public $hasAndBelongsToMany = array(
        'Obj' =>
            array(
                'className'              => 'Obj',
                'joinTable'              => 'objs_tags',
                'foreignKey'             => 'tag_id',
                'associationForeignKey'  => 'obj_id',
                'unique'                 => true,
                'conditions'             => '',
                'fields'                 => '',
                'order'                  => '',
                'limit'                  => '',
                'offset'                 => '',
                'finderQuery'            => '',
                'deleteQuery'            => '',
                'insertQuery'            => ''
            )
    );
}