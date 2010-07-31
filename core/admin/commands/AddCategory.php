<?php

class AddCategory
{
    private $view;
 	
 	public function __construct($view)
 	{
 	    $this->view = $view;
 	}
 	
    public function execute()
    {        
    	$request = Request::getInstance();

		if (!is_null($request->name))
 		{
 		    $cat = new Category();
 		    $cat->name = $request->name;
 		    $cat->save();
 		    
 		    $this->view->feedback = "Category successfully created";
 		}
 		
 		header('location: ' . ROOT_URL . '/admin/category/list');
     }
}

?>