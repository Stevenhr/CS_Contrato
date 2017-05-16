<?php


class HistorialContrato
{
	private $idHistorialContrato;
	private $idSolicitud;
	private $fecha;
	private $seguimiento;				

	public function __construct()
	{

	}

	public function guardarHistorial($idSolicitud, $seguimiento, $db1)
	{
		$db1->RunSP("SP_HISTORIAL_CONTRATO",INSERT, array('ingresarSegumiento', '' , $idSolicitud, '', $seguimiento));
	}

	public function getIdHistorialContrato()
	{
		return $this->idHistorialContrato;
	}

	public function setIdHistorialContrato($idHistorialContrato)
	{
		$this->idHistorialContrato = $idHistorialContrato;
	}	
	
	public function getIdSolicitud()
	{
		return $this->idSolicitud;
	}
	
	public function setIdSolicitud($idSolicitud)
	{
		$this->idSolicitud = $idSolicitud;
	}		

	public function getFecha()
	{
		return $this->fecha;

	}
	public function setFecha($fecha)
	{
		$this->fecha = $fecha;
	}			

	public function getSeguimiento()
	{
		return $this->seguimiento;

	}
	public function setSeguimiento($seguimiento)
	{
		$this->seguimiento = $seguimiento;
	}				

}

?>