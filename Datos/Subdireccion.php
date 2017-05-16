<?php

class Subdireccion
{

	private $idSubdireccion;
	private $nombreSubdireccion;
	private $estadoSubdireccion;

	public function __construct()
	{		        	

	}

	public function asignarDatos($idSubdireccion, $nombreSubdireccion, $estadoSubdireccion)
	{
		$this->setIdSubdireccion($idSubdireccion);
		$this->setNombreSubdireccion($nombreSubdireccion);
		$this->setEstadoSubdireccion($estadoSubdireccion);
	}

	public function guardar($db)
	{
		if(isset($this->idSubdireccion) && isset($this->nombreSubdireccion) && isset($this->estadoSubdireccion))
		{
			if($this->verificarExistenciaNombreSubdireccion($db))
				$db->RunSP("SP_SUB_SOLICITANTE",INSERT, array('insertarSubdireccion',$this->getidSubdireccion(),$this->getnombreSubdireccion(),$this->getestadoSubdireccion()));
			else
				return false;
		}
		else
			return false;
		return true;		
	}

	public function modificar($db)
	{
		if(isset($this->idSubdireccion) && isset($this->nombreSubdireccion) && isset($this->estadoSubdireccion))
		{
			if($this->verificarExistenciaNombreSubdireccion($db))
				$db->RunSP("SP_SUB_SOLICITANTE",UPDATE, array('modificarExistenciaSub',$this->getidSubdireccion(),$this->getnombreSubdireccion(),$this->getestadoSubdireccion()));
			else
				return false;
		}
		else
			return false;
		return true;
	}

	private function verificarExistenciaNombreSubdireccion($db)
	{
		$query = $db->RunSP("SP_SUB_SOLICITANTE",SELECT, array('validarExistenciaSubdireccion',$this->getidSubdireccion(),$this->getnombreSubdireccion(), ''));		
		if($query[0]["PK_I_ID_SUB_SOLICITANTE"] == 0)
			return true;
		else
			return false;
	}

	public function obtenerSubdireccionId($idSubdireccion, $db)
	{
		$query = $db->RunSP("SP_SUB_SOLICITANTE",SELECT, array('obtenerSubdireccioneId', $idSubdireccion, '', ''));		
		$this->setIdSubdireccion($query[0]["PK_I_ID_SUB_SOLICITANTE"]);
		$this->setNombreSubdireccion($query[0]["V_NOMBRE_SUB_SOLICITANTE"]);
		$this->setEstadoSubdireccion($query[0]["B_ESTADO_LOGICO"]);
	}	

	public function getIdSubdireccion()
	{    	
    	return $this->idSubdireccion;
	}

	private function setIdSubdireccion($idSubdireccion)
	{    	
    	$this->idSubdireccion = $idSubdireccion;
	}	

	public function getNombreSubdireccion()
	{    	
    	return $this->nombreSubdireccion;
	}

	private function setNombreSubdireccion($nombreSubdireccion)
	{    	
    	$this->nombreSubdireccion = $nombreSubdireccion;
	}		

	public function getEstadoSubdireccion()
	{    	
    	return $this->estadoSubdireccion;
	}

	private function setEstadoSubdireccion($estadoSubdireccion)
	{    	
    	$this->estadoSubdireccion = $estadoSubdireccion;
	}			

}

?>