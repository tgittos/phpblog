<?php

class DeleteCategory
{
    private $view = null;
    
    public function __constuct($view)
    {
        $this->view = $view;
    }
    
    public function execute()
    {
        $request = Request::getInstance();
        if (!is_null($request->delete))
        {
            $id = $request->id;
            $table = Doctrine::getTable('Category');
            $article = $table->find($id);
            $article->delete();
        }
        header('location: ' . ROOT_URL . '/admin/category/list');
    }
}

?>