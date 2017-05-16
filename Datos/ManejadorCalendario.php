<?php

if(!class_exists('Query')){ include 'Query.php'; }
include 'Calendario.php';

class ManejadorCalendario
{
	
	private $calendarios;
	private $db;

	public function __construct()
	{
		$this->db = new Query('Principal');
		$this->calendarios = array();
	}	

	public function obtenerCalendarios()
	{
		$query = $this->db->RunSP("SP_CALENDARIO",SELECT, array('verCalendarioTodo', ''));				
		for($i = 0; $i < count($query); $i++)
		{
			if($query[$i]["DT_FECHA_AUDIENCIA_RIESGO"] != null || $query[$i]["DT_FECHA_AUDIENCIA_ADJUDICACION"] != null || $query[$i]["DT_FECHA_CIERRE_PROCESO"] != null)
			{
				$calendario = new Calendario();
				$calendario->setIdCalendario(null);			
				$calendario->setNombreAbogado($query[$i]["Primer_Nombre"] . " " . $query[$i]["Primer_Apellido"]);
				$calendario->setFechaAudienciaRiesgo($query[$i]["DT_FECHA_AUDIENCIA_RIESGO"]);
				$calendario->setJornadaAudienciaRiesgo($query[$i]["V_JORNADA_AUDIENCIA_RIESGO"]);	
				$calendario->setFechaAudienciaAdjudicacion($query[$i]["DT_FECHA_AUDIENCIA_ADJUDICACION"]);
				$calendario->setjornadaAudienciaAdjudicacion($query[$i]["V_JORNADA_AUDIENCIA_ADJUDICACION"]);											
				$calendario->setFechaCierreProcesos($query[$i]["DT_FECHA_CIERRE_PROCESO"]);
				array_push($this->calendarios, $calendario);
			}
		}						
	}

	public function proximosEventosPorAbogado($idPersona)
	{
		$query = $this->db->RunSP("SP_CALENDARIO",SELECT, array('verProximosEventosPorAbogado', $idPersona));				
		for($i = 0; $i < count($query); $i++)
		{
			if($query[$i]["DT_FECHA_AUDIENCIA_RIESGO"] != null || $query[$i]["DT_FECHA_AUDIENCIA_ADJUDICACION"] != null || $query[$i]["DT_FECHA_CIERRE_PROCESO"] != null)
			{
				$calendario = new Calendario();
				$calendario->setIdCalendario(null);			
				$calendario->setNombreAbogado($query[$i]["Primer_Nombre"] . " " . $query[$i]["Primer_Apellido"]);
				$calendario->setFechaAudienciaRiesgo($query[$i]["DT_FECHA_AUDIENCIA_RIESGO"]);
				$calendario->setJornadaAudienciaRiesgo($query[$i]["V_JORNADA_AUDIENCIA_RIESGO"]);	
				$calendario->setFechaAudienciaAdjudicacion($query[$i]["DT_FECHA_AUDIENCIA_ADJUDICACION"]);
				$calendario->setjornadaAudienciaAdjudicacion($query[$i]["V_JORNADA_AUDIENCIA_ADJUDICACION"]);	
				$calendario->setFechaCierreProcesos($query[$i]["DT_FECHA_CIERRE_PROCESO"]);										
				array_push($this->calendarios, $calendario);
			}
		}						
	}	

	public function getCalendario()
	{
		return $this->calendarios;
	}
}

?>