<?php

include 'HistorialContrato.php';

class ManejadorHistorial
{
	
	private $historial;
	private $db;

	public function __construct()
	{
		$this->historial = array();
	}	

	public function guardarHistorial($idSolicitud, $seguimiento, $db)
	{
		$historialContrato = new HistorialContrato();
		$historialContrato->guardarHistorial($idSolicitud, $seguimiento, $db);	
	}

	public function obtenerHistorial($idSolicitud, $db)
	{
		$query = $db->RunSP("SP_HISTORIAL_CONTRATO",SELECT, array('buscarSeguimiento', '', $idSolicitud, '', ''));		
		for($i = 0; $i < count($query); $i++)
		{
			$historialContrato = new HistorialContrato();
			$historialContrato->setFecha($query[$i]["DT_FECHA"]);
			$historialContrato->setSeguimiento($query[$i]["T_SEGUIMIENTO"]);
			array_push($this->historial, $historialContrato);
		}						
	}

	public function getHistorial()
	{
		return $this->historial;
	}
}

?>