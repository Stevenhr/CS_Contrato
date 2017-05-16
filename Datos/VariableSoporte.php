<?php

class VariableSoporte
{

	private $idVariableSoporte;
	private $nombreVariableSoporte;
	private $valorVariableSoporte;

	public function __construct()
	{		        	

	}

	public function asignarDatos($idVariableSoporte, $nombreVariableSoporte, $valorVariableSoporte)
	{
		$this->setIdVariableSoporte($idVariableSoporte);
		$this->setNombreVariableSoporte($nombreVariableSoporte);
		$this->setValorVariableSoporte($valorVariableSoporte);
	}

	public function modificar($db)
	{
		if(isset($this->idVariableSoporte) && isset($this->nombreVariableSoporte) && isset($this->valorVariableSoporte))
		{
			$db->RunSP("SP_VARIABLES_ENTORNO",UPDATE, array('editarVariableEntorno',$this->getIdVariableSoporte(),$this->getNombreVariableSoporte(),$this->getValorVariableSoporte()));
		}
		return true;
	}	

	public function obtenerVariableSoporteNombre($nombreVariableSoporte, $db)
	{
		$query = $db->RunSP("SP_VARIABLES_ENTORNO",SELECT, array('obtenerVariableSoporteNombre', '', $nombreVariableSoporte, ''));	
		$this->setIdVariableSoporte(null);
		$this->setNombreVariableSoporte(null);
		$this->setValorVariableSoporte($query[0]["V_VALOR_VARIABLE"]);
	}	

	public function getIdVariableSoporte()
	{    	
    	return $this->idVariableSoporte;
	}

	private function setIdVariableSoporte($idVariableSoporte)
	{    	
    	$this->idVariableSoporte = $idVariableSoporte;
	}	

	public function getNombreVariableSoporte()
	{    	
    	return $this->nombreVariableSoporte;
	}

	private function setNombreVariableSoporte($nombreVariableSoporte)
	{    	
    	$this->nombreVariableSoporte = $nombreVariableSoporte;
	}		

	public function getValorVariableSoporte()
	{    	
    	return $this->valorVariableSoporte;
	}

	private function setValorVariableSoporte($valorVariableSoporte)
	{    	
    	$this->valorVariableSoporte = $valorVariableSoporte;
	}			

}

?>
