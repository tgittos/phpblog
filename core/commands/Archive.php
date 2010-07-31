<?php

class Archive
{
    private $view = null;
    
    public function __construct($view)
    {
        $this->view = $view;
    }
    
    public function execute()
    {
        $id = Request::getInstance()->id;
        
        if(isset($id))
        	$this->doCategory($id);
        else
        	$this->doList();
    }
    
    private function doList()
    {
    	$all = new stdClass();
    	$all->name = 'All';
    	$all->url = 'all';
        $categories = array($all);
        
        $table = Doctrine::getTable('Category');
        $results = $table->findAll();
        foreach($results as $result)
        {
        	$cat = new stdClass();
        	$cat->name = $result->name;
        	$cat->url = strtolower(implode('-', explode(' ', $result->name)));
            array_push($categories, $cat);
        }
        
        $this->view->categories = $categories;
        
        $this->view->title = "Past Posts by Category";
        $this->view->content = ROOT_PATH . "/templates/timgittos.com/macros.html/categorylist";
    }
    
    private function doCategory($cat)
    {
    	$cat = implode(' ', explode('-', $cat));
    	if ($cat == 'all')
    	{
    		$this->view->posts = Doctrine::getTable('Post')->findAll();
    	}
    	else
    	{
	        $this->view->posts = Doctrine_Query::create()
				        		 ->select('p.*')
				        		 ->from('Post p')
				        		 ->leftJoin('p.Category c')
				        		 ->where('c.name = ?', $cat)
				        		 ->execute();
    	}
    	$count = count($this->view->posts);
    	for($i = 0; $i < $count; $i++)
    	{
    		$post = $this->view->posts[$i];
    		$post->description = $post->summarise(20);
    		$this->view->post[$i] = $post;
    	}
		$this->view->title = "All Posts in Category '$cat'";
		$this->view->content = ROOT_PATH . "/templates/timgittos.com/macros.html/categoryposts"; 
		$this->view->cat = ucfirst($cat);       
    }
}

?>