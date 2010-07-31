<?php

/**
 * Login command
 */
 
 class Login
 {
 	 private $view = null;
 	 
	 public function __construct($view)
	 {
	     $this->view = $view;
	 }
	 
     public function execute()
     {
        $this->view->title = "Log In";
		$request = Request::getInstance();
		if (!is_null($_SESSION['username']))
			header('location: ' . ROOT_URL . '/admin/dashboard');
 		if (!(is_null($request->username) && is_null($request->password)))
 		{
 			$command = new Authenticate();
	 		if ($command->execute($request->username, $request->raw('password')))
	 		{
	 			if (isset($_SESSION['returnUrl']))
	 				header('location: ' . $_SESSION['returnUrl']);
	 			else
					header('location: ' . ROOT_URL . '/admin/dashboard');
	 		}
	 		else
	 		{
	 			$this->view->feedback = Commands::Message();
	 			$this->view->action = ROOT_URL . '/admin/login';
            	$this->view->content = ROOT_PATH . '/templates/timgittos.com/admin/macros.html/login';
	 		}
 		}
 		else
 		{
 		    $this->view->action = ROOT_URL . '/admin/login';
            $this->view->content = ROOT_PATH . '/templates/timgittos.com/admin/macros.html/login';
 		}
     }
 }

?>
