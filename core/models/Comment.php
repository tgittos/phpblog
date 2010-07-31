<?php

class Comment extends BaseComment
{ 
    public function stripslashes()
    {
    	$this->content = stripslashes($this->content);
    }
}

?>