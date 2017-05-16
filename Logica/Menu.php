<?php

include("../Datos/Persona.php");
session_start();  
if(isset($idPersona))
{
	$_SESSION["ID_PERSONA_MOD_CONTR"] = $idPersona;
}
else
{
	if(!isset($_SESSION['Creación Check-List']))
	{
		?>
			<script type="text/javascript">
				 window.close();
			</script>		
		<?php	
	}
}


$persona = new Persona();
if($persona->cargarPersonaPorId($_SESSION["ID_PERSONA_MOD_CONTR"]))
{
	$_SESSION["NOMBRE_PERSONA_MOD_CONTR"] = $persona->getPrimerNombre() . " " . $persona->getPrimerApellido();	
	$persona->asignarPermisos();		
}


?>