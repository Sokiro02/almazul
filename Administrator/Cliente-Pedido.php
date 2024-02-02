<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');


$TxtConsPedido=$_POST['TxtConsPedido'];
$TxtClienteSel=$_POST['TxtClienteSel'];
$ConfirmarCliente=$_POST['ConfirmarCliente'];
$TxtCorreoUp=$_POST['TxtCorreoUp'];
$TxtCelularUp=$_POST['TxtCelularUp'];
$TxtLargoManga=$_POST['TxtLargoManga'];
$TxtLargoCamisa=$_POST['TxtLargoCamisa'];
$TxtEspalda=$_POST['TxtEspalda'];
$TxtPecho=$_POST['TxtPecho'];
$TxtAbdomen=$_POST['TxtAbdomen'];
$TxtContornoCuello=$_POST['TxtContornoCuello'];
$TxtCintura=$_POST['TxtCintura'];
$TxtCadera=$_POST['TxtCadera'];
$TxtTiro=$_POST['TxtTiro'];
$TxtPierna=$_POST['TxtPierna'];
$TxtRodilla=$_POST['TxtRodilla'];
$TxtPantorrilla=$_POST['TxtPantorrilla'];
$TxtBota=$_POST['TxtBota'];
$TxtLargoPantalon=$_POST['TxtLargoPantalon'];


// Actualizar los datos del Cliente

	$sql="UPDATE t_clientes SET Correo_Cliente='".$TxtCorreoUp."',Cel1_Cliente='".$TxtCelularUp."',Largo_Manga='".$TxtLargoManga."',Largo_Camisa='".$TxtLargoCamisa."',Espalda='".$TxtEspalda."',Pecho='".$TxtPecho."',Abdomen='".$TxtAbdomen."',Contorno_Cuello='".$TxtContornoCuello."',Cintura='".$TxtCintura."',Cadera='".$TxtCadera."',Tiro='".$TxtTiro."',Pierna='".$TxtPierna."',Rodilla='".$TxtRodilla."',Pantorrilla='".$TxtPantorrilla."',Bota='".$TxtBota."',Largo_Pantalon='".$TxtLargoPantalon."' WHERE Id_cliente='".$TxtClienteSel."'";
	//Echo($sql);
	$result=$conexion->query($sql);
    include("Lib/seguridad.php");
    $Datos="Se agrego un pedido del cliente: ".$TxtClienteSel;
    $Paginas= $_SERVER['PHP_SELF'];
    $seguridad = AgregarLog($IdUser,$Datos,$Paginas);

 header("location:Pedido-Crear.php?ClientePedido=".$TxtClienteSel."");

 ?>
