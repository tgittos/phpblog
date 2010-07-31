<?php

/**
 * Simple controller
 */
 
 class Controller
 {
 	private $view = null;
 	
 	public function __construct()
 	{
 		$this->view = new View();
 		$this->view->template = new Template();
 		$this->view->menu = new Menu();
 	}
 	
 	public function process($mode)
 	{
 	    switch($mode)
 	    {
 	        case "public":
 	        	$this->doPublic();
 	        	break;
 	        case "admin":
 	        	$this->doAdmin();
 	        	break;
 	        default:
 	        	throw new Exception("Cannot find requested page");
 	    }
 	}
 	
 	private function doPublic()
 	{   
 		$request = Request::getInstance();
 		$class = $request->class;
 		
 		//Map request to command
        $commandClass = ucfirst($class);
        $commandFile = ROOT_PATH . "/core/commands/$commandClass.php";
        if (file_exists($commandFile))
        {
        	require_once $commandFile;
        	$command = new $commandClass($this->view);
        	$command->execute();
        	$this->view->display();
        }
        else
        {
        	throw new Exception('Cannot find requested page');
        }
 	}
 	
 	private function doAdmin()
 	{
        $class = Request::getInstance()->class;
        $action = Request::getInstance()->action;
        
        //Check security
        if (is_null($_SESSION['username']) && $class != 'login')
        {
        	$_SESSION['returnUrl'] = ROOT_URL . "/admin/$class/$action";
        	header("location: " . ROOT_URL . "/admin/login");
        }
        
        //Map request to command
        $commandClass = ucfirst($action) . ucfirst($class);
        $commandFile = ROOT_PATH . "/core/admin/commands/$commandClass.php";
        if (file_exists($commandFile))
        {
        	require_once $commandFile;
        	$command = new $commandClass($this->view);
        	$command->execute();
        	$this->view->display();
        }
        else
        {
        	throw new Exception('Cannot find requested page');
        }
 	}
 }

?>
