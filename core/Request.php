<?php

/**
 * Request
 * Parses $_FORM and $_GET superglobals.
 * Enables auto filtering
 */
 
class Request
{
	private static $instance = null;
 	private $filter = null;
 	
 	private $get = array();
 	private $post = array();
 	private $files = array();
 	
 	public function __set($var, $val)
 	{
 	    //Only allow the filter to be set
 	    $this->filter = $val;
 	}
 	
 	public function __get($val)
 	{
 		if (is_null($this->filter))
 			throw new Exception("You must set the input filter before you can retrieve variables");
 	    if (array_key_exists($val, $this->get))
 	    	return $this->filter->cleanse($this->get[$val]);
 	    else if (array_key_exists($val, $this->post))
 	    	return $this->filter->cleanse($this->post[$val]);
 	    else if (array_key_exists($val, $this->files))
 	    	return $this->files[$val];
 	    else
 	    	return null;
 	}
 	
 	public function raw($val)
 	{
 	     if (array_key_exists($val, $this->get))
 	    	return $this->get[$val];
 	    else if (array_key_exists($val, $this->post))
 	    	return $this->post[$val];
 	    else if (array_key_exists($val, $this->files))
 	    	return $this->files[$val];
 	    else
 	    	return null;
 	}
 	
 	public static function getInstance($filter=null)
 	{
 	    if(is_null(self::$instance))
 	    	self::$instance = new self();
 	    if(!is_null($filter))
 	    	self::$instance->filter = $filter;
 	    return self::$instance;
 	}
 	 
    private function __construct()
    {
        $this->processGet();
        $this->processPost();
        $this->processFiles();
    }
    
    private function processGet()
    {
        foreach($_GET as $key => $val)
        {
            $this->get[$key] = $val;
        }
    }
    
    private function processPost()
    {
        foreach($_POST as $key => $val)
        {
            $this->post[$key] = $val;
        }
    }
    
    private function processFiles()
    {
        foreach($_FILES as $key => $val)
        {
            $this->files[$key] = $val;
        }
    }
}

?>
