<?php

/**
 * Menu, currently hardcoded, dunno what I'll do with it.
 */

class Menu
{
	private $home = null;
	
	public function __get($var)
	{
	    return $this->$var;
	}
	
    public function __construct()
    {
        $this->home = new stdClass();
        $this->home->url = ROOT_URL . "/";
        $this->home->title = "Latest Posts";
    }
}

?>
