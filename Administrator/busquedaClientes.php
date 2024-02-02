<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <!--/Inicio Alertas-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link href="https://modasof.com/espejo/assets/css/sweetalert.css" rel="stylesheet">
    <!-- Custom functions file -->
    <script src="https://modasof.com/espejo/assets/js/functions.js"></script>
    <!-- Sweet Alert Script -->
    <script src="https://modasof.com/espejo/assets/js/sweetalert.min.js"></script>
    <!--/Fin Alertas-->
 
</head>
<body>

<?php 

$Phone=$_GET['Phone'];

if ($Phone==1) {
  // Búsqueda por número de celular
  $BusquedaCel=strtoupper($_POST['palabraphone']); //se recibe la cadena que queremos buscar
if ($BusquedaCel!="") {
      $sql ="SELECT Id_Cliente, Documento_Cliente,Avatar_Cliente, Nom_Cliente, Ape_Cliente, Ciudad_Id_Ciudad, Correo_Cliente, Tel_Cliente, Cel1_Cliente, Cel2_Cliente, Tipo_Cliente,Largo_Manga, Largo_Camisa, Espalda, Pecho, Abdomen, Contorno_Cuello, Cintura, Cadera, Tiro, Pierna, Rodilla, Pantorrilla, Bota, Largo_Pantalon from t_clientes  WHERE  Cel1_Cliente='".$BusquedaCel."'|| Cel2_Cliente='".$BusquedaCel."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Id_Cliente=$row['Id_Cliente'];
        $Documento_Cliente=$row['Documento_Cliente'];
        $Avatar_Cliente=$row['Avatar_Cliente'];
         $Nom_Cliente=$row['Nom_Cliente'];
        $Ape_Cliente=$row['Ape_Cliente'];
        $Correo_Cliente=$row['Correo_Cliente'];
        $Cel1_Cliente=$row['Cel1_Cliente'];
        $Cel2_Cliente=$row['Cel2_Cliente'];

         $Largo_Manga=$row['Largo_Manga'];
          $Largo_Camisa=$row['Largo_Camisa'];
           $Espalda=$row['Espalda'];
            $Pecho=$row['Pecho'];
             $Abdomen=$row['Abdomen'];
              $Contorno_Cuello=$row['Contorno_Cuello'];
               $Cintura=$row['Cintura'];
                $Cadera=$row['Cadera'];
                 $Tiro=$row['Tiro'];
                  $Pierna=$row['Pierna'];
                   $Rodilla=$row['Rodilla'];
                    $Pantorrilla=$row['Pantorrilla'];
                     $Bota=$row['Bota'];
                      $Largo_Pantalon=$row['Largo_Pantalon'];
                      ?>
                         <!-- Column -->
       <form action="Cliente-Pedido.php" method="post" id="FormNuevoPedido">
       
                    <div class="col-lg-12 col-xlg-3 col-md-5">
                      <input style="display: none;" type="text"  name="TxtClienteSel" value="<?php Echo($Id_Cliente)?>" >
                        <div class="card">
                          <div class="card-body">
                                <center class="m-t-30"> <img src="<?php Echo($Avatar_Cliente); ?>" class="img-circle" width="120" />
                                    <h4 class="card-title m-t-10"><?php Echo utf8_encode($Nom_Cliente." ".$Ape_Cliente)  ?></h4>
                                    <div class="checkbox">
                          <label>
                            <input name="ConfirmarCliente" value="1" required="true" class="ace ace-checkbox-2" type="checkbox" />
                            <?php 

$sql ="SELECT Cons_PedidosCl FROM t_config WHERE Desarrollador='TEKSYSTEM S.A.S'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Cons_PedidosCl=$row['Cons_PedidosCl']+1;
 }
}
                             ?>
                            <span class="lbl"> <strong>Confirmar Cliente</strong></span>
                            <input style="display: none;" type="text" name="TxtConsPedido" value="<?php Echo($Cons_PedidosCl);?>">
                          </label>
                        </div>
                        <button type="submit" class="btn btn-sm btn-danger">
                          <i class="ace-icon fa fa-save"></i>
                         Realizar Pago
                        </button>

                                   
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body">
                              <div class="col-xs-6 col-lg-3">
                                 <label><strong>E-mail: </strong></label>
                              </div>
                              <div class="col-lg-9 col-xs-6">
                              <input type="text" required="true"  name="TxtCorreoUp" class="input-xlarge" value="<?php Echo($Correo_Cliente) ?>">
                              </div>
                             <hr>
                              <div class="col-xs-6 col-lg-3">
                                 <label><strong>Celular: </strong></label>
                              </div>
                             <div class="col-lg-6 col-xs-6">
                               <input type="text" required="true" name="TxtCelularUp" class="form-control input-mask-phone" value="<?php Echo($Cel1_Cliente) ?>">
                             </div>
                              
                             
                            </div>
                        </div>
                    </div>
                    <hr>
                   <div class="col-lg-12 col-xlg-3 col-md-5" style="border: dotted 1px black;padding: 8px;">
                      
                      <div class="col-lg-6 col-xlg-3 col-md-5" >
                         <center class="m-t-30"> <img src="../Administrator/images/Rotate/Superior.jpg" class="img-circle" width="50" />
                                    <h4 class="card-title m-t-10">Outfit Superior</h4>
                        <table>
                          <tr>
                            <td style="width: 50%">Largo Manga</td>
    <td><input type="number" class="col-xs-6" name="TxtLargoManga" step="any" value="<?php Echo($Largo_Manga)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Largo Camisa</td>
    <td><input type="number" class="col-xs-6" name="TxtLargoCamisa" step="any" value="<?php Echo($Largo_Camisa)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Espalda</td>
    <td><input type="number" class="col-xs-6" name="TxtEspalda" step="any" value="<?php Echo($Espalda)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Pecho</td>
    <td><input type="number" class="col-xs-6" name="TxtPecho" step="any" value="<?php Echo($Pecho)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Abdomen</td>
    <td><input type="number" class="col-xs-6" name="TxtAbdomen" step="any" value="<?php Echo($Abdomen)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Contorno Cuello</td>
    <td><input type="number" class="col-xs-6" name="TxtContornoCuello" step="any" value="<?php Echo($Contorno_Cuello)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Cintura</td>
    <td><input type="number" class="col-xs-6" name="TxtCintura" step="any" value="<?php Echo($Cintura)?>">&nbsp;Cm.</td>
                          </tr>
                        </table>
                      </div>
                      <div class="col-lg-6 col-xlg-3 col-md-5" >
                         <center class="m-t-30"> <img src="../Administrator/images/Rotate/Inferior.jpg" class="img-circle" width="50" />
                                    <h4 class="card-title m-t-10">Outfit Inferior</h4>
                        <table>
                          <tr>
                            <td style="width: 50%">Cadera</td>
    <td><input type="number" class="col-xs-6" name="TxtCadera" step="any" value="<?php Echo($Cadera)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Tiro</td>
    <td><input type="number" class="col-xs-6" name="TxtTiro" step="any" value="<?php Echo($Tiro)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Pierna</td>
    <td><input type="number" class="col-xs-6" name="TxtPierna" step="any" value="<?php Echo($Pierna)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Rodilla</td>
    <td><input type="number" class="col-xs-6" name="TxtRodilla" step="any" value="<?php Echo($Rodilla)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Pantorrilla</td>
    <td><input type="number" class="col-xs-6" name="TxtPantorrilla" step="any" value="<?php Echo($Pantorrilla)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Bota</td>
    <td><input type="number" class="col-xs-6" name="TxtBota" step="any" value="<?php Echo($Bota)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Largo Pantalón</td>
    <td><input type="number" class="col-xs-6" name="TxtLargoPantalon" step="any" value="<?php Echo($Largo_Pantalon)?>">&nbsp;Cm.</td>
                          </tr>
                        </table>
                      </div>
                    </div>
                     <script type="text/javascript">
          $('input').keydown( function(e) {
        var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
        if(key == 13) {
            e.preventDefault();
            var inputs = $(this).closest('form').find(':input:visible');
            inputs.eq( inputs.index(this)+ 1 ).focus();
        }
    });
        </script>
</form>

                      <?php
                    }
                  }
                  else 
                  {
                    Echo("<h5>Lo sentimos no se encontraron resultados en su búsqueda</h5>");
                  }

    }
}
else 
{
   // Búsqueda por número de celular
  $Busqueda=strtoupper($_POST['palabra']); //se recibe la cadena que queremos buscar
if ($Busqueda!="") {
      $sql ="SELECT Id_Cliente, Documento_Cliente,Avatar_Cliente, Nom_Cliente, Ape_Cliente, Ciudad_Id_Ciudad, Correo_Cliente, Tel_Cliente, Cel1_Cliente, Cel2_Cliente, Tipo_Cliente,Largo_Manga, Largo_Camisa, Espalda, Pecho, Abdomen, Contorno_Cuello, Cintura, Cadera, Tiro, Pierna, Rodilla, Pantorrilla, Bota, Largo_Pantalon from t_clientes  WHERE  Documento_Cliente='".$Busqueda."'"; 


      
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Id_Cliente=$row['Id_Cliente'];
        $Documento_Cliente=$row['Documento_Cliente'];
        $Avatar_Cliente=$row['Avatar_Cliente'];
         $Nom_Cliente=$row['Nom_Cliente'];
        $Ape_Cliente=$row['Ape_Cliente'];
        $Correo_Cliente=$row['Correo_Cliente'];
        $Cel1_Cliente=$row['Cel1_Cliente'];
        $Cel2_Cliente=$row['Cel2_Cliente'];

         $Largo_Manga=$row['Largo_Manga'];
          $Largo_Camisa=$row['Largo_Camisa'];
           $Espalda=$row['Espalda'];
            $Pecho=$row['Pecho'];
             $Abdomen=$row['Abdomen'];
              $Contorno_Cuello=$row['Contorno_Cuello'];
               $Cintura=$row['Cintura'];
                $Cadera=$row['Cadera'];
                 $Tiro=$row['Tiro'];
                  $Pierna=$row['Pierna'];
                   $Rodilla=$row['Rodilla'];
                    $Pantorrilla=$row['Pantorrilla'];
                     $Bota=$row['Bota'];
                      $Largo_Pantalon=$row['Largo_Pantalon'];
                      ?>
                         <!-- Column -->
       <form action="Cliente-Pedido.php" method="post" id="FormNuevoPedido">
        <input style="display: none;" type="text"  name="TxtClienteSel" value="<?php Echo($Id_Cliente)?>" >
                    <div class="col-lg-12 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> <img src="<?php Echo($Avatar_Cliente); ?>" class="img-circle" width="120" />
                                    <h4 class="card-title m-t-10"><?php Echo utf8_encode($Nom_Cliente." ".$Ape_Cliente)  ?></h4>
                                    <div class="checkbox">
                          <label>
                            <input name="ConfirmarCliente" value="1" required="true" class="ace ace-checkbox-2" type="checkbox" />
                            <?php 

$sql ="SELECT Cons_PedidosCl FROM t_config WHERE Desarrollador='TEKSYSTEM S.A.S'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Cons_PedidosCl=$row['Cons_PedidosCl']+1;
 }
}
                             ?>
                            <span class="lbl"> <strong>Confirmar Cliente </strong></span>
                            <input style="display: none;" type="text" name="TxtConsPedido" value="<?php Echo($Cons_PedidosCl);?>">
                          </label>
                        </div>
                        <button type="submit" class="btn btn-sm btn-danger">
                          <i class="ace-icon fa fa-save"></i>
                         Realizar Pago
                        </button>                                   
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body">
                              <div class="col-xs-6 col-lg-3">
                                 <label><strong>E-mail: </strong></label>
                              </div>
                              <div class="col-lg-9 col-xs-9">
                              <input type="text" name="TxtCorreoUp" class="input-xlarge" value="<?php Echo($Correo_Cliente) ?>">
                              </div>
                             <hr>
                              <div class="col-xs-6 col-lg-3">
                                 <label><strong>Celular: </strong></label>
                              </div>
                             <div class="col-lg-6 col-xs-6">
                               <input type="text" name="TxtCelularUp" class="form-control input-mask-phone" value="<?php Echo($Cel1_Cliente) ?>">
                             </div>
                              
                             
                            </div>
                        </div>
                    </div>
                   <div class="col-lg-12 col-xlg-3 col-md-5" style="border: dotted 1px black;padding: 8px;">
                      
                      <div class="col-lg-6 col-xlg-3 col-md-5" >
                         <center class="m-t-30"> <img src="../Administrator/images/Rotate/Superior.jpg" class="img-circle" width="50" />
                                    <h4 class="card-title m-t-10">Outfit Superior</h4>
                        <table>
                          <tr>
                            <td style="width: 50%">Largo Manga</td>
    <td><input type="number" class="col-xs-6" name="TxtLargoManga" step="any" value="<?php Echo($Largo_Manga)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Largo Camisa</td>
    <td><input type="number" class="col-xs-6" name="TxtLargoCamisa" step="any" value="<?php Echo($Largo_Camisa)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Espalda</td>
    <td><input type="number" class="col-xs-6" name="TxtEspalda" step="any" value="<?php Echo($Espalda)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Pecho</td>
    <td><input type="number" class="col-xs-6" name="TxtPecho" step="any" value="<?php Echo($Pecho)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Abdomen</td>
    <td><input type="number" class="col-xs-6" name="TxtAbdomen" step="any" value="<?php Echo($Abdomen)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Contorno Cuello</td>
    <td><input type="number" class="col-xs-6" name="TxtContornoCuello" step="any" value="<?php Echo($Contorno_Cuello)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Cintura</td>
    <td><input type="number" class="col-xs-6" name="TxtCintura" step="any" value="<?php Echo($Cintura)?>">&nbsp;Cm.</td>
                          </tr>
                        </table>
                      </div>
                      <div class="col-lg-6 col-xlg-3 col-md-5" >
                         <center class="m-t-30"> <img src="../Administrator/images/Rotate/Inferior.jpg" class="img-circle" width="50" />
                                    <h4 class="card-title m-t-10">Outfit Inferior</h4>
                        <table>
                          <tr>
                            <td style="width: 50%">Cadera</td>
    <td><input type="number" class="col-xs-6" name="TxtCadera" step="any" value="<?php Echo($Cadera)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Tiro</td>
    <td><input type="number" class="col-xs-6" name="TxtTiro" step="any" value="<?php Echo($Tiro)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Pierna</td>
    <td><input type="number" class="col-xs-6" name="TxtPierna" step="any" value="<?php Echo($Pierna)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Rodilla</td>
    <td><input type="number" class="col-xs-6" name="TxtRodilla" step="any" value="<?php Echo($Rodilla)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Pantorrilla</td>
    <td><input type="number" class="col-xs-6" name="TxtPantorrilla" step="any" value="<?php Echo($Pantorrilla)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Bota</td>
    <td><input type="number" class="col-xs-6" name="TxtBota" step="any" value="<?php Echo($Bota)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Largo Pantalón</td>
    <td><input type="number" class="col-xs-6" name="TxtLargoPantalon" step="any" value="<?php Echo($Largo_Pantalon)?>">&nbsp;Cm.</td>
                          </tr>
                        </table>
                      </div>
                    </div>
                     <script type="text/javascript">
          $('input').keydown( function(e) {
        var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
        if(key == 13) {
            e.preventDefault();
            var inputs = $(this).closest('form').find(':input:visible');
            inputs.eq( inputs.index(this)+ 1 ).focus();
        }
    });
        </script>
</form>

                      <?php
                    }
                  }
                  else 
                  {
                    Echo("<h5>Lo sentimos no se encontraron resultados en su búsqueda</h5>");
                  }

    }
}


  ?>

								

 
 </body>
</html> 
