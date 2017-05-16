<?php

class MySql
{
	protected $driver;
	protected $host;
	protected $user;
	protected $pass;
	protected $database;
	protected $charset;
	protected $db;

	public function __construct($db_config)
	{
		
     	$this->driver = $db_config["driver"];
        $this->host = $db_config["host"];
        $this->user = $db_config["user"];
        $this->pass = $db_config["pass"];
        $this->database = $db_config["database"];
        $this->charset = $db_config["charset"];	

		$this->db = new mysqli($this->host, $this->user, $this->pass, $this->database); 
		if($this->db->connect_errno)
        {
        	//echo "Fallo al contectar a MySQL: " . $this->db->connect_error;
        }
        else
        {	        	
			$this->db->set_charset($this->charset);
        } 
	}

	public function __destruct()
  	{  		    	
    	$this->db->close();
  	}	
		
}

?>