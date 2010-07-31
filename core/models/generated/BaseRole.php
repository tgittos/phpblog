<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseRole extends Doctrine_Record
{
  public function setTableDefinition()
  {
    $this->setTableName('role');
    $this->hasColumn('name', 'string', 20, array('type' => 'string', 'length' => '20'));
    $this->hasColumn('isAdmin', 'boolean', null, array('type' => 'boolean'));
    $this->hasColumn('isModerator', 'boolean', null, array('type' => 'boolean'));
    $this->hasColumn('isPoster', 'boolean', null, array('type' => 'boolean'));
  }

  public function setUp()
  {
    $this->hasMany('User', array('refClass' => 'RoleUser',
                                 'local' => 'role_id',
                                 'foreign' => 'user_id'));
  }
}