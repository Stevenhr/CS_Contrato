<?php

class ModalidadTramite
{

	private $idModalidadTramite;
	private $nombreModalidadTramite;
	private $estadoModalidadTramite;

	public function __construct()
	{		        	

	}

	public function asignarDatos($idModalidadTramite, $nombreModalidadTramite, $estadoModalidadTramite)
	{
		$this->setIdModalidadTramite($idModalidadTramite);
		$this->setNombreModalidadTramite($nombreModalidadTramite);
		$this->setEstadoModalidadTramite($estadoModalidadTramite);
	}

	public function guardar($db)
	{
		if(isset($this->idModalidadTramite) && isset($this->nombreModalidadTramite) && isset($this->estadoModalidadTramite))
		{
			if($this->verificarExistenciaNombreTramite($db))
				$db->RunSP("SP_MODALIDAD_TRAMITE",INSERT, array('insertarExistenciaModalidad',$this->getIdModalidadTramite(),$this->getNombreModalidadTramite(),$this->getEstadoModalidadTramite()));
			else
				return false;
		}
		else
			return false;
		return true;		
	}

	public function modificar($db)
	{
		if(isset($this->idModalidadTramite) && isset($this->nombreModalidadTramite) && isset($this->estadoModalidadTramite))
		{
			if($this->verificarExistenciaNombreTramite($db))
				$db->RunSP("SP_MODALIDAD_TRAMITE",UPDATE, array('modificarExistenciaModalidad',$this->getIdModalidadTramite(),$this->getNombreModalidadTramite(),$this->getEstadoModalidadTramite()));
			else
				return false;
		}
		else
			return false;
		return true;
	}

	private function verificarExistenciaNombreTramite($db)
	{
		$query = $db->RunSP("SP_MODALIDAD_TRAMITE",SELECT, array('validarExistenciaModalidad',$this->getIdModalidadTramite(),$this->getNombreModalidadTramite(), ''));		
		if($query[0]["PK_I_ID_MODADLIDAD_TRAMITE"] == 0)
			return true;
		else
			return false;
	}

	public function obtenerTramiteId($idModalidadTramite, $db)
	{
		$query = $db->RunSP("SP_MODALIDAD_TRAMITE",SELECT, array('obtenerModalidadTramiteId', $idModalidadTramite, '', ''));		
		$this->setIdModalidadTramite($query[0]["PK_I_ID_MODADLIDAD_TRAMITE"]);
		$this->setNombreModalidadTramite($query[0]["V_NOMBRE_MODADLIDAD_TRAMITE"]);
		$this->setEstadoModalidadTramite($query[0]["B_ESTADO_LOGICO"]);
	}

	public function obtenerIdTramitePorNombre($nombreModalidadTramite, $db)
	{
		$query = $db->RunSP("SP_MODALIDAD_TRAMITE",SELECT, array('obtenerIdTramitePorNombre', '', $nombreModalidadTramite, ''));		
		$this->setIdModalidadTramite($query[0]["PK_I_ID_MODADLIDAD_TRAMITE"]);
	}	

	public function getIdModalidadTramite()
	{    	
    	return $this->idModalidadTramite;
	}

	private function setIdModalidadTramite($idModalidadTramite)
	{    	
    	$this->idModalidadTramite = $idModalidadTramite;
	}	

	public function getNombreModalidadTramite()
	{    	
    	return $this->nombreModalidadTramite;
	}

	private function setNombreModalidadTramite($nombreModalidadTramite)
	{    	
    	$this->nombreModalidadTramite = $nombreModalidadTramite;
	}		

	public function getEstadoModalidadTramite()
	{    	
    	return $this->estadoModalidadTramite;
	}

	private function setEstadoModalidadTramite($estadoModalidadTramite)
	{    	
    	$this->estadoModalidadTramite = $estadoModalidadTramite;
	}			

}

?>