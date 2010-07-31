<?php

/**
 * Create Post command
 */
 
 class AddPost
 {
 	private $view;
 	
 	public function __construct($view)
 	{
 	    $this->view = $view;
 	}
 	
    public function execute()
    {        
        $table = Doctrine::getTable('Category');
        $this->view->categories = $table->findAll();
        
        $request = Request::getInstance();
        
		if (!is_null($request->title) &&
 			!is_null($request->url) &&
 			!is_null($request->content))
 		{
 		   $post = new Post();
 		   $post->title = $request->title;
 		   $post->url = $request->raw('url');
 		   $post->date = date('Y-m-d');
 		   $post->content = $request->raw('content');
 		   $post->description = $post->summarise(50);
 		   $post->user_id = $_SESSION['user_id'];
 		   $post->save();
 		   $this->view->feedback = "Post successfully created";
 		}
 		
 		header('location: ' . ROOT_URL . "/admin/post/list");
     }
 }

?>
