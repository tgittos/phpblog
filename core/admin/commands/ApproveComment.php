<?php

class ApproveComment
{
    private $view;
 	
 	public function __construct($view)
 	{
 	    $this->view = $view;
 	}
 	
 	public function execute()
 	{
		$id = Request::getInstance()->id;
 	    
 	    $comments = Doctrine_Query::create()
 	    			->select('c.*')
 	    			->from('Comment c')
 	    			->where('c.id = ?', $id)
 	    			->execute();
 	    
 	    $comment = $comments[0];
 	    $comment->checked = true;
 	    $comment->save();
 	    
 	    header('location: ' . ROOT_URL . '/admin/comment/list');
 	}
}

?>
