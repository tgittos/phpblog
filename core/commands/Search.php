<?php

class Search
{
	private $view = null;
	
    public function __construct($view)
    {
        $this->view = $view;
    }
    
    public function execute()
    {
    	$id = Request::getInstance()->id;
    	
    	if (isset($id))
    		$query = $id;
    	else    	
    		$query = Request::getInstance()->query;
    	$this->view->query = $query;
    	
        $table = Doctrine::getTable('Post');
        $posts = $table->findAll();
        
        $results = array();
        
        foreach ($posts as $post)
        {
            if (strpos($post->content, $query) > -1)
            {
                array_push($results, $post);
            }
        }
        
        if (count($results) > 0)
        {
            $this->view->content = ROOT_PATH . "/templates/timgittos.com/macros.html/searchfound";
            $this->view->results['count'] = count($results);
            $this->view->results = $results;
        }
        else
        {
            $this->view->content = ROOT_PATH . "/templates/timgittos.com/macros.html/searchnotfound";
        }
    }
}

?>