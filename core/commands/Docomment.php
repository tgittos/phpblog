<?php

class Docomment
{
	private $view = null;
	
    public function __construct($view)
    {
        $this->view = $view;
    }
    
    public function execute()
    {
        $request = Request::getInstance();
 		$url = $request->id;
 		
 		$posts = Doctrine_Query::create()
        			 ->select('p.*')
        			 ->from('Post p')
        			 ->where('p.url = ?', $url)
        			 ->execute();
        $post = $posts[0];
        
        $comment = new Comment();
        $comment->user_id = $_SESSION['user_id'];
        $comment->parent_id = $post->id;
        $comment->parenttype = 'post';
        $comment->timestamp = date('Y-m-d');
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->content = $request->content;
        $comment->checked = false;
        $comment->save();
 		
 	    header('location: ' . ROOT_URL . '/full/' . $url);
    }
}

?>
