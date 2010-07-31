<?php

/**
 * Defines the current template of the site.
 * Currently hardcoded, will probably move to a database soon.
 */
 
 class Template
 {
        private $blog;
        
        public function __get($var)
        {
            return $this->$var;
        }
        
        public function __construct()
        {
            $this->blog = new stdClass();
            $this->blog->main = ROOT_PATH . "/templates/timgittos.com/index.html";
            $this->blog->css = new stdClass();
            $this->blog->css->main = ROOT_URL . "/templates/timgittos.com/timgittos.css";
            
            $this->admin = new stdClass();
            $this->admin->main = ROOT_PATH . "/templates/timgittos.com/admin/index.html";
            $this->blog->css->admin = ROOT_URL . "/templates/timgittos.com/admin/admin.css";
        }
 }

?>
