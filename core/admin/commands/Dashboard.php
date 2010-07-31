<?php

class Dashboard
{
	private $view;

	public function __construct($view)
	{
		$this->view = $view;
	}
	
	public function execute()
	{
		$command = new AddPost($this->view);
        $command->execute();
        $command = new ListComment($this->view);
        $command->execute();
        
        $this->view->postsNo = Doctrine_Query::create()
        					   ->select('p.*')
        					   ->from('Post p')
        					   ->execute()
        					   ->count();
        $this->view->commentsNo = Doctrine_Query::create()
        					   	  ->select('c.*')
        					   	  ->from('Comment c')
        					   	  ->execute()
        					   	  ->count();
        $this->view->categoriesNo = Doctrine_Query::create()
        					   ->select('c.*')
        					   ->from('Category c')
        					   ->execute()
        					   ->count();
        					   
        $this->view->title = "Dashboard";
        $this->view->content = ROOT_PATH . '/templates/timgittos.com/admin/macros.html/dashboard';
	}

}

?>