<?php

/**
* Database data store, implements IDataStore
* MySQL
*/

class DB implements IDataStore
{
    //Connection details
    private $host = null;
    private $username = null;
    private $password = null;
    private $databaseName = null;
    
    //Internal connection
    private $conn = null;
    
    /**
    * Constructor, accepts database connection details
    */
    public function __construct($host, $username, $password, $databaseName)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->databaseName = $databaseName;
    }
    
    /**
    * Initiates connection to server if not connected, uses database supplied in constructor
    */
    public function connect()
    {
        if ($this->conn)
            return;
        $this->conn = mysql_connect($this->host, $this->username, $this->password);
        if (!$this->conn) 
        {
            throw new Exception('Could not connect using ' . __CLASSNAME__ . ': ' . mysql_error());
        }
        if (!mysql_select_db($this->databaseName, $this->conn)) 
        {
            throw new Exception ("Could not use $this->databaseName: " . mysql_error());
        }
    }
    
    /**
    * Runs query. Opens connection if not open.
    * Does rudimentary auto cleansing.
    * Throws exception on MySQL error.
    * Returns associative array of results, or null if no results
    */
    public function query($query)
    {
        if (!$this->conn)
            $this->connect;
        $query = mysql_real_escape_string($query);
        $result = mysql_query($query);
        if (!$result) 
        {
            $message = "Could not complete query: \n";
            $message .= 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $query;
            throw new Exception($message);
        }

        $return = null;
        while ($row = mysql_fetch_assoc($result)) 
        {
            if ($return == null)
                $return = Array();
            array_push($return, $row);
        }
        mysql_free_result($result);
        return $return;
    }
    
    /**
    * Disconnect if connected.
    */
    public function disconnect()
    {
        if ($this->conn)
            mysql_close($this->conn);
    }
}

?>