<?php

Class Calendario
{

	private $idCalendario;
	private $nombreAbogado;
	private $fechaAudienciaRiesgo;
	private $jornadaAudienciaRiesgo;
	private $fechaAudienciaAdjudicacion;
	private $jornadaAudienciaAdjudicacion;
	private $fechaCierreProcesos;

	public function __construct()
	{		        	

	}

	public function asignarDatos($idCalendario, $nombreAbogado, $fechaAudienciaRiesgo, $jornadaAudienciaRiesgo, $fechaAudienciaAdjudicacion, $jornadaAudienciaAdjudicacion, $fechaCierreProcesos)
	{
		$this->setIdCalendario($idCalendario);
		$this->setNombreAbogado($nombreAbogado);
		$this->setFechaAudienciaRiesgo($fechaAudienciaRiesgo);
		$this->setJornadaAudienciaRiesgo($jornadaAudienciaRiesgo);
		$this->setFechaAudienciaAdjudicacion($fechaAudienciaAdjudicacion);
		$this->setjornadaAudienciaAdjudicacion($jornadaAudienciaAdjudicacion);		
		$this->setFechaCierreProcesos($fechaCierreProcesos);		
	}	

	public function getIdCalendario()
	{    	
    	return $this->idCalendario;
	}

	public function setIdCalendario($idCalendario)
	{    	
    	$this->idCalendario = $idCalendario;
	}		

	public function getNombreAbogado()
	{    	
    	return $this->nombreAbogado;
	}

	public function setNombreAbogado($nombreAbogado)
	{    	
    	$this->nombreAbogado = $nombreAbogado;
	}			

	public function getFechaAudienciaRiesgo()
	{    	
    	return $this->fechaAudienciaRiesgo;
	}

	public function setFechaAudienciaRiesgo($fechaAudienciaRiesgo)
	{    	
    	$this->fechaAudienciaRiesgo = $fechaAudienciaRiesgo;
	}				

	public function getJornadaAudienciaRiesgo()
	{    	
    	return $this->jornadaAudienciaRiesgo;
	}

	public function setJornadaAudienciaRiesgo($jornadaAudienciaRiesgo)
	{    	
    	$this->jornadaAudienciaRiesgo = $jornadaAudienciaRiesgo;
	}			

	public function getFechaAudienciaAdjudicacion()
	{    	
    	return $this->fechaAudienciaAdjudicacion;
	}

	public function setFechaAudienciaAdjudicacion($fechaAudienciaAdjudicacion)
	{    	
    	$this->fechaAudienciaAdjudicacion = $fechaAudienciaAdjudicacion;
	}				

	public function getJornadaAudienciaAdjudicacion()
	{    	
    	return $this->jornadaAudienciaAdjudicacion;
	}

	public function setjornadaAudienciaAdjudicacion($jornadaAudienciaAdjudicacion)
	{    	
    	$this->jornadaAudienciaAdjudicacion = $jornadaAudienciaAdjudicacion;
	}					

	public function getFechaCierreProcesos()
	{    	
    	return $this->fechaCierreProcesos;
	}

	public function setFechaCierreProcesos($fechaCierreProcesos)
	{    	
    	$this->fechaCierreProcesos = $fechaCierreProcesos;
	}						


}

?>