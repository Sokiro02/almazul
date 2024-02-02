<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];

// Variables de  Bodegas.php
$UpTxtDocumento = strtoupper($_POST['UpTxtDocumento']);
$UpTxtNombres = htmlentities(strtoupper($_POST['UpTxtNombres']));

$UpTxtApellidos = htmlentities(strtoupper($_POST['UpTxtApellidos']));
$UpTxtDir = htmlentities(strtoupper($_POST['UpTxtDir']));
$UpTxtCelular = strtoupper($_POST['UpTxtCelular']);
$UpTxtCiudad = strtoupper($_POST['UpTxtCiudad']);
$UpTxtCorreo = strtoupper($_POST['UpTxtCorreo']);
$TxtEditCliente=$_POST['TxtEditCliente'];


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


$EstadoTekMaster=1;

//Actualizar Información de Bodegas
// Datos extraídos de Bodegas.php

$sql=("UPDATE t_clientes SET Documento_Cliente='".utf8_decode($UpTxtDocumento)."', Nom_Cliente='".utf8_encode($UpTxtNombres)."', Ape_Cliente='".utf8_decode($UpTxtApellidos)."', Dir_Cliente='".utf8_decode($UpTxtDir)."', Correo_Cliente='".($UpTxtCorreo)."',Ciudad_Id_Ciudad='".utf8_decode($UpTxtCiudad)."', Cel1_Cliente='".utf8_decode($UpTxtCelular)."', Largo_Manga='".utf8_decode($TxtLargoManga)."' , Largo_Camisa='".utf8_decode($TxtLargoCamisa)."', Espalda='".utf8_decode($TxtEspalda)."',Pecho='".utf8_decode($TxtPecho)."', Abdomen='".utf8_decode($TxtAbdomen)."', Contorno_Cuello='".utf8_decode($TxtContornoCuello)."', Cintura='".utf8_decode($TxtCintura)."', Cadera='".utf8_decode($TxtCadera)."', Tiro='".utf8_decode($TxtTiro)."', Pierna='".utf8_decode($TxtPierna)."', Rodilla='".utf8_decode($TxtRodilla)."', Pantorrilla='".utf8_decode($TxtPantorrilla)."', Bota='".utf8_decode($TxtBota)."', Largo_Pantalon='".utf8_decode($TxtLargoPantalon)."'  WHERE Id_Cliente='".$TxtEditCliente."'");
echo($sql);
$result = $conexion->query($sql);

header("location:OrdenCliente.php?Mensaje=25");


 ?>