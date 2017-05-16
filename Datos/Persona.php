<?php

if(!class_exists('Query')){ include'Query.php'; }

include("ActividadAcceso.php");

class Persona
{
	private $idPersona;
	private $cedulaPersona;
	private $idTipoDocumento;
	private $primerApellido;
	private $segundoApellido;
	private $primerNombre;
	private $segundoNombre;
	private $fechaNacimiento;
	private $idPais;
	private $nombreCiudad;
	private $idGenero;
	private $idEtnia;
  private $usuarioPersona;
  private $contrasenaPersona;
  private $db; 
  private $mensaje; 

	public function __construct()
	{		    
    $this->db = new Query('Apoyo');
	}

  public function nuevaPersona($cedulaPersona, $idTipoDocumento, $primerApellido, $segundoApellido, $primerNombre, $segundoNombre, $fechaNacimiento, $idPais, $nombreCiudad, $idGenero, $idEtnia)
  {
        if(isset($this->idPersona))
        {
          unset($this->idPersona);
        }   
        $this->cedulaPersona = $cedulaPersona;
        $this->idTipoDocumento = $idTipoDocumento;
        $this->primerApellido = $primerApellido;
        $this->segundoApellido = $segundoApellido;
        $this->primerNombre = $primerNombre;
        $this->segundoNombre = $segundoNombre;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->idPais = $idPais;
        $this->nombreCiudad = $nombreCiudad;
        $this->idGenero = $idGenero;
        $this->idEtnia = $idEtnia;
  }

  public function editarPersona($idPersona,$cedulaPersona, $idTipoDocumento, $primerApellido, $segundoApellido, $primerNombre, $segundoNombre, $fechaNacimiento, $idPais, $nombreCiudad, $idGenero, $idEtnia)
  {
        $this->idPersona = $idPersona;
        $this->cedulaPersona = $cedulaPersona;
        $this->idTipoDocumento = $idTipoDocumento;
        $this->primerApellido = $primerApellido;
        $this->segundoApellido = $segundoApellido;
        $this->primerNombre = $primerNombre;
        $this->segundoNombre = $segundoNombre;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->idPais = $idPais;
        $this->nombreCiudad = $nombreCiudad;
        $this->idGenero = $idGenero;
        $this->idEtnia = $idEtnia;
        $this->db->RunSP("SP_Modificar_Persona",UPDATE, array($this->idPersona, $this->cedulaPersona, $this->idTipoDocumento, $this->primerApellido, $this->segundoApellido, $this->primerNombre, $this->segundoNombre, $this->fechaNacimiento, $this->idPais, $this->nombreCiudad, $this->idGenero, $this->idEtnia));      
        $this->mensaje = "Se ha modificado correctamente el funcionario.";
  }

  public function guardarPersona()
  {
      if(!$this->cargarPersonaPorCedula($this->cedulaPersona))      
        $this->almacenarPersona();              
      if(!$this->validarExistenciaPersonaModulo())
        $this->almecenarTipoPersona();
      if($this->usuarioPersona == null)
      {
        $this->crearAcceso();      
        $this->mensaje = "Se ha agregado correctamente el funcionario, el usuario es: " . $this->getUsuarioPersona() . " y la contraseña es el número de cedula.";
      }
      else
      {
        $this->mensaje = "Se ha agregado correctamente el funcionario, el usuario y contraseña es el mismo con que actualmente ingresar al SIM 'Sistema de información misional'.";
      }
      

      $actividadAcesso = new ActividadAcceso($this->idPersona,$this->db);
      $actividadAcesso->agregarPermisos();
  }

  public function eliminarPersona($idPersona)
  {
      $this->idPersona = $idPersona;
      $actividadAcesso = new ActividadAcceso($this->idPersona,$this->db);
      if($actividadAcesso->eliminarPermisos())
      {
          $this->eliminarTipoPersona();
          $this->mensaje = "Se ha eliminado correctamente el funcionario.";
      }
      else
      {
          $this->mensaje = "Ha ocurrido un error inesperado, Por favor comuniquese con el área de sistemas.";
      }
  }

  public function cargarPermisos($idPersona)
  {
      $this->idPersona = $idPersona;
      $actividadAcesso = new ActividadAcceso($this->idPersona,$this->db);
      $actividadAcesso->cargarPermisos();
      return $actividadAcesso;
  }

  public function editarPermisos($idPersona,$idActividad,$opcion)
  {
      $this->idPersona = $idPersona;
      $actividadAcesso = new ActividadAcceso($this->idPersona,$this->db);
      if($actividadAcesso->editarPermisos($idActividad,$opcion))
      {
          $this->mensaje = "Se ha modificado correctamente la actividad.";
          return true;
      }
      else
      {
          $this->mensaje = "Ha ocurrido un error inesperado, Por favor comuniquese con el área de sistemas.";
          return false;
      }

  }

  private function almacenarPersona()
  {
      $this->db->RunSP("SP_Insertar_Persona",INSERT, array($this->cedulaPersona, $this->idTipoDocumento, $this->primerApellido, $this->segundoApellido, $this->primerNombre, $this->segundoNombre, $this->fechaNacimiento, $this->idPais, $this->nombreCiudad, $this->idGenero, $this->idEtnia));      
      $this->cargarPersonaPorCedula($this->cedulaPersona);      
  }
  
  private function almecenarTipoPersona()
  {
      $this->db->RunSP("SP_Insertar_Persona_Tipo",INSERT, array(PERSONA_TIPO,$this->idPersona));
  }

  private function eliminarTipoPersona()
  {
      $this->db->RunSP("SP_Eliminar_Persona_Tipo",DELETE, array(PERSONA_TIPO,$this->idPersona)); 
  }

  private function crearAcceso()
  {      
      $this->usuarioPersona =  $this->crearUsuario();
      $this->contrasenaPersona = $this->cifrarCesar($this->cedulaPersona);    
      $sql = "INSERT INTO   acceso
                                (Id_Persona, Usuario, Contrasena)       
                            values
                                ($this->idPersona, '$this->usuarioPersona', SHA1('$this->contrasenaPersona'))";
      $this->db->RunQuery($sql,INSERT);      
  }

  private function cifrarCesar($texto)
  {     
    $claveCrifada = "";
    $constanteCorrimiento = 18; 
    for( $i = 0; $i < strlen($texto); $i++)
      $claveCrifada .= chr(( ord($texto[$i]) + $constanteCorrimiento) % 255);
    return $claveCrifada;
  }

  private function crearUsuario()
  {
      $usuarioPersona = strtolower($this->eliminarAcento($this->primerNombre . "." . $this->primerApellido));      
      if($this->validarUsuario($usuarioPersona))
          return $usuarioPersona;

      if($this->segundoNombre != "")
      {
          $usuarioPersona = strtolower($this->eliminarAcento($this->primerNombre . $this->segundoNombre[0] . "." . $this->primerApellido));
          if($this->validarUsuario($usuarioPersona))
            return $usuarioPersona;
      }   

      if($this->segundoApellido != "")
      {
          $usuarioPersona = strtolower($this->eliminarAcento($this->primerNombre  . "." . $this->primerApellido . $this->segundoApellido[0]));
          if($this->validarUsuario($usuarioPersona))
            return $usuarioPersona;
      }   

      if($this->segundoNombre != "" && $this->segundoApellido != "")
      {
          $usuarioPersona = strtolower($this->eliminarAcento($this->primerNombre  .  $this->segundoNombre[0]  ."." . $this->primerApellido . $this->segundoApellido[0]));
          if($this->validarUsuario($usuarioPersona))
            return $usuarioPersona;        
      }

      for($i = 10; $i <= 50; $i++)
      {
          $usuarioPersona = strtolower($this->eliminarAcento($this->primerNombre . "." . $this->primerApellido . $i));      
          if($this->validarUsuario($usuarioPersona))
              break;
      }
      return $usuarioPersona;        
  }

  private function eliminarAcento($palabra)
  {
    $palabra = str_replace(array('á','à','â','ã','ª','ä'),"a",$palabra);
    $palabra = str_replace(array('Á','À','Â','Ã','Ä'),"A",$palabra);
    $palabra = str_replace(array('Í','Ì','Î','Ï'),"I",$palabra);
    $palabra = str_replace(array('í','ì','î','ï'),"i",$palabra);
    $palabra = str_replace(array('é','è','ê','ë'),"e",$palabra);
    $palabra = str_replace(array('É','È','Ê','Ë'),"E",$palabra);
    $palabra = str_replace(array('ó','ò','ô','õ','ö','º'),"o",$palabra);
    $palabra = str_replace(array('Ó','Ò','Ô','Õ','Ö'),"O",$palabra);
    $palabra = str_replace(array('ú','ù','û','ü'),"u",$palabra);
    $palabra = str_replace(array('Ú','Ù','Û','Ü'),"U",$palabra);
    $palabra = str_replace(array('[','^','´','`','¨','~',']'),"",$palabra);    
    $palabra = str_replace("ñ","n",$palabra);
    $palabra = str_replace("Ñ","N",$palabra);
    $palabra = str_replace("&aacute;","a",$palabra);
    $palabra = str_replace("&Aacute;","A",$palabra);
    $palabra = str_replace("&eacute;","e",$palabra);
    $palabra = str_replace("&Eacute;","E",$palabra);
    $palabra = str_replace("&iacute;","i",$palabra);
    $palabra = str_replace("&Iacute;","I",$palabra);
    $palabra = str_replace("&oacute;","o",$palabra);
    $palabra = str_replace("&Oacute;","O",$palabra);
    $palabra = str_replace("&uacute;","u",$palabra);
    $palabra = str_replace("&Uacute;","U",$palabra);
    return $palabra;      
  }

  private function validarUsuario($opcionUsuario)
  {
      $query = $this->db->RunSP("SP_Validar_Existencia_Usuario",SELECT, array($opcionUsuario));
      if(count($query) == 0)
          return true;
      return false;    
  }

  public function cargarPersonaPorId($idPersona)
  {
      $query = $this->db->RunSP("SP_Obtener_Persona_Id",SELECT, array($idPersona));
      if(count($query) > 0)
      {
          $this->setIdPersona($query[0]["Id_Persona"]);
          $this->setIdTipoDocumento($query[0]["Id_TipoDocumento"]);
          $this->setCedulaPersona($query[0]["Cedula"]);
          $this->setPrimerApellido($query[0]["Primer_Apellido"]);
          $this->setSegundoApellido($query[0]["Segundo_Apellido"]);
          $this->setPrimerNombre($query[0]["Primer_Nombre"]);
          $this->setSegundoNombre($query[0]["Segundo_Nombre"]);
          $this->setFechaNacimiento($query[0]["Fecha_Nacimiento"]);
          $this->setNombreCiudad($query[0]["Nombre_Ciudad"]);
          $this->setIdGenero($query[0]["Id_Genero"]);
          $this->setIdEtnia($query[0]["Id_Etnia"]);

          $query = $this->db->RunSP("SP_Validar_Existencia_Usuario_Contraseña",SELECT, array($this->idPersona));
          if($query[0]["Resultado"] == 0)
          {
              $this->setUsuarioPersona(null);
              $this->setContrasenaPersona(null);
          }
          else
          {
              $this->setUsuarioPersona("-");            
              $this->setContrasenaPersona("-");
          }

          return true;
      }
      else
      {
          $this->mensaje = "Persona no existe.";        
      }
      return false;
  }

  public function cargarPersonaPorCedula($cedulaPersona)
  {
      $query = $this->db->RunSP("SP_Obtener_Persona",SELECT, array($cedulaPersona));
      if(count($query) > 0)
      {
          $this->setIdPersona($query[0]["Id_Persona"]);
          $this->setIdTipoDocumento($query[0]["Id_TipoDocumento"]);
          $this->setCedulaPersona($query[0]["Cedula"]);
          $this->setPrimerApellido($query[0]["Primer_Apellido"]);
          $this->setSegundoApellido($query[0]["Segundo_Apellido"]);
          $this->setPrimerNombre($query[0]["Primer_Nombre"]);
          $this->setSegundoNombre($query[0]["Segundo_Nombre"]);
          $this->setFechaNacimiento($query[0]["Fecha_Nacimiento"]);
          $this->setNombreCiudad($query[0]["Nombre_Ciudad"]);
          $this->setIdGenero($query[0]["Id_Genero"]);
          $this->setIdEtnia($query[0]["Id_Etnia"]);

          $query = $this->db->RunSP("SP_Validar_Existencia_Usuario_Contraseña",SELECT, array($this->idPersona));
          if($query[0]["Resultado"] == 0)
          {
              $this->setUsuarioPersona(null);
              $this->setContrasenaPersona(null);
          }
          else
          {
              $this->setUsuarioPersona("-");            
              $this->setContrasenaPersona("-");
          }
          return true;
      }
      else
      {
          $this->mensaje = "Persona no existe.";        
      }
      return false;
  }

  public function validarExistenciaPersonaModulo()
  {
      $query = $this->db->RunSP("SP_Validar_Existencia_Persona_Tipo",SELECT, array(PERSONA_TIPO,$this->idPersona));
      if($query[0]["Resultado"] != 0)
      {
        return true;
      }
      return false;
  }    

  public function asignarPermisos()
  {
     $actividadAcesso = new ActividadAcceso($this->idPersona,$this->db);     
     $actividadAcesso->asignarPermisos();     
  }

  public function getIdPersona()
  {
		return $this->idPersona;
  }

   public function setIdPersona($idPersona)
   {
    $this->idPersona = $idPersona;
   }   

   public function getCedulaPersona()
   {
		return $this->cedulaPersona;
   }

   public function setCedulaPersona($cedulaPersona)
   {
		$this->cedulaPersona = $cedulaPersona;
   }   

   public function getIdTipoDocumento()
   {
		return $this->idTipoDocumento;
   }

   public function setIdTipoDocumento($idTipoDocumento)
   {
		$this->idTipoDocumento = $idTipoDocumento;
   }   

   public function getPrimerApellido()
   {
		return $this->primerApellido;
   }

   public function setPrimerApellido($primerApellido)
   {
		$this->primerApellido = $primerApellido;
   }      

   public function getSegundoApellido()
   {
		return $this->segundoApellido;
   }

   public function setSegundoApellido($segundoApellido)
   {
		$this->segundoApellido = $segundoApellido;
   }         

   public function getPrimerNombre()
   {
		return $this->primerNombre;
   }

   public function setPrimerNombre($primerNombre)
   {
		$this->primerNombre = $primerNombre;
   }            

   public function getSegundoNombre()
   {
		return $this->segundoNombre;
   }

   public function setSegundoNombre($segundoNombre)
   {
		$this->segundoNombre = $segundoNombre;
   }            

   public function getFechaNacimiento()
   {
		return $this->fechaNacimiento;
   }

   public function setFechaNacimiento($fechaNacimiento)
   {
		$this->fechaNacimiento = $fechaNacimiento;
   }               

   public function getIdPais()
   {
		return $this->idPais;
   }

   public function setIdPais($idPais)
   {
		$this->idPais = $idPais;
   }                  

   public function getNombreCiudad()
   {
		return $this->nombreCiudad;
   }

   public function setNombreCiudad($nombreCiudad)
   {
		$this->nombreCiudad = $nombreCiudad;
   }                     

   public function getIdGenero()
   {
		return $this->idGenero;
   }

   public function setIdGenero($idGenero)
   {
		$this->idGenero = $idGenero;
   }                     

   public function getIdEtnia()
   {
		  return $this->idEtnia;
   }

   	public function setIdEtnia($idEtnia)
    {
		  $this->idEtnia = $idEtnia;
    }                        

   public function getUsuarioPersona()
   {
      return $this->usuarioPersona;
   }

    public function setUsuarioPersona($usuarioPersona)
    {
      $this->usuarioPersona = $usuarioPersona;
    }                        

   public function getContrasenaPersona()
   {
      return $this->contrasenaPersona;
   }

   public function setContrasenaPersona($contrasenaPersona)
   {
      $this->contrasenaPersona = $contrasenaPersona;
   }   

  public function getMensaje()
  {
    return $this->mensaje;
  }


}

?>