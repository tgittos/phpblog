<?php

class Role extends BaseRole
{ 
    public function in($user)
    {
    	$in = false;
    	foreach($user->Role as $role)
    	{
    		if ($role->id == $this->id)
    			$in = true;
    	}
    	return $in;
    }
}

?>