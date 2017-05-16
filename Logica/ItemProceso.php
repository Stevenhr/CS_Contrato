<?php

$opcion = $_POST["HD_VALIDACION"];

if($opcion == 'cargarModalidad')
{
	session_start();
	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	$manejadorItemsProceso->cararModadlidadTramite();
	$subdirecciones = $manejadorItemsProceso->getModalidadTramite();

    if($subdirecciones != null)
    {
		$subdireccionOpciones = "<br><br><div class='table-responsive'><table class='table table-bordered table-responsive'>
            					<tr>
            		 				<th class='col-md-8'>Nombre</th> <th class='col-md-4'>Opciones</th>
		  						</tr>";				   	
	    
	    foreach($subdirecciones as $subdireccion)
	    {
				 $subdireccionOpciones .= "<tr id='ROW". $subdireccion->getIdModalidadTramite() ."'>";					 
				 $subdireccionOpciones .= '<td><input type="text" id="TX_MODALIDAD_TRAMITE' .  $subdireccion->getIdModalidadTramite() . '" class="form-control" placeholder="Nombre Modalidad" value="' .  $subdireccion->getNombreModalidadTramite() . '"maxlength="50" required disabled /></td>';					

				$tablaOpciones = "<div class='table-responsive'><table class='table table-bordered table-responsive'><tr>";
				if($_SESSION['Modificar Opciones De Proceso'] == 1)
				{
					$tablaOpciones .= "<td><button type='button' class='editar_motalidadTramite btn btn-link' id='EDIT". $subdireccion->getIdModalidadTramite() ."' title='Editar Modalidad' ><span class='glyphicon glyphicon-pencil'></span></button></td>";
					//$tablaOpciones .= "<td><button type='button' class='guardar_motalidadTramite btn btn-link' id='SAVE". $subdireccion->getIdModalidadTramite() ."' title='Guardar Modalidad' disabled><span class='glyphicon glyphicon-floppy-disk'></span></button></td>";					
					$tablaOpciones .= "<td><button type='button' class='eliminarModalidadTramite btn btn-link' id='DELE". $subdireccion->getIdModalidadTramite() ."' title='Eliminar Modalidad'><span class='glyphicon glyphicon-remove'></span></button></td>";					
				}
				else
				{
					$tablaOpciones .= "<td><button type='button' class='btn btn-link' title='Editar Modalidad' disabled='disabled'><span class='glyphicon glyphicon-pencil'></span></button></td>";
					//$tablaOpciones .= "<td><button type='button' class='btn btn-link' title='Guardar Modalidad' disabled='disabled'><span class='glyphicon glyphicon-floppy-disk'></span></button></td>";					
					$tablaOpciones .= "<td><button type='button' class='btn btn-link' title='Eliminar Modalidad' disabled='disabled'><span class='glyphicon glyphicon-remove'></span></button></td>";					
				}
				

	    		$tablaOpciones .= "</tr></table><div>";	
				$subdireccionOpciones .=  "<td>" . $tablaOpciones ."</td>";									 									 
				$subdireccionOpciones .= "</tr>";															 
		}

	    $subdireccionOpciones .= "</table></div>";

		$subdireccionOpciones .= "
				<script>

					$('.editar_motalidadTramite').click(function(){
						  var idModalidadTramite = $(this).attr('id');
						  editarModalidad(idModalidadTramite);						  
											          			});		 

					$('.guardar_motalidadTramite').click(function(){
						  var idModalidadTramite = $(this).attr('id');
						  guardarModalidad(idModalidadTramite);
											          				});		 
											  
					$('.eliminarModalidadTramite').click(function(){
						   	var idModalidadTramite = $(this).attr('id');
							 eliminarModalidad(idModalidadTramite);
											  						});

					</script>
					";

	    echo $subdireccionOpciones;

	}
	else
	{
		echo '<br><strong>!No existen modalidades de tramites registrados.</strong>';    
	}

}

if($opcion == 'obtenerTramiteId')
{
	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	echo $manejadorItemsProceso->obtenerTramiteId($_POST["idModalidadTramite"]);
}

if($opcion == 'cargarPanelNavegacion')
{
	include("../Datos/ManejadorItemsProceso.php");
	include("../Datos/itemProceso.php");	
	$manejadorItemsProceso = new ManejadorItemsProceso();
	$itemProcesoArray = $manejadorItemsProceso->obtenerPanel();
	$arrayItemProcesoArray = array();	
	$opcionChequeo = "";
	foreach($itemProcesoArray as $itemProceso)
	{				
		$opcionChequeo .= '<div class="checkbox" >
								<label>
									<input type="checkbox" value="' . $itemProceso->getIdItemProceso() . '" id="CB_ITEM_PANEL_NAVEGACION' . $itemProceso->getIdItemProceso() . '" name="CB_ITEM_PANEL_NAVEGACION[]">
									' .  $itemProceso->getNombreItemProceso() . '
									</label>
							</div>							
							';		
	}	
	echo $opcionChequeo;
}

if($opcion == 'cargarPanelNavegacionPorId')
{
	include("../Datos/ManejadorItemsProceso.php");
	include("../Datos/itemProceso.php");	
	$itemProcesoArray = array();
	$manejadorItemsProceso = new ManejadorItemsProceso();
	$itemProcesos = $manejadorItemsProceso->obtenerPanelPorId($_POST["idModalidadTramite"]);	
	foreach($itemProcesos as $itemProceso)
	{
		array_push($itemProcesoArray, $itemProceso->getIdItemProceso());
	}
	print_r(json_encode($itemProcesoArray));		
}

if($opcion == 'editarModalidad')
{
	if(isset($_POST["CB_ITEM_PANEL_NAVEGACION"]) )
	{	
		include("../Datos/ManejadorItemsProceso.php");
		$manejadorItemsProceso = new ManejadorItemsProceso();
		if($manejadorItemsProceso->modificarModadlidadTramite($_POST["HD_MODALIDAD_TRAMITE"],$_POST["TX_ITEM_PROCESO"], $_POST["CB_ITEM_PANEL_NAVEGACION"]))
		{
			echo 1;
		}
		else
		{
			echo '<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> El nombre que desea modificar en la modalidad de selección o trámite ya se encuentra registrado.</div>';
		}
	}
	else
	{
			echo '<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> La modalidad de selección debe contener mínimo un módulo.</div>';			
	}	
}

if($opcion == 'eliminarModalidad')
{
	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	if($manejadorItemsProceso->eliminarModadlidadTramite($_POST["idModalidadTramite"],$_POST["nombreModalidadTramite"]))
	{
		echo 1;
	}
	else
	{
		echo '<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> No se puede eliminar la modalidad, por favor comuniquese con el área de sistemas.</div>';
	}
}

if($opcion == 'agregarModalidadTramite')
{	
	if(isset($_POST["CB_ITEM_PANEL_NAVEGACION"]) )
	{	
		include("../Datos/ManejadorItemsProceso.php");
		$manejadorItemsProceso = new ManejadorItemsProceso();			
		if($manejadorItemsProceso->guardarModadlidadTramite($_POST["TX_ITEM_PROCESO"], $_POST["CB_ITEM_PANEL_NAVEGACION"]))
		{		
			echo 1;
		}
		else
		{
		 	echo '<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> La modalidad de selección o trámite que desea registrar ya se encuentra registrado.</div>';
		}	
	}
	else
	{
		echo '<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> La modalidad de selección debe contener mínimo un módulo.</div>';			
	}														
}


if($opcion == 'cargarSubdireccion')
{
	session_start();
	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	$manejadorItemsProceso->cargarSubdirecciones();
	$subdirecciones = $manejadorItemsProceso->getSubdireccion();

    if($subdirecciones != null)
    {
		$subdireccionOpciones = "<br><br><div class='table-responsive'><table class='table table-bordered table-responsive'>
            					<tr>
            		 				<th class='col-md-8'>Nombre</th> <th class='col-md-4'>Opciones</th>
		  						</tr>";				   	
	    
	    foreach($subdirecciones as $subdireccion)
	    {
				 $subdireccionOpciones .= "<tr id='ROSB". $subdireccion->getIdSubdireccion() ."'>";					 
				 $subdireccionOpciones .= '<td><input type="text" id="TX_SUBDIRECCION' .  $subdireccion->getIdSubdireccion() . '" class="form-control" placeholder="Nombre Modalidad" value="' .  $subdireccion->getNombreSubdireccion() . '"maxlength="50" required disabled /></td>';					

				$tablaOpciones = "<div class='table-responsive'><table class='table table-bordered table-responsive'><tr>";
				if($_SESSION['Modificar Opciones De Proceso'] == 1)
				{
					$tablaOpciones .= "<td><button type='button' class='editar_subSolicitante btn btn-link' id='EDSB". $subdireccion->getIdSubdireccion() ."' title='Editar Subdirección' ><span class='glyphicon glyphicon-pencil'></span></button></td>";
					$tablaOpciones .= "<td><button type='button' class='guardar_subSolicitante btn btn-link' id='SASB". $subdireccion->getIdSubdireccion() ."' title='Guardar Subdirección' disabled><span class='glyphicon glyphicon-floppy-disk'></span></button></td>";					
					$tablaOpciones .= "<td><button type='button' class='eliminar_subSolicitante btn btn-link' id='DESB". $subdireccion->getIdSubdireccion() ."' title='Eliminar Subdirección'><span class='glyphicon glyphicon-remove'></span></button></td>";					
				}
				else
				{
					$tablaOpciones .= "<td><button type='button' class='btn btn-link' title='Editar Subdirección' disabled='disabled'><span class='glyphicon glyphicon-pencil'></span></button></td>";
					$tablaOpciones .= "<td><button type='button' class='btn btn-link' title='Guardar Subdirección' disabled='disabled'><span class='glyphicon glyphicon-floppy-disk'></span></button></td>";					
					$tablaOpciones .= "<td><button type='button' class='btn btn-link' title='Eliminar Subdirección' disabled='disabled'><span class='glyphicon glyphicon-remove'></span></button></td>";					
				}
				

	    		$tablaOpciones .= "</tr></table><div>";	
				$subdireccionOpciones .=  "<td>" . $tablaOpciones ."</td>";									 									 
				$subdireccionOpciones .= "</tr>";															 
		}

	    $subdireccionOpciones .= "</table></div>";

		$subdireccionOpciones .= "
				<script>

					$('.editar_subSolicitante').click(function(){
						  var idSubdireccion = $(this).attr('id');
						  editarSubdireccion(idSubdireccion);						  
											          			});		 

					$('.guardar_subSolicitante').click(function(){
						  var idSubdireccion = $(this).attr('id');
						  guardarSubdireccion(idSubdireccion);
											          				});		 
											  
					$('.eliminar_subSolicitante').click(function(){
						   	var idSubdireccion = $(this).attr('id');
							 eliminarSubdireccion(idSubdireccion);
											  						});

					</script>
					";

	    echo $subdireccionOpciones;

	}
	else
	{
		echo '<br><strong>!No existen subdirecciones registradas.</strong>';    
	}

}

if($opcion == 'editarSubdireccion')
{
	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	if($manejadorItemsProceso->modificarSubdireccion($_POST["idSubdireccion"],$_POST["nombreSubdireccion"]))
	{
		echo 1;
	}
	else
	{
		echo '<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> El nombre que desea modificar de la Subdirección ya se encuentra registrado.</div>';
	}
}

if($opcion == 'eliminarSubdireccion')
{
	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	if($manejadorItemsProceso->eliminarSubdireccion($_POST["idSubdireccion"],$_POST["nombreSubdireccion"]))
	{
		echo 1;
	}
	else
	{
		echo '<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> No se puede eliminar la subdirección, por favor comuniquese con el área de sistemas.</div>';
	}
}

if($opcion == 'agregarSubdireccion')
{
	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	if($manejadorItemsProceso->guardarSubdireccion($_POST["TX_ITEM_PROCESO"]))
	{
		echo 1;
	}
	else
	{
		echo '<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> La Subdirección que desea ingresar ya se encuentra registrada.</div>';
	}	
}


if($opcion == 'cargarActuacion')
{
	session_start();
	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	$manejadorItemsProceso->cargarActuaciones();
	$documentoes = $manejadorItemsProceso->getActuacion();

    if($documentoes != null)
    {
		$documentosOpciones = "<br><br><div class='table-responsive'><table class='table table-bordered table-responsive'>
            					<tr>
            		 				<th class='col-md-4'>Nombre</th> <th class='col-md-4'>Acción</th> <th class='col-md-4'>Opciones</th>
		  						</tr>";				   	
	    
	    foreach($documentoes as $documento)
	    {
				 $documentosOpciones .= "<tr id='ROAC". $documento->getIdActuacion() ."'>";					 
				 $documentosOpciones .= '<td><input type="text" id="TX_ACTUACION' .  $documento->getIdActuacion() . '" class="form-control" placeholder="Nombre Modalidad" value="' .  $documento->getNombreActuacion() . '"maxlength="50" required disabled /></td>';					

				 if($documento->getAccionActuacion() == 1)				 	
				 {
				 	$opcSelCont = " selected ";
				 	$opcSelDet = " ";
				 }
				 else
				 {
				 	$opcSelCont = " ";
				 	$opcSelDet = " selected ";				 	
				 }

				 $documentosOpciones .= '<td><select id="SL_ACTUACION_ACCION' .  $documento->getIdActuacion() . '" class="form-control" required disabled>
				 							<option value="1" ' . $opcSelCont . '>Continuar</option>
				 							<option value="0" ' . $opcSelDet . '>Detener</option>
										</select></td>
				 						';

				$tablaOpciones = "<div class='table-responsive'><table class='table table-bordered table-responsive'><tr>";
				if($_SESSION['Modificar Opciones De Proceso'] == 1)
				{
					$tablaOpciones .= "<td><button type='button' class='editar_actuacion btn btn-link' id='EDAC". $documento->getIdActuacion() ."' title='Editar Actuación' ><span class='glyphicon glyphicon-pencil'></span></button></td>";
					$tablaOpciones .= "<td><button type='button' class='guardar_actuacion btn btn-link' id='SAAC". $documento->getIdActuacion() ."' title='Guardar Actuación' disabled><span class='glyphicon glyphicon-floppy-disk'></span></button></td>";					
					$tablaOpciones .= "<td><button type='button' class='eliminar_actuacion btn btn-link' id='DEAC". $documento->getIdActuacion() ."' title='Eliminar Actuación'><span class='glyphicon glyphicon-remove'></span></button></td>";					
				}
				else
				{
					$tablaOpciones .= "<td><button type='button' class='btn btn-link' title='Editar Actuación' disabled='disabled'><span class='glyphicon glyphicon-pencil'></span></button></td>";
					$tablaOpciones .= "<td><button type='button' class='btn btn-link' title='Guardar Actuación' disabled='disabled'><span class='glyphicon glyphicon-floppy-disk'></span></button></td>";					
					$tablaOpciones .= "<td><button type='button' class='btn btn-link' title='Eliminar Actuación' disabled='disabled'><span class='glyphicon glyphicon-remove'></span></button></td>";					
				}
				

	    		$tablaOpciones .= "</tr></table><div>";	
				$documentosOpciones .=  "<td>" . $tablaOpciones ."</td>";									 									 
				$documentosOpciones .= "</tr>";															 
		}

	    $documentosOpciones .= "</table></div>";

		$documentosOpciones .= "
				<script>

					$('.editar_actuacion').click(function(){
						  var idActuacion = $(this).attr('id');
						  editarActuacion(idActuacion);						  
											          			});		 

					$('.guardar_actuacion').click(function(){
						  var idActuacion = $(this).attr('id');
						  guardarActuacion(idActuacion);
											          				});		 
											  
					$('.eliminar_actuacion').click(function(){
						   	var idActuacion = $(this).attr('id');
							 eliminarActuacion(idActuacion);
											  						});

					</script>
					";

	    echo $documentosOpciones;

	}
	else
	{
		echo '<br><strong>!No existen actuaciones registradas.</strong>';    
	}

}


if($opcion == 'editarActuacion')
{
	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	if($manejadorItemsProceso->modificarActuacion($_POST["idActuacion"],$_POST["nombreActuacion"],$_POST["estadoActuacion"]))
	{
		echo 1;
	}
	else
	{
		echo '<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> El nombre que desea modificar de la actuación ya se encuentra registrado.</div>';
	}
}

if($opcion == 'eliminarActuacion')
{
	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	if($manejadorItemsProceso->eliminarActuacion($_POST["idActuacion"],$_POST["nombreActuacion"],$_POST["estadoActuacion"]))
	{
		echo 1;
	}
	else
	{
		echo '<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> No se puede eliminar la actuación, por favor comuniquese con el área de sistemas.</div>';
	}
}

if($opcion == 'agregarActuación')
{
	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	if($manejadorItemsProceso->guardarActuacion($_POST["TX_ITEM_PROCESO"], $_POST["SL_ACTUACION_ACCION_FORM"]))
	{
		echo 1;
	}
	else
	{
		echo '<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> La Actuación que desea ingresar ya se encuentra registrada.</div>';
	}	
}

if($opcion == 'cargarMotivo')
{
	session_start();
	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	$manejadorItemsProceso->cargarMotivo();
	$documentos = $manejadorItemsProceso->getMotivo();

    if($documentos != null)
    {
		$documentosOpciones = "<br><br><div class='table-responsive'><table class='table table-bordered table-responsive'>
            					<tr>
            		 				<th class='col-md-8'>Nombre</th> <th class='col-md-4'>Opciones</th>
		  						</tr>";				   	
	    
	    foreach($documentos as $documento)
	    {
				 $documentosOpciones .= "<tr id='ROMT". $documento->getIdMotivo() ."'>";					 
				 $documentosOpciones .= '<td><input type="text" id="TX_MOTIVO' .  $documento->getIdMotivo() . '" class="form-control" placeholder="Nombre Modalidad" value="' .  $documento->getNombreMotivo() . '"maxlength="50" required disabled /></td>';					


				$tablaOpciones = "<div class='table-responsive'><table class='table table-bordered table-responsive'><tr>";
				if($_SESSION['Modificar Opciones De Proceso'] == 1)
				{
					$tablaOpciones .= "<td><button type='button' class='editar_motivo btn btn-link' id='EDMT". $documento->getIdMotivo() ."' title='Editar Motivo' ><span class='glyphicon glyphicon-pencil'></span></button></td>";
					$tablaOpciones .= "<td><button type='button' class='guardar_motivo btn btn-link' id='SAMT". $documento->getIdMotivo() ."' title='Guardar Motivo' disabled><span class='glyphicon glyphicon-floppy-disk'></span></button></td>";					
					$tablaOpciones .= "<td><button type='button' class='eliminar_motivo btn btn-link' id='DEMT". $documento->getIdMotivo() ."' title='Eliminar Motivo'><span class='glyphicon glyphicon-remove'></span></button></td>";					
				}
				else
				{
					$tablaOpciones .= "<td><button type='button' class='btn btn-link' title='Editar Motivo' disabled='disabled'><span class='glyphicon glyphicon-pencil'></span></button></td>";
					$tablaOpciones .= "<td><button type='button' class='btn btn-link' title='Guardar Motivo' disabled='disabled'><span class='glyphicon glyphicon-floppy-disk'></span></button></td>";					
					$tablaOpciones .= "<td><button type='button' class='btn btn-link' title='Eliminar Motivo' disabled='disabled'><span class='glyphicon glyphicon-remove'></span></button></td>";					
				}
				

	    		$tablaOpciones .= "</tr></table><div>";	
				$documentosOpciones .=  "<td>" . $tablaOpciones ."</td>";									 									 
				$documentosOpciones .= "</tr>";															 
		}

	    $documentosOpciones .= "</table></div>";

		$documentosOpciones .= "
				<script>

					$('.editar_motivo').click(function(){
						  var idMotivo = $(this).attr('id');
						  editarMotivo(idMotivo);						  
											          			});		 

					$('.guardar_motivo').click(function(){
						  var idMotivo = $(this).attr('id');
						  guardarMotivo(idMotivo);
											          				});		 
											  
					$('.eliminar_motivo').click(function(){
						   	var idMotivo = $(this).attr('id');
							 eliminarMotivo(idMotivo);
											  						});

					</script>
					";

	    echo $documentosOpciones;

	}
	else
	{
		echo '<br><strong>!No existen motivos registrados.</strong>';    
	}

}

if($opcion == 'editarMotivo')
{
	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	if($manejadorItemsProceso->modificarMotivo($_POST["idMotivo"],$_POST["nombreMotivo"]))
	{
		echo 1;
	}
	else
	{
		echo '<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> El nombre que desea modificar de el motivo ya se encuentra registrado.</div>';
	}
}

if($opcion == 'eliminarMotivo')
{
	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	if($manejadorItemsProceso->eliminarMotivo($_POST["idMotivo"],$_POST["nombreMotivo"]))
	{
		echo 1;
	}
	else
	{
		echo '<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> No se puede eliminar el motivo, por favor comuniquese con el área de sistemas.</div>';
	}
}

if($opcion == 'agregarMotivo')
{
	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	if($manejadorItemsProceso->guardarMotivo($_POST["TX_ITEM_PROCESO"]))
	{
		echo 1;
	}
	else
	{
		echo '<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> El motivo que desea ingresar ya se encuentra registrado.</div>';
	}	
}

if($opcion == 'cargarDocumento')
{
	session_start();
	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	$manejadorItemsProceso->cargarDocumento();
	$documentos = $manejadorItemsProceso->getDocumento();

    if($documentos != null)
    {
		$documentosOpciones = "<br><br><div class='table-responsive'><table class='table table-bordered table-responsive'>
            					<tr>
            		 				<th class='col-md-8'>Nombre</th> <th class='col-md-4'>Opciones</th>
		  						</tr>";				   	
	    
	    foreach($documentos as $documento)
	    {
				 $documentosOpciones .= "<tr id='RODC". $documento->getIdDocumento() ."'>";					 
				 $documentosOpciones .= '<td><input type="text" id="TX_DOCUMENTO' .  $documento->getIdDocumento() . '" class="form-control" placeholder="Nombre Modalidad" value="' .  $documento->getNombreDocumento() . '"maxlength="50" required disabled /></td>';					


				$tablaOpciones = "<div class='table-responsive'><table class='table table-bordered table-responsive'><tr>";
				if($_SESSION['Modificar Opciones De Proceso'] == 1)
				{
					$tablaOpciones .= "<td><button type='button' class='editar_documento btn btn-link' id='EDDC". $documento->getIdDocumento() ."' title='Editar Documento' ><span class='glyphicon glyphicon-pencil'></span></button></td>";
					$tablaOpciones .= "<td><button type='button' class='guardar_documento btn btn-link' id='SADC". $documento->getIdDocumento() ."' title='Guardar Documento' disabled><span class='glyphicon glyphicon-floppy-disk'></span></button></td>";					
					$tablaOpciones .= "<td><button type='button' class='eliminar_documento btn btn-link' id='DEDC". $documento->getIdDocumento() ."' title='Eliminar Documento'><span class='glyphicon glyphicon-remove'></span></button></td>";					
				}
				else
				{
					$tablaOpciones .= "<td><button type='button' class='btn btn-link' title='Editar Documento' disabled='disabled'><span class='glyphicon glyphicon-pencil'></span></button></td>";
					$tablaOpciones .= "<td><button type='button' class='btn btn-link' title='Guardar Documento' disabled='disabled'><span class='glyphicon glyphicon-floppy-disk'></span></button></td>";					
					$tablaOpciones .= "<td><button type='button' class='btn btn-link' title='Eliminar Documento' disabled='disabled'><span class='glyphicon glyphicon-remove'></span></button></td>";					
				}
				

	    		$tablaOpciones .= "</tr></table><div>";	
				$documentosOpciones .=  "<td>" . $tablaOpciones ."</td>";									 									 
				$documentosOpciones .= "</tr>";															 
		}

	    $documentosOpciones .= "</table></div>";

		$documentosOpciones .= "
				<script>

					$('.editar_documento').click(function(){
						  var idDocumento = $(this).attr('id');
						  editarDocumento(idDocumento);						  
											          			});		 

					$('.guardar_documento').click(function(){
						  var idDocumento = $(this).attr('id');
						  guardarDocumento(idDocumento);
											          				});		 
											  
					$('.eliminar_documento').click(function(){
						   	var idDocumento = $(this).attr('id');
							 eliminarDocumento(idDocumento);
											  						});

					</script>
					";

	    echo $documentosOpciones;

	}
	else
	{
		echo '<br><strong>!No existen documentos registrados.</strong>';    
	}

}

if($opcion == 'editarDocumento')
{
	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	if($manejadorItemsProceso->modificarDocumento($_POST["idDocumento"],$_POST["nombreDocumento"]))
	{
		echo 1;
	}
	else
	{
		echo '<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> El nombre que desea modificar de el documento ya se encuentra registrado.</div>';
	}
}

if($opcion == 'eliminarDocumento')
{
	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	if($manejadorItemsProceso->eliminarDocumento($_POST["idDocumento"],$_POST["nombreDocumento"]))
	{
		echo 1;
	}
	else
	{
		echo '<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> No se puede eliminar el documento, por favor comuniquese con el área de sistemas.</div>';
	}
}

if($opcion == 'agregarDocumento')
{
	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	if($manejadorItemsProceso->guardarDocumento($_POST["TX_ITEM_PROCESO"]))
	{
		echo 1;
	}
	else
	{
		echo '<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> El documento que desea ingresar ya se encuentra registrado.</div>';
	}	
}

if($opcion == 'cargarVariableSoporte')
{
	session_start();
	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	$manejadorItemsProceso->cargarVariableSoporte();
	$variablesSoporte = $manejadorItemsProceso->getVariableSoporte();

    if($variablesSoporte != null)
    {
		$documentosOpciones = "<br><br><div class='table-responsive'><table class='table table-bordered table-responsive'>
            					<tr>
            		 				<th class='col-md-4'>Nombre</th> <th class='col-md-4'>Valor</th> <th class='col-md-4'>Opciones</th>
		  						</tr>";				   	
	    
	    foreach($variablesSoporte as $variableSoporte)
	    {
				 $documentosOpciones .= "<tr id='ROVS". $variableSoporte->getIdVariableSoporte() ."'>";					 
				 $documentosOpciones .= '<td><input type="text" id="TX_NOMBRE_VARIABLE_SOPORTE' .  $variableSoporte->getIdVariableSoporte() . '" class="form-control" placeholder="Nombre Variable Soporte" value="' .  $variableSoporte->getNombreVariableSoporte() . '"maxlength="50" required disabled /></td>';					
				 $documentosOpciones .= '<td><input type="text" id="TX_VALOR_VARIABLE_SOPORTE' .  $variableSoporte->getIdVariableSoporte() . '" class="form-control" placeholder="Nombre Valor Variable Soporte" value="' .  $variableSoporte->getValorVariableSoporte() . '"maxlength="50" required disabled /></td>';					


				$tablaOpciones = "<div class='table-responsive'><table class='table table-bordered table-responsive'><tr>";
				if($_SESSION['Modificar Opciones De Proceso'] == 1)
				{
					$tablaOpciones .= "<td><button type='button' class='editar_variable_soporte btn btn-link' id='EDVS". $variableSoporte->getIdVariableSoporte() ."' title='Editar variable de soporte' ><span class='glyphicon glyphicon-pencil'></span></button></td>";
					$tablaOpciones .= "<td><button type='button' class='guardar_variable_soporte btn btn-link' id='SAVS". $variableSoporte->getIdVariableSoporte() ."' title='Guardar variable de soporte' disabled><span class='glyphicon glyphicon-floppy-disk'></span></button></td>";										
				}
				else
				{
					$tablaOpciones .= "<td><button type='button' class='btn btn-link' title='Editar variable de soporte' disabled='disabled'><span class='glyphicon glyphicon-pencil'></span></button></td>";
					$tablaOpciones .= "<td><button type='button' class='btn btn-link' title='Guardar variable de soporte' disabled='disabled'><span class='glyphicon glyphicon-floppy-disk'></span></button></td>";					
				}
				

	    		$tablaOpciones .= "</tr></table><div>";	
				$documentosOpciones .=  "<td>" . $tablaOpciones ."</td>";									 									 
				$documentosOpciones .= "</tr>";															 
		}

	    $documentosOpciones .= "</table></div>";

		$documentosOpciones .= "
				<script>

					$('.editar_variable_soporte').click(function(){
						  var idVariableSoporte = $(this).attr('id');
						  editarVariableSoporte(idVariableSoporte);						  
											          			});		 

					$('.guardar_variable_soporte').click(function(){
						  var idVariableSoporte = $(this).attr('id');
						  guardarVariableSoporte(idVariableSoporte);
											          				});		 											  
					</script>
					";

	    echo $documentosOpciones;

	}
	else
	{
		echo '<br><strong>!No existen variables de soporte registrados.</strong>';    
	}

}


if($opcion == 'editarVariableSoporte')
{
	if(is_numeric($_POST["valorVariableSoporte"]))
	{
		include("../Datos/ManejadorItemsProceso.php");
		$manejadorItemsProceso = new ManejadorItemsProceso();
		if($manejadorItemsProceso->modificarVariableDocumento($_POST["idVariableSoporte"],$_POST["valorVariableSoporte"]))
		{
			echo 1;
		}
		else
		{
			echo '<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> Ocurrio un error al modificar el valor, por favor comuníquese al área de sistemas.</div>';
		}
	}
	else
	{
		echo '<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> El valor debe ser numérico.</div>';
	}
}

?>