<?php

class Post extends BasePost
{ 
    public $comments = null;
    public $hasAuthor = false;
    public $categoryString = null;
    
    public function inCategory($id)
    {
        foreach($this->Category as $cat)
        {
            if ($cat->id == $id)
            	return true;
        }
        return false;
    }
    
    public function summarise($no)
    {
    	return implode(array_slice(str_word_count($this->content, 1), 0, $no), ' ');
    }
}

?>