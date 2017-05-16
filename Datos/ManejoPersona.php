<?php

include("Persona.php");

class ManejoPersona
{
	private $db; 
	private $personas;

	public function __construct()
	{		    
    	$this->db = new Query('Apoyo');
    	$this->personas = array();
	}

	public function otbenerFuncionario()
	{		
		$query = $this->db->RunSP("SP_Obtener_Persona_Por_Tipo",SELECT, array(PERSONA_TIPO));
		if(count($query) > 0)
		{			
			for($i = 0; $i < count($query); $i++)
			{
				$persona = new Persona();
				$persona->setIdPersona($query[$i]["Id_Persona"]);
				$persona->setCedulaPersona($query[$i]["Cedula"]);
				$persona->setIdTipoDocumento($query[$i]["Id_TipoDocumento"]);
				$persona->setPrimerApellido($query[$i]["Primer_Apellido"]);
				$persona->setSegundoApellido($query[$i]["Segundo_Apellido"]);
				$persona->setPrimerNombre($query[$i]["Primer_Nombre"]);
				$persona->setSegundoNombre($query[$i]["Segundo_Nombre"]);
				$persona->setFechaNacimiento($query[$i]["Fecha_Nacimiento"]);
				$persona->setIdPais($query[$i]["Id_Pais"]);
				$persona->setNombreCiudad($query[$i]["Nombre_Ciudad"]);
				$persona->setIdGenero($query[$i]["Id_Genero"]);
				$persona->setIdEtnia($query[$i]["Id_Etnia"]);
				array_push($this->personas, $persona);
			}
		}
		else
		{
			 return null;
		}

		return $this->personas;
	}

}

?>