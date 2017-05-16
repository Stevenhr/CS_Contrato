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

                    <div id="DV_CARGA"></div>        



                      <form id="FR_VER_CALENDARIO" name="FR_VER_CALENDARIO" class="form-horizontal"  action="#" method="POST">  

                          <div class="form-group">

                            <label class="col-sm-1 control-label" >Mes:</label>

                            <div class="col-sm-4">

                                  <select id="SL_MES" name="SL_MES" class="form-control" required>

                                      <option value="0"></option>  

                                      <option value="1">Enero</option>  

                                      <option value="2">Febrero</option>  

                                      <option value="3">Marzo</option>  

                                      <option value="4">Abril</option>  

                                      <option value="5">Mayo</option>  

                                      <option value="6">Junio</option>  

                                      <option value="7">Julio</option>  

                                      <option value="8">Agosto</option>  

                                      <option value="9">Septiembre</option>  

                                      <option value="10">Octubre</option>  

                                      <option value="11">Noviembre</option>  

                                      <option value="12">Diciembre</option>  

                                </select>

                            </div>

                            <label class="col-sm-1 control-label" >Año:</label>

                            <div class="col-sm-4">

                                  <select id="SL_ANIO" name="SL_ANIO" class="form-control" required>

                                      <option value="0"></option>  

                                      <option>2015</option>  

                                      <option>2016</option>  

                                      <option>2017</option>  

                                      <option>2018</option>  

                                </select>                                

                            </div>                      

                            <div class="col-sm-2">                                                                    

                                  <button type="button" class="btn btn-primary" id="BTN_VER_CALENDARIO">

                                      <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Ver

                                  </button>                                    

                            </div>                                              

                          </div>                     

                       </form> 



                    <div id="DV_CONTENIDO"></div>      



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



  <script src="../../../Plantilla_Base/Presentacion/Js/jquery-1.10.2.min.js"></script>

  <script src="../../../Plantilla_Base/Presentacion/Js/bootstrap.min.js"></script>

  <script src="Js/jquery.form.js"></script>  

  <script src="Js/bootstrap-datepicker.js"></script>  

  <script src="Js/VerCalendario.js"></script>



  <script>

       //  Cargar_Calendario();

  </script>





</html>

