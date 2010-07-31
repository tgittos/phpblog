<?php

/**
 * Secure session class, saves to database
 */
 
 class SessionManager
 {
 	private $_session = null;
	public $maxTime = array();
	private $db = null;
 	private $fingerprint = null;
 	
    public function start($fingerprint)
    {
		$this->maxTime['access'] = time();
		$this->maxTime['gc'] = get_cfg_var('session.gc_maxlifetime');
		session_set_save_handler(	array($this, 'open'),
									array($this, 'close'),
									array($this, 'read'),
									array($this, 'write'),
									array($this, 'destroy'),
									array($this, 'clean'));
		register_shutdown_function('session_write_close');
		session_start();
		
		//if (is_null($this->fingerprint))
    		//$this->fingerprint = $fingerprint;
    	//if ($this->fingerprint != $fingerprint)
    		//session_destroy();
    }
    
    public function open()
    {        	  
        $this->table = Doctrine::getTable('Session');
        return true;
    }
    
    public function close()
    {
    	$this->clean($this->maxTime['gc']);
        return true;
    }
    
    public function read($id)
    {
        $entry = $this->table->find($id);
        return $entry->data;
    }
    
    public function write($id, $data)
    {
    	$entry = $this->table->find($id);
        if (!is_object($entry))
        {
        	$entry = new Session();
        	$entry->id = $id;
        }
        $entry->data = $data;
        $entry->access = time();
        
        $entry->save();
    }
    
    public function destroy($id)
    {
        $entry = $this->table->find($id);
        if ($entry)
        	$entry->delete();
    }
    
    public function clean($max)
    {
        $old = ($this->maxTime['access'] - $max);
        $query = new Doctrine_Query();
        $query->delete('s')
        	  ->from('Session s')
        	  ->where('s.access < ?', $old)
        	  ->execute();    
    }
 }

?>
