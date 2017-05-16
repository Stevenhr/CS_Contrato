<?php
include("MySql.php");

define("INSERT","1", true);
define("UPDATE","1", true);
define("DELETE","1", true);
define("SELECT","2", true);
define("MODULO","19", true);
define("PERSONA_TIPO","41", true);


class Query extends MySql
{
   
	public function __construct($db)
	{
		if($db == 'Apoyo')
			$db_config = require_once 'Database.php';
		else if($db == 'Principal')
			$db_config = require_once 'DatabaseContratacion.php';
		parent::__construct($db_config);
	}

	public function __destruct()
	{
        parent::__destruct();     
	}	

	public function RunQuery($query,$tipo)
	{       
		 if($result = $this->db->query($query))
		 {			  
			   $this->freeResult();
			   if($tipo == INSERT || $tipo == DELETE || $tipo == UPDATE)
			   {
				   return 0;				  			
			   }
               else
               {
                   return $this->loadArray($result);	
	           }
		 }		
		else
		{
			echo("Error-> " . $this->db->error . "<br>Consulta: ". $query . "<br>");						
		}		   					
    }
										   
    public function RunSP($nombreProcedimiento, $tipo, array $valores)
    {

			$query = 'CALL '.$nombreProcedimiento.' ('; 
			for($i = 0; $i < count($valores); $i++)
			{
				$query .= "'" . $valores[$i] . "',";
			}
			if(count($valores) >= 1)
			{
				$query = substr($query, 0, (strlen($query)-1)).')';
			}
			else
			{
				$query = $query.')';
			}
			
			if($result = $this->db->query($query))
			{			
				$this->freeResult();
				if($tipo == INSERT || $tipo == DELETE || $tipo == UPDATE)
				{
					return 0;
			    } 
                if($tipo == SELECT)
                {
                     return $this->loadArray($result);
			    }																							
	        }													 
			else
			{
				echo("Error-> " . $this->db->error . "<br>Consulta: " . $query . "<br>");
			}													 		
    } 	
															   															   
    private function loadArray($result)
    {				    
			$resultArray = array();
			$i = 0;									   			        
			while ($_fila = mysqli_fetch_array($result))
			{
		         array_push($resultArray, $_fila);
				 $i++;
	        }	        
			 mysqli_free_result ($result);
			 if($i == 0)
			 {
				 return null;
		     }
             else
             {								
			     return $resultArray;					 											  
			 }						 
    }	

    public function freeResult()
    {
    	while ($this->db->more_results())
    	{
    	   $this->db->next_result();	
    	} 
    }														   									   									   	
}
?>