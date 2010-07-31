<?php

class ListCategory
{
    private $view;
 	
 	public function __construct($view)
 	{
 	    $this->view = $view;
 	}
 	
    public function execute()
    {
        $this->view->title = "All categories";
        $this->view->content = ROOT_PATH . '/templates/timgittos.com/admin/macros.html/categories';
        
        $table = Doctrine::getTable('Category');
        $this->view->categories = $table->findAll();
     }
}

?>
