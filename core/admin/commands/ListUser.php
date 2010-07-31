<?php

class ListUser
{
    private $view;
 	
 	public function __construct($view)
 	{
 	    $this->view = $view;
 	}
 	
    public function execute()
    {
        $this->view->title = "All users";
        $this->view->content = ROOT_PATH . '/templates/timgittos.com/admin/macros.html/users';
        $this->view->url = ROOT_URL . '/admin';
		$table = Doctrine::getTable('User');
		$this->view->users = $table->findAll();	
     }
}

?>