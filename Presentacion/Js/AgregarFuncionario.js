$("#TX_FECHA_NACIMIENTO").datepicker(
{
	format : "yyyy/mm/dd"
});	
function reiniciar()
{
	$('#BTN_GUARDAR_FUNCIONARIO').attr('disabled',true);	
	$("#TX_IDENTIFICACION").val(""); 
	$("#SL_TIPO_DOCUMENTO").val(0);
	$("#TX_PRIMER_APELLIDO").val("");
	$("#TX_SEGUNDO_APELLIDO").val("");
	$("#TX_PRIMER_NOMBRE").val("");
	$("#TX_SEGUNDO_NOMBRE").val("");
	$("#TX_FECHA_NACIMIENTO").val("");					
	$("#SL_CIUDAD").val(0);																
	$("#SL_GENERO").val(0);
	$("#SL_ETNIA").val(0);				
	$('#DV_CARGA_2').html('');	  

	$('#TX_IDENTIFICACION').attr('readonly', false);  								
	$('#SL_TIPO_DOCUMENTO').attr('readonly', false);  								
	$('#TX_PRIMER_APELLIDO').attr('readonly', false);  								
	$('#TX_SEGUNDO_APELLIDO').attr('readonly', false);  								
	$('#TX_PRIMER_NOMBRE').attr('readonly', false);  								
	$('#TX_SEGUNDO_NOMBRE').attr('readonly', false); 
	$('#SL_CIUDAD').attr('readonly', false);  								
	$('#SL_GENERO').attr('readonly', false);  								
	$('#SL_ETNIA').attr('readonly', false);  	
}

function bloquearCampos()
{
	$('#SL_TIPO_DOCUMENTO').attr('readonly', true);  								
	$('#TX_PRIMER_APELLIDO').attr('readonly', true);  								
	$('#TX_SEGUNDO_APELLIDO').attr('readonly', true);  								
	$('#TX_PRIMER_NOMBRE').attr('readonly', true);  								
	$('#TX_SEGUNDO_NOMBRE').attr('readonly', true);  									
	$('#SL_CIUDAD').attr('readonly', true);  								
	$('#SL_GENERO').attr('readonly', true);  								
	$('#SL_ETNIA').attr('readonly', true);  
}

$('#BTN_AGREGAR_FUNCIONARIO').click(function()
{	
	reiniciar();
	$('#LB_TITULO_FUNCIONARIO').html("Nuevo Funcionario");		
	$('#HD_VALIDACION').val('crearPersona');		
	$('#HD_ID_PERSONA').val(0);		
	$('#MODAL_NUEVO_FUNCIONARIO').modal('show');	
});

$('#BTN_CERRAR_VENTANA').click(function()
{	  
	$('#MODAL_NUEVO_FUNCIONARIO').modal('hide');	  
});														 

$('#BTN_CERRAR_VENTANA_CONFIRMACION').click(function()
{	  
	$('#MODAL_CONFIRMACION_NUEVO_FUNCIONARIO').modal('hide');	  
	$('#INFORMACION_CONFIRMACION_NUEVO_FUNCIONARIO').html('');	
});														 
$('#BTN_CERRAR_MODIFICAR_ACTIVIDADES').click(function()
{	  
	$('#MODAL_MODIFICAR_ACTIVIDADES').modal('hide');	  
	$('#OPCIONES_MODIFICAR_ACTIVIDADES').html('');	
});														 


$("#TX_IDENTIFICACION").focusout(function()
{	
	if($('#HD_VALIDACION').val() == 'crearPersona')
	{
		var identificacion = $("#TX_IDENTIFICACION").val(); 
		reiniciar();
		$("#TX_IDENTIFICACION").val(identificacion); 
		if(identificacion == "")
		{

		}        
        else
        {
			$('#BTN_GUARDAR_FUNCIONARIO').attr('readonly', false); 
			$("#DV_CARGA_2").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
			$.ajax({
		  		type: 'POST',
		  		url: '../Logica/AgregarFuncionario.php',
		  		data: {HD_VALIDACION : 'validarExistenciaPersona', identificacion : identificacion}, 
		  		success: function(data)
		  		{				  		  		   
                	$("#DV_CARGA_2").html('');
                	$('#BTN_GUARDAR_FUNCIONARIO').attr('disabled',false);	                	
            		if(data == 1)
            		{
            			bloquearCampos();
						$("#DV_CARGA_2").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>El funcionario que pretende ingresar ya pertence al módulo.</div>');
            			$('#BTN_GUARDAR_FUNCIONARIO').attr('disabled', true); 
            		}
                    else
                    {
	                	if(data != 0)
	                	{
							var datoPersona = $.parseJSON(data);												
							bloquearCampos();
							$("#SL_TIPO_DOCUMENTO").val(datoPersona.Id_TipoDocumento);
							$("#TX_PRIMER_APELLIDO").val(datoPersona.Primer_Apellido);
							$("#TX_SEGUNDO_APELLIDO").val(datoPersona.Segundo_Apellido);
							$("#TX_PRIMER_NOMBRE").val(datoPersona.Primer_Nombre);										
							$("#TX_SEGUNDO_NOMBRE").val(datoPersona.Segundo_Nombre);										
							$("#TX_FECHA_NACIMIENTO").val(datoPersona.Fecha_Nacimiento);										
							$("#SL_CIUDAD").val(datoPersona.Nombre_Ciudad);										
							$("#SL_GENERO").val(datoPersona.Id_Genero);										
							$("#SL_ETNIA").val(datoPersona.Id_Etnia);																
	                	}
                	}

                }
                	});
        }
    }					             
});

$( document ).ready(function() {

	$("#FR_NUEVO_FUNCIONARIO").submit(function()
	{
		$("#DV_CARGA_2").html('<img src="../../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/AgregarFuncionario.php',
			   data: $("#FR_NUEVO_FUNCIONARIO").serialize(),
			   success: function(data)
			   {								   

				   if(data[0] == 'S' && data[1] == 'e' && data[2] == ' ' && data[3] == 'h' && data[4] == 'a' && data[5] == ' ')
				   {
						$("#DV_CARGA_2").html('');
						$('#MODAL_NUEVO_FUNCIONARIO').modal('hide');	
						$('#MODAL_CONFIRMACION_NUEVO_FUNCIONARIO').modal('show');	  
						$('#INFORMACION_CONFIRMACION_NUEVO_FUNCIONARIO').html('<div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> ' + data + '</div>');	
						Cargar_Funcionarios();					
				   }
				   else
				   {
					   	$("#DV_CARGA_2").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información Alerta</strong> Ha ocurrido un error inesperado, Por favor comuniquese con el área de sistemas.</div>');						
				   }
			   }
			 });		
		return false;
	});
   
});

function Cargar_Funcionarios()
{
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/AgregarFuncionario.php',
			   data: {HD_VALIDACION : 'cargarFuncionarios'}, 
			   success: function(data)
			   {							   		
			   		if(data != 0)
			   		{
				   		$("#DV_CARGA").html('');
				   		$("#DV_CONTENIDO").show();
				   		$("#DV_CONTENIDO").html(data);
				   	}
				   	else
				   	{
				   		$("#DV_CARGA").html('<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Atención! </strong>No hay funcionarios registrados en el sistema.</div>');
				   		$("#DV_CONTENIDO").hide();
				   	}
			   }
			 });			
}

function Editar_Funcionario(_Id_Persona)
{

	$.ajax({
  		type: 'POST',
  		url: '../Logica/AgregarFuncionario.php',
  		data: {HD_VALIDACION : 'validarExistenciaPersonaId', idPersona : _Id_Persona}, 
  		success: function(data)
  		{				  		  		   
			if(data != 0)
			{
				reiniciar();
				$('#LB_TITULO_FUNCIONARIO').html("Editar Funcionario");		
				$('#HD_VALIDACION').val('editarPersona');		
				$('#HD_ID_PERSONA').val(_Id_Persona);
				$('#BTN_GUARDAR_FUNCIONARIO').attr('disabled', false); 						
				var datoPersona = $.parseJSON(data);
				$('#TX_IDENTIFICACION').attr('readonly', true);  								
				$("#TX_IDENTIFICACION").val(datoPersona.Cedula);
				$("#SL_TIPO_DOCUMENTO").val(datoPersona.Id_TipoDocumento);
				$("#TX_PRIMER_APELLIDO").val(datoPersona.Primer_Apellido);
				$("#TX_SEGUNDO_APELLIDO").val(datoPersona.Segundo_Apellido);
				$("#TX_PRIMER_NOMBRE").val(datoPersona.Primer_Nombre);										
				$("#TX_SEGUNDO_NOMBRE").val(datoPersona.Segundo_Nombre);										
				$("#TX_FECHA_NACIMIENTO").val(datoPersona.Fecha_Nacimiento);										
				$("#SL_CIUDAD").val(datoPersona.Nombre_Ciudad);										
				$("#SL_GENERO").val(datoPersona.Id_Genero);										
				$("#SL_ETNIA").val(datoPersona.Id_Etnia);																				
				$('#MODAL_NUEVO_FUNCIONARIO').modal('show');	
			}
			else
			{

			}
  		}
  			});
}
function Eliminar_Funcionario(_Id_Persona)
{
	$.ajax({
  		type: 'POST',
  		url: '../Logica/AgregarFuncionario.php',
  		data: {HD_VALIDACION : 'eliminarPersona', idPersona : _Id_Persona}, 
  		success: function(data)
  		{				  		  		   
			if(data[0] == 'S' && data[1] == 'e' && data[2] == ' ' && data[3] == 'h' && data[4] == 'a' && data[5] == ' ')
			{
				Cargar_Funcionarios();				
				$('#MODAL_CONFIRMACION_NUEVO_FUNCIONARIO').modal('show');	  
				$('#INFORMACION_CONFIRMACION_NUEVO_FUNCIONARIO').html('<div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> ' + data + '</div>');					
			}
			else
			{
				$('#MODAL_CONFIRMACION_NUEVO_FUNCIONARIO').modal('show');	  
				$('#INFORMACION_CONFIRMACION_NUEVO_FUNCIONARIO').html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> ' + data + '</div>');					
			}
  		}
  			});
}
function Editar_Actividades(_Id_Persona)
{
	$("#DV_CARGA_3").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$("#HD_ID_PERSONA_ACTIVIDADES").val(_Id_Persona);

	$.ajax({
  		type: 'POST',
  		url: '../Logica/AgregarFuncionario.php',
  		data: {HD_VALIDACION : 'cargarPermisos', idPersona : _Id_Persona}, 
  		success: function(data)
  		{
			$('#MODAL_MODIFICAR_ACTIVIDADES').modal('show');	  
			$('#OPCIONES_MODIFICAR_ACTIVIDADES').html(data);
			$("#DV_CARGA_3").html('');
  		}  		
  			});	
}

function Editar_Permisos(idActividad,opcion)
{		
	idPersona =  $('#HD_ID_PERSONA_ACTIVIDADES').val();			
	$.ajax({
  		type: 'POST',
  		url: '../Logica/AgregarFuncionario.php',
  		data: {HD_VALIDACION : 'editarPermiso', idPersona : idPersona, idActividad : idActividad, opcion : opcion}, 
  		success: function(data)
  		{  			
  			if(data == 1)
  			{
				$("#DV_CARGA_3").html('');
  			}
  			else
  			{
				$("#DV_CARGA_3").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información Alerta</strong> Ha ocurrido un error inesperado, no se puede modificar la actividad, por favor comuniquese con el área de sistemas.</div>');
  			}
  		}  		
  			});	

}

