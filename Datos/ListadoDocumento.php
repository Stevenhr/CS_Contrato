<?php

class ListadoDocumento
{

	private $idListadoDocumento;
	private $nombreListadoDocumento;
	private $rutaListadoDocumento;

	public function __construct()
	{		        	

	}

	public function asignarDatos($idListadoDocumento, $nombreListadoDocumento, $rutaListadoDocumento)
	{
		$this->setIdListadoDocumento($idListadoDocumento);
		$this->setNombreListadoDocumento($nombreListadoDocumento);
		$this->setRutaListadoDocumento($rutaListadoDocumento);
	}	

	private function verificarExistenciaNombreListaDocumento($db)
	{
		$query = $db->RunSP("SP_LISTADO_DOCUMENTO",SELECT, array('validarExistenciaListadoDocumento', $this->getIdListadoDocumento() , $this->getNombreListadoDocumento(), ''));		
		if(COUNT($query) > 0)
			return true;
		else
			return false;
	}	

	public function guardar($db)
	{
		if(!$this->verificarExistenciaNombreListaDocumento($db))
			$db->RunSP("SP_LISTADO_DOCUMENTO",INSERT, array('agregarListadoDocumento', null, $this->getNombreListadoDocumento(), $this->getRutaListadoDocumento()));
		else
			return false;	
		return true;
	}	

	public function modificar($db)
	{
		if(!$this->verificarExistenciaNombreListaDocumento($db))
			$db->RunSP("SP_LISTADO_DOCUMENTO", UPDATE, array('modificarListadoDocumento', $this->getIdListadoDocumento(), $this->getNombreListadoDocumento(), ''));
		else
			return false;	
		return true;
	}		

	public function eliminar($db)
	{
		$db->RunSP("SP_LISTADO_DOCUMENTO",UPDATE, array('eliminarListadoDocumento', $this->getIdListadoDocumento(), '', ''));
		return true;
	}			

	public function getIdListadoDocumento()
	{    	
    	return $this->idListadoDocumento;
	}

	private function setIdListadoDocumento($idListadoDocumento)
	{    	
    	$this->idListadoDocumento = $idListadoDocumento;
	}			

	public function getNombreListadoDocumento()
	{    	
    	return $this->nombreListadoDocumento;
	}

	private function setNombreListadoDocumento($nombreListadoDocumento)
	{    	
    	$this->nombreListadoDocumento = $nombreListadoDocumento;
	}				

	public function getRutaListadoDocumento()
	{    	
    	return $this->rutaListadoDocumento;
	}

	private function setRutaListadoDocumento($rutaListadoDocumento)
	{    	
    	$this->rutaListadoDocumento = $rutaListadoDocumento;
	}				

}

?>