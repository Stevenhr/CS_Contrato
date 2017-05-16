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

      <title>MÓDULO CONTROL Y SEGUIMIENTO DE CONTRATOS.</title>
  </head>

  <style type="text/css">
    div.scroll
    {        
        height: 462px;        
        overflow-y: scroll;
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
          <div class="panel panel-default">
                <div class="panel-body">

                  <br><div id="DV_CARGA"></div>

                  
                  <div role="tabpanel">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#TAB_MODALIDAD" aria-controls="TAB_MODALIDAD" role="tab" data-toggle="tab">Modalidad de Trámite</a></li>
                            <!--<li role="presentation"><a href="#TAB_SUBDIRECCION_SOL" aria-controls="TAB_SUBDIRECCION_SOL" role="tab" data-toggle="tab">Subdirección Solicitante</a></li>-->
                            <li role="presentation"><a href="#TAB_ACTUACION" aria-controls="TAB_ACTUACION" role="tab" data-toggle="tab">Actuación</a></li>
                            <li role="presentation"><a href="#TAB_MOTIVO" aria-controls="TAB_MOTIVO" role="tab" data-toggle="tab">Motivo</a></li>
                            <li role="presentation"><a href="#TAB_DOCUMENTO" aria-controls="TAB_DOCUMENTO" role="tab" data-toggle="tab">Documento</a></li>
                            <li role="presentation"><a href="#TAB_VARIABLE_SOPORTE" aria-controls="TAB_VARIABLE_SOPORTE" role="tab" data-toggle="tab">Variables de Soporte</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="TAB_MODALIDAD">
                                  
                                  <div id="TAB_MODALIDAD_2" class="scroll"></div>
                                  <br><br>
                                  <?php 
                                    if($_SESSION['Crear Opciones De Proceso'] == 1)
                                    {
                                  ?>
                                  <p align="right">
                                    <button type="button" class="btn btn-primary" id="BTN_MODALIDAD_TRAMITE">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Modalidad
                                    </button>
                                  </p>
                                  <?php
                                     }
                                     else
                                     {
                                  ?>
                                  <p align="right">
                                    <button type="button" class="btn btn-primary"  disabled="disabled">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Modalidad
                                    </button>
                                  </p>
                                  <?php
                                      }
                                  ?>

                            </div>

                            <!--<div role="tabpanel" class="tab-pane" id="TAB_SUBDIRECCION_SOL">
                                  
                                  <div id="TAB_SUBDIRECCION_SOL_2" class="scroll"></div>
                                  <br><br>
                                  <?php 
                                    if($_SESSION['Crear Opciones De Proceso'] == 1)
                                    {
                                  ?>
                                  <p align="right">
                                    <button type="button" class="btn btn-primary" id="BTN_SUBDIRECCION">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Subdirección
                                    </button>
                                  </p>
                                  <?php
                                     }
                                     else
                                     {
                                  ?>
                                  <p align="right">
                                    <button type="button" class="btn btn-primary"  disabled="disabled">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Subdirección
                                    </button>
                                  </p>
                                  <?php
                                      }
                                  ?>

                            </div> -->

                            <div role="tabpanel" class="tab-pane" id="TAB_ACTUACION">
                                 
                                  <div id="TAB_ACTUACION_2" class="scroll"></div>
                                  <br><br>
                                  <?php 
                                    if($_SESSION['Crear Opciones De Proceso'] == 1)
                                    {
                                  ?>
                                  <p align="right">
                                    <button type="button" class="btn btn-primary" id="BTN_ACTUACION">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Actuación
                                    </button>
                                  </p>
                                  <?php
                                     }
                                     else
                                     {
                                  ?>
                                  <p align="right">
                                    <button type="button" class="btn btn-primary"  disabled="disabled">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Actuación
                                    </button>
                                  </p>
                                  <?php
                                      }
                                  ?>

                            </div>

                            <div role="tabpanel" class="tab-pane" id="TAB_MOTIVO">

                                  <div id="TAB_MOTIVO_2" class="scroll"></div>
                                  <br><br>
                                  <?php 
                                    if($_SESSION['Crear Opciones De Proceso'] == 1)
                                    {
                                  ?>
                                  <p align="right">
                                    <button type="button" class="btn btn-primary" id="BTN_MOTIVO">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Motivo
                                    </button>
                                  </p>
                                  <?php
                                     }
                                     else
                                     {
                                  ?>
                                  <p align="right">
                                    <button type="button" class="btn btn-primary"  disabled="disabled">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Motivo
                                    </button>
                                  </p>
                                  <?php
                                      }
                                  ?>


                            </div>

                            <div role="tabpanel" class="tab-pane" id="TAB_DOCUMENTO">

                                  <div id="TAB_DOCUMENTO_2" class="scroll"></div>
                                  <br><br>
                                  <?php 
                                    if($_SESSION['Crear Opciones De Proceso'] == 1)
                                    {
                                  ?>
                                  <p align="right">
                                    <button type="button" class="btn btn-primary" id="BTN_DOCUMENTO">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Documento
                                    </button>
                                  </p>
                                  <?php
                                     }
                                     else
                                     {
                                  ?>
                                  <p align="right">
                                    <button type="button" class="btn btn-primary"  disabled="disabled">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Documento
                                    </button>
                                  </p>
                                  <?php
                                      }
                                  ?>


                            </div>

                            <div role="tabpanel" class="tab-pane" id="TAB_VARIABLE_SOPORTE">

                                  <div id="TAB_VARIABLE_SOPORTE_2" class="scroll"></div>
                                  <br><br>                                  
                            </div>



                        </div>
                      </div>

                  
                </div>
          </div>
      </div>        
      <!-- FIN Contenedor panel principal -->

      <footer class="footer">          
          <div class="container">
              <p>&copy; IDRD 2015</p>                
          </div>
      </footer>          
   
  </body>


    <div class="modal fade" id="MODAL_NUEVO_ITEM_PROCESO">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <form id="FR_NUEVO_ITEM_PROCESO" name="FR_NUEVO_ITEM_PROCESO" class="form-horizontal"  action="#" method="POST">
           
           <input type="hidden" name="HD_VALIDACION" id="HD_VALIDACION"  />           
           <input type="hidden" name="HD_MODALIDAD_TRAMITE" id="HD_MODALIDAD_TRAMITE"  />           
           
        <div class="modal-header">
       
          <button type="button" class="close"  id="BTN_CERRAR_VENTANA" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="LB_ITEM_PROCESO"></h4>
          <br><div id="DV_CARGA_2"></div>
       
        </div>
       
        <div class="modal-body">                

           <div class="form-group">
              <label class="col-sm-2 control-label" id="LB_ITEM_PROCESO_2"></label>
              <div class="col-sm-10">
                  <input type="text" name="TX_ITEM_PROCESO" class="form-control" id="TX_ITEM_PROCESO"  maxlength="50" required />
              </div>
          </div>                           

           <div class="form-group" id="DV_ACTUACION_OPC">
              <label class="col-sm-2 control-label">Acción</label>
              <div class="col-sm-10">
                  <select id="SL_ACTUACION_ACCION_FORM" name="SL_ACTUACION_ACCION_FORM" class="form-control" required>
                      <option></option>
                      <option value="1">Continuar</option>                      
                      <option value="0">Detener</option>
                  </select>
              </div>
          </div>                           

           <div class="form-group" id="DV_PANEL_NAVEGACION">
              <label class="col-sm-2 control-label">Módulos:</label>
              <div class="col-sm-10">
                    <div id="DV_ITEM_PANEL_NAVEGACION">

                    </div>
              </div>
          </div>                           


          
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" >Guardar</button>
          </form>
          <br><br>
          <h6>Presione en el botón guardar o cierre esta ventana emergente para cancelar.</h6>        
        </div>     
      </div>
    </div>
  </div>




  <script src="../../../Plantilla_Base/Presentacion/Js/jquery-1.10.2.min.js"></script>
  <script src="../../../Plantilla_Base/Presentacion/Js/bootstrap.min.js"></script>
  <script src="Js/bootstrap-datepicker.js"></script>
  <script src="Js/ItemProceso.js"></script>

  <script>
        cargarModalidad();
        //cargarSubdireccion();
        cargarActuacion();
        cargarMotivo();
        cargarDocumento();
        cargarPanelNavegacion();
        cargarVariableSoporte();
  </script>

</html>
