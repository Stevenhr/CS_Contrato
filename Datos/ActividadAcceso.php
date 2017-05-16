<?php


class ActividadAcceso
{

	private $idPersona;
	private $idActividad;
	private $nombreActividad;
	private $db; 
	private $actividadesModulo;

	public function __construct($idPersona,$db)
	{		    
    	$this->idPersona = $idPersona;
    	$this->idActividad = array();
    	$this->nombreActividad = array();    	
		$this->db = $db;
	}	

	public function asignarPermisos()
	{		
		$this->retornarActividades();		
		$this->asignarEstado();
	}

	private function retornarActividades()
	{
		$query = $this->db->RunSP("SP_Obtener_Actividades_Modulo",SELECT, array(MODULO));	
		for($i = 0; $i < count($query); $i++)
		{			
			$this->idActividad[$query[$i]["Nombre_Actividad"]] = $query[$i]["Id_Actividad"];
			$this->nombreActividad[$query[$i]["Nombre_Actividad"]] = 0;
		}				
	}

	private function asignarEstado()
	{		
		$query = $this->db->RunSP("SP_Obtener_Estado_Actividades_Persona",SELECT, array($this->idPersona,MODULO));	
		for($i = 0; $i < count($query); $i++)
		{
			$this->nombreActividad[$query[$i]["Nombre_Actividad"]] = $query[$i]["Estado"];			
		}

		foreach ($this->nombreActividad as $actividad => $estado)
		{
			$_SESSION[$actividad] = $estado;		
		}		
	}

	public function agregarPermisos()
	{
		$query = $this->db->RunSP("SP_Obtener_Actividades_Modulo",SELECT, array(MODULO));	
		for($i = 0; $i < count($query); $i++)
		{			
			$query2 = $this->db->RunSP("SP_Validar_Existencia_Persona_Actividad",SELECT, array($this->idPersona, $query[$i]["Id_Actividad"]));	
			if($query2[0]["Resultado"] == 0)
			{
				$this->db->RunSP("SP_Insertar_Actividad_Persona",INSERT, array($this->idPersona, $query[$i]["Id_Actividad"], 0));	
			}
		}		
	}

	public function eliminarPermisos()
	{
		$query = $this->db->RunSP("SP_Obtener_Actividades_Modulo",SELECT, array(MODULO));	
		for($i = 0; $i < count($query); $i++)
		{			
			$query2 = $this->db->RunSP("SP_Validar_Existencia_Persona_Actividad",SELECT, array($this->idPersona, $query[$i]["Id_Actividad"]));	
			if($query2[0]["Resultado"] == 1)
			{
				$this->db->RunSP("SP_Eliminar_Actividad_Persona",INSERT, array($this->idPersona, $query[$i]["Id_Actividad"]));	
			}
		}	
		
		$query = $this->db->RunSP("SP_Obtener_Cantidad_Actividades_Persona",SELECT, array($this->idPersona));	
		if($query[0]["Resultado"] == 0)
		{
			$this->db->RunSP("SP_Eliminar_Acceso_Persona",DELETE, array($this->idPersona));			
		}
		return true;			
	}

	public function cargarPermisos()
	{
		$this->retornarActividades();
		$query = $this->db->RunSP("SP_Obtener_Estado_Actividades_Persona",SELECT, array($this->idPersona,MODULO));	
		for($i = 0; $i < count($query); $i++)
		{
			$this->nombreActividad[$query[$i]["Nombre_Actividad"]] = $query[$i]["Estado"];			
		}		
	}

	public function editarPermisos($idActividad,$opcion)
	{
		if($opcion == 'Activar')
			$estado = 1;
		if($opcion == 'Denegar')
			$estado = 0;

		$query = $this->db->RunSP("SP_Validar_Existencia_Persona_Actividad",SELECT, array($this->idPersona,$idActividad));	
		if($query[0]["Resultado"] == 0)
			$this->db->RunSP("SP_Insertar_Actividad_Persona",INSERT, array($this->idPersona,$idActividad,$estado));	
		else
			$this->db->RunSP("SP_Modificar_Estado_Actividad_Persona",DELETE, array($this->idPersona,$idActividad,$estado));	
		return true;
	}

	public function getNombreActividad()
	{
		return $this->nombreActividad;
	}

	public function getIdActividad()
	{
		return $this->idActividad;	
	}

	
}

?>