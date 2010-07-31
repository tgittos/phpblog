<?php

class Logout
{
    public function execute()
    {
        session_destroy();
        header('location: ' . ROOT_URL . '/admin/login');
    }
}

?>
