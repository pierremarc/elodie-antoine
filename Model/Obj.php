<?php

// Obj


class Obj extends AppModel
{
	public $hasAndBelongsToMany = array(
        'Tag' =>
            array(
                'className'              => 'Tag',
                'joinTable'              => 'objs_tags',
                'foreignKey'             => 'obj_id',
                'associationForeignKey'  => 'tag_id',
                'unique'                 => false,
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