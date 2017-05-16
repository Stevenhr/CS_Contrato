<html lang="es">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="description" content="">
      <meta name="author" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />

      <link rel="icon" href="../../../Plantilla_Base/Presentacion/Img/idrd_icon.ico">    
      <link rel="stylesheet" href="../../../Plantilla_Base/Presentacion/Css/bootstrap.min.css" media="screen">    
      <link rel="styleseet" href="../../../Plantilla_Base/Presentacion/Css/sticky-footer.css" media="screen">    
      <link rel="stylesheet" href="Css/datepicker.css" media="screen">    
      <link rel="stylesheet" href="Css/bootstrap-datetimepicker.min.css" media="screen">    

      <title>MÓDULO CONTROL Y SEGUIMIENTO DE CONTRATOS.</title>
  </head>

  <style type="text/css">
    div.scroll
    {        
        height: 462px;        
        overflow-y: scroll;
        overflow-x: scroll;
    }
  </style>

  <body>
      
      <?php include("Menu.php") ?>;  
      
      <!-- Contenedor información módulo -->
      </br></br>
      <div class="container">
          <div class="page-header" id="banner">
            <div class="row">
              <div class="col-lg-8 col-md-7 col-sm-6">
                <h2><strong>MÓDULO CONTROL Y SEGUIMIENTO DE CONTRATOS.</strong></h2>
                <p class="lead"><h4>Subdirección Administrativa y financiera.</h4></p>
              </div>
              <div class="col-lg-4 col-md-5 col-sm-6">
                 <div align="right"> 
                    <img src="../../../Plantilla_Base/Presentacion/Img/IDRD.JPG" width="50%" heigth="40%"/>
                 </div>                    
              </div>
            </div>
          </div>        
      </div>
      <!-- FIN Contenedor información módulo -->

      
      <!-- Contenedor panel principal -->
      <div class="container">
          <div id="DV_CARGA"></div>                    
          <div class="panel panel-default">
                <div class="panel-body">
                                                                                
                      <div id="DV_CONTRATOS_ASIGNADOS"></div>                  
                      
                      <div id="DV_BARRA_PROCESO_CONTRATO">
                          <div class="progress">
                                <div class="progress-bar progress-bar-default progress-bar-striped" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="PB_PROGRESO">
                          </div>                  
                      </div>   


                      <div id="DV_PROCESO_CONTRATO_ESPECIFICO"></div>                  
                      <div id="DV_PROCESO_OPCIONES_CONTRATO_ESPECIFICO">                            

                                 <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">                                    
                                                                      
                                    <div class="panel panel-default" id="DIV_PANEL_1">
                                      <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title">
                                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Iniciación.
                                          </a>         
                                          <!--<p align="right"><button type='button' class='btn btn-link'  id="BTN_EDIT_INICIACION"><span class='glyphicon glyphicon-pencil'></span></button></p>-->
                                        </h4>
                                      </div>
                                      <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">
                                              <form id="FR_INICIACION" name="FR_INICIACION" class="form-horizontal"  action="#" method="POST">                                                                                           
                                                   <input type="hidden" name="HD_VALIDACION" id="HD_VALIDACION_1" value="guardarIniciacion"  />
                                                   <input type="hidden" name="HD_ID_SOLICITUD" id="HD_ID_SOLICITUD_1"  />

                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Objeto: </label>
                                                      <div class="col-sm-10">
                                                            <textarea class="form-control" rows="4" id="TA_OBJETO" name="TA_OBJETO" required></textarea>
                                                      </div>
                                                  </div>                                       

                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Modalidad de selección o trámite:</label>
                                                      <div class="col-sm-10">
                                                            <select id="SL_MODALIDAD" name="SL_MODALIDAD" class="form-control" required>
                                                                  <option></option>
                                                            </select>
                                                      </div>
                                                  </div>                                       

                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Valor estimado de contrato y/o adición:</label>
                                                      <div class="col-sm-10">
                                                        <input type="number" name="TX_VALOR_ESTIMADO" class="form-control" id="TX_VALOR_ESTIMADO" placeholder="$" required />                                           
                                                      </div>
                                                  </div>                                       

                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Observación:</label>
                                                      <div class="col-sm-10">
                                                        <textarea class="form-control" rows="3" id="TA_OBSERVACION_1" name="TA_OBSERVACION_1" ></textarea>
                                                      </div>
                                                  </div>     

                                                  <p align="right">
                                                    <button type="submit" class="btn btn-primary" id="BT_FR_INICIACION"> 
                                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Datos
                                                    </button>
                                                  </p>
                                              </form>     

                                        </div>
                                      </div>
                                     </div>
                                   </form>   

                                  
                                    <div class="panel panel-default"  id="DIV_PANEL_2">
                                      <div class="panel-heading" role="tab" id="headingTwo">
                                        <h4 class="panel-title">
                                          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Validación de documentos.
                                          </a>
                                          <!--<p align="right"><button type='button' class='btn btn-link' id="BTN_EDIT_VAL_DOCUMENTOS"><span class='glyphicon glyphicon-pencil'></span></button></p>-->
                                        </h4>
                                      </div>
                                      <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                        <div class="panel-body">                                                                                        
                                                <form id="FR_VAL_DOC" name="FR_VAL_DOC" class="form-horizontal"  action="#" method="POST">

                                                   <input type="hidden" name="HD_ID_SOLICITUD" id="HD_ID_SOLICITUD_2"  />
                                                   <input type="hidden" name="HD_VALIDACION" id="HD_VALIDACION_2" value="guardarVerificacion"  />
                                                   <input type="hidden" name="HD_VALIDACION_CHECK_LIST" id="HD_VALIDACION_CHECK_LIST"  />
                                                   <input type="hidden" name="HD_DATOS_CHECK_LIST" id="HD_DATOS_CHECK_LIST"  />


                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Check List: </label>
                                                      <div class="col-sm-10">
                                                            <select id="SL_CHECK_LIST" name="SL_CHECK_LIST" class="form-control" required>
                                                                  <option></option>
                                                            </select>                                                          
                                                      </div>
                                                  </div>   
                                                 
                                                  <div id="DV_ACTUACION">                                                         
                                                         <div class="form-group">
                                                            <label class="col-sm-2 control-label">Actuación: </label>
                                                            <div class="col-sm-10">
                                                                  <select id="SL_ACTUACION" name="SL_ACTUACION" class="form-control" required>
                                                                        <option></option>
                                                                  </select>                                                          
                                                            </div>
                                                        </div>                                                       
                                                  </div>
                                                  
                                                  <div id="DV_MOTIVO">                                                         
                                                         <div class="form-group">
                                                            <label class="col-sm-2 control-label">Motivo: </label>
                                                            <div class="col-sm-10">
                                                                  <select id="SL_MOTIVO" name="SL_MOTIVO" class="form-control" required>
                                                                        <option></option>
                                                                  </select>                                                          
                                                            </div>
                                                        </div>                                                       
                                                  </div>
                                                
                                                  <div id="DV_DOCUMENTO">                                                         
                                                         <div class="form-group">
                                                            <label class="col-sm-2 control-label">Documento: </label>
                                                            <div class="col-sm-10">
                                                                  <select id="SL_DOCUMENTO" name="SL_DOCUMENTO" class="form-control" required>
                                                                        <option></option>
                                                                  </select>                                                          
                                                            </div>
                                                        </div>                                                       
                                                  </div>

                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Observación:</label>
                                                      <div class="col-sm-10">
                                                        <textarea class="form-control" rows="3" id="TA_OBSERVACION_2" name="TA_OBSERVACION_2" ></textarea>
                                                      </div>
                                                  </div>     

                                                  <br>
                                                  <p align="right">
                                                    <button type="submit" class="btn btn-primary" id="BT_FR_VAL_DOC"> 
                                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Datos
                                                    </button>
                                                  </p>

                                              </form>
                                        </div>
                                      </div>
                                    </div>
                                  

                                    <div class="panel panel-default" id="DIV_PANEL_3">
                                      <div class="panel-heading" role="tab" id="headingThree">
                                        <h4 class="panel-title">
                                          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                             Fecha Radicación
                                          </a>
                                          <p align="right"><button type='button' class='btn btn-link'  id="BTN_EDIT_FECHA_RADI"><span class='glyphicon glyphicon-pencil'></span></button></p>
                                        </h4>
                                      </div>
                                      <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                        <div class="panel-body">

                                                <form id="FR_FECHA_RADI" name="FR_FECHA_RADI" class="form-horizontal"  action="#" method="POST">

                                                   <input type="hidden" name="HD_ID_SOLICITUD" id="HD_ID_SOLICITUD_3"  />
                                                   <input type="hidden" name="HD_VALIDACION" id="HD_VALIDACION_3" value="guardarFechaRadicacion"  />

                                                  <div class="form-group">
                                                      <label class="col-sm-2 control-label">Fecha Radicación: </label>
                                                      <div class="col-sm-10">
                                                          <input type="text" readonly name="DT_FECHA_RADICACION" class="form-control" id="DT_FECHA_RADICACION" placeholder="dd/mm/yyyy" required />
                                                      </div>
                                                  </div>     

                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Observación:</label>
                                                      <div class="col-sm-10">
                                                        <textarea class="form-control" rows="3" id="TA_OBSERVACION_3" name="TA_OBSERVACION_3" ></textarea>
                                                      </div>
                                                  </div>     

                                                  <br>
                                                  <p align="right">
                                                    <button type="submit" class="btn btn-primary" id="BT_FR_FECHA_RADI"> 
                                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Datos
                                                    </button>
                                                  </p>

                                                </form>


                                        </div>
                                      </div>
                                    </div>


                                    <div class="panel panel-default" id="DIV_PANEL_4">
                                      <div class="panel-heading" role="tab" id="headingFour">
                                        <h4 class="panel-title">
                                          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                             Fecha sesión comite aprobación
                                          </a>
                                          <p align="right"><button type='button' class='btn btn-link'  id="BTN_EDIT_SESION_COMITE_APRO"><span class='glyphicon glyphicon-pencil'></span></button></p>
                                        </h4>
                                      </div>
                                      <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                        <div class="panel-body">

                                                <form id="FR_SESION_COMITE_APRO" name="FR_SESION_COMITE_APRO" class="form-horizontal"  action="#" method="POST">  

                                                   <input type="hidden" name="HD_ID_SOLICITUD" id="HD_ID_SOLICITUD_4"  />
                                                   <input type="hidden" name="HD_VALIDACION" id="HD_VALIDACION_4" value="guardarFechaSesionComiteAprobracion"  />

                                                  <div class="form-group">
                                                      <label class="col-sm-2 control-label">Fecha sesión comite aprobación: </label>
                                                      <div class="col-sm-10">
                                                          <input type="text" readonly name="DT_FECHA_SESION_COMITE_APROBACION" class="form-control" id="DT_FECHA_SESION_COMITE_APROBACION" placeholder="dd/mm/yyyy" required />
                                                      </div>
                                                  </div>  

                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Observación:</label>
                                                      <div class="col-sm-10">
                                                        <textarea class="form-control" rows="3" id="TA_OBSERVACION_4" name="TA_OBSERVACION_4" ></textarea>
                                                      </div>
                                                  </div>     

                                                  <br>
                                                  <p align="right">
                                                    <button type="submit" class="btn btn-primary" id="BT_FR_SESION_COMITE_APRO"> 
                                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Datos
                                                    </button>
                                                  </p>

                                                </form>                                 


                                        </div>
                                      </div>
                                    </div>


                                    <div class="panel panel-default" id="DIV_PANEL_5">
                                      <div class="panel-heading" role="tab" id="headingFive">
                                        <h4 class="panel-title">
                                          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                             Fecha publicación convocatoria SECOP
                                          </a>
                                          <p align="right"><button type='button' class='btn btn-link'  id="BTN_EDIT_PUB_CONVO_SECOP"><span class='glyphicon glyphicon-pencil'></span></button></p>
                                        </h4>
                                      </div>
                                      <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                                        <div class="panel-body">

                                                 <form id="FR_PUB_CONVO_SECOP" name="FR_PUB_CONVO_SECOP" class="form-horizontal"  action="#" method="POST"> 
                                                 
                                                   <input type="hidden" name="HD_ID_SOLICITUD" id="HD_ID_SOLICITUD_5"  />
                                                   <input type="hidden" name="HD_VALIDACION" id="HD_VALIDACION_5" value="guardarFechaPublicacionConSecop"  />


                                                  <div class="form-group">
                                                      <label class="col-sm-2 control-label">Fecha publicación convocatoria SECOP: </label>
                                                      <div class="col-sm-10">
                                                          <input type="text" readonly name="DT_FECHA_PUBLICACION_CONVOCATORIA_SECOP" class="form-control" id="DT_FECHA_PUBLICACION_CONVOCATORIA_SECOP" placeholder="dd/mm/yyyy" required />
                                                      </div>
                                                  </div>

                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Observación:</label>
                                                      <div class="col-sm-10">
                                                        <textarea class="form-control" rows="3" id="TA_OBSERVACION_5" name="TA_OBSERVACION_5" ></textarea>
                                                      </div>
                                                  </div>     

                                                  <br>
                                                  <p align="right">
                                                    <button type="submit" class="btn btn-primary" id="BT_FR_PUB_CONVO_SECOP"> 
                                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Datos
                                                    </button>
                                                  </p>                                                  

                                                 </form> 


                                        </div>
                                      </div>
                                    </div>

                                 
                                    <div class="panel panel-default" id="DIV_PANEL_6">
                                      <div class="panel-heading" role="tab" id="headingSeven">
                                        <h4 class="panel-title">
                                          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                             Número y Fecha resolución apertura de proceso
                                          </a>
                                          <p align="right"><button type='button' class='btn btn-link'  id="BTN_EDIT_NUM_FEC_RESOL_APER_PRO"><span class='glyphicon glyphicon-pencil'></span></button></p>
                                        </h4>
                                      </div>
                                      <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                                        <div class="panel-body">
                                                  
                                                   
                                              <form id="FR_NUM_FEC_RESOL_APER_PRO" name="FR_NUM_FEC_RESOL_APER_PRO" class="form-horizontal"  action="#" method="POST">    

                                                   <input type="hidden" name="HD_ID_SOLICITUD" id="HD_ID_SOLICITUD_7"  />
                                                   <input type="hidden" name="HD_VALIDACION" id="HD_VALIDACION_7" value="guardarNumeroFechaResolucionAperProc"  />                                                  


                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Número resolución apertura de proceso:</label>
                                                      <div class="col-sm-10">
                                                        <input type="number" name="TX_NUMERO_RESOLUCION_APERTURA_PROCESO" class="form-control" id="TX_NUMERO_RESOLUCION_APERTURA_PROCESO" placeholder="#" required />                                           
                                                      </div>
                                                  </div>                                       
                                                  <div class="form-group">
                                                      <label class="col-sm-2 control-label">Fecha resolución apertura de proceso: </label>
                                                      <div class="col-sm-10">
                                                          <input type="text" readonly name="DT_FECHA_RESOLUCION_APERTURA_PROCESO" class="form-control" id="DT_FECHA_RESOLUCION_APERTURA_PROCESO" placeholder="dd/mm/yyyy" required />
                                                      </div>
                                                  </div>   
                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Observación:</label>
                                                      <div class="col-sm-10">
                                                        <textarea class="form-control" rows="3" id="TA_OBSERVACION_7" name="TA_OBSERVACION_7" ></textarea>
                                                      </div>
                                                  </div>     

                                                  <br>
                                                  <p align="right">
                                                    <button type="submit" class="btn btn-primary" id="BT_FR_NUM_FEC_RESOL_APER_PRO"> 
                                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Datos
                                                    </button>
                                                  </p>                                                                                                                                                             
                                               </form>                                       

                                        </div>
                                      </div>
                                    </div>   


                                    <div class="panel panel-default" id="DIV_PANEL_7">
                                      <div class="panel-heading" role="tab" id="headingEight">
                                        <h4 class="panel-title">
                                          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                             Fecha publicación de prepliegos SECOP
                                          </a>
                                          <p align="right"><button type='button' class='btn btn-link'  id="BTN_EDIT_FEC_PUB_PRE_SECOP"><span class='glyphicon glyphicon-pencil'></span></button></p>
                                        </h4>
                                      </div>
                                      <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
                                        <div class="panel-body">

                                                <form id="FR_FEC_PUB_PRE_SECOP" name="FR_FEC_PUB_PRE_SECOP" class="form-horizontal"  action="#" method="POST">    

                                                   <input type="hidden" name="HD_ID_SOLICITUD" id="HD_ID_SOLICITUD_8"  />
                                                   <input type="hidden" name="HD_VALIDACION" id="HD_VALIDACION_8" value="guardarFechaPublicacionPrepliegosSECOP"  />                                                  

                                                  <div class="form-group">
                                                      <label class="col-sm-2 control-label">Fecha publicación de prepliegos SECOP: </label>
                                                      <div class="col-sm-10">
                                                          <input type="text" readonly name="DT_FECHA_PUB_PREPLIEGOS_SECOP" class="form-control" id="DT_FECHA_PUB_PREPLIEGOS_SECOP" placeholder="dd/mm/yyyy" required />
                                                      </div>
                                                  </div>                                       
                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Observación:</label>
                                                      <div class="col-sm-10">
                                                        <textarea class="form-control" rows="3" id="TA_OBSERVACION_8" name="TA_OBSERVACION_8" ></textarea>
                                                      </div>
                                                  </div>     
                                                  <br>
                                                  <p align="right">
                                                    <button type="submit" class="btn btn-primary" id="BT_FR_FEC_PUB_PRE_SECOP"> 
                                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Datos
                                                    </button>
                                                  </p>                                                                                                           

                                                 </form> 

                                        </div>
                                      </div>
                                    </div>                                  


                                    <div class="panel panel-default" id="DIV_PANEL_8">
                                      <div class="panel-heading" role="tab" id="headingSix">
                                        <h4 class="panel-title">
                                          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                             Fecha audiencia riesgos
                                          </a>
                                          <p align="right"><button type='button' class='btn btn-link'  id="BTN_EDIT_FECHA_AUD_RIESGOS"><span class='glyphicon glyphicon-pencil'></span></button></p>
                                        </h4>
                                      </div>
                                      <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                                        <div class="panel-body">

                                               <form id="FR_FECHA_AUD_RIESGOS" name="FR_FECHA_AUD_RIESGOS" class="form-horizontal"  action="#" method="POST">    
                                                  
                                                   <input type="hidden" name="HD_ID_SOLICITUD" id="HD_ID_SOLICITUD_6"  />
                                                   <input type="hidden" name="HD_VALIDACION" id="HD_VALIDACION_6" value="guardarFechaAudienciaRiesgos"  />                                                  

                                                  <div class="form-group">
                                                      <label class="col-sm-2 control-label">Fecha audiencia riesgos: </label>
                                                      <div class="col-sm-10">
                                                          <input type="text" readonly name="DT_FECHA_AUDIENCIA_RIESGOS" class="form-control" id="DT_FECHA_AUDIENCIA_RIESGOS" placeholder="dd/mm/yyyy" required />                                                                         
                                                      </div>
                                                  </div>     

                                                 <div class="form-group">
                                                    <label class="col-sm-2 control-label">Jornada: </label>
                                                    <div class="col-sm-10">
                                                          <select id="SL_Jornada_AUD_RIES" name="SL_Jornada_AUD_RIES" class="form-control" required>
                                                                <option value=""></option>
                                                                <option>Mañana</option>
                                                                <option>Tarde</option>
                                                          </select>                                                          
                                                    </div>
                                                </div>                                                       


                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Observación:</label>
                                                      <div class="col-sm-10">
                                                        <textarea class="form-control" rows="3" id="TA_OBSERVACION_6" name="TA_OBSERVACION_6" ></textarea>
                                                      </div>
                                                  </div>     

                                                  <br>
                                                  <p align="right">
                                                    <button type="submit" class="btn btn-primary" id="BT_FR_FECHA_AUD_RIESGOS"> 
                                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Datos
                                                    </button>
                                                  </p>                                                                                                                                      

                                              </form>

                                        </div>
                                      </div>
                                    </div> 


                                    <div class="panel panel-default" id="DIV_PANEL_9">
                                      <div class="panel-heading" role="tab" id="headingNine">
                                        <h4 class="panel-title">
                                          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                             Fecha publicación de pliegos definitivos SECOP
                                          </a>
                                          <p align="right"><button type='button' class='btn btn-link'  id="BTN_EDIT_FEC_PUB_PLI_DEF_SECOP"><span class='glyphicon glyphicon-pencil'></span></button></p>
                                        </h4>
                                      </div>
                                      <div id="collapseNine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNine">
                                        <div class="panel-body">

                                                <form id="FR_FEC_PUB_PLI_DEF_SECOP" name="FR_FEC_PUB_PLI_DEF_SECOP" class="form-horizontal"  action="#" method="POST">

                                                   <input type="hidden" name="HD_ID_SOLICITUD" id="HD_ID_SOLICITUD_9"  />
                                                   <input type="hidden" name="HD_VALIDACION" id="HD_VALIDACION_9" value="guardarFechaPublicacionPliegosDefinitivoSECOP"  />                                                  


                                                  <div class="form-group">
                                                      <label class="col-sm-2 control-label">Fecha publicación de pliegos definitivos SECOP: </label>
                                                      <div class="col-sm-10">
                                                          <input type="text" readonly name="DT_FECHA_PUB_PLIEGOS_DEF_SECOP" class="form-control" id="DT_FECHA_PUB_PLIEGOS_DEF_SECOP" placeholder="dd/mm/yyyy" required />
                                                      </div>
                                                  </div>   
                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Observación:</label>
                                                      <div class="col-sm-10">
                                                        <textarea class="form-control" rows="3" id="TA_OBSERVACION_9" name="TA_OBSERVACION_9" ></textarea>
                                                      </div>
                                                  </div>     
                                                  <br>
                                                  <p align="right">
                                                    <button type="submit" class="btn btn-primary" id="BT_FR_FEC_PUB_PLI_DEF_SECOP"> 
                                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Datos
                                                    </button>
                                                  </p>                                                                                                                                                                                                 
                                                </form>  

                                        </div>
                                      </div>
                                    </div>  



                                    <div class="panel panel-default" id="DIV_PANEL_10">
                                      <div class="panel-heading" role="tab" id="headingTen">
                                        <h4 class="panel-title">
                                          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                             Fecha cierre de procesos
                                          </a>
                                          <p align="right"><button type='button' class='btn btn-link'  id="BTN_EDIT_FEC_CIERRE_PRO"><span class='glyphicon glyphicon-pencil'></span></button></p>
                                        </h4>
                                      </div>
                                      <div id="collapseTen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTen">
                                        <div class="panel-body">

                                                <form id="FR_FEC_CIERRE_PRO" name="FR_FEC_CIERRE_PRO" class="form-horizontal"  action="#" method="POST">
                                                  
                                                   <input type="hidden" name="HD_ID_SOLICITUD" id="HD_ID_SOLICITUD_10"  />
                                                   <input type="hidden" name="HD_VALIDACION" id="HD_VALIDACION_10" value="guardarFechaCierreProcesos"  />                                                  

                                                  <div class="form-group">
                                                      <label class="col-sm-2 control-label">Fecha cierre de procesos: </label>
                                                      <div class="col-sm-10">
                                                          <input type="text" readonly name="DT_FECHA_CIERRE_PROCESOS" class="form-control" id="DT_FECHA_CIERRE_PROCESOS" placeholder="dd/mm/yyyy" required />
                                                      </div>
                                                  </div>      
                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Observación:</label>
                                                      <div class="col-sm-10">
                                                        <textarea class="form-control" rows="3" id="TA_OBSERVACION_10" name="TA_OBSERVACION_10" ></textarea>
                                                      </div>
                                                  </div>     
                                                  <br>
                                                  <p align="right">
                                                    <button type="submit" class="btn btn-primary" id="BT_FR_FEC_CIERRE_PRO"> 
                                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Datos
                                                    </button>
                                                  </p>                                                                                                                                                                                             
                                                </form>

                                        </div>
                                      </div>
                                    </div>                                  

                                    <div class="panel panel-default" id="DIV_PANEL_11">
                                      <div class="panel-heading" role="tab" id="headingSeventeen">
                                        <h4 class="panel-title">
                                          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeventeen" aria-expanded="false" aria-controls="collapseSeventeen">
                                             Publicación evaluación preliminar
                                          </a>
                                          <p align="right"><button type='button' class='btn btn-link'  id="BTN_EDIT_PUBLICACION_EVAL_PRELIMINAR"><span class='glyphicon glyphicon-pencil'></span></button></p>
                                        </h4>
                                      </div>
                                      <div id="collapseSeventeen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeventeen">
                                        <div class="panel-body">

                                                <form id="FR_PUBLICACION_EVAL_PRELIMINAR" name="FR_PUBLICACION_EVAL_PRELIMINAR" class="form-horizontal"  action="#" method="POST">

                                                   <input type="hidden" name="HD_ID_SOLICITUD" id="HD_ID_SOLICITUD_17"  />
                                                   <input type="hidden" name="HD_VALIDACION" id="HD_VALIDACION_17" value="guardarFechaPublicacionEvaluacionPreliminar"  />                                                  
                                                  
                                                  <div class="form-group">
                                                      <label class="col-sm-2 control-label">Fecha publicación evaluación preliminar: </label>
                                                      <div class="col-sm-10">
                                                          <input type="text" readonly name="DT_FECHA_PUB_EVAL_PRELIMINAR" class="form-control" id="DT_FECHA_PUB_EVAL_PRELIMINAR" placeholder="dd/mm/yyyy" required />
                                                      </div>
                                                  </div>
                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Observación:</label>
                                                      <div class="col-sm-10">
                                                        <textarea class="form-control" rows="3" id="TA_OBSERVACION_17" name="TA_OBSERVACION_17" ></textarea>
                                                      </div>
                                                  </div>     
                                                  <br>
                                                  <p align="right">
                                                    <button type="submit" class="btn btn-primary" id="BT_FR_PUBLICACION_EVAL_PRELIMINAR"> 
                                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Datos
                                                    </button>
                                                  </p>                                                                                                                                                                 
                                                </form>                                     

                                        </div>
                                      </div>                                      
                                    </div>  

                                    <div class="panel panel-default" id="DIV_PANEL_12">
                                      <div class="panel-heading" role="tab" id="headingEleven">
                                        <h4 class="panel-title">
                                          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                                             Comite de contratación - Presentación evaluación definitiva
                                          </a>
                                          <p align="right"><button type='button' class='btn btn-link'  id="BTN_EDIT_SESION_COMITE_APRO_2"><span class='glyphicon glyphicon-pencil'></span></button></p>
                                        </h4>
                                      </div>
                                      <div id="collapseEleven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEleven">
                                        <div class="panel-body">

                                                <form id="FR_SESION_COMITE_APRO_2" name="FR_SESION_COMITE_APRO_2" class="form-horizontal"  action="#" method="POST">

                                                   <input type="hidden" name="HD_ID_SOLICITUD" id="HD_ID_SOLICITUD_11"  />
                                                   <input type="hidden" name="HD_VALIDACION" id="HD_VALIDACION_11" value="guardarFechaSesionComiteAprobracion2"  />                                                  
                                                  
                                                  <div class="form-group">
                                                      <label class="col-sm-2 control-label">Comite de contratación - Presentación evaluación definitiva: </label>
                                                      <div class="col-sm-10">
                                                          <input type="text" readonly name="DT_FECHA_SESION_COMITE_APROBACION_2" class="form-control" id="DT_FECHA_SESION_COMITE_APROBACION_2" placeholder="dd/mm/yyyy" required />
                                                      </div>
                                                  </div>
                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Observación:</label>
                                                      <div class="col-sm-10">
                                                        <textarea class="form-control" rows="3" id="TA_OBSERVACION_11" name="TA_OBSERVACION_11" ></textarea>
                                                      </div>
                                                  </div>     
                                                  <br>
                                                  <p align="right">
                                                    <button type="submit" class="btn btn-primary" id="BT_FR_SESION_COMITE_APRO_2"> 
                                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Datos
                                                    </button>
                                                  </p>                                                                                                                                                                 
                                                </form>                                     

                                        </div>
                                      </div>
                                    </div>




                                    <div class="panel panel-default" id="DIV_PANEL_13">
                                      <div class="panel-heading" role="tab" id="headingTwelve">
                                        <h4 class="panel-title">
                                          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                                             Fecha publicación de la evaluación definitiva
                                          </a>
                                          <p align="right"><button type='button' class='btn btn-link'  id="BTN_EDIT_PUB_EVAL_DEFI"><span class='glyphicon glyphicon-pencil'></span></button></p>
                                        </h4>
                                      </div>
                                      <div id="collapseTwelve" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwelve">
                                        <div class="panel-body">

                                                <form id="FR_PUB_EVAL_DEFI" name="FR_PUB_EVAL_DEFI" class="form-horizontal"  action="#" method="POST">
                                                  
                                                   <input type="hidden" name="HD_ID_SOLICITUD" id="HD_ID_SOLICITUD_12"  />
                                                   <input type="hidden" name="HD_VALIDACION" id="HD_VALIDACION_12" value="guardarFechaPublicacionEvaluaiconDefinitiva"  />                                                  


                                                  <div class="form-group">
                                                      <label class="col-sm-2 control-label">Fecha publicación de la evaluación definitiva: </label>
                                                      <div class="col-sm-10">
                                                          <input type="text" readonly name="DT_FECHA_PUB_EVAL_DEFINITIVA" class="form-control" id="DT_FECHA_PUB_EVAL_DEFINITIVA" placeholder="dd/mm/yyyy" required />
                                                      </div>
                                                  </div>  
                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Observación:</label>
                                                      <div class="col-sm-10">
                                                        <textarea class="form-control" rows="3" id="TA_OBSERVACION_12" name="TA_OBSERVACION_12" ></textarea>
                                                      </div>
                                                  </div>     
                                                  <br>
                                                  <p align="right">
                                                    <button type="submit" class="btn btn-primary" id="BT_FR_PUB_EVAL_DEFI"> 
                                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Datos
                                                    </button>
                                                  </p>                                                                                                                                                                                                  
                                                </form>  


                                        </div>
                                      </div>
                                    </div>




                                    <div class="panel panel-default" id="DIV_PANEL_14">
                                      <div class="panel-heading" role="tab" id="headingThirteen">
                                        <h4 class="panel-title">
                                          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
                                             Fecha audiencia adjudicación
                                          </a>
                                          <p align="right"><button type='button' class='btn btn-link'  id="BTN_EDIT_FECHA_AUD_ADJ"><span class='glyphicon glyphicon-pencil'></span></button></p>
                                        </h4>
                                      </div>
                                      <div id="collapseThirteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThirteen">
                                        <div class="panel-body">

                                                <form id="FR_FECHA_AUD_ADJ" name="FR_FECHA_AUD_ADJ" class="form-horizontal"  action="#" method="POST">                                                  

                                                   <input type="hidden" name="HD_ID_SOLICITUD" id="HD_ID_SOLICITUD_13"  />
                                                   <input type="hidden" name="HD_VALIDACION" id="HD_VALIDACION_13" value="guardarFechaAudienciaAdjudicacion"  />                                                  


                                                  <div class="form-group">
                                                      <label class="col-sm-2 control-label">Fecha audiencia adjudicación: </label>
                                                      <div class="col-sm-10">
                                                          <input type="text" readonly name="DT_FECHA_AUD_ADJUDICACION" class="form-control" id="DT_FECHA_AUD_ADJUDICACION" placeholder="dd/mm/yyyy" required />
                                                      </div>
                                                  </div>   
                                                 <div class="form-group">
                                                    <label class="col-sm-2 control-label">Jornada: </label>
                                                    <div class="col-sm-10">
                                                          <select id="SL_Jornada_AUD_ADJUDICACION" name="SL_Jornada_AUD_ADJUDICACION" class="form-control" required>
                                                                <option value=""></option>
                                                                <option>Mañana</option>
                                                                <option>Tarde</option>
                                                          </select>                                                          
                                                    </div>
                                                </div>                                                                                                                                             
                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Observación:</label>
                                                      <div class="col-sm-10">
                                                        <textarea class="form-control" rows="3" id="TA_OBSERVACION_13" name="TA_OBSERVACION_13" ></textarea>
                                                      </div>
                                                  </div>     
                                                  <br>
                                                  <p align="right">
                                                    <button type="submit" class="btn btn-primary" id="BT_FR_FECHA_AUD_ADJ"> 
                                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Datos
                                                    </button>
                                                  </p>                                                                                                           

                                                </form>

                                        </div>
                                      </div>
                                    </div>



                                    <div class="panel panel-default" id="DIV_PANEL_15">
                                      <div class="panel-heading" role="tab" id="headingFourteen">
                                        <h4 class="panel-title">
                                          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFourteen" aria-expanded="false" aria-controls="collapseFourteen">
                                             Número y Fecha resolución adjudicación
                                          </a>
                                          <p align="right"><button type='button' class='btn btn-link'  id="BTN_EDIT_NUM_RESOL_AJD"><span class='glyphicon glyphicon-pencil'></span></button></p>
                                        </h4>
                                      </div>
                                      <div id="collapseFourteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFourteen">
                                        <div class="panel-body">
                                                  
                                                <form id="FR_NUM_FEC_RESOL_ADJ" name="FR_NUM_FEC_RESOL_ADJ" class="form-horizontal"  action="#" method="POST">                                                   

                                                   <input type="hidden" name="HD_ID_SOLICITUD" id="HD_ID_SOLICITUD_14"  />
                                                   <input type="hidden" name="HD_VALIDACION" id="HD_VALIDACION_14" value="guardarFechaNumeroResolucionAdjudicacion"  />                                                  


                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Número resolución adjudicación:</label>
                                                      <div class="col-sm-10">
                                                        <input type="number" name="TX_NUMERO_RESOLUCION_ADJUDICACION" class="form-control" id="TX_NUMERO_RESOLUCION_ADJUDICACION" placeholder="#" required />                                           
                                                      </div>
                                                  </div>                                       
                                                  <div class="form-group">
                                                      <label class="col-sm-2 control-label">Fecha resolución adjudicación: </label>
                                                      <div class="col-sm-10">
                                                          <input type="text" readonly name="DT_FECHA_RESOLUCION_ADJUDICACION" class="form-control" id="DT_FECHA_RESOLUCION_ADJUDICACION" placeholder="dd/mm/yyyy" required />
                                                      </div>
                                                  </div>   
                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Observación:</label>
                                                      <div class="col-sm-10">
                                                        <textarea class="form-control" rows="3" id="TA_OBSERVACION_14" name="TA_OBSERVACION_14" ></textarea>
                                                      </div>
                                                  </div>     
                                                  <br>
                                                  <p align="right">
                                                    <button type="submit" class="btn btn-primary" id="BT_FR_NUM_FEC_RESOL_ADJ"> 
                                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Datos
                                                    </button>
                                                  </p>                                                                                                                                                             
                                                </form>                                      

                                        </div>
                                      </div>
                                    </div>   



                                    <div class="panel panel-default" id="DIV_PANEL_16">
                                      <div class="panel-heading" role="tab" id="headingFifteen">
                                        <h4 class="panel-title">
                                          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFifteen" aria-expanded="false" aria-controls="collapseFifteen">
                                             Fecha elaboración de contrato, número de suscripción, nombre del contratista, valor, plazo de ejecución, supervisor.
                                          </a>
                                          <p align="right"><button type='button' class='btn btn-link'  id="BTN_EDIT_FECHA_ELA_CNNVS"><span class='glyphicon glyphicon-pencil'></span></button></p>
                                        </h4>
                                      </div>
                                      <div id="collapseFifteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFifteen">
                                        <div class="panel-body">
                                                  
                                                <form id="FR_FECHA_ELA_CNNVS" name="FR_FECHA_ELA_CNNVS" class="form-horizontal"  action="#" method="POST">                                                  
                                                  
                                                   <input type="hidden" name="HD_ID_SOLICITUD" id="HD_ID_SOLICITUD_15"  />
                                                   <input type="hidden" name="HD_VALIDACION" id="HD_VALIDACION_15" value="guardarElaboracionContrato"  />                                                  


                                                  <div class="form-group">
                                                      <label class="col-sm-2 control-label">Fecha elaboración de contrato: </label>
                                                      <div class="col-sm-10">
                                                          <input type="text" readonly name="DT_FECHA_ELABORACION_CONTRATO" class="form-control" id="DT_FECHA_ELABORACION_CONTRATO" placeholder="dd/mm/yyyy" required />
                                                      </div>
                                                  </div>                                       
                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Número de contrato:</label>
                                                      <div class="col-sm-10">
                                                        <input type="number" name="TX_NUMERO_SUSCRIPCION" class="form-control" id="TX_NUMERO_SUSCRIPCION" placeholder="#" required />                                           
                                                      </div>
                                                  </div>                                       
                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Nombre del contratista:</label>
                                                      <div class="col-sm-10">
                                                        <input type="text" name="TX_NOMBRE_CONTRATISTA" class="form-control" id="TX_NOMBRE_CONTRATISTA" placeholder="" required />                                           
                                                      </div>
                                                  </div>                                       
                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Valor del Contrato:</label>
                                                      <div class="col-sm-10">
                                                        <input type="number" name="TX_VALOR_CONTRATO" class="form-control" id="TX_VALOR_CONTRATO" placeholder="#" required />                                           
                                                      </div>
                                                  </div>                                       
                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Plazo de ejecución:</label>
                                                      <div class="col-sm-10">
                                                        <input type="text" name="TX_PLAZO_EJECUCION" class="form-control" id="TX_PLAZO_EJECUCION" placeholder="" required />                                           
                                                      </div>
                                                  </div>                                       
                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Supervisor:</label>
                                                      <div class="col-sm-10">
                                                        <input type="text" name="TX_SUPERVISOR" class="form-control" id="TX_SUPERVISOR" placeholder="" required />                                           
                                                      </div>
                                                  </div>   
                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Observación:</label>
                                                      <div class="col-sm-10">
                                                        <textarea class="form-control" rows="3" id="TA_OBSERVACION_15" name="TA_OBSERVACION_15" ></textarea>
                                                      </div>
                                                  </div>     
                                                  <br>
                                                  <p align="right">
                                                    <button type="submit" class="btn btn-primary" id="BT_FR_FECHA_ELA_CNNVS"> 
                                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Datos
                                                    </button>
                                                  </p>                                                                                                                                                             
                                                 </form>                                     

                                        </div>
                                      </div>
                                    </div>    

                                    <div class="panel panel-default" id="DIV_PANEL_17">
                                      <div class="panel-heading" role="tab" id="headingEigthteen">
                                        <h4 class="panel-title">
                                          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEigthteen" aria-expanded="false" aria-controls="collapseEigthteen">
                                             Fecha Entrega de Concepto
                                          </a>
                                          <p align="right"><button type='button' class='btn btn-link'  id="BTN_EDIT_FECHA_ENTREGA_CONCEPTO"><span class='glyphicon glyphicon-pencil'></span></button></p>
                                        </h4>
                                      </div>
                                      <div id="collapseEigthteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEigthteen">
                                        <div class="panel-body">

                                                <form id="FR_FECHA_ENTREGA_CONCEPTO" name="FR_FECHA_ENTREGA_CONCEPTO" class="form-horizontal"  action="#" method="POST">

                                                   <input type="hidden" name="HD_ID_SOLICITUD" id="HD_ID_SOLICITUD_18"  />
                                                   <input type="hidden" name="HD_VALIDACION" id="HD_VALIDACION_18" value="guardarFechaEntregaConcepto"  />                                                  
                                                  
                                                  <div class="form-group">
                                                      <label class="col-sm-2 control-label">Fecha Entrega de Concepto: </label>
                                                      <div class="col-sm-10">
                                                          <input type="text" readonly name="DT_FECHA_ENTREGA_CONCEPTO" class="form-control" id="DT_FECHA_ENTREGA_CONCEPTO" placeholder="dd/mm/yyyy" required />
                                                      </div>
                                                  </div>
                                                   <div class="form-group">
                                                      <label class="col-sm-2 control-label">Observación:</label>
                                                      <div class="col-sm-10">
                                                        <textarea class="form-control" rows="3" id="TA_OBSERVACION_18" name="TA_OBSERVACION_18" ></textarea>
                                                      </div>
                                                  </div>     
                                                  <br>
                                                  <p align="right">
                                                    <button type="submit" class="btn btn-primary" id="BT_FR_FECHA_ENTREGA_CONCEPTO"> 
                                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Datos
                                                    </button>
                                                  </p>                                                                                                                                                                 
                                                </form>                                     

                                        </div>
                                      </div>                                      
                                    </div>  


                                  <br>
                                  <p align="right">
                                      <button type="button" class="btn btn-primary" id="BTN_TERMINARCION_PROCESO"> 
                                          <span class="glyphicon glyphicon-off" aria-hidden="true"></span> Terminar Proceso
                                      </button>
                                  </p>

                      </div>                                          
                </div>
          </div>
      </div>        
      <!-- FIN Contenedor panel principal -->

      <footer class="footer">          
          <div class="container">
              <p>&copy; IDRD 2017</p>                
          </div>
      </footer> 


    <div class="modal fade" id="MODAL_CHECKLIST">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                  <button type="button" class="close"  id="BTN_CERRAR_VENTANA_CHECKLIST" aria-hidden="true">&times;</button>
                  <div id="DV_CARGA_2"></div>                    
                  Item's CheckList...
            </div>
           
            <div class="modal-body">                
                  <form id="FR_CHECK_LIST" name="FR_CHECK_LIST">
                      <div id="DIV_ITEMS_CHECK_LIST"></div>
                  </form>
            </div>

            <div class="modal-footer">

                  <p align="right">
                    <button type="submit" class="btn btn-primary" id="BTN_CHECK_LIST"> 
                        <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> Generar CheckList
                    </button>
                  </p>

            </div>          
         </div> 
      </div>
    </div>    

    <div class="modal fade" id="MODAL_NOTIFICACION">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                  <button type="button" class="close"  id="BTN_CERRAR_MODAL_NOTIFICACON" aria-hidden="true">&times;</button>
                  Información...
            </div>
           
            <div class="modal-body">                
                  
                  <div id="DV_PROC_TERM">
                    <strong>Proceso terminado correctamente.</strong>
                    <input type="hidden" name="HD_ID_PROCESO" id="HD_ID_PROCESO"  />
                  </div>                    

                  <div id="DV_PROC_TERM_ANTIC">
                      <form id="FR_TERMINARCION_PROCESO" name="FR_TERMINARCION_PROCESO" class="form-horizontal"  action="#" method="POST">                                                  
                                              
                           <input type="hidden" name="HD_ID_SOLICITUD" id="HD_ID_SOLICITUD_16"  />
                           <input type="hidden" name="HD_VALIDACION" id="HD_VALIDACION_16" value="finalizarProceso"  />                                                  

                        
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Terminación de proceso.</label>
                              <div class="col-sm-10">
                                
                              </div>
                          </div>     

                           <div class="form-group">
                              <label class="col-sm-2 control-label">Motivo:</label>
                              <div class="col-sm-10">
                                <textarea class="form-control" rows="3" id="TA_OBSERVACION_FINAL" name="TA_OBSERVACION_FINAL" required></textarea>
                              </div>
                          </div>     

                          <br>
                          <p align="right">
                            <button type="submit" class="btn btn-primary" id="BT_FR_TERMINARCION_PROCESO"> 
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span> Finalizar
                            </button>
                          </p> 

                      </form>                                     
                  </div>                    


            </div>

            <div class="modal-footer">
            </div>          
         </div> 
      </div>
    </div>       


   
  </body>

  <script src="../../../Plantilla_Base/Presentacion/Js/jquery-1.10.2.min.js"></script>
  <script src="../../../Plantilla_Base/Presentacion/Js/bootstrap.min.js"></script>
  <script src="Js/bootstrap-datepicker.js"></script>
  <script src="Js/bootstrap-datetimepicker.js"></script>
  <script src="Js/bootstrap-datetimepicker.es.js"></script>
  <script src="Js/VerProceso.js"></script>

  <script>
    validarInicioProcesoItems();
  </script>    

</html>
