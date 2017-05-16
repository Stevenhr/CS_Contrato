<?php

class Documento
{

	private $idDocumento;
	private $nombreDocumento;
	private $estadoDocumento;

	public function __construct()
	{		        	

	}

	public function asignarDatos($idDocumento, $nombreDocumento, $estadoDocumento)
	{
		$this->setIdDocumento($idDocumento);
		$this->setNombreDocumento($nombreDocumento);
		$this->setEstadoDocumento($estadoDocumento);
	}

	public function guardar($db)
	{
		if(isset($this->idDocumento) && isset($this->nombreDocumento) && isset($this->estadoDocumento))
		{
			if($this->verificarExistenciaNombreDocumento($db))
				$db->RunSP("SP_DOCUMENTO",INSERT, array('insertarDocumento',$this->getIdDocumento(),$this->getNombreDocumento(),$this->getEstadoDocumento()));
			else
				return false;
		}
		else
			return false;
		return true;		
	}

	public function modificar($db)
	{
		if(isset($this->idDocumento) && isset($this->nombreDocumento) && isset($this->estadoDocumento))
		{
			if($this->verificarExistenciaNombreDocumento($db))
				$db->RunSP("SP_DOCUMENTO",UPDATE, array('modificarExistenciaDocumento',$this->getIdDocumento(),$this->getNombreDocumento(),$this->getEstadoDocumento()));
			else
				return false;
		}
		else
			return false;
		return true;
	}

	private function verificarExistenciaNombreDocumento($db)
	{
		$query = $db->RunSP("SP_DOCUMENTO",SELECT, array('validarExistenciaDocumento',$this->getIdDocumento(),$this->getNombreDocumento(), ''));		
		if($query[0]["PK_I_ID_ACTUACION_DOCUMENTO"] == 0)
			return true;
		else
			return false;
	}

	public function obtenerDocumentoId($idDocumento, $db)
	{
		$query = $db->RunSP("SP_DOCUMENTO",SELECT, array('obtenerDocumentoId', $idDocumento, '', ''));		
		$this->setIdDocumento($query[0]["PK_I_ID_ACTUACION_DOCUMENTO"]);
		$this->setNombreDocumento($query[0]["V_NOMBRE_ACTUACION_DOCUMENTO"]);
		$this->setEstadoDocumento($query[0]["B_ESTADO_LOGICO"]);
	}			

	public function getIdDocumento()
	{    	
    	return $this->idDocumento;
	}

	private function setIdDocumento($idDocumento)
	{    	
    	$this->idDocumento = $idDocumento;
	}	

	public function getNombreDocumento()
	{    	
    	return $this->nombreDocumento;
	}

	private function setNombreDocumento($nombreDocumento)
	{    	
    	$this->nombreDocumento = $nombreDocumento;
	}		

	public function getEstadoDocumento()
	{    	
    	return $this->estadoDocumento;
	}

	private function setEstadoDocumento($estadoDocumento)
	{    	
    	$this->estadoDocumento = $estadoDocumento;
	}			

}

?>