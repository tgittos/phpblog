<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BasePost extends Doctrine_Record
{
  public function setTableDefinition()
  {
    $this->setTableName('post');
    $this->hasColumn('title', 'string', 200, array('type' => 'string', 'notnull' => true, 'length' => '200'));
    $this->hasColumn('content', 'string', null, array('type' => 'string', 'notnull' => true));
    $this->hasColumn('user_id', 'int', 50, array('type' => 'int', 'length' => '50'));
    $this->hasColumn('date', 'date', null, array('type' => 'date', 'notnull' => true));
    $this->hasColumn('url', 'string', 200, array('type' => 'string', 'notnull' => true, 'length' => '200'));
    $this->hasColumn('description', 'string', 500, array('type' => 'string', 'notnull' => true, 'length' => '500'));


    $this->index('postindex', array('fields' => array(0 => 'url', 1 => 'user_id')));
  }

  public function setUp()
  {
    $this->hasOne('User', array('local' => 'user_id',
                                'foreign' => 'id'));

    $this->hasMany('Category', array('refClass' => 'CategoryPost',
                                     'local' => 'post_id',
                                     'foreign' => 'category_id'));
  }
}