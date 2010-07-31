<?php

class Full
{
	private $view = null;
	
    public function __construct($view)
    {
        $this->view = $view;
    }
    
    public function execute()
    {
    	$id = Request::getInstance()->id;
    	
        $posts = Doctrine_Query::create()
        		 ->select('p.*')
        		 ->from('Post p')
        		 ->where('p.url = ?', $id)
        		 ->execute();
        	
    	$comments = Doctrine_Query::create()
    				->select('c.*')
    				->from('Comment c')
    				->where('c.parent_id = ? and c.checked = 1', $posts[0]->id)
    				->execute();
    	
    	foreach($comments as $comment)
    	{
    		$comment->stripslashes();
    	}
    			 
    	$this->view->title = $posts[0]->title;
    	$this->view->content = ROOT_PATH . "/templates/timgittos.com/macros.html/post";

    	$this->view->post = $posts[0];
    	$this->view->comments = $comments;
    }
}

?>
