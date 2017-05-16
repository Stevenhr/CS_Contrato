<?php

if(!class_exists('Query')){ include 'Query.php'; }
include("ListadoDocumento.php");

class ManejadorListaDocumento
{

	private $listadoDocumento;
	private $db; 

	public function __construct()
	{		        	
		$this->db = new Query('Principal');
		$this->listadoDocumento = array();
	}

	public function cargarListadoDocumento()
	{
		$query = $this->db->RunSP("SP_LISTADO_DOCUMENTO",SELECT, array('obtenerListadoDocumento','','',''));      
		for($i = 0; $i < count($query); $i++)
		{
			$listadoDocumento = new ListadoDocumento();			
			$listadoDocumento->asignarDatos($query[$i]["PK_I_ID_LISTADO_DOC"],$query[$i]["V_NOMBRE_DOCUMENTO"],$query[$i]["T_RUTRA_DOCUMENTO"]);						
			array_push($this->listadoDocumento, $listadoDocumento);
		}		
	}

	public function guardarListadoDocumento($nombreListadoDocumento, $rutaListadoDocumento)
	{
		$listadoDocumento = new ListadoDocumento();
		$listadoDocumento->asignarDatos(-1, $nombreListadoDocumento, $rutaListadoDocumento);
		return $listadoDocumento->guardar($this->db);
	}

	public function modificarListadoDocumento($idListadoDocumento, $nombreListadoDocumento, $rutaListadoDocumento)
	{
		$listadoDocumento = new ListadoDocumento();
		$listadoDocumento->asignarDatos($idListadoDocumento, $nombreListadoDocumento, $rutaListadoDocumento);
		return $listadoDocumento->modificar($this->db);
	}	

	public function eliminarListadoDocumento($idListadoDocumento)
	{
		$listadoDocumento = new ListadoDocumento();
		$listadoDocumento->asignarDatos($idListadoDocumento, '', '');
		return $listadoDocumento->eliminar($this->db);
	}		

	public function getListadoDocumento()
	{
		return $this->listadoDocumento;
	}

	public function setListadoDocumento($listadoDocumento)
	{
		$this->listadoDocumento = $listadoDocumento;
	}	


}

?>