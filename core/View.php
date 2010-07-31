<?php

/**
 * HTML view
 */
 
 class View
 {
 	private $vars = Array();
 	
 	public function __construct()
 	{
 		//Constants
 	    foreach(get_defined_constants() as $key => $value)
 	    {
 	        $this->$key = $value;
 	    }
 	    //User information
 	    $this->loggedIn = isset($_SESSION['username']);
 	    $this->username = $_SESSION['username'];
 	    //Register PHPTales extensions
 	    $instance = PHPTAL_TalesRegistry::getInstance();
 	    $instance->registerPrefix('date', array('TalesExtensions', 'date'));
 	}
 	
 	public function __set($var, $val)
 	{
 		$this->vars[$var] = $val;
 	}
 	
 	public function __get($var)
 	{
 		if (isset($this->vars[$var]))
 			return $this->vars[$var];
 		return null;
 	}
    
 	public function display()
 	{
 		$mode = Request::getInstance()->mode;
 		$template = $this->template->$mode->main;
 		if (is_null($template))
 			$template = $this->template->blog->main;
 		echo $this->get($template);
 	}
 	
 	public function get($template)
 	{
 		$tal = new PHPTAL($template);
 		foreach($this->vars as $key => $val)
 		{
 		    $tal->$key = $val;
 		}
 		return $tal->execute();
 	}
 }

?>
