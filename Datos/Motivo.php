<?php

class Motivo
{

	private $idMotivo;
	private $nombreMotivo;
	private $estadoMotivo;

	public function __construct()
	{		        	

	}

	public function asignarDatos($idMotivo, $nombreMotivo, $estadoMotivo)
	{
		$this->setIdMotivo($idMotivo);
		$this->setNombreMotivo($nombreMotivo);
		$this->setEstadoMotivo($estadoMotivo);
	}

	public function guardar($db)
	{
		if(isset($this->idMotivo) && isset($this->nombreMotivo) && isset($this->estadoMotivo))
		{
			if($this->verificarExistenciaNombreMotivo($db))
				$db->RunSP("SP_MOTIVO",INSERT, array('insertarMotivo',$this->getIdMotivo(),$this->getNombreMotivo(),$this->getEstadoMotivo()));
			else
				return false;
		}
		else
			return false;
		return true;		
	}

	public function modificar($db)
	{
		if(isset($this->idMotivo) && isset($this->nombreMotivo) && isset($this->estadoMotivo))
		{
			if($this->verificarExistenciaNombreMotivo($db))
				$db->RunSP("SP_MOTIVO",UPDATE, array('modificarExistenciaMotivo',$this->getIdMotivo(),$this->getNombreMotivo(),$this->getEstadoMotivo()));
			else
				return false;
		}
		else
			return false;
		return true;
	}

	private function verificarExistenciaNombreMotivo($db)
	{
		$query = $db->RunSP("SP_MOTIVO",SELECT, array('validarExistenciaMotivo',$this->getIdMotivo(),$this->getNombreMotivo(), ''));		
		if($query[0]["PK_I_ID_ACTUACION_MOTIVO"] == 0)
			return true;
		else
			return false;
	}

	public function obtenerMotivoId($idMotivo, $db)
	{
		$query = $db->RunSP("SP_MOTIVO",SELECT, array('obtenerMotivoId', $idMotivo, '', ''));		
		$this->setIdMotivo($query[0]["PK_I_ID_ACTUACION_MOTIVO"]);
		$this->setNombreMotivo($query[0]["V_NOMBRE_ACTUACION_MOTIVO"]);
		$this->setEstadoMotivo($query[0]["B_ESTADO_LOGICO"]);
	}		

	public function getIdMotivo()
	{    	
    	return $this->idMotivo;
	}

	private function setIdMotivo($idMotivo)
	{    	
    	$this->idMotivo = $idMotivo;
	}	

	public function getNombreMotivo()
	{    	
    	return $this->nombreMotivo;
	}

	private function setNombreMotivo($nombreMotivo)
	{    	
    	$this->nombreMotivo = $nombreMotivo;
	}		

	public function getEstadoMotivo()
	{    	
    	return $this->estadoMotivo;
	}

	private function setEstadoMotivo($estadoMotivo)
	{    	
    	$this->estadoMotivo = $estadoMotivo;
	}			

}

?>