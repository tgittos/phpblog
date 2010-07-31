<?php

/**
 * Edit Post command
 */
 
 class EditPost
 {
 	private $view;
 	
 	public function __construct($view)
 	{
 	    $this->view = $view;
 	}
 	
    public function execute()
    {        
        $request = Request::getInstance();
        
        $this->view->title = "Edit blog post";
        $this->view->content = ROOT_PATH . '/templates/timgittos.com/admin/macros.html/postscreate';
        $this->view->action = ROOT_URL . '/admin/post/edit/' . $request->id;
        $this->view->message = "";
        
        $table = Doctrine::getTable('Post');
 		$post = $table->find($request->id);
 		$this->view->post = $post;
 		       
        $table = Doctrine::getTable('Category');
        $categories = $table->findAll();
        foreach($categories as $cat)
        {
            if ($post->inCategory($cat->id))
            	$cat->selected = true;
        }
        $this->view->categories = $categories;
        
		if (!is_null($request->title) &&
 			!is_null($request->url) &&
 			!is_null($request->content))
 		{
 		    $post->title = $request->title;
 		    $post->url = $request->raw('url');
 		    $post->date = date('Y-m-d');
 		    $post->content = $request->raw('content');
 		    $post->description = $post->summarise(50);
 		    $post->user_id = $_SESSION['user_id']; 		    
 		    $post->save();
 		    
 		    $catIDs = array();
 		  	if (is_array($request->categories))
	 		    foreach($request->categories as $value)
	 		    {
	 		    	if(!$post->inCategory($value))
	 		        	array_push($catIDs, $value);
	 		    }
	 		else if (!is_null($request->categories) && !$post->inCategory($request->categories))
	 			array_push($catIDs, $request->categories);
	 		$post->link('Category', $catIDs);
	 		foreach($post->Category as $cat)
	 		{
	 		    if (!in_array($cat->id, $request->categories))
	 		    {
	 		        $post->unlink('Category', $cat->id);
	 		    }
	 		}
	 		
 		    
 		    $this->view->message = "Post successfully created";
 		}
     }
 }

?>
