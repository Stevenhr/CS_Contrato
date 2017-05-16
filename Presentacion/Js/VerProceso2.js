panelNavegacion = [
    "DIV_PANEL_1"
			];

var pasoNavegacion = -1;
//$("#DV_ACTUACION").hide();
$("#DV_MOTIVO").hide();
$("#DV_DOCUMENTO").hide();

function siguientePaso()
{
    pasoNavegacion = pasoNavegacion + 1;	
    varBarra = (pasoNavegacion * 100) / panelNavegacion.length;
    $('#' + panelNavegacion[pasoNavegacion]).show();       
    $("#PB_PROGRESO").css({width : varBarra + '%'}); 
    
    if(panelNavegacion[pasoNavegacion] == "DIV_PANEL_2")
    {		
		validarVerificacionDocumentos($("#HD_ID_SOLICITUD_1").val());
    }
    if(panelNavegacion[pasoNavegacion] == "DIV_PANEL_3")
    {				
		validarFechaRadicacion($("#HD_ID_SOLICITUD_1").val());
    }    
    if(panelNavegacion[pasoNavegacion] == "DIV_PANEL_4")
    {						
		validarFechaSesionComiteAprobracion($("#HD_ID_SOLICITUD_1").val());
    }           
    if(panelNavegacion[pasoNavegacion] == "DIV_PANEL_5")
    {						
    	validarFechaPublicacionConSecop($("#HD_ID_SOLICITUD_1").val());
    }
    if(panelNavegacion[pasoNavegacion] == "DIV_PANEL_6")
    {						
    	validarFechaAudienciaRiesgos($("#HD_ID_SOLICITUD_1").val());
    } 
    if(panelNavegacion[pasoNavegacion] == "DIV_PANEL_7")
    {						
    	validarNumeroFechaResolucionAperProc($("#HD_ID_SOLICITUD_1").val());
    }         
    if(panelNavegacion[pasoNavegacion] == "DIV_PANEL_8")
    {						
    	validarFechaPublicacionPrepliegosSECOP($("#HD_ID_SOLICITUD_1").val());
    }   
    if(panelNavegacion[pasoNavegacion] == "DIV_PANEL_9")
    {						
    	validarFechaPublicacionPliegosDefinitivoSECOP($("#HD_ID_SOLICITUD_1").val());
    }           
    if(panelNavegacion[pasoNavegacion] == "DIV_PANEL_10")
    {						
    	validarFechaCierreProcesos($("#HD_ID_SOLICITUD_1").val());
    }      
    if(panelNavegacion[pasoNavegacion] == "DIV_PANEL_11")
    {						
    	validarFechaSesionComiteAprobracion2($("#HD_ID_SOLICITUD_1").val());
    }          
    if(panelNavegacion[pasoNavegacion] == "DIV_PANEL_12")
    {						
    	validarFechaPublicacionEvaluaiconDefinitiva($("#HD_ID_SOLICITUD_1").val());
    }                  
    if(panelNavegacion[pasoNavegacion] == "DIV_PANEL_13")
    {						
    	validarFechaAudienciaAdjudicacion2($("#HD_ID_SOLICITUD_1").val());
    }
    if(panelNavegacion[pasoNavegacion] == "DIV_PANEL_14")
    {						
    	validarFechaNumeroResolucionAdjudicacion($("#HD_ID_SOLICITUD_1").val());
    }        
    if(panelNavegacion[pasoNavegacion] == "DIV_PANEL_15")
    {						
    	validarElaboracionContrato($("#HD_ID_SOLICITUD_1").val());    	
    }    

    if(varBarra >= 100)
    {
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/ValidacionProceso.php',
			   data: {HD_VALIDACION : 'finalizarProceso', HD_ID_SOLICITUD: $("#HD_ID_SOLICITUD_1").val()}, 
			   success: function(data)
			   {								   												
					alert(data);
					$("#DV_CARGA").html('');				
					if(data == 1)
					{
						alert("Proceso terminado correctamente.");
						window.location.href = 'VerProceso2.php';
					}
					else
					{
						$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ocurrio un error al finalizar el proceso, por favor comuníquese con el área de sistemas.</div>');
					}
			   }
			 });	    	
    }           
}

$("#DT_FECHA_RADICACION").datepicker({
		format : "yyyy/mm/dd"		
	});		

$("#DT_FECHA_SESION_COMITE_APROBACION").datepicker({
		format : "yyyy/mm/dd"		
	});		

$("#DT_FECHA_PUBLICACION_CONVOCATORIA_SECOP").datepicker({
		format : "yyyy/mm/dd"		
	});		

$("#DT_FECHA_AUDIENCIA_RIESGOS").datepicker({
		format : "yyyy/mm/dd"		
	});		

$("#DT_FECHA_RESOLUCION_APERTURA_PROCESO").datepicker({
		format : "yyyy/mm/dd"		
	});		

$("#DT_FECHA_PUB_PREPLIEGOS_SECOP").datepicker({
		format : "yyyy/mm/dd"		
	});		

$("#DT_FECHA_PUB_PLIEGOS_DEF_SECOP").datepicker({
		format : "yyyy/mm/dd"		
	});		

$("#DT_FECHA_CIERRE_PROCESOS").datepicker({
		format : "yyyy/mm/dd"		
	});		

$("#DT_FECHA_SESION_COMITE_APROBACION_2").datepicker({
		format : "yyyy/mm/dd"		
	});		

$("#DT_FECHA_PUB_EVAL_DEFINITIVA").datepicker({
		format : "yyyy/mm/dd"		
	});		

$("#DT_FECHA_AUD_ADJUDICACION").datepicker({
		format : "yyyy/mm/dd"		
	});		

$("#DT_FECHA_RESOLUCION_ADJUDICACION").datepicker({
		format : "yyyy/mm/dd"		
	});		

$("#DT_FECHA_ELABORACION_CONTRATO").datepicker({
		format : "yyyy/mm/dd"		
	});		


$('#BTN_CERRAR_VENTANA_CHECKLIST').click(function()
{	  
	$('#MODAL_CHECKLIST').modal('hide');
});


cargarModalidadTramite();
cargarCheckList();
cargarActuacion();
cargarMotivo();
cargarDocumento();
$('#DIV_PANEL_1').hide();
$('#DIV_PANEL_2').hide();
$('#DIV_PANEL_3').hide();
$('#DIV_PANEL_4').hide();
$('#DIV_PANEL_5').hide();
$('#DIV_PANEL_6').hide();
$('#DIV_PANEL_7').hide();
$('#DIV_PANEL_8').hide();
$('#DIV_PANEL_9').hide();
$('#DIV_PANEL_10').hide();
$('#DIV_PANEL_11').hide();
$('#DIV_PANEL_12').hide();
$('#DIV_PANEL_13').hide();
$('#DIV_PANEL_14').hide();
$('#DIV_PANEL_15').hide();


function cargarModalidadTramite()
{	
	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ValidacionProceso.php',
		   data: {HD_VALIDACION : 'cargarModalidadTramite'}, 
		   success: function(data)
		   {								   												
				$("#DV_CARGA").html('');				
				$("#SL_MODALIDAD").append(data);
		   }
		 });	
}

function cargarCheckList()
{	
	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ValidacionProceso.php',
		   data: {HD_VALIDACION : 'cargarCheckList'}, 
		   success: function(data)
		   {								   												
				$("#DV_CARGA").html('');				
				$("#SL_CHECK_LIST").append(data);
		   }
		 });	
}

function cargarActuacion()
{	
	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ValidacionProceso.php',
		   data: {HD_VALIDACION : 'cargarActuacion'}, 
		   success: function(data)
		   {								   												
				$("#DV_CARGA").html('');				
				$("#SL_ACTUACION").append(data);
		   }
		 });	
}

function cargarMotivo()
{	
	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ValidacionProceso.php',
		   data: {HD_VALIDACION : 'cargarMotivo'}, 
		   success: function(data)
		   {								   												
				$("#DV_CARGA").html('');				
				$("#SL_MOTIVO").append(data);
		   }
		 });	
}

function cargarDocumento()
{	
	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ValidacionProceso.php',
		   data: {HD_VALIDACION : 'cargarDocumento'}, 
		   success: function(data)
		   {								   												
				$("#DV_CARGA").html('');				
				$("#SL_DOCUMENTO").append(data);
		   }
		 });	
}


function cargarItemsCheckList(idCheckList)
{
	$("#DV_CARGA_2").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ValidacionProceso.php',
		   data: {HD_VALIDACION : 'cargarItemCheckList', idCheckList : idCheckList}, 
		   success: function(data)
		   {								   												
				if(data == 0)
				{					
					$("#BTN_CHECK_LIST").attr('disabled', true);
					$("#DV_CARGA_2").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>La lista de chequeo que seleccionó no cuenta con item\'s de selección.</div>');
				}
				else
				{
					$("#BTN_CHECK_LIST").attr('disabled', false);
					$("#DV_CARGA_2").html('');
					$("#DIV_ITEMS_CHECK_LIST").html(data);				
				}				
		   }
		 });			
}

function validarInicioProcesoItems()
{
	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');	
	$("#DV_PROCESO_CONTRATO_ESPECIFICO").html('');
	$("#DV_PROCESO_CONTRATO_ESPECIFICO").hide();
	$("#DV_BARRA_PROCESO_CONTRATO").hide();
	$.ajax({
		   type: "POST",
		   url: '../Logica/ValidacionProceso.php',
		   data: {HD_VALIDACION : 'validarInicioProcesoItems'}, 
		   success: function(data)
		   {								   								
				if(data == 1)
				{
					$("#DV_CARGA").html('');
					cargarContratosAsignados();					
				}
				else
				{
					$("#DV_CARGA").html(data);
				}
		   }
		 });		
}

function cargarContratosAsignados()
{
	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ValidacionProceso.php',
		   data: {HD_VALIDACION : 'cargarContratosAsignados'}, 
		   success: function(data)
		   {								   												
				$("#DV_CARGA").html('');
				if(data != 0)
				{
					$("#DV_CONTRATOS_ASIGNADOS").html(data);
				}
				else
				{
					$("#DV_CONTRATOS_ASIGNADOS").html('<div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>No tiene proceso activos.</div>');
				}
		   }
		 });			
}

function verProceso(idRadicado,asunto,solicitante,fecha, area, subidreccion)
{
	$("#HD_ID_SOLICITUD_1").val(idRadicado);
	$("#HD_ID_SOLICITUD_2").val(idRadicado);
	$("#HD_ID_SOLICITUD_3").val(idRadicado);
	$("#HD_ID_SOLICITUD_4").val(idRadicado);
	$("#HD_ID_SOLICITUD_5").val(idRadicado);
	$("#HD_ID_SOLICITUD_6").val(idRadicado);
	$("#HD_ID_SOLICITUD_7").val(idRadicado);
	$("#HD_ID_SOLICITUD_8").val(idRadicado);
	$("#HD_ID_SOLICITUD_9").val(idRadicado);
	$("#HD_ID_SOLICITUD_10").val(idRadicado);
	$("#HD_ID_SOLICITUD_11").val(idRadicado);
	$("#HD_ID_SOLICITUD_12").val(idRadicado);
	$("#HD_ID_SOLICITUD_13").val(idRadicado);
	$("#HD_ID_SOLICITUD_14").val(idRadicado);
	$("#HD_ID_SOLICITUD_15").val(idRadicado);	
	$("#DIV_TABLA_CONTRATOS").hide();	
	$("#DV_PROCESO_CONTRATO_ESPECIFICO").append('<blockquote><p><strong>' + asunto + '</strong></p><footer>' +  idRadicado + '</footer><footer>' +  solicitante + '</footer><footer>' +  area + '</footer><footer>' +  subidreccion + '</footer><footer>' +  fecha + '</footer></blockquote>');
	$("#DV_PROCESO_CONTRATO_ESPECIFICO").show();
	$("#DV_BARRA_PROCESO_CONTRATO").show();	
	$("#DV_PROCESO_OPCIONES_CONTRATO_ESPECIFICO").show();	
	siguientePaso();						
	validarIniciacion(idRadicado);
}

function validarIniciacion(idRadicado)
{	
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/ProcesoAbogado.php',
			   data: {HD_VALIDACION : 'validarIniciacion', HD_ID_SOLICITUD: idRadicado}, 
			   success: function(data)
			   {								   										
					$("#DV_CARGA").html('');
					var datosRadicado = $.parseJSON(data);				
					if(datosRadicado.objeto == null)
					{
						$("#TA_OBJETO").val('');
						$("#SL_MODALIDAD").val('');
						$("#TX_VALOR_ESTIMADO").val('');
						$("#TA_OBSERVACION_1").val('');						
					}
					else
					{
						$("#TA_OBJETO").val(datosRadicado.objeto);
						$("#SL_MODALIDAD").val(datosRadicado.idModalidad);
						$("#TX_VALOR_ESTIMADO").val(datosRadicado.valorEstimando);						
						$("#TA_OBJETO").attr('disabled', true);												
						$("#SL_MODALIDAD").attr('disabled', true);												
						$("#TX_VALOR_ESTIMADO").attr('disabled', true);												
						$("#TA_OBSERVACION_1").attr('disabled', true);																		
						$("#BT_FR_INICIACION").attr('disabled', true);
						cargarPanelNavegacion();																			
					}
			   }
			 });			
}

function validarVerificacionDocumentos(idRadicado)
{
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/ProcesoAbogado.php',
			   data: {HD_VALIDACION : 'validarVerificacionDocumentos', HD_ID_SOLICITUD: idRadicado}, 
			   success: function(data)
			   {								   					
					$("#DV_CARGA").html('');
					var datosRadicado = $.parseJSON(data);				
					if(datosRadicado.idMotivo == 0)
					{
						$("#SL_CHECK_LIST").val(datosRadicado.idCheckList);						
						$("#SL_ACTUACION").val(datosRadicado.idActuacion);
						$("#DV_ACTUACION").show();
						$("#SL_CHECK_LIST").attr('disabled', true);												
						$("#SL_ACTUACION").attr('disabled', true);							
						$("#TA_OBSERVACION_2").attr('disabled', true);		
						$("#BT_FR_VAL_DOC").attr('disabled', true);		
						siguientePaso();	
					}
					else if(datosRadicado.idMotivo == null)
					{
						$("#SL_CHECK_LIST").val(0);						
						$("#SL_ACTUACION").val(0);						
						$("#TA_OBSERVACION_2").val('');																	
					}
					else
					{
						$("#SL_CHECK_LIST").val(datosRadicado.idCheckList);
						$("#SL_ACTUACION").val(datosRadicado.idActuacion);						
						$("#SL_MOTIVO").val(datosRadicado.idMotivo);						
						$("#SL_DOCUMENTO").val(datosRadicado.idDocumento);						
						$("#DV_ACTUACION").show();
						$("#DV_MOTIVO").show();
						$("#DV_DOCUMENTO").show();
						$("#HD_VALIDACION_CHECK_LIST").val(0);
						$("#HD_DATOS_CHECK_LIST").val('');						
					}
			   }
			 });
}

function validarFechaRadicacion(idRadicado)
{			
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/ProcesoAbogado.php',
			   data: {HD_VALIDACION : 'validarFechaRadicacion', HD_ID_SOLICITUD: idRadicado}, 
			   success: function(data)
			   {								   															
					$("#DV_CARGA").html('');
					var datosRadicado = $.parseJSON(data);				
					if(datosRadicado.fechaSolicitud == null)
					{
						$("#DT_FECHA_RADICACION").val('');
						$("#TA_OBSERVACION_3").val('');
					}
					else
					{
						$("#DT_FECHA_RADICACION").val(datosRadicado.fechaSolicitud);
						$("#DT_FECHA_RADICACION").attr('disabled', true);												
						$("#TA_OBSERVACION_3").attr('disabled', true);												
						$("#BT_FR_FECHA_RADI").attr('disabled', true);												
						siguientePaso();	
					}
			   }
			 });			
}

function validarFechaSesionComiteAprobracion(idRadicado)
{			
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/ProcesoAbogado.php',
			   data: {HD_VALIDACION : 'validarFechaSesionComiteAprobracion', HD_ID_SOLICITUD: idRadicado}, 
			   success: function(data)
			   {								   															
					$("#DV_CARGA").html('');
					var datosRadicado = $.parseJSON(data);				
					if(datosRadicado.fechaSesionComiteAprobacion == null)
					{
						$("#DT_FECHA_SESION_COMITE_APROBACION").val('');
						$("#TA_OBSERVACION_4").val('');
					}
					else
					{
						$("#DT_FECHA_SESION_COMITE_APROBACION").val(datosRadicado.fechaSesionComiteAprobacion);
						$("#DT_FECHA_SESION_COMITE_APROBACION").attr('disabled', true);												
						$("#TA_OBSERVACION_4").attr('disabled', true);												
						$("#BT_FR_SESION_COMITE_APRO").attr('disabled', true);												
						siguientePaso();	
					}
			   }
			 });			
}

function validarFechaPublicacionConSecop(idRadicado)
{			
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/ProcesoAbogado.php',
			   data: {HD_VALIDACION : 'validarFechaPublicacionConSecop', HD_ID_SOLICITUD: idRadicado}, 
			   success: function(data)
			   {								   															
					$("#DV_CARGA").html('');
					var datosRadicado = $.parseJSON(data);				
					if(datosRadicado.fechaPublicacionSecop == null)
					{
						$("#DT_FECHA_PUBLICACION_CONVOCATORIA_SECOP").val('');
						$("#TA_OBSERVACION_5").val('');
					}
					else
					{
						$("#DT_FECHA_PUBLICACION_CONVOCATORIA_SECOP").val(datosRadicado.fechaPublicacionSecop);
						$("#DT_FECHA_PUBLICACION_CONVOCATORIA_SECOP").attr('disabled', true);												
						$("#TA_OBSERVACION_5").attr('disabled', true);												
						$("#BT_FR_PUB_CONVO_SECOP").attr('disabled', true);												
						siguientePaso();	
					}
			   }
			 });			
}

function validarFechaAudienciaRiesgos(idRadicado)
{					
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/ProcesoAbogado.php',
			   data: {HD_VALIDACION : 'validarFechaAudienciaRiesgos', HD_ID_SOLICITUD: idRadicado}, 
			   success: function(data)
			   {								   																		
					$("#DV_CARGA").html('');
					var datosRadicado = $.parseJSON(data);				
					if(datosRadicado.fechaAudienciaRiesgo == null)
					{
						$("#DT_FECHA_AUDIENCIA_RIESGOS").val('');
						$("#SL_Jornada_AUD_RIES").val('');
						$("#TA_OBSERVACION_6").val('');
					}
					else
					{
						$("#DT_FECHA_AUDIENCIA_RIESGOS").val(datosRadicado.fechaAudienciaRiesgo);
						$("#DT_FECHA_AUDIENCIA_RIESGOS").attr('disabled', true);												
						$("#SL_Jornada_AUD_RIES").val(datosRadicado.jornadaAudienciaRiesgo);
						$("#SL_Jornada_AUD_RIES").attr('disabled', true);																		
						$("#TA_OBSERVACION_6").attr('disabled', true);												
						$("#BT_FR_FECHA_AUD_RIESGOS").attr('disabled', true);												
						siguientePaso();	
					}
			   }
			 });			
}

function validarNumeroFechaResolucionAperProc(idRadicado)
{					
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/ProcesoAbogado.php',
			   data: {HD_VALIDACION : 'validarNumeroFechaResolucionAperProc', HD_ID_SOLICITUD: idRadicado}, 
			   success: function(data)
			   {								   																		
					$("#DV_CARGA").html('');
					var datosRadicado = $.parseJSON(data);				
					if(datosRadicado.fechaResolucionAperturaProceso == null)
					{
						$("#TX_NUMERO_RESOLUCION_APERTURA_PROCESO").val('');
						$("#DT_FECHA_RESOLUCION_APERTURA_PROCESO").val('');
						$("#TA_OBSERVACION_7").val('');
					}
					else
					{
						$("#TX_NUMERO_RESOLUCION_APERTURA_PROCESO").val(datosRadicado.numeroAperturaProceso);
						$("#TX_NUMERO_RESOLUCION_APERTURA_PROCESO").attr('disabled', true);												
						$("#DT_FECHA_RESOLUCION_APERTURA_PROCESO").val(datosRadicado.fechaResolucionAperturaProceso);
						$("#DT_FECHA_RESOLUCION_APERTURA_PROCESO").attr('disabled', true);																		
						$("#TA_OBSERVACION_7").attr('disabled', true);												
						$("#BT_FR_NUM_FEC_RESOL_APER_PRO").attr('disabled', true);												
						siguientePaso();	
					}
			   }
			 });			
}

function validarFechaPublicacionPrepliegosSECOP(idRadicado)
{					
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/ProcesoAbogado.php',
			   data: {HD_VALIDACION : 'validarFechaPublicacionPrepliegosSECOP', HD_ID_SOLICITUD: idRadicado}, 
			   success: function(data)
			   {								   																		
					$("#DV_CARGA").html('');
					var datosRadicado = $.parseJSON(data);				
					if(datosRadicado.fechaPublicacionPliegosSecop == null)
					{
						$("#DT_FECHA_PUB_PREPLIEGOS_SECOP").val('');
						$("#TA_OBSERVACION_8").val('');
					}
					else
					{
						$("#DT_FECHA_PUB_PREPLIEGOS_SECOP").val(datosRadicado.fechaPublicacionPliegosSecop);
						$("#DT_FECHA_PUB_PREPLIEGOS_SECOP").attr('disabled', true);																		
						$("#TA_OBSERVACION_8").attr('disabled', true);																								
						$("#BT_FR_FEC_PUB_PRE_SECOP").attr('disabled', true);												
						siguientePaso();	
					}
			   }
			 });			
}

function validarFechaPublicacionPliegosDefinitivoSECOP(idRadicado)
{					
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/ProcesoAbogado.php',
			   data: {HD_VALIDACION : 'validarFechaPublicacionPliegosDefinitivoSECOP', HD_ID_SOLICITUD: idRadicado}, 
			   success: function(data)
			   {								   																		
					$("#DV_CARGA").html('');
					var datosRadicado = $.parseJSON(data);				
					if(datosRadicado.fechaPublicacionPliegosSecop == null)
					{
						$("#DT_FECHA_PUB_PLIEGOS_DEF_SECOP").val('');
						$("#TA_OBSERVACION_9").val('');
					}
					else
					{
						$("#DT_FECHA_PUB_PLIEGOS_DEF_SECOP").val(datosRadicado.fechaPublicacionPliegosSecop);
						$("#DT_FECHA_PUB_PLIEGOS_DEF_SECOP").attr('disabled', true);																		
						$("#TA_OBSERVACION_9").attr('disabled', true);																								
						$("#BT_FR_FEC_PUB_PLI_DEF_SECOP").attr('disabled', true);												
						siguientePaso();	
					}
			   }
			 });			
}

function validarFechaCierreProcesos(idRadicado)
{					
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/ProcesoAbogado.php',
			   data: {HD_VALIDACION : 'validarFechaCierreProcesos', HD_ID_SOLICITUD: idRadicado}, 
			   success: function(data)
			   {								   																		
					$("#DV_CARGA").html('');
					var datosRadicado = $.parseJSON(data);				
					if(datosRadicado.fechaCierreProceso == null)
					{
						$("#DT_FECHA_CIERRE_PROCESOS").val('');
						$("#TA_OBSERVACION_10").val('');
					}
					else
					{
						$("#DT_FECHA_CIERRE_PROCESOS").val(datosRadicado.fechaCierreProceso);
						$("#DT_FECHA_CIERRE_PROCESOS").attr('disabled', true);																		
						$("#TA_OBSERVACION_10").attr('disabled', true);																								
						$("#BT_FR_FEC_CIERRE_PRO").attr('disabled', true);												
						siguientePaso();	
					}
			   }
			 });			
}

function validarFechaSesionComiteAprobracion2(idRadicado)
{					
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/ProcesoAbogado.php',
			   data: {HD_VALIDACION : 'validarFechaSesionComiteAprobracion2', HD_ID_SOLICITUD: idRadicado}, 
			   success: function(data)
			   {								   																		
					$("#DV_CARGA").html('');
					var datosRadicado = $.parseJSON(data);				
					if(datosRadicado.fechaSesionComiteAprobacion2 == null)
					{
						$("#DT_FECHA_SESION_COMITE_APROBACION_2").val('');
						$("#TA_OBSERVACION_11").val('');
					}
					else
					{
						$("#DT_FECHA_SESION_COMITE_APROBACION_2").val(datosRadicado.fechaSesionComiteAprobacion2);
						$("#DT_FECHA_SESION_COMITE_APROBACION_2").attr('disabled', true);																		
						$("#TA_OBSERVACION_11").attr('disabled', true);																								
						$("#BT_FR_SESION_COMITE_APRO_2").attr('disabled', true);												
						siguientePaso();	
					}
			   }
			 });			
}

function validarFechaPublicacionEvaluaiconDefinitiva(idRadicado)
{					
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/ProcesoAbogado.php',
			   data: {HD_VALIDACION : 'validarFechaPublicacionEvaluaiconDefinitiva', HD_ID_SOLICITUD: idRadicado}, 
			   success: function(data)
			   {								   																		
					$("#DV_CARGA").html('');
					var datosRadicado = $.parseJSON(data);				
					if(datosRadicado.fechaPublicacionEvaluaiconDefinitiva == null)
					{
						$("#DT_FECHA_PUB_EVAL_DEFINITIVA").val('');
						$("#TA_OBSERVACION_12").val('');
					}
					else
					{
						$("#DT_FECHA_PUB_EVAL_DEFINITIVA").val(datosRadicado.fechaPublicacionEvaluaiconDefinitiva);
						$("#DT_FECHA_PUB_EVAL_DEFINITIVA").attr('disabled', true);																		
						$("#TA_OBSERVACION_12").attr('disabled', true);																								
						$("#BT_FR_PUB_EVAL_DEFI").attr('disabled', true);												
						siguientePaso();	
					}
			   }
			 });			
}

function validarFechaAudienciaAdjudicacion2(idRadicado)
{					
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/ProcesoAbogado.php',
			   data: {HD_VALIDACION : 'validarFechaAudienciaAdjudicacion2', HD_ID_SOLICITUD: idRadicado}, 
			   success: function(data)
			   {								   																		
					$("#DV_CARGA").html('');
					var datosRadicado = $.parseJSON(data);				
					if(datosRadicado.fechaAudienciaAdjudicacion == null)
					{
						$("#DT_FECHA_AUD_ADJUDICACION").val('');
						$("#SL_Jornada_AUD_ADJUDICACION").val('');
						$("#TA_OBSERVACION_13").val('');
					}
					else
					{
						$("#DT_FECHA_AUD_ADJUDICACION").val(datosRadicado.fechaAudienciaAdjudicacion);
						$("#DT_FECHA_AUD_ADJUDICACION").attr('disabled', true);																		
						$("#SL_Jornada_AUD_ADJUDICACION").val(datosRadicado.jornadaAudienciaAdjudicacion);
						$("#SL_Jornada_AUD_ADJUDICACION").attr('disabled', true);																								
						$("#TA_OBSERVACION_13").attr('disabled', true);																								
						$("#BT_FR_FECHA_AUD_ADJ").attr('disabled', true);												
						siguientePaso();	
					}
			   }
			 });			
}

function validarFechaNumeroResolucionAdjudicacion(idRadicado)
{					
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/ProcesoAbogado.php',
			   data: {HD_VALIDACION : 'validarFechaNumeroResolucionAdjudicacion', HD_ID_SOLICITUD: idRadicado}, 
			   success: function(data)
			   {								   																		
					$("#DV_CARGA").html('');
					var datosRadicado = $.parseJSON(data);				
					if(datosRadicado.fechaResolucionAdjudicacion == null)
					{
						$("#TX_NUMERO_RESOLUCION_ADJUDICACION").val('');
						$("#DT_FECHA_RESOLUCION_ADJUDICACION").val('');
						$("#TA_OBSERVACION_14").val('');
					}
					else
					{
						$("#DT_FECHA_RESOLUCION_ADJUDICACION").val(datosRadicado.fechaResolucionAdjudicacion);
						$("#DT_FECHA_RESOLUCION_ADJUDICACION").attr('disabled', true);																		
						$("#TX_NUMERO_RESOLUCION_ADJUDICACION").val(datosRadicado.numeroResolucionAdjudicacion);
						$("#TX_NUMERO_RESOLUCION_ADJUDICACION").attr('disabled', true);																								
						$("#TA_OBSERVACION_14").attr('disabled', true);																								
						$("#BT_FR_NUM_FEC_RESOL_ADJ").attr('disabled', true);												
						siguientePaso();	
					}
			   }
			 });			
}

function validarElaboracionContrato(idRadicado)
{					
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/ProcesoAbogado.php',
			   data: {HD_VALIDACION : 'validarElaboracionContrato', HD_ID_SOLICITUD: idRadicado}, 
			   success: function(data)
			   {								   																							
					$("#DV_CARGA").html('');
					var datosRadicado = $.parseJSON(data);				
					if(datosRadicado.fechaElaboracionContrato == null)
					{
						$("#DT_FECHA_ELABORACION_CONTRATO").val('');
						$("#TX_NUMERO_SUSCRIPCION").val('');
						$("#TX_NOMBRE_CONTRATISTA").val('');
						$("#TX_VALOR_CONTRATO").val('');
						$("#TX_PLAZO_EJECUCION").val('');
						$("#TX_SUPERVISOR").val('');
						$("#TA_OBSERVACION_15").val('');
					}
					else
					{
						$("#DT_FECHA_ELABORACION_CONTRATO").val(datosRadicado.fechaElaboracionContrato);
						$("#DT_FECHA_ELABORACION_CONTRATO").attr('disabled', true);																		
						$("#TX_NUMERO_SUSCRIPCION").val(datosRadicado.numeroSuscripcion);
						$("#TX_NUMERO_SUSCRIPCION").attr('disabled', true);																								
						$("#TX_NOMBRE_CONTRATISTA").val(datosRadicado.nombreContratista);
						$("#TX_NOMBRE_CONTRATISTA").attr('disabled', true);																								
						$("#TX_VALOR_CONTRATO").val(datosRadicado.valorContrato);
						$("#TX_VALOR_CONTRATO").attr('disabled', true);																								
						$("#TX_PLAZO_EJECUCION").val(datosRadicado.plazoEjecucion);
						$("#TX_PLAZO_EJECUCION").attr('disabled', true);																								
						$("#TX_SUPERVISOR").val(datosRadicado.supervisor);
						$("#TX_SUPERVISOR").attr('disabled', true);																														
						$("#TA_OBSERVACION_15").attr('disabled', true);																								
						$("#BT_FR_FECHA_ELA_CNNVS").attr('disabled', true);												
						siguientePaso();	
					}
			   }
			 });			
}

$('#SL_CHECK_LIST').change(function()
{	  
	var idCheckList = $('#SL_CHECK_LIST').val();	
	if(idCheckList != "")
	{
		cargarItemsCheckList(idCheckList);
		$("#DV_CARGA").html('');		
		$('#DIV_ITEMS_CHECK_LIST').html('');
		$('#MODAL_CHECKLIST').modal('show');
	}
	else
	{
		$("#BT_FR_VAL_DOC").attr('disabled', true);
		$("#DV_ACTUACION").hide();
		$("#DV_MOTIVO").hide();
		$("#DV_DOCUMENTO").hide();									
		$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Debe seleccionar un CheckList.</div>');
	}
});

$('#SL_ACTUACION').change(function()
{	  
	var idActuacion = $('#SL_ACTUACION').val();	
	var validacionEstadoCheckList = $("#HD_VALIDACION_CHECK_LIST").val();
	if(idActuacion != "")
	{			
		$("#BT_FR_VAL_DOC").attr('disabled', false);
		$("#DV_CARGA").html('');
		validarEstadoActicion(idActuacion, validacionEstadoCheckList);
	}
	else
	{
		$("#BT_FR_VAL_DOC").attr('disabled', true);
		$("#DV_MOTIVO").hide();
		$("#DV_DOCUMENTO").hide();							
		$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Debe seleccionar un tipo de actuación.</div>');
	}	
});


$('#BTN_CHECK_LIST').click(function()
{	  
 	var frm = document.getElementById("FR_CHECK_LIST");
 	var contadorChequeo = 0;
 	var datosCheckList = "<br>Los Items del CheckList son: ";
 	 for (i = 0; i < frm.checkeItemDinamido.length; ++i)
 	 { 	 	
 	 	if (frm.checkeItemDinamido[i].checked)
        {
            contadorChequeo++;
            datosCheckList = datosCheckList + '<br>----<strong>' + $("#HD_CHECKBOX_NAME" + frm.checkeItemDinamido[i].value).val() + '</strong> es chequeado.';            
        }
        else
        {
			datosCheckList = datosCheckList + '<br>----<strong>' + $("#HD_CHECKBOX_NAME" + frm.checkeItemDinamido[i].value).val() + '</strong> no chequeado. ';            			
        }
 	 }
 	 
	 $("#HD_DATOS_CHECK_LIST").val(datosCheckList);
 	 $("#DV_ACTUACION").show(); 	 
 	 $('#MODAL_CHECKLIST').modal('hide');
 	 if(contadorChequeo == frm.checkeItemDinamido.length)
 	 {
		$("#HD_VALIDACION_CHECK_LIST").val(1);
 	 }
 	 else
 	 {
		$("#HD_VALIDACION_CHECK_LIST").val(0);
 	 }

});


function cargarItemsCheckList(idCheckList)
{
	$("#DV_CARGA_2").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ValidacionProceso.php',
		   data: {HD_VALIDACION : 'cargarItemCheckList', idCheckList : idCheckList}, 
		   success: function(data)
		   {								   												
				if(data == 0)
				{					
					$("#BTN_CHECK_LIST").attr('disabled', true);
					$("#DV_CARGA_2").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>La lista de chequeo que seleccionó no cuenta con item\'s de selección.</div>');
				}
				else
				{
					$("#BTN_CHECK_LIST").attr('disabled', false);
					$("#DV_CARGA_2").html('');
					$("#DIV_ITEMS_CHECK_LIST").html(data);				
				}				
		   }
		 });			
}


function validarEstadoActicion(idActuacion, validacionEstadoCheckList)
{
	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ValidacionProceso.php',
		   data: {HD_VALIDACION : 'validarEstadoActicion', idActuacion : idActuacion, validacionEstadoCheckList : validacionEstadoCheckList}, 
		   success: function(data)
		   {								   												
		   		if(data == 1)
		   		{
					$("#DV_MOTIVO").hide();
					$("#DV_DOCUMENTO").hide();					
					$("#SL_MOTIVO").attr('disabled', true);
					$("#SL_DOCUMENTO").attr('disabled', true);						
					$("#DV_CARGA").html('');
		   		}
		   		else if(data == 0)
		   		{
					$("#DV_MOTIVO").show();
					$("#DV_DOCUMENTO").show();
					$("#SL_MOTIVO").attr('disabled', false);
					$("#SL_DOCUMENTO").attr('disabled', false);											
					$("#DV_CARGA").html('');
		   		}
		   		else
		   		{
		   			$("#DV_MOTIVO").hide();
					$("#DV_DOCUMENTO").hide();					
		   			$("#BT_FR_VAL_DOC").attr('disabled', true);
		   			$("#DV_CARGA").html(data);
		   		}
		   }
		 });
}	

function cargarPanelNavegacion()
{	
	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ProcesoAbogado.php',
		   data: {HD_VALIDACION : 'cargarPanelNavegacion', SL_MODALIDAD : $("#SL_MODALIDAD").val()}, 
		   success: function(data)
		   {								   																								
				var datos_panel_navegacion = $.parseJSON(data);
				for (i = 0; i < datos_panel_navegacion.length; i++) { 
					panelNavegacion.push(datos_panel_navegacion[i]);
				}					
				siguientePaso();							
				$("#DV_CARGA").html('');
		   }
		 });		
}

$( document ).ready(function() {

	$("#FR_INICIACION").submit(function()
	{
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/ProcesoAbogado.php',
			   data: $("#FR_INICIACION").serialize(),
			   success: function(data)
			   {								   				   				   
				   if(data == 1)
				   {
						$("#TA_OBJETO").attr('disabled', true);
						$("#SL_MODALIDAD").attr('disabled', true);
						$("#TX_VALOR_ESTIMADO").attr('disabled', true);
						$("#TA_OBSERVACION_1").attr('disabled', true);
						$("#BT_FR_INICIACION").attr('disabled', true);						
						$("#DV_CARGA").html('<div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Se agregaron correctamente los datos.</div>');
						cargarPanelNavegacion();							
				   }
				   else
				   {
				   		$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
				   }
			   }
			 });		
		return false;
	});

	$("#FR_VAL_DOC").submit(function()
	{
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/ProcesoAbogado.php',
			   data: $("#FR_VAL_DOC").serialize(),
			   success: function(data)
			   {								   			   					   		
			   		if(data == 1)
			   		{
						$("#SL_CHECK_LIST").attr('disabled', true);
						$("#SL_ACTUACION").attr('disabled', true);
						$("#TA_OBSERVACION_2").attr('disabled', true);
						$("#BT_FR_VAL_DOC").attr('disabled', true);
						//$("#PB_PROGRESO").css({width : '30%'}); 										
						$("#DV_CARGA").html('<div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Se agregaron correctamente los datos.</div>');						
						siguientePaso();						
			   		}
			   		else if(data == 0)
			   		{
						$("#BT_FR_VAL_DOC").attr('disabled', true);
						$("#DV_CARGA").html('<div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Se agregaron correctamente los datos, queda en espera de continuar con el trámite.</div>');						
			   		}			   		
			   		else
			   		{
						$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
			   		}
			   }
			 });		
		return false;
	});	

	$("#FR_FECHA_RADI").submit(function()
	{
		var fechaRadicacion = $('#DT_FECHA_RADICACION').val();	
		if(fechaRadicacion == "")
		{
			$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Por favor ingrese la fecha de radicación.</div>');
		}
		else
		{
			$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
			$.ajax({
				   type: "POST",
				   url: '../Logica/ProcesoAbogado.php',
				   data: $("#FR_FECHA_RADI").serialize(),
				   success: function(data)
				   {								   			   						   						   	
				   		if(data == 1)
				   		{
							$("#DT_FECHA_RADICACION").attr('disabled', true);
							$("#TA_OBSERVACION_3").attr('disabled', true);
							$("#BT_FR_FECHA_RADI").attr('disabled', true);
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Se agregaron correctamente los datos.</div>');						
							siguientePaso();
				   		}
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
				   		}
				   }
				 });		
		}
		return false;
	});	


	$("#FR_SESION_COMITE_APRO").submit(function()
	{
		var fechaRadicacion = $('#DT_FECHA_SESION_COMITE_APROBACION').val();	
		if(fechaRadicacion == "")
		{
			$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Por favor ingrese la fecha de sesión de comite de aprobación.</div>');
		}
		else
		{
			$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
			$.ajax({
				   type: "POST",
				   url: '../Logica/ProcesoAbogado.php',
				   data: $("#FR_SESION_COMITE_APRO").serialize(),
				   success: function(data)
				   {								   			   		
				   		
				   		if(data == 1)
				   		{
							$("#DT_FECHA_SESION_COMITE_APROBACION").attr('disabled', true);
							$("#TA_OBSERVACION_4").attr('disabled', true);
							$("#BT_FR_SESION_COMITE_APRO").attr('disabled', true);
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Se agregaron correctamente los datos.</div>');						
							siguientePaso();
				   		}
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
				   		}
				   }
				 });		
		}
		return false;
	});	


	$("#FR_PUB_CONVO_SECOP").submit(function()
	{
		var fechaRadicacion = $('#DT_FECHA_PUBLICACION_CONVOCATORIA_SECOP').val();	
		if(fechaRadicacion == "")
		{
			$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Por favor ingrese la fecha de publicación de convocatoria SECOP.</div>');
		}
		else
		{
			$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
			$.ajax({
				   type: "POST",
				   url: '../Logica/ProcesoAbogado.php',
				   data: $("#FR_PUB_CONVO_SECOP").serialize(),
				   success: function(data)
				   {								   			   						   		
				   		if(data == 1)
				   		{
							$("#DT_FECHA_PUBLICACION_CONVOCATORIA_SECOP").attr('disabled', true);
							$("#TA_OBSERVACION_5").attr('disabled', true);
							$("#BT_FR_PUB_CONVO_SECOP").attr('disabled', true);
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Se agregaron correctamente los datos.</div>');						
							siguientePaso();
				   		}
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
				   		}
				   }
				 });		
		}
		return false;
	});	


	$("#FR_FECHA_AUD_RIESGOS").submit(function()
	{
		var fechaRadicacion = $('#DT_FECHA_AUDIENCIA_RIESGOS').val();			
		if(fechaRadicacion == "")
		{
			$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Por favor ingrese la fecha de audiencia de riesgos.</div>');
		}
		else
		{
			$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
			$.ajax({
				   type: "POST",
				   url: '../Logica/ProcesoAbogado.php',
				   data: $("#FR_FECHA_AUD_RIESGOS").serialize(),
				   success: function(data)
				   {								   			   						   		
				   		if(data == 1)
				   		{
							$("#DT_FECHA_AUDIENCIA_RIESGOS").attr('disabled', true);
							$("#TA_OBSERVACION_6").attr('disabled', true);
							$("#SL_Jornada_AUD_RIES").attr('disabled', true);
							$("#BT_FR_FECHA_AUD_RIESGOS").attr('disabled', true);
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Se agregaron correctamente los datos.</div>');						
							siguientePaso();
				   		}
			   			else if(data == 0)
			   			{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Esta fecha ya se encuentra reservada, por favor cambia la fecha o jornada.</div>');			   				
						}
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
				   		}
				   }
				 });		
		}
		return false;
	});	


	$("#FR_NUM_FEC_RESOL_APER_PRO").submit(function()
	{
		var fechaRadicacion = $('#DT_FECHA_RESOLUCION_APERTURA_PROCESO').val();			
		if(fechaRadicacion == "")
		{
			$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Por favor ingrese la fecha resolución apertura de proceso.</div>');
		}
		else
		{
			$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
			$.ajax({
				   type: "POST",
				   url: '../Logica/ProcesoAbogado.php',
				   data: $("#FR_NUM_FEC_RESOL_APER_PRO").serialize(),
				   success: function(data)
				   {								   			   						   						   		
				   		if(data == 1)
				   		{
							$("#TX_NUMERO_RESOLUCION_APERTURA_PROCESO").attr('disabled', true);
							$("#DT_FECHA_RESOLUCION_APERTURA_PROCESO").attr('disabled', true);
							$("#TA_OBSERVACION_7").attr('disabled', true);
							$("#BT_FR_NUM_FEC_RESOL_APER_PRO").attr('disabled', true);
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Se agregaron correctamente los datos.</div>');						
							siguientePaso();							
				   		}
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
				   		}
				   }
				 });		
		}
		return false;
	});	

	$("#FR_FEC_PUB_PRE_SECOP").submit(function()
	{
		var fechaRadicacion = $('#DT_FECHA_PUB_PREPLIEGOS_SECOP').val();			
		if(fechaRadicacion == "")
		{
			$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Por favor ingrese la fecha de publicación de prepliegos SECOP.</div>');
		}
		else
		{
			$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
			$.ajax({
				   type: "POST",
				   url: '../Logica/ProcesoAbogado.php',
				   data: $("#FR_FEC_PUB_PRE_SECOP").serialize(),
				   success: function(data)
				   {								   			   						   						   		
				   		if(data == 1)
				   		{							
							$("#DT_FECHA_PUB_PREPLIEGOS_SECOP").attr('disabled', true);
							$("#TA_OBSERVACION_8").attr('disabled', true);
							$("#BT_FR_FEC_PUB_PRE_SECOP").attr('disabled', true);
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Se agregaron correctamente los datos.</div>');						
							siguientePaso();							
				   		}
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
				   		}
				   }
				 });		
		}
		return false;
	});	

	$("#FR_FEC_PUB_PLI_DEF_SECOP").submit(function()
	{
		var fechaRadicacion = $('#DT_FECHA_PUB_PLIEGOS_DEF_SECOP').val();			
		if(fechaRadicacion == "")
		{
			$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Por favor ingrese la fecha de publicación de pliegos definitivos SECOP.</div>');
		}
		else
		{
			$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
			$.ajax({
				   type: "POST",
				   url: '../Logica/ProcesoAbogado.php',
				   data: $("#FR_FEC_PUB_PLI_DEF_SECOP").serialize(),
				   success: function(data)
				   {								   			   						   						   		
				   		if(data == 1)
				   		{							
							$("#DT_FECHA_PUB_PLIEGOS_DEF_SECOP").attr('disabled', true);
							$("#TA_OBSERVACION_9").attr('disabled', true);
							$("#BT_FR_FEC_PUB_PLI_DEF_SECOP").attr('disabled', true);
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Se agregaron correctamente los datos.</div>');						
							siguientePaso();
				   		}
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
				   		}
				   }
				 });		
		}
		return false;
	});	

	$("#FR_FEC_CIERRE_PRO").submit(function()
	{
		var fechaRadicacion = $('#DT_FECHA_CIERRE_PROCESOS').val();			
		if(fechaRadicacion == "")
		{
			$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Por favor ingrese la fecha de cierre de proceso.</div>');
		}
		else
		{
			$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
			$.ajax({
				   type: "POST",
				   url: '../Logica/ProcesoAbogado.php',
				   data: $("#FR_FEC_CIERRE_PRO").serialize(),
				   success: function(data)
				   {								   			   						   						   		
				   		if(data == 1)
				   		{							
							$("#DT_FECHA_CIERRE_PROCESOS").attr('disabled', true);
							$("#TA_OBSERVACION_10").attr('disabled', true);
							$("#BT_FR_FEC_CIERRE_PRO").attr('disabled', true);
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Se agregaron correctamente los datos.</div>');						
							siguientePaso();
				   		}
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
				   		}
				   }
				 });		
		}
		return false;
	});	


	$("#FR_SESION_COMITE_APRO_2").submit(function()
	{
		var fechaRadicacion = $('#DT_FECHA_SESION_COMITE_APROBACION_2').val();			
		if(fechaRadicacion == "")
		{
			$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Por favor ingrese la fecha sesión comite aprobación #2 .</div>');
		}
		else
		{
			$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
			$.ajax({
				   type: "POST",
				   url: '../Logica/ProcesoAbogado.php',
				   data: $("#FR_SESION_COMITE_APRO_2").serialize(),
				   success: function(data)
				   {								   			   						   						   						   		
				   		if(data == 1)
				   		{							
							$("#DT_FECHA_SESION_COMITE_APROBACION_2").attr('disabled', true);
							$("#TA_OBSERVACION_11").attr('disabled', true);
							$("#BT_FR_SESION_COMITE_APRO_2").attr('disabled', true);
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Se agregaron correctamente los datos.</div>');						
							siguientePaso();
				   		}
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
				   		}
				   }
				 });		
		}
		return false;
	});	


	$("#FR_PUB_EVAL_DEFI").submit(function()
	{
		var fechaRadicacion = $('#DT_FECHA_PUB_EVAL_DEFINITIVA').val();			
		if(fechaRadicacion == "")
		{
			$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Por favor ingrese la fecha publicación de la evaluación definitiva.</div>');
		}
		else
		{
			$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
			$.ajax({
				   type: "POST",
				   url: '../Logica/ProcesoAbogado.php',
				   data: $("#FR_PUB_EVAL_DEFI").serialize(),
				   success: function(data)
				   {								   			   						   						   						   		
				   		if(data == 1)
				   		{							
							$("#DT_FECHA_PUB_EVAL_DEFINITIVA").attr('disabled', true);
							$("#TA_OBSERVACION_12").attr('disabled', true);
							$("#BT_FR_PUB_EVAL_DEFI").attr('disabled', true);
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Se agregaron correctamente los datos.</div>');						
							siguientePaso();
				   		}
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
				   		}
				   }
				 });		
		}
		return false;
	});	

	$("#FR_FECHA_AUD_ADJ").submit(function()
	{
		var fechaRadicacion = $('#DT_FECHA_AUD_ADJUDICACION').val();			
		if(fechaRadicacion == "")
		{
			$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Por favor ingrese la fecha audiencia adjudicación.</div>');
		}
		else
		{
			$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
			$.ajax({
				   type: "POST",
				   url: '../Logica/ProcesoAbogado.php',
				   data: $("#FR_FECHA_AUD_ADJ").serialize(),
				   success: function(data)
				   {								   			   						   						   						   						   		
				   		if(data == 1)
				   		{							
							$("#DT_FECHA_AUD_ADJUDICACION").attr('disabled', true);
							$("#SL_Jornada_AUD_ADJUDICACION").attr('disabled', true);
							$("#TA_OBSERVACION_13").attr('disabled', true);
							$("#BT_FR_FECHA_AUD_ADJ").attr('disabled', true);
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Se agregaron correctamente los datos.</div>');						
							siguientePaso();
				   		}
			   			else if(data == 0)
			   			{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Esta fecha ya se encuentra reservada, por favor cambia la fecha o jornada.</div>');			   				
						}				   		
			   			else if(data == 2)
			   			{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Esta fecha debe ser posterior a la fecha de audiencia de riesgos.</div>');			   				
						}				   								
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
				   		}
				   }
				 });		
		}
		return false;
	});	


	$("#FR_NUM_FEC_RESOL_ADJ").submit(function()
	{
		var fechaRadicacion = $('#DT_FECHA_RESOLUCION_ADJUDICACION').val();			
		if(fechaRadicacion == "")
		{
			$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Por favor ingrese la fecha de resolución de adjudicación .</div>');
		}
		else
		{
			$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
			$.ajax({
				   type: "POST",
				   url: '../Logica/ProcesoAbogado.php',
				   data: $("#FR_NUM_FEC_RESOL_ADJ").serialize(),
				   success: function(data)
				   {								   			   						   						   						   		
				   		if(data == 1)
				   		{							
							$("#DT_FECHA_RESOLUCION_ADJUDICACION").attr('disabled', true);
							$("#TX_NUMERO_RESOLUCION_ADJUDICACION").attr('disabled', true);
							$("#TA_OBSERVACION_14").attr('disabled', true);
							$("#BT_FR_NUM_FEC_RESOL_ADJ").attr('disabled', true);
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Se agregaron correctamente los datos.</div>');						
							siguientePaso();
				   		}
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
				   		}
				   }
				 });		
		}
		return false;
	});	

	$("#FR_FECHA_ELA_CNNVS").submit(function()
	{
		var fechaRadicacion = $('#DT_FECHA_ELABORACION_CONTRATO').val();			
		if(fechaRadicacion == "")
		{
			$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Por favor ingrese la fecha de elaboración de contrato.</div>');
		}
		else
		{
			$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
			$.ajax({
				   type: "POST",
				   url: '../Logica/ProcesoAbogado.php',
				   data: $("#FR_FECHA_ELA_CNNVS").serialize(),
				   success: function(data)
				   {								   			   						   						   						   		
				   		if(data == 1)
				   		{							
							$("#DT_FECHA_ELABORACION_CONTRATO").attr('disabled', true);
							$("#TX_NUMERO_SUSCRIPCION").attr('disabled', true);
							$("#TX_NOMBRE_CONTRATISTA").attr('disabled', true);
							$("#TX_VALOR_CONTRATO").attr('disabled', true);
							$("#TX_PLAZO_EJECUCION").attr('disabled', true);
							$("#TX_SUPERVISOR").attr('disabled', true);
							$("#TA_OBSERVACION_15").attr('disabled', true);
							$("#BT_FR_FECHA_ELA_CNNVS").attr('disabled', true);
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Se agregaron correctamente los datos.</div>');						
							siguientePaso();
				   		}
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
				   		}
				   }
				 });		
		}
		return false;
	});	

   
});