<?php

/**
 * Delete Post command
 */
 
 class DeletePost
 {
 	private $view;
 	
 	public function __construct($view)
 	{
 	    $this->view = $view;
 	}
 	
    public function execute()
    {        
        $request = Request::getInstance();
        if (!is_null($request->delete))
        {
            $id = $request->id;
            
        	Doctrine_Query::create()
        	->delete()
        	->from('CategoryPost cp')
        	->where('cp.post_id = ?', $id)
        	->execute();
        	
            $table = Doctrine::getTable('Post');
            $article = $table->find($id);
            $article->delete();
        }
        header('location: ' . ROOT_URL . '/admin/post/list');
     }
 }

?>
