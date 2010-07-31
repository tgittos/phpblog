<?php

class User extends BaseUser
{
	public static function getByUsername($username)
	{
	    $users = Doctrine_Query::create()
        		->from('User u')
            	->where('u.username = ?', $username)
            	->execute();
	    return $users[0];
	}
}

?>