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
                                                          
                    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active" ><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Asignar Abogado</a></li>
                        <li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">Reasignar  Abogado</a></li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledBy="home-tab">

                               <div class="form-group">
                                  <label class="col-sm-1 control-label" >Fecha Inicio:</label>
                                  <div class="col-sm-4">
                                      <input type="text" readonly name="TX_FECHA_INICIO" class="form-control" id="TX_FECHA_INICIO" placeholder="Fecha Inicio" required />
                                  </div>
                                  <label class="col-sm-1 control-label" >Fecha Final:</label>
                                  <div class="col-sm-4">
                                      <input type="text" readonly name="TX_FECHA_FINAL" class="form-control" id="TX_FECHA_FINAL" placeholder="Fecha Final" required />
                                  </div>                      
                                  <div class="col-sm-2">                                
                                            <?php
                                            if($_SESSION['Asignar Contrato'])
                                            {
                                            ?> 
                                              <button type="button" class="btn btn-primary" id="BTN_BUSCAR_CONTRATOS">
                                                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Buscar
                                              </button>
                                            <?php                                  
                                            }
                                            else
                                            {
                                            ?>
                                              <button type="button" class="btn btn-primary disabled">
                                                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Buscar
                                              </button>       
                                            <?php                                                                                                         
                                            }
                                            ?>
                                  </div>                                              
                              </div>                     

                              <br><br>
                              <div id="DV_SOLICITUD_CONTRATOS"></div> 

                          
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledBy="profile-tab">

                               <div class="form-group">
                                  <label class="col-sm-1 control-label" >Fecha Inicio:</label>
                                  <div class="col-sm-4">
                                      <input type="text" readonly name="TX_FECHA_INICIO_2" class="form-control" id="TX_FECHA_INICIO_2" placeholder="Fecha Inicio" required />
                                  </div>
                                  <label class="col-sm-1 control-label" >Fecha Final:</label>
                                  <div class="col-sm-4">
                                      <input type="text" readonly name="TX_FECHA_FINAL_2" class="form-control" id="TX_FECHA_FINAL_2" placeholder="Fecha Final" required />
                                  </div>                      
                                  <div class="col-sm-2">                                
                                            <?php
                                            if($_SESSION['Modificar Asignación Contrato'])
                                            {
                                            ?> 
                                              <button type="button" class="btn btn-primary" id="BTN_BUSCAR_CONTRATOS_2">
                                                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Buscar
                                              </button>
                                            <?php                                  
                                            }
                                            else
                                            {
                                            ?>
                                              <button type="button" class="btn btn-primary disabled">
                                                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Buscar
                                              </button>       
                                            <?php                                                                                                         
                                            }
                                            ?>
                                  </div>                                              
                              </div>                     

                              <br><br>
                              <div id="DV_SOLICITUD_CONTRATOS_2"></div> 



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


    <div class="modal fade" id="MODAL_INFORMACION">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                  <button type="button" class="close"  id="BTN_CERRAR_VENTANA_INFORMACION" aria-hidden="true">&times;</button>
                  Información...
            </div>
           
            <div class="modal-body">                
                  <br><div id="DIV_INFORMACION"></div>
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
  <script src="Js/AsignacionContrato.js"></script>

</html>
