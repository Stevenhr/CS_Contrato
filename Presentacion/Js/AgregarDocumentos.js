$('#BTN_AGREGAR_LISTA_DOCUMENTO').click(function()
{	  	
	$('#MT_Titulo').val('Nuevo Documento');
	$('#TX_ARCHIVO').attr('disabled', false);
	$('#HD_VALIDACION').val('guardarListadoDocumento');
	$('#HD_ID_LISTA_DOCUMENTO').val('#');
	$('#TX_NOMBRE_LISTA_DOCUMENTO').val('');
	$('#TX_ARCHIVO').val('');
	$('#MODAL_NUEVO_LISTA_DOCUMENTO').modal('show');	  	
});														 

$('#BTN_CERRAR_VENTANA').click(function()
{	  
	$('#MODAL_NUEVO_LISTA_DOCUMENTO').modal('hide');	  
	$('#DV_CARGA_2').html('');	
});

$( document ).ready(function() {

	$('#FR_NUEVO_LISTA_DOCUMENTO').ajaxForm
	({
				beforeSubmit: validate,
				success: function(data, statusText, xhr, form)
				{										
					if(data == "CN")
					{
						$("#DV_CARGA_2").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ocurrio un error al intentar subir el archivo, por favor comuníquese con el área de sistemas.</div>');
					}
					else if(data == 0)
					{
						$("#DV_CARGA_2").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>El nombre de documento que desea registrar ya se encuentra en uso.</div>');
					}
					else if(data == 1)
					{
						$('#DV_CARGA_2').html('');
						Cargar_Documentos();
						$('#MODAL_NUEVO_LISTA_DOCUMENTO').modal('hide');	
					}
					else
					{
						$("#DV_CARGA_2").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ocurrio un error inesperado, por favor comuníquese con el área de sistemas.</div>');
					}
				}									   					 			                                              
	});
   
});

							
function validate(formData, jqForm, options)
{			
   $('#DV_CARGA_2').html('<img src="images/loading.gif" />');
}	

function Cargar_Documentos()
{
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/AgregarDocumentos.php',
			   data: {HD_VALIDACION : 'cargarListadoDocumento'}, 
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
				   		$("#DV_CARGA").html('<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Atención! </strong>No hay documentos registrados en el sistema.</div>');
				   		$("#DV_CONTENIDO").hide();
				   	}
			   }
			 });			
}

function Editar_Lista_Documento(_Id_Lista_Doc, _Nom_Lista_Doc)
{	
	$('#MT_Titulo').val('Modificar Documento');
	$('#TX_ARCHIVO').attr('disabled', true);
	$('#HD_VALIDACION').val('modificarListadoDocumento');	
	$('#HD_ID_LISTA_DOCUMENTO').val(_Id_Lista_Doc);
	$('#TX_NOMBRE_LISTA_DOCUMENTO').val(_Nom_Lista_Doc);
	$('#MODAL_NUEVO_LISTA_DOCUMENTO').modal('show');	
}

function Eliminar_Lista_Documento(_Id_Lista_Doc, _Ruta_Documento)
{		
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/AgregarDocumentos.php',
			   data: {HD_VALIDACION : 'eliminarListadoDocumento', HD_ID_LISTA_DOCUMENTO : _Id_Lista_Doc, HD_RUTA_DOCUMENTO : _Ruta_Documento}, 
			   success: function(data)
			   {							   		
			   		if(data == 1)
			   		{
				   		$("#DV_CARGA").html('');
				   		//Cargar_Funcionarios();				   		
				   		$('#' + _Id_Lista_Doc).hide(1000);
				   	}
				   	else
				   	{
				   		$("#DV_CARGA").html('<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Atención! </strong>Ocurrio un error inesperado, por favor comuníquese con el área de sistemas.</div>');				   		
				   	}
			   }
			 });				
}