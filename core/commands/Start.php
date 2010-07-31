<?php

class Start
{
	private $view = null;
	
    public function __construct($view)
    {
        $this->view = $view;
        $this->view->content = ROOT_PATH . "/templates/timgittos.com/macros.html/index";
    }
    
    public function execute()
    {
        $posts = $this->displayTop(5);
        $this->view->posts = $posts;
    }
    
    private function displayTop($n)
    {
    	$posts = array();
        $result = Doctrine_Query::create()
        			 ->select('p.*')
        	     	 ->from('Post p')
        	     	 ->limit(5)
        	     	 ->execute();
       	$count = count($result);    	 
       	for($i = 0; $i < $count; $i++)
       	{
       		$post = $result[$i];
       		$post->comments = Doctrine_Query::create()
       						->select('c.*')
       						->from('Comment c')
       						->where('c.parent_id = ? and c.checked = 1', $post->id)
       						->execute()
       						->count();

       		if($post['User']->username != "")
       			$post->hasAuthor = true;
       		if ($post['Category'])
       		foreach($post['Category'] as $cat)
       		{
       			if (is_null($post->categoryString))
       				$post->categoryString = $cat->name;
       			else
       				$post->categoryString .= ', ' . $cat->name;
       		}
       		$posts[$i] = $post;
       	}
       	$posts = array_reverse($posts);
       	return $posts;
    }
}

?>