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
                                                                                
                        <div id="DV_ACTIVACION_CONTRATOS"></div>                    
                  
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
                  <div id="DIV_INFORMACION"></div>
            </div>

            <div class="modal-footer">

            </div>          
         </div> 
      </div>
    </div>    

    <div class="modal fade" id="MODAL_CONFIRMACION">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                  <button type="button" class="close"  id="BTN_CERRAR_MODAL_CONFIRMACION" aria-hidden="true">&times;</button>
                  Información...
            </div>
           
            <div class="modal-body">                
                  <strong>Esta seguro de iniciar el proceso ?</strong>
                  <input type="hidden" name="HD_ID_PROCESO" id="HD_ID_PROCESO"  />
            </div>

            <div class="modal-footer">
                          <button type="button" class="btn btn-default" id="BTN_CANCELAR_PROCESO" data-dismiss="modal">Cancelar</button>
                          <button type="button" class="btn btn-primary" id="BTN_ACTIVAR_PROCESO">Aceptar</button>
            </div>          
         </div> 
      </div>
    </div>       


   
  </body>

  <script src="../../../Plantilla_Base/Presentacion/Js/jquery-1.10.2.min.js"></script>
  <script src="../../../Plantilla_Base/Presentacion/Js/bootstrap.min.js"></script>
  <script src="Js/bootstrap-datepicker.js"></script>
  <script src="Js/IniciarProceso.js"></script>

  <script>
      cargarContratosAsignadosInactivos();
  </script>
</html>
