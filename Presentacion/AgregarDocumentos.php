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

                    <img src="../../../Plantilla_Base/Presentacion/Img/IDRD.JPG" width="50%" heigth="50%"/>

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

                    <div id="DV_CONTENIDO" class="scroll"></div>     



                    <p align="right">

                      <button type="button" class="btn btn-primary" id="BTN_AGREGAR_LISTA_DOCUMENTO">

                          <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Nuevo Documento

                      </button>

                    </p>



                    

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





  <div class="modal fade" id="MODAL_NUEVO_LISTA_DOCUMENTO">

    <div class="modal-dialog modal-lg">

      <div class="modal-content">

      

        <form id="FR_NUEVO_LISTA_DOCUMENTO" name="FR_NUEVO_LISTA_DOCUMENTO" class="form-horizontal"  action="../Logica/AgregarDocumentos.php" method="POST">

           

           <input type="hidden" name="HD_VALIDACION" id="HD_VALIDACION" value="guardarListadoDocumento"/>           

           <input type="hidden" name="HD_ID_LISTA_DOCUMENTO" id="HD_ID_LISTA_DOCUMENTO" value="#"/>           

           

        <div class="modal-header">

       

          <button type="button" class="close"  id="BTN_CERRAR_VENTANA" aria-hidden="true">&times;</button>

          <h4 class="modal-title" id="MT_Titulo">Nuevo Documento</h4>

          <br><div id="DV_CARGA_2"></div>

       

        </div>

       

        <div class="modal-body">                

 

           <div class="form-group">

              <label class="col-sm-2 control-label">Nombre Lista Documento: </label>

              <div class="col-sm-4">

                  <input type="text" name="TX_NOMBRE_LISTA_DOCUMENTO" class="form-control" id="TX_NOMBRE_LISTA_DOCUMENTO" placeholder="Nombre Lista Documento" maxlength="100" required/>

              </div>

              <label class="col-sm-2 control-label">Archivo: </label>

              <div class="col-sm-4" >

                  <input type="file" name="TX_ARCHIVO" class="form-control" id="TX_ARCHIVO" required/>

              </div> 

          </div>       

                   

        </div>

        <div class="modal-footer">

          <button type="submit" class="btn btn-primary">Guardar</button>

          </form>

          <br><br>

          <h6>Presione en el botón guardar o cierre esta ventana emergente para cancelar.</h6>        

        </div>     

      </div>

    </div>

  </div>



  <script src="../../../Plantilla_Base/Presentacion/Js/jquery-1.10.2.min.js"></script>

  <script src="../../../Plantilla_Base/Presentacion/Js/bootstrap.min.js"></script>

  <script src="Js/jquery.form.js"></script>  

  <script src="Js/bootstrap-datepicker.js"></script>  

  <script src="Js/AgregarDocumentos.js"></script>



  <script>

         Cargar_Documentos();

  </script>





</html>

