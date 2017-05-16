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

          <div class="panel panel-default">

                <div class="panel-body">

                                                                                                        

                       <h3><ins><strong>SELECCIONAR BÚSQUEDA.</strong></ins></h3><br><br>

                       <div id="DV_CARGA"></div>                        



                       <form id="FR_BUSQUEDA_ABOGADO_PER" name="FR_BUSQUEDA_ABOGADO_PER" class="form-horizontal"  action="#" method="POST">

                           <input type="HIDDEN" name="HD_VALIDACION" value="busquedaAbogado">

                           <div class="form-group">

                              <label class="col-sm-2 control-label">Búsqueda por fecha:</label>

                              <div class="col-sm-4">

                                  <input type="text" readonly name="TX_FECHA_INICIO" class="form-control" id="TX_FECHA_INICIO" placeholder="Fecha Inicio" required />

                              </div>                              

                              <div class="col-sm-4">

                                  <input type="text" readonly name="TX_FECHA_FINAL" class="form-control" id="TX_FECHA_FINAL" placeholder="Fecha Final" required />

                              </div>                                                    

                              <div class="col-sm-2">

                                  <button type="submit" class="btn btn-primary"> 

                                      <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Generar Búsqueda

                                  </button>

                              </div>

                          </div>                     

                      </form>                                              



                      <div id="DV_INFORMACION_BUSQUEDA_CONTRATOS"></div>

                      <div id="DV_INFORMACION_BUSQUEDA"></div>



                </div>

          </div>

      </div>        

      <!-- FIN Contenedor panel principal -->



      <footer class="footer">          

          <div class="container">

              <p>&copy; IDRD 2017</p>                

          </div>

      </footer> 

   

  </body>



  <script src="../../../Plantilla_Base/Presentacion/Js/jquery-1.10.2.min.js"></script>

  <script src="../../../Plantilla_Base/Presentacion/Js/bootstrap.min.js"></script>

  <script src="Js/bootstrap-datepicker.js"></script>

  <script src="Js/MisProcesos.js"></script>  



</html>

