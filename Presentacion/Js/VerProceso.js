$("#BTN_CERRAR_MODAL_NOTIFICACON").modal('hide');

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
    //alert(pasoNavegacion);
    varBarra = (pasoNavegacion * 100) / panelNavegacion.length;
    $('#' + panelNavegacion[pasoNavegacion]).show();        	
    $("#PB_PROGRESO").css({width : varBarra + '%'});     
    if(panelNavegacion[pasoNavegacion] == "DIV_PANEL_2")
    {		
		//alert("Entro a validacion de documentos");
		validarVerificacionDocumentos($("#HD_ID_SOLICITUD_1").val());
    }
    if(panelNavegacion[pasoNavegacion] == "DIV_PANEL_3")
    {						
		//alert("Entro a validacion de fecha de radicacion");
		validarFechaRadicacion($("#HD_ID_SOLICITUD_1").val());		
    }    
    if(panelNavegacion[pasoNavegacion] == "DIV_PANEL_4")
    {										
		//alert("Entro a validacion de fecha de sesion de comite aprobacion");
		if($("#SL_MODALIDAD").val() == 1 || $("#SL_MODALIDAD").val() == 3)
		{			
			if($("#TX_VALOR_ESTIMADO").val() > cargarVariableSoporteNombre("MENOR CUANTIA"))
			{
				validarFechaSesionComiteAprobracion($("#HD_ID_SOLICITUD_1").val(), 0);	
			}
			else
			{
				$('#' + panelNavegacion[pasoNavegacion]).hide(); 
				validarFechaSesionComiteAprobracion($("#HD_ID_SOLICITUD_1").val(), 1);					
				//siguientePaso();
			}
		}
		else
		{
			validarFechaSesionComiteAprobracion($("#HD_ID_SOLICITUD_1").val(), 0);	
		}
    }           
    if(panelNavegacion[pasoNavegacion] == "DIV_PANEL_5")
    {						
    	//alert("Entro a validar fecha publicacion con secop");
    	validarFechaPublicacionConSecop($("#HD_ID_SOLICITUD_1").val());
    }
    if(panelNavegacion[pasoNavegacion] == "DIV_PANEL_6")
    {						    	    	
    	//alert("Entro a validar numero fecha resolucion apretura proceso");
    	validarNumeroFechaResolucionAperProc($("#HD_ID_SOLICITUD_1").val());    	
    } 
    if(panelNavegacion[pasoNavegacion] == "DIV_PANEL_7")
    {						
    	//alert("Entro a validar fecha publicacion prepliegos secop");
    	validarFechaPublicacionPrepliegosSECOP($("#HD_ID_SOLICITUD_1").val());
    }         
    if(panelNavegacion[pasoNavegacion] == "DIV_PANEL_8")
    {						
    	validarFechaAudienciaRiesgos($("#HD_ID_SOLICITUD_1").val());
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
    	validarFechaPublicacionEvaluacionPreliminar($("#HD_ID_SOLICITUD_1").val());
    }             
    if(panelNavegacion[pasoNavegacion] == "DIV_PANEL_12")
    {						
    	validarFechaSesionComiteAprobracion2($("#HD_ID_SOLICITUD_1").val());
    }          
    if(panelNavegacion[pasoNavegacion] == "DIV_PANEL_13")
    {						
    	validarFechaPublicacionEvaluaiconDefinitiva($("#HD_ID_SOLICITUD_1").val());
    }                  
    if(panelNavegacion[pasoNavegacion] == "DIV_PANEL_14")
    {						
    	validarFechaAudienciaAdjudicacion2($("#HD_ID_SOLICITUD_1").val());
    }
    if(panelNavegacion[pasoNavegacion] == "DIV_PANEL_15")
    {						
    	validarFechaNumeroResolucionAdjudicacion($("#HD_ID_SOLICITUD_1").val());
    }        
    if(panelNavegacion[pasoNavegacion] == "DIV_PANEL_16")
    {						
    	validarElaboracionContrato($("#HD_ID_SOLICITUD_1").val());    	
    }    
    if(panelNavegacion[pasoNavegacion] == "DIV_PANEL_17")
    {						
    	validarFechaEntregaConcepto($("#HD_ID_SOLICITUD_1").val());    	
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
					$("#DV_CARGA").html('');				
					if(data == 1)
					{
						$("#DV_PROC_TERM").show();
						$("#DV_PROC_TERM_ANTIC").hide();
						$("#MODAL_NOTIFICACION").modal('show');
						setTimeout(function(){
							window.location.href = 'VerProceso.php';
											 }, 5000);						
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

$("#DT_FECHA_PUB_EVAL_PRELIMINAR").datepicker({
		format : "yyyy/mm/dd"		
	});		

$("#DT_FECHA_ENTREGA_CONCEPTO").datepicker({
		format : "yyyy/mm/dd"		
	});		

$('#BTN_CERRAR_VENTANA_CHECKLIST').click(function()
{	  
	$('#MODAL_CHECKLIST').modal('hide');
});

$('#BTN_TERMINARCION_PROCESO').click(function()
{	  
	$("#DV_PROC_TERM").hide();
	$("#TA_OBSERVACION_FINAL").val('');
	$("#DV_PROC_TERM_ANTIC").show();
	$("#MODAL_NOTIFICACION").modal('show');	
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
$('#DIV_PANEL_16').hide();
$('#DIV_PANEL_17').hide();

//$("#BTN_EDIT_INICIACION").attr('disabled', true);
//$("#BTN_EDIT_VAL_DOCUMENTOS").attr('disabled', true);
$("#BTN_EDIT_FECHA_RADI").attr('disabled', true);
$("#BTN_EDIT_SESION_COMITE_APRO").attr('disabled', true);
$("#BTN_EDIT_PUB_CONVO_SECOP").attr('disabled', true);
$("#BTN_EDIT_NUM_FEC_RESOL_APER_PRO").attr('disabled', true);
$("#BTN_EDIT_FEC_PUB_PRE_SECOP").attr('disabled', true);
$("#BTN_EDIT_FECHA_AUD_RIESGOS").attr('disabled', true);
$("#BTN_EDIT_FEC_PUB_PLI_DEF_SECOP").attr('disabled', true);
$("#BTN_EDIT_FEC_CIERRE_PRO").attr('disabled', true);
$("#BTN_EDIT_SESION_COMITE_APRO_2").attr('disabled', true);
$("#BTN_EDIT_PUB_EVAL_DEFI").attr('disabled', true);
$("#BTN_EDIT_FECHA_AUD_ADJ").attr('disabled', true);
$("#BTN_EDIT_NUM_RESOL_AJD").attr('disabled', true);
$("#BTN_EDIT_FECHA_ELA_CNNVS").attr('disabled', true);
$("#BTN_EDIT_PUBLICACION_EVAL_DEFINITIVA").attr('disabled', true);
$("#BTN_EDIT_FECHA_ENTREGA_CONCEPTO").attr('disabled', true);

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

function cargarVariableSoporteNombre(nombreVariableSoporte)
{	
	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	 var value = 0;
	$.ajax({
		   type: "POST",
		   async: false,
		   url: '../Logica/ValidacionProceso.php',
		   data: {HD_VALIDACION : 'obtenerVariableSoporteNombre', nombreVariableSoporte : nombreVariableSoporte}, 
		   success: function(resp)
		   {								   															
				value = parseInt(resp);
		   }
		 });
	return value;	 		
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
	$("#HD_ID_SOLICITUD_16").val(idRadicado);	
	$("#HD_ID_SOLICITUD_17").val(idRadicado);	
	$("#HD_ID_SOLICITUD_18").val(idRadicado);	
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
						//$("#BTN_EDIT_INICIACION").attr('disabled', true);
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
						//$("#BTN_EDIT_INICIACION").attr('disabled', false);
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
					//	$("#BTN_EDIT_VAL_DOCUMENTOS").attr('disabled', false);					
						siguientePaso();	
					}
					else if(datosRadicado.idMotivo == null)
					{
						$("#SL_CHECK_LIST").val(0);						
						$("#SL_ACTUACION").val(0);						
						$("#TA_OBSERVACION_2").val('');		
						//$("#BTN_EDIT_VAL_DOCUMENTOS").attr('disabled', true);																				
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
					//	$("#BTN_EDIT_VAL_DOCUMENTOS").attr('disabled', true);		
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
						$("#BTN_EDIT_FECHA_RADI").attr('disabled', true);
					}
					else
					{
						$("#DT_FECHA_RADICACION").val(datosRadicado.fechaSolicitud);
						$("#DT_FECHA_RADICACION").attr('disabled', true);												
						$("#TA_OBSERVACION_3").attr('disabled', true);												
						$("#BT_FR_FECHA_RADI").attr('disabled', true);	
						$("#BTN_EDIT_FECHA_RADI").attr('disabled', false);											
						siguientePaso();	
					}
			   }
			 });			
}

function validarFechaSesionComiteAprobracion(idRadicado, opcionMenorCuantia)
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
					if(opcionMenorCuantia == 0)
					{
						if(datosRadicado.fechaSesionComiteAprobacion == null)
						{
							$("#DT_FECHA_SESION_COMITE_APROBACION").val('');
							$("#TA_OBSERVACION_4").val('');
							$("#BTN_EDIT_SESION_COMITE_APRO").attr('disabled', true);
						}
						else
						{
							$("#DT_FECHA_SESION_COMITE_APROBACION").val(datosRadicado.fechaSesionComiteAprobacion);
							$("#DT_FECHA_SESION_COMITE_APROBACION").attr('disabled', true);												
							$("#TA_OBSERVACION_4").attr('disabled', true);												
							$("#BT_FR_SESION_COMITE_APRO").attr('disabled', true);	
							$("#BTN_EDIT_SESION_COMITE_APRO").attr('disabled', false);											
							siguientePaso();	
						}						
					}
					if(opcionMenorCuantia == 1)
					{
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
						$("#BTN_EDIT_PUB_CONVO_SECOP").attr('disabled', true);
					}
					else
					{
						$("#DT_FECHA_PUBLICACION_CONVOCATORIA_SECOP").val(datosRadicado.fechaPublicacionSecop);
						$("#DT_FECHA_PUBLICACION_CONVOCATORIA_SECOP").attr('disabled', true);												
						$("#TA_OBSERVACION_5").attr('disabled', true);												
						$("#BT_FR_PUB_CONVO_SECOP").attr('disabled', true);	
						$("#BTN_EDIT_PUB_CONVO_SECOP").attr('disabled', false);											
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
						$("#BTN_EDIT_FECHA_AUD_RIESGOS").attr('disabled', true);
					}
					else
					{
						$("#DT_FECHA_AUDIENCIA_RIESGOS").val(datosRadicado.fechaAudienciaRiesgo);
						$("#DT_FECHA_AUDIENCIA_RIESGOS").attr('disabled', true);												
						$("#SL_Jornada_AUD_RIES").val(datosRadicado.jornadaAudienciaRiesgo);
						$("#SL_Jornada_AUD_RIES").attr('disabled', true);																		
						$("#TA_OBSERVACION_6").attr('disabled', true);												
						$("#BT_FR_FECHA_AUD_RIESGOS").attr('disabled', true);
						$("#BTN_EDIT_FECHA_AUD_RIESGOS").attr('disabled', false);												
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
						$("#BTN_EDIT_NUM_FEC_RESOL_APER_PRO").attr('disabled', true);
					}
					else
					{
						$("#TX_NUMERO_RESOLUCION_APERTURA_PROCESO").val(datosRadicado.numeroAperturaProceso);
						$("#TX_NUMERO_RESOLUCION_APERTURA_PROCESO").attr('disabled', true);												
						$("#DT_FECHA_RESOLUCION_APERTURA_PROCESO").val(datosRadicado.fechaResolucionAperturaProceso);
						$("#DT_FECHA_RESOLUCION_APERTURA_PROCESO").attr('disabled', true);																		
						$("#TA_OBSERVACION_7").attr('disabled', true);												
						$("#BT_FR_NUM_FEC_RESOL_APER_PRO").attr('disabled', true);	
						$("#BTN_EDIT_NUM_FEC_RESOL_APER_PRO").attr('disabled', false);																	
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
						$("#BTN_EDIT_FEC_PUB_PRE_SECOP").attr('disabled', true);
					}
					else
					{
						$("#DT_FECHA_PUB_PREPLIEGOS_SECOP").val(datosRadicado.fechaPublicacionPliegosSecop);
						$("#DT_FECHA_PUB_PREPLIEGOS_SECOP").attr('disabled', true);																		
						$("#TA_OBSERVACION_8").attr('disabled', true);																								
						$("#BT_FR_FEC_PUB_PRE_SECOP").attr('disabled', true);	
						$("#BTN_EDIT_FEC_PUB_PRE_SECOP").attr('disabled', false);											
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
						$("#BTN_EDIT_FEC_PUB_PLI_DEF_SECOP").attr('disabled', true);
					}
					else
					{
						$("#DT_FECHA_PUB_PLIEGOS_DEF_SECOP").val(datosRadicado.fechaPublicacionPliegosSecop);
						$("#DT_FECHA_PUB_PLIEGOS_DEF_SECOP").attr('disabled', true);																		
						$("#TA_OBSERVACION_9").attr('disabled', true);																								
						$("#BT_FR_FEC_PUB_PLI_DEF_SECOP").attr('disabled', true);
						$("#BTN_EDIT_FEC_PUB_PLI_DEF_SECOP").attr('disabled', false);												
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
						$("#BTN_EDIT_FEC_CIERRE_PRO").attr('disabled', true);
					}
					else
					{
						$("#DT_FECHA_CIERRE_PROCESOS").val(datosRadicado.fechaCierreProceso);
						$("#DT_FECHA_CIERRE_PROCESOS").attr('disabled', true);																		
						$("#TA_OBSERVACION_10").attr('disabled', true);																								
						$("#BT_FR_FEC_CIERRE_PRO").attr('disabled', true);	
						$("#BTN_EDIT_FEC_CIERRE_PRO").attr('disabled', false);											
						siguientePaso();	
					}
			   }
			 });			
}

function validarFechaPublicacionEvaluacionPreliminar(idRadicado)
{					
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/ProcesoAbogado.php',
			   data: {HD_VALIDACION : 'validarFechaPublicacionEvaluacionPreliminar', HD_ID_SOLICITUD: idRadicado}, 
			   success: function(data)
			   {								   																							
					$("#DV_CARGA").html('');
					var datosRadicado = $.parseJSON(data);				
					if(datosRadicado.fechaPublicacionEvaluacionPreliminar == null)
					{
						$("#DT_FECHA_PUB_EVAL_PRELIMINAR").val('');
						$("#TA_OBSERVACION_17").val('');
						$("#BTN_EDIT_PUBLICACION_EVAL_PRELIMINAR").attr('disabled', true);
					}
					else
					{
						$("#DT_FECHA_PUB_EVAL_PRELIMINAR").val(datosRadicado.fechaPublicacionEvaluacionPreliminar);
						$("#DT_FECHA_PUB_EVAL_PRELIMINAR").attr('disabled', true);																		
						$("#TA_OBSERVACION_17").attr('disabled', true);																								
						$("#BT_FR_PUBLICACION_EVAL_PRELIMINAR").attr('disabled', true);												
						$("#BTN_EDIT_PUBLICACION_EVAL_PRELIMINAR").attr('disabled', false);
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
						$("#BTN_EDIT_SESION_COMITE_APRO_2").attr('disabled', true);
					}
					else
					{
						$("#DT_FECHA_SESION_COMITE_APROBACION_2").val(datosRadicado.fechaSesionComiteAprobacion2);
						$("#DT_FECHA_SESION_COMITE_APROBACION_2").attr('disabled', true);																		
						$("#TA_OBSERVACION_11").attr('disabled', true);																								
						$("#BT_FR_SESION_COMITE_APRO_2").attr('disabled', true);												
						$("#BTN_EDIT_SESION_COMITE_APRO_2").attr('disabled', false);
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
						$("#BTN_EDIT_PUB_EVAL_DEFI").attr('disabled', true);
					}
					else
					{
						$("#DT_FECHA_PUB_EVAL_DEFINITIVA").val(datosRadicado.fechaPublicacionEvaluaiconDefinitiva);
						$("#DT_FECHA_PUB_EVAL_DEFINITIVA").attr('disabled', true);																		
						$("#TA_OBSERVACION_12").attr('disabled', true);																								
						$("#BT_FR_PUB_EVAL_DEFI").attr('disabled', true);
						$("#BTN_EDIT_PUB_EVAL_DEFI").attr('disabled', false);												
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
						$("#BTN_EDIT_FECHA_AUD_ADJ").attr('disabled', true);
					}
					else
					{
						$("#DT_FECHA_AUD_ADJUDICACION").val(datosRadicado.fechaAudienciaAdjudicacion);
						$("#DT_FECHA_AUD_ADJUDICACION").attr('disabled', true);																		
						$("#SL_Jornada_AUD_ADJUDICACION").val(datosRadicado.jornadaAudienciaAdjudicacion);
						$("#SL_Jornada_AUD_ADJUDICACION").attr('disabled', true);																								
						$("#TA_OBSERVACION_13").attr('disabled', true);																								
						$("#BT_FR_FECHA_AUD_ADJ").attr('disabled', true);	
						$("#BTN_EDIT_FECHA_AUD_ADJ").attr('disabled', false);											
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
						$("#BTN_EDIT_NUM_RESOL_AJD").attr('disabled', true);
					}
					else
					{
						$("#DT_FECHA_RESOLUCION_ADJUDICACION").val(datosRadicado.fechaResolucionAdjudicacion);
						$("#DT_FECHA_RESOLUCION_ADJUDICACION").attr('disabled', true);																		
						$("#TX_NUMERO_RESOLUCION_ADJUDICACION").val(datosRadicado.numeroResolucionAdjudicacion);
						$("#TX_NUMERO_RESOLUCION_ADJUDICACION").attr('disabled', true);																								
						$("#TA_OBSERVACION_14").attr('disabled', true);																								
						$("#BT_FR_NUM_FEC_RESOL_ADJ").attr('disabled', true);
						$("#BTN_EDIT_NUM_RESOL_AJD").attr('disabled', false);												
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
						$("#BTN_EDIT_FECHA_ELA_CNNVS").attr('disabled', true);
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
						$("#BTN_EDIT_FECHA_ELA_CNNVS").attr('disabled', false);											
						siguientePaso();	
					}
			   }
			 });			
}

function validarFechaEntregaConcepto(idRadicado)
{					
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/ProcesoAbogado.php',
			   data: {HD_VALIDACION : 'validarFechaEntregaConcepto', HD_ID_SOLICITUD: idRadicado}, 
			   success: function(data)
			   {								   																		
					$("#DV_CARGA").html('');
					var datosRadicado = $.parseJSON(data);				
					if(datosRadicado.fechaEntregaConcepto == null)
					{
						$("#DT_FECHA_ENTREGA_CONCEPTO").val('');
						$("#TA_OBSERVACION_18").val('');
						$("#BTN_EDIT_FECHA_ENTREGA_CONCEPTO").attr('disabled', true);
					}
					else
					{
						$("#DT_FECHA_ENTREGA_CONCEPTO").val(datosRadicado.fechaEntregaConcepto);
						$("#DT_FECHA_ENTREGA_CONCEPTO").attr('disabled', true);																		
						$("#TA_OBSERVACION_18").attr('disabled', true);																								
						$("#BT_FR_FECHA_ENTREGA_CONCEPTO").attr('disabled', true);
						$("#BTN_EDIT_FECHA_ENTREGA_CONCEPTO").attr('disabled', false);												
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

						//if($("#BTN_EDIT_INICIACION").is('[disabled=disabled]') == true)
						//{							
							cargarPanelNavegacion();
						//}
						//$("#BTN_EDIT_INICIACION").attr('disabled', false);								

				   }
				   else
				   {
				   		$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
				   		//$("#BTN_EDIT_INICIACION").attr('disabled', false);								
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
						$("#DV_CARGA").html('<div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Se agregaron correctamente los datos.</div>');												

						//if($("#BTN_EDIT_VAL_DOCUMENTOS").is('[disabled=disabled]') == true)
						//{							
							siguientePaso();
						//}
						//$("#BTN_EDIT_VAL_DOCUMENTOS").attr('disabled', false);								

			   		}
			   		else if(data == 0)
			   		{
						$("#BT_FR_VAL_DOC").attr('disabled', true);
						$("#DV_CARGA").html('<div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Se agregaron correctamente los datos, queda en espera de continuar con el trámite.</div>');						
						//$("#BTN_EDIT_VAL_DOCUMENTOS").attr('disabled', false);		
			   		}			   		
			   		else
			   		{
						$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
						//$("#BTN_EDIT_VAL_DOCUMENTOS").attr('disabled', false);		
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
							

							if($("#BTN_EDIT_FECHA_RADI").is('[disabled=disabled]') == true)
							{							
								siguientePaso();
							}
							$("#BTN_EDIT_FECHA_RADI").attr('disabled', false);								

				   		}
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
							$("#BTN_EDIT_FECHA_RADI").attr('disabled', false);								
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

							if($("#BTN_EDIT_SESION_COMITE_APRO").is('[disabled=disabled]') == true)
							{							
								siguientePaso();
							}
							$("#BTN_EDIT_SESION_COMITE_APRO").attr('disabled', false);								

				   		}
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
							$("#BTN_EDIT_SESION_COMITE_APRO").attr('disabled', false);								
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
							
							if($("#BTN_EDIT_PUB_CONVO_SECOP").is('[disabled=disabled]') == true)
							{							
								siguientePaso();
							}
							$("#BTN_EDIT_PUB_CONVO_SECOP").attr('disabled', false);								

				   		}
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
							$("#BTN_EDIT_PUB_CONVO_SECOP").attr('disabled', false);								
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
							
							if($("#BTN_EDIT_FECHA_AUD_RIESGOS").is('[disabled=disabled]') == true)
							{							
								siguientePaso();
							}
							$("#BTN_EDIT_FECHA_AUD_RIESGOS").attr('disabled', false);								

				   		}
			   			else if(data == 0)
			   			{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Esta fecha ya se encuentra reservada, por favor cambia la fecha o jornada.</div>');			   				
							$("#BTN_EDIT_FECHA_AUD_RIESGOS").attr('disabled', true);								
						}
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
							$("#BTN_EDIT_FECHA_AUD_RIESGOS").attr('disabled', false);								
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
							
							if($("#BTN_EDIT_NUM_FEC_RESOL_APER_PRO").is('[disabled=disabled]') == true)
							{							
								siguientePaso();
							}
							$("#BTN_EDIT_NUM_FEC_RESOL_APER_PRO").attr('disabled', false);								

				   		}
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
							$("#BTN_EDIT_NUM_FEC_RESOL_APER_PRO").attr('disabled', false);															
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
							
							if($("#BTN_EDIT_FEC_PUB_PRE_SECOP").is('[disabled=disabled]') == true)
							{							
								siguientePaso();
							}
							$("#BTN_EDIT_FEC_PUB_PRE_SECOP").attr('disabled', false);								

				   		}
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
							$("#BTN_EDIT_FEC_PUB_PRE_SECOP").attr('disabled', false);															
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
							

							if($("#BTN_EDIT_FEC_PUB_PLI_DEF_SECOP").is('[disabled=disabled]') == true)
							{							
								siguientePaso();
							}
							$("#BTN_EDIT_FEC_PUB_PLI_DEF_SECOP").attr('disabled', false);								

				   		}
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
							$("#BTN_EDIT_FEC_PUB_PLI_DEF_SECOP").attr('disabled', false);															
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
							
							if($("#BTN_EDIT_FEC_CIERRE_PRO").is('[disabled=disabled]') == true)
							{							
								siguientePaso();
							}
							$("#BTN_EDIT_FEC_CIERRE_PRO").attr('disabled', false);								

				   		}
			   			else if(data == 2)
			   			{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Esta fecha debe ser posterior a la fecha de audiencia de riesgos.</div>');			   				
							$("#BTN_EDIT_FEC_CIERRE_PRO").attr('disabled', true);															
						}				   		
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
							$("#BTN_EDIT_FEC_CIERRE_PRO").attr('disabled', false);															
				   		}
				   }
				 });		
		}
		return false;
	});	


	$("#FR_PUBLICACION_EVAL_PRELIMINAR").submit(function()
	{
		var fechaRadicacion = $('#DT_FECHA_PUB_EVAL_PRELIMINAR').val();			
		if(fechaRadicacion == "")
		{
			$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Por favor ingrese la fecha de publicación evaluación preliminar.</div>');
		}
		else
		{
			$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
			$.ajax({
				   type: "POST",
				   url: '../Logica/ProcesoAbogado.php',
				   data: $("#FR_PUBLICACION_EVAL_PRELIMINAR").serialize(),
				   success: function(data)
				   {								   			   						   						   						   		
				   		if(data == 1)
				   		{							
							$("#DT_FECHA_PUB_EVAL_PRELIMINAR").attr('disabled', true);
							$("#TA_OBSERVACION_17").attr('disabled', true);
							$("#BT_FR_PUBLICACION_EVAL_PRELIMINAR").attr('disabled', true);
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Se agregaron correctamente los datos.</div>');						
							
							if($("#BTN_EDIT_PUBLICACION_EVAL_PRELIMINAR").is('[disabled=disabled]') == true)
							{							
								siguientePaso();
							}
							$("#BTN_EDIT_PUBLICACION_EVAL_PRELIMINAR").attr('disabled', false);								

				   		}
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
							$("#BTN_EDIT_PUBLICACION_EVAL_PRELIMINAR").attr('disabled', false);															
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
			$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Por favor ingrese la fecha de presentación evaluación definitiva.</div>');
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
							
							if($("#BTN_EDIT_SESION_COMITE_APRO_2").is('[disabled=disabled]') == true)
							{							
								siguientePaso();
							}
							$("#BTN_EDIT_SESION_COMITE_APRO_2").attr('disabled', false);								

				   		}
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
							$("#BTN_EDIT_SESION_COMITE_APRO_2").attr('disabled', false);															
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
							
							if($("#BTN_EDIT_PUB_EVAL_DEFI").is('[disabled=disabled]') == true)
							{							
								siguientePaso();								
							}
							$("#BTN_EDIT_PUB_EVAL_DEFI").attr('disabled', false);								

				   		}
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
							$("#BTN_EDIT_PUB_EVAL_DEFI").attr('disabled', false);															
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

							if($("#BTN_EDIT_FECHA_AUD_ADJ").is('[disabled=disabled]') == true)
							{							
								siguientePaso();								
							}
							$("#BTN_EDIT_FECHA_AUD_ADJ").attr('disabled', false);								


				   		}
			   			else if(data == 0)
			   			{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Esta fecha ya se encuentra reservada, por favor cambia la fecha o jornada.</div>');			   				
							$("#BTN_EDIT_FECHA_AUD_ADJ").attr('disabled', true);															
						}				   		
			   			else if(data == 2)
			   			{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Esta fecha debe ser posterior a la fecha de cierre de proceso.</div>');			   				
							$("#BTN_EDIT_FECHA_AUD_ADJ").attr('disabled', true);																						
						}				   								
			   			else if(data == 3)
			   			{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Esta fecha debe ser posterior a la fecha de audiencia de riesgo.</div>');			   				
							$("#BTN_EDIT_FECHA_AUD_ADJ").attr('disabled', true);																						
						}				   														
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
							$("#BTN_EDIT_FECHA_AUD_ADJ").attr('disabled', false);																						
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
							
							if($("#BTN_EDIT_NUM_RESOL_AJD").is('[disabled=disabled]') == true)
							{							
								siguientePaso();
							}
							$("#BTN_EDIT_NUM_RESOL_AJD").attr('disabled', false);								

				   		}
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
							$("#BTN_EDIT_NUM_RESOL_AJD").attr('disabled', false);															
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
							
							if($("#BTN_EDIT_FECHA_ELA_CNNVS").is('[disabled=disabled]') == true)
							{							
								siguientePaso();
							}
							$("#BTN_EDIT_FECHA_ELA_CNNVS").attr('disabled', false);								

				   		}
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
							$("#BTN_EDIT_FECHA_ELA_CNNVS").attr('disabled', false);															
				   		}
				   }
				 });		
		}
		return false;
	});	


	$("#FR_FECHA_ENTREGA_CONCEPTO").submit(function()
	{
		var fechaRadicacion = $('#DT_FECHA_ENTREGA_CONCEPTO').val();	
		if(fechaRadicacion == "")
		{
			$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Por favor ingrese la fecha de entrega de concepto.</div>');
		}
		else
		{
			$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
			$.ajax({
				   type: "POST",
				   url: '../Logica/ProcesoAbogado.php',
				   data: $("#FR_FECHA_ENTREGA_CONCEPTO").serialize(),
				   success: function(data)
				   {								   			   						   						   	
				   		if(data == 1)
				   		{
							$("#DT_FECHA_ENTREGA_CONCEPTO").attr('disabled', true);
							$("#TA_OBSERVACION_18").attr('disabled', true);
							$("#BT_FR_FECHA_ENTREGA_CONCEPTO").attr('disabled', true);
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Se agregaron correctamente los datos.</div>');						
							

							if($("#BTN_EDIT_FECHA_ENTREGA_CONCEPTO").is('[disabled=disabled]') == true)
							{							
								siguientePaso();
							}
							$("#BTN_EDIT_FECHA_ENTREGA_CONCEPTO").attr('disabled', false);								

				   		}
				   		else
				   		{
							$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
							$("#BTN_EDIT_FECHA_ENTREGA_CONCEPTO").attr('disabled', false);								
				   		}
				   }
				 });		
		}
		return false;
	});	


	$("#FR_TERMINARCION_PROCESO").submit(function()
	{

		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/ValidacionProceso.php',
			   data: $("#FR_TERMINARCION_PROCESO").serialize(),
			   success: function(data)
			   {								   			   						   						   						   		
			   		if(data == 1)
			   		{							
						$("#DV_CARGA").html('');
						$("#DV_PROC_TERM").show();
						$("#DV_PROC_TERM_ANTIC").hide();						
						setTimeout(function(){
							window.location.href = 'VerProceso.php';
											 }, 5000);						
			   		}
			   		else
			   		{
						$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Ha ocurrido un error, por favor comuniquese con el área de sistemas.</div>');
			   		}
			   }
			 });		
		
		return false;
	});	

   
});



/*$('#BTN_EDIT_INICIACION').click(function()
{	  
	$("#TA_OBJETO").attr('disabled', false);												
	$("#SL_MODALIDAD").attr('disabled', false);												
	$("#TX_VALOR_ESTIMADO").attr('disabled', false);												
	$("#TA_OBSERVACION_1").attr('disabled', false);																		
	$("#BT_FR_INICIACION").attr('disabled', false);
});*/


/*$('#BTN_EDIT_VAL_DOCUMENTOS').click(function()
{	  
	$("#SL_CHECK_LIST").attr('disabled', false);												
	$("#SL_ACTUACION").attr('disabled', false);							
	$("#TA_OBSERVACION_2").attr('disabled', false);		
	$("#BT_FR_VAL_DOC").attr('disabled', false);		
});*/

$('#BTN_EDIT_FECHA_RADI').click(function()
{	  
	$("#DT_FECHA_RADICACION").attr('disabled', false);												
	$("#TA_OBSERVACION_3").attr('disabled', false);												
	$("#BT_FR_FECHA_RADI").attr('disabled', false);	
});

$('#BTN_EDIT_SESION_COMITE_APRO').click(function()
{	  
	$("#DT_FECHA_SESION_COMITE_APROBACION").attr('disabled', false);												
	$("#TA_OBSERVACION_4").attr('disabled', false);												
	$("#BT_FR_SESION_COMITE_APRO").attr('disabled', false);	
});

$('#BTN_EDIT_PUB_CONVO_SECOP').click(function()
{	  
	$("#DT_FECHA_PUBLICACION_CONVOCATORIA_SECOP").attr('disabled', false);												
	$("#TA_OBSERVACION_5").attr('disabled', false);												
	$("#BT_FR_PUB_CONVO_SECOP").attr('disabled', false);	
});

$('#BTN_EDIT_NUM_FEC_RESOL_APER_PRO').click(function()
{	  
	$("#TX_NUMERO_RESOLUCION_APERTURA_PROCESO").attr('disabled', false);												
	$("#DT_FECHA_RESOLUCION_APERTURA_PROCESO").attr('disabled', false);																		
	$("#TA_OBSERVACION_7").attr('disabled', false);												
	$("#BT_FR_NUM_FEC_RESOL_APER_PRO").attr('disabled', false);	
});

$('#BTN_EDIT_FEC_PUB_PRE_SECOP').click(function()
{	  
	$("#DT_FECHA_PUB_PREPLIEGOS_SECOP").attr('disabled', false);																		
	$("#TA_OBSERVACION_8").attr('disabled', false);																								
	$("#BT_FR_FEC_PUB_PRE_SECOP").attr('disabled', false);	
});

$('#BTN_EDIT_FECHA_AUD_RIESGOS').click(function()
{	  
	$("#DT_FECHA_AUDIENCIA_RIESGOS").attr('disabled', false);
	$("#TA_OBSERVACION_6").attr('disabled', false);
	$("#SL_Jornada_AUD_RIES").attr('disabled', false);
	$("#BT_FR_FECHA_AUD_RIESGOS").attr('disabled', false);
});

$('#BTN_EDIT_FEC_PUB_PLI_DEF_SECOP').click(function()
{	  
	$("#DT_FECHA_PUB_PLIEGOS_DEF_SECOP").attr('disabled', false);																		
	$("#TA_OBSERVACION_9").attr('disabled', false);																								
	$("#BT_FR_FEC_PUB_PLI_DEF_SECOP").attr('disabled', false);
});

$('#BTN_EDIT_FEC_CIERRE_PRO').click(function()
{	  
	$("#DT_FECHA_CIERRE_PROCESOS").attr('disabled', false);																		
	$("#TA_OBSERVACION_10").attr('disabled', false);																								
	$("#BT_FR_FEC_CIERRE_PRO").attr('disabled', false);	
});

$('#BTN_EDIT_PUBLICACION_EVAL_PRELIMINAR').click(function()
{	  
	$("#DT_FECHA_PUB_EVAL_PRELIMINAR").attr('disabled', false);																		
	$("#TA_OBSERVACION_17").attr('disabled', false);																								
	$("#BT_FR_PUBLICACION_EVAL_PRELIMINAR").attr('disabled', false);												
});

$('#BTN_EDIT_SESION_COMITE_APRO_2').click(function()
{	  
	$("#DT_FECHA_SESION_COMITE_APROBACION_2").attr('disabled', false);																		
	$("#TA_OBSERVACION_11").attr('disabled', false);																								
	$("#BT_FR_SESION_COMITE_APRO_2").attr('disabled', false);												
});

$('#BTN_EDIT_PUB_EVAL_DEFI').click(function()
{	  
	$("#DT_FECHA_PUB_EVAL_DEFINITIVA").attr('disabled', false);																		
	$("#TA_OBSERVACION_12").attr('disabled', false);																								
	$("#BT_FR_PUB_EVAL_DEFI").attr('disabled', false);
});

$('#BTN_EDIT_FECHA_AUD_ADJ').click(function()
{	  
	$("#DT_FECHA_AUD_ADJUDICACION").attr('disabled', false);																		
	$("#SL_Jornada_AUD_ADJUDICACION").attr('disabled', false);																								
	$("#TA_OBSERVACION_13").attr('disabled', false);																								
	$("#BT_FR_FECHA_AUD_ADJ").attr('disabled', false);	
});

$('#BTN_EDIT_NUM_RESOL_AJD').click(function()
{	  
	$("#DT_FECHA_RESOLUCION_ADJUDICACION").attr('disabled', false);																			
	$("#TX_NUMERO_RESOLUCION_ADJUDICACION").attr('disabled', false);																								
	$("#TA_OBSERVACION_14").attr('disabled', false);																								
	$("#BT_FR_NUM_FEC_RESOL_ADJ").attr('disabled', false);
});

$('#BTN_EDIT_FECHA_ELA_CNNVS').click(function()
{	  
	$("#DT_FECHA_ELABORACION_CONTRATO").attr('disabled', false);																		
	$("#TX_NUMERO_SUSCRIPCION").attr('disabled', false);																								
	$("#TX_NOMBRE_CONTRATISTA").attr('disabled', false);																								
	$("#TX_VALOR_CONTRATO").attr('disabled', false);																								
	$("#TX_PLAZO_EJECUCION").attr('disabled', false);																								
	$("#TX_SUPERVISOR").attr('disabled', false);																														
	$("#TA_OBSERVACION_15").attr('disabled', false);																								
	$("#BT_FR_FECHA_ELA_CNNVS").attr('disabled', false);	
});


