<?php

class ListPost
{
    private $view;
 	
 	public function __construct($view)
 	{
 	    $this->view = $view;
 	}
 	
    public function execute()
    {
        $this->view->title = "All blog posts";
        $this->view->action = ROOT_URL . '/admin/post/add';
        $this->view->content = ROOT_PATH . '/templates/timgittos.com/admin/macros.html/posts';
        $this->view->url = ROOT_URL . '/admin';
		$table = Doctrine::getTable('Post');
		$this->view->posts = $table->findAll();
     }
}

?>
