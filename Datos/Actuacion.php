<?php

class Actuacion
{

	private $idActuacion;
	private $nombreActuacion;
	private $accionActuacion;
	private $estadoActuacion;

	public function __construct()
	{		        	

	}

	public function asignarDatos($idActuacion, $nombreActuacion, $accionActuacion, $estadoActuacion)
	{
		$this->setIdActuacion($idActuacion);
		$this->setNombreActuacion($nombreActuacion);
		$this->setAccionActuacion($accionActuacion);
		$this->setestadoActuacion($estadoActuacion);
	}

	public function guardar($db)
	{
		if(isset($this->idActuacion) && isset($this->nombreActuacion) && isset($this->accionActuacion) && isset($this->estadoActuacion))
		{
			if($this->verificarExistencianombreActuacion($db))
				$db->RunSP("SP_ACTUACION",INSERT, array('insertarActuacion',$this->getidActuacion(),$this->getnombreActuacion(),$this->getAccionActuacion(),$this->getestadoActuacion()));
			else
				return false;
		}
		else
			return false;
		return true;		
	}

	public function modificar($db)
	{
		if(isset($this->idActuacion) && isset($this->nombreActuacion) && isset($this->accionActuacion) && isset($this->estadoActuacion))
		{
			if($this->verificarExistencianombreActuacion($db))
				$db->RunSP("SP_ACTUACION",UPDATE, array('modificarExistenciaActuacion',$this->getidActuacion(),$this->getnombreActuacion(),$this->getAccionActuacion(),$this->getestadoActuacion()));
			else
				return false;
		}
		else
			return false;
		return true;
	}

	private function verificarExistencianombreActuacion($db)
	{
		$query = $db->RunSP("SP_ACTUACION",SELECT, array('validarExistenciaActuacion',$this->getidActuacion(),$this->getnombreActuacion(), '', ''));		
		if($query[0]["PK_I_ID_ACTUACION"] == 0)
			return true;
		else
			return false;
	}

	public function obtenerActuacionId($idActuacion, $db)
	{
		$query = $db->RunSP("SP_ACTUACION",SELECT, array('obtenerActuacionId', $idActuacion, '', '', ''));		
		$this->setIdActuacion($query[0]["PK_I_ID_ACTUACION"]);
		$this->setNombreActuacion($query[0]["V_NOMBRE_ACTUACION"]);
		$this->setAccionActuacion($query[0]["B_ACCION_ACTUACION"]);
		$this->setestadoActuacion($query[0]["B_ESTADO_LOGICO"]);
	}	


	public function getIdActuacion()
	{    	
    	return $this->idActuacion;
	}

	private function setIdActuacion($idActuacion)
	{    	
    	$this->idActuacion = $idActuacion;
	}	

	public function getNombreActuacion()
	{    	
    	return $this->nombreActuacion;
	}

	private function setNombreActuacion($nombreActuacion)
	{    	
    	$this->nombreActuacion = $nombreActuacion;
	}		

	public function getAccionActuacion()
	{    	
    	return $this->accionActuacion;
	}

	private function setAccionActuacion($accionActuacion)
	{    	
    	$this->accionActuacion = $accionActuacion;
	}			

	public function getestadoActuacion()
	{    	
    	return $this->estadoActuacion;
	}

	private function setestadoActuacion($estadoActuacion)
	{    	
    	$this->estadoActuacion = $estadoActuacion;
	}			

}

?>