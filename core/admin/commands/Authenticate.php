<?php

/**
 * Commands
 * Static class, holding all commands for the app
 */

class Authenticate
{
	private $message = null;
	
	public function Message()
	{
	    return self::$message;
	}
	
    public function execute($username, $password)
    {
        if(	is_null($username) ||
 			is_null($password))
 		{
 		    self::$message = "Missing username or password";
 		    return false;
 		}
 		else
 		{
	 		$user = User::getByUsername($username);
	 		if (!is_null($user))
	 		{
	 			if (hash('whirlpool', $password) == $user->password)
	 			{
    	 			$_SESSION['username'] = $user->username;
	 				$_SESSION['user_id'] = $user->id;
	 				return true;
	 			}
	 				
	 			else
	 				self::$message = "Wrong username or password";
	 		}
	 		else
	 			self::$message = "Wrong username or password";
 		}
    }
}

?>
