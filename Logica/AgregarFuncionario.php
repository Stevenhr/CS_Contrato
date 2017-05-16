<?php

$opcion = $_POST["HD_VALIDACION"];

if($opcion == 'validarExistenciaPersona')
{
	include("../Datos/Persona.php");
	$persona = new Persona();
	if($persona->cargarPersonaPorCedula($_POST["identificacion"]))
	{
		if($persona->validarExistenciaPersonaModulo())
		{
			echo 1;
		}
		else
		{
				$resultadoPersona = array();
				$resultadoPersona[0]["idPersona"] = $persona->getIdPersona();		
				$resultadoPersona[0]["Id_TipoDocumento"] = $persona->getIdTipoDocumento();		
				$resultadoPersona[0]["Cedula"] = $persona->getCedulaPersona();		
				$resultadoPersona[0]["Primer_Apellido"] = $persona->getPrimerApellido();				
				$resultadoPersona[0]["Segundo_Apellido"] = $persona->getSegundoApellido();				
				$resultadoPersona[0]["Primer_Nombre"] = $persona->getPrimerNombre();					
				$resultadoPersona[0]["Segundo_Nombre"] = $persona->getSegundoNombre();				
				$resultadoPersona[0]["Fecha_Nacimiento"] = $persona->getFechaNacimiento();				
				$resultadoPersona[0]["Nombre_Ciudad"] = $persona->getNombreCiudad();				
				$resultadoPersona[0]["Id_Genero"] = $persona->getIdGenero();				
				$resultadoPersona[0]["Id_Etnia"] = $persona->getIdEtnia();						
				print_r(json_encode($resultadoPersona[0]));  
		}
	}
	else
	{
		echo 0;
	}
}

if($opcion == 'validarExistenciaPersonaId')
{
	include("../Datos/Persona.php");
	$persona = new Persona();
	if($persona->cargarPersonaPorId($_POST["idPersona"]))
	{
				$resultadoPersona = array();
				$resultadoPersona[0]["idPersona"] = $persona->getIdPersona();		
				$resultadoPersona[0]["Id_TipoDocumento"] = $persona->getIdTipoDocumento();		
				$resultadoPersona[0]["Cedula"] = $persona->getCedulaPersona();		
				$resultadoPersona[0]["Primer_Apellido"] = $persona->getPrimerApellido();				
				$resultadoPersona[0]["Segundo_Apellido"] = $persona->getSegundoApellido();				
				$resultadoPersona[0]["Primer_Nombre"] = $persona->getPrimerNombre();					
				$resultadoPersona[0]["Segundo_Nombre"] = $persona->getSegundoNombre();				
				$resultadoPersona[0]["Fecha_Nacimiento"] = $persona->getFechaNacimiento();				
				$resultadoPersona[0]["Nombre_Ciudad"] = $persona->getNombreCiudad();				
				$resultadoPersona[0]["Id_Genero"] = $persona->getIdGenero();				
				$resultadoPersona[0]["Id_Etnia"] = $persona->getIdEtnia();						
				print_r(json_encode($resultadoPersona[0]));  
	}
	else
	{
		echo 0;
	}
}

if($opcion == 'crearPersona')
{
	include("../Datos/Persona.php");
	$persona = new Persona();	
	$persona->nuevaPersona($_POST["TX_IDENTIFICACION"],$_POST["SL_TIPO_DOCUMENTO"],$_POST["TX_PRIMER_APELLIDO"],$_POST["TX_SEGUNDO_APELLIDO"],$_POST["TX_PRIMER_NOMBRE"],$_POST["TX_SEGUNDO_NOMBRE"],$_POST["TX_FECHA_NACIMIENTO"],41,$_POST["SL_CIUDAD"],$_POST["SL_GENERO"],$_POST["SL_ETNIA"]);
	$persona->guardarPersona();
	echo $persona->getMensaje();
}

if($opcion == 'editarPersona')
{
	include("../Datos/Persona.php");
	$persona = new Persona();	
	$persona->editarPersona($_POST["HD_ID_PERSONA"],$_POST["TX_IDENTIFICACION"],$_POST["SL_TIPO_DOCUMENTO"],$_POST["TX_PRIMER_APELLIDO"],$_POST["TX_SEGUNDO_APELLIDO"],$_POST["TX_PRIMER_NOMBRE"],$_POST["TX_SEGUNDO_NOMBRE"],$_POST["TX_FECHA_NACIMIENTO"],41,$_POST["SL_CIUDAD"],$_POST["SL_GENERO"],$_POST["SL_ETNIA"]);	
	echo $persona->getMensaje();
}

if($opcion == 'eliminarPersona')
{
	include("../Datos/Persona.php");
	$persona = new Persona();	
	$persona->eliminarPersona($_POST["idPersona"]);	
	echo $persona->getMensaje();
}


if($opcion == 'cargarPermisos')
{
	include("../Datos/Persona.php");
	$persona = new Persona();	
	$permisos = $persona->cargarPermisos($_POST["idPersona"]);		
	$nombreActividad = $permisos->getNombreActividad();
	$idActividad = $permisos->getIdActividad();

	$actividadesOpciones = "<div class='table-responsive'><table class='table table-bordered table-responsive'>
            					<tr>
            		 				<th class='col-md-8'>Actividad</th> <th class='col-md-4'>Estado</th>
		  						</tr>";				   	
	foreach ($nombreActividad as $actividad => $estado)
	{
		foreach ($idActividad as $nombreActividad => $id)
		{
			if($actividad == $nombreActividad)
			{
				if($estado == 1)
				{
					$radioOpcionActivo = 'btn btn-primary active';
					$radioOpcionInactivo = 'btn btn-primary';
				}					
				else
				{
					$radioOpcionActivo = 'btn btn-primary';
					$radioOpcionInactivo = 'btn btn-primary active';
				}
				$actividadesOpciones .= "<tr id='". $id ."'>";					
				$actividadesOpciones .= '<td><h5>' .  $actividad . '</h5></td>';
				$actividadesOpciones .= '<td><h5>';
				$actividadesOpciones .=  '<div class="btn-group" data-toggle="buttons">';
				$actividadesOpciones .=  '	<label class="' . $radioOpcionActivo . '" onClick="Funcion_Permiso(' . $id . ',\'Activar\') ">
												<input type="radio" name="options"  autocomplete="off">
													Activo
											</label>
											<label class="' .  $radioOpcionInactivo . '" onClick="Funcion_Permiso(' . $id . ',\'Denegar\') ">
												<input type="radio" name="options"  autocomplete="off">
													Inacitvo
											</label>';	
				$actividadesOpciones .= '</td></h5>';												
				$actividadesOpciones .=  '</div>';
			}
		}
	}	

	$actividadesOpciones .= "
			<script>
	
				function Funcion_Permiso(idActividad,opcion)
				{					  
					  Editar_Permisos(idActividad,opcion);
				}
										
			</script>
			";	

    echo $actividadesOpciones;

}

if($opcion == 'editarPermiso')
{
	include("../Datos/Persona.php");
	$persona = new Persona();		
	if($persona->editarPermisos($_POST["idPersona"],$_POST["idActividad"],$_POST["opcion"]))
	{
		echo 1;
	}
	else
	{
		echo 0;
	}
}

if($opcion == 'cargarFuncionarios')
{
	session_start();
	include("../Datos/ManejoPersona.php");
	$manejoPersona = new ManejoPersona();
	$personas = $manejoPersona->otbenerFuncionario();

    if($personas != null)
    {
     	$tablaFuncionario = "<div class='table-responsive'><table class='table table-bordered table-responsive'>
            					<tr>
            		 				<th class='col-md-3'>Identificación</th> <th class='col-md-4'>Apellido</th>  <th class='col-md-4'>Nombre</th> <th class='col-md-1'>Operaciones</th>
		  						</tr>";				   
	    
	    foreach($personas as $persona)
	    {
				 $tablaFuncionario .= "<tr id='". $persona->getIdPersona() ."'>";	
				 $tablaFuncionario .= "<td><h5>" . $persona->getCedulaPersona() . "</h5></td>";	
				 $tablaFuncionario .= "<td><h5>" . $persona->getPrimerApellido() . " " . $persona->getSegundoApellido(). "</h5></td>";					 
				 $tablaFuncionario .= "<td><h5>" . $persona->getPrimerNombre() . " " . $persona->getSegundoNombre(). "</h5></td>";			

				$tablaFuncionarioOpciones = "<div class='table-responsive'><table class='table table-bordered table-responsive'><tr>";
				if($_SESSION['Editar Funcionario'] == 1)
					$tablaFuncionarioOpciones .= "<td><button type='button' class='editar_fun btn btn-link' id='". $persona->getIdPersona() ."' title='Editar Funcionario' ><span class='glyphicon glyphicon-pencil'></span></button></td>";
				else
					$tablaFuncionarioOpciones .= "<td><button type='button' class='btn btn-link' title='Editar Funcionario' disabled='disabled'><span class='glyphicon glyphicon-pencil'></span></button></td>";

				if($_SESSION['Eliminar Funcionario'] == 1)
					$tablaFuncionarioOpciones .= "<td><button type='button' class='eliminar_fun btn btn-link' id='". $persona->getIdPersona() ."' title='Eliminar Funcionario'><span class='glyphicon glyphicon-remove'></span></button></td>";
				else
					$tablaFuncionarioOpciones .= "<td><button type='button' class='btn btn-link' title='Eliminar Funcionario' disabled='disabled'><span class='glyphicon glyphicon-remove'></span></button></td>";
				
				if($_SESSION['Editar Actividades'] == 1)
					$tablaFuncionarioOpciones .= "<td><button type='button' class='permisos_fun btn btn-link' id='". $persona->getIdPersona() ."' title='Agregar - Editar Permisos'><span class='glyphicon glyphicon-globe'></span></button></td>";
				else
					$tablaFuncionarioOpciones .= "<td><button type='button' class='btn btn-link'  title='Agregar - Editar Permisos' disabled='disabled'><span class='glyphicon glyphicon-globe'></span></button></td>";

	    		$tablaFuncionarioOpciones .= "</tr></table><div>";	
				$tablaFuncionario .=  "<td>" . $tablaFuncionarioOpciones ."</td>";									 									 
				$tablaFuncionario .= "</tr>";											

		 
	    }

	    $tablaFuncionario .= "</table></div>";

		$tablaFuncionario .= "
				<script>
					$('.editar_fun').click(function(){
						  var _Id_Persona = $(this).attr('id');
						  Editar_Funcionario(_Id_Persona);
						
											          });		 
											  
					$('.eliminar_fun').click(function(){
						   var _Id_Persona = $(this).attr('id');
						   Eliminar_Funcionario(_Id_Persona);
											  });

					$('.permisos_fun').click(function(){
						   var _Id_Persona = $(this).attr('id');
						   Editar_Actividades(_Id_Persona);
											  });											 
					</script>
					";

	    echo $tablaFuncionario;
    }
    else
    {
    	echo 0;
    }

    
}
?>