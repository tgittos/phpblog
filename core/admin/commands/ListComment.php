<?php

class ListComment
{
    private $view;
 	
 	public function __construct($view)
 	{
 	    $this->view = $view;
        $this->view->url = ROOT_URL . '/admin';
 	}
 	
 	public function execute()
 	{
 	    $this->view->title = 'Administrate Comments';
 	    $this->view->content = ROOT_PATH . '/templates/timgittos.com/admin/macros.html/comments';
 	    
 	    $comments = Doctrine_Query::create()
 	    			->select('c.*')
 	    			->from('Comment c')
 	    			->where('c.checked = 0')
 	    			->execute();
 	    foreach($comments as $comment)
 	    {
 	    	$comment->stripslashes();
 	    	echo $comment->content;
 	    }
 	    $this->view->comments = $comments;
 	    $this->view->hasComments = count($comments) > 0;
 	}
}

?>
