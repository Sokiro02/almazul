<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
//RECOGER INFORMACIÒN DE DESPACHOSM.PHP
$id_tienda = $_POST['TxtIdTienda'];
$Nombre_Tienda = $_POST['TxtNomTienda'];
$Id_Referencia = $_POST['TxtInsumoSel'];
$Cantidad = $_POST['TxtCantidad'];
$Talla = $_POST['TxtTalla'];
$Codigo_Generado = $_POST['TxtICodigoGenerado'];
echo "SE ESTAN MOSTRANDO VALORES?";
echo "ERRORES";
echo $Id_Referencia;
while ($post = each($_POST))
{
echo $post[0] . " = " . $post[1];
}

?>
