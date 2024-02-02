<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
?>

<?php 
// Inicio Validación de Nombre de Colección
$Valcoleccion=strtoupper($_POST['Valcoleccion']);// Variable de Productos-Colección.php
if ($Valcoleccion!="") {
$sql ="SELECT Nom_Coleccion from t_colecciones WHERE Nom_Coleccion='".$Valcoleccion."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Nom_Coleccion=$row['Nom_Coleccion'];
    }
}
if ($Nom_Coleccion==$Valcoleccion) {
	?>
		<small class="red">Este nombre de colección ya existe</small>
	<?php
}
else
{
	?>
		<small class="green">Nombre de colección disponible </small>
	<?php
}
}
// Fin Validación de Nombre de Colección
 ?>

 <?php 
// Inicio Validación de Nombre de Proveedor
$ValProveedor=strtoupper($_POST['ValProveedor']);// Variable de Productos-Colección.php
if ($ValProveedor!="") {
$sql ="SELECT Nom_Prov from t_proveedores WHERE Nom_Prov='".$ValProveedor."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Nom_Prov=$row['Nom_Prov'];
    }
}
if ($Nom_Prov==$ValProveedor) {
	?>
		<small class="red">Este proveedor ya existe</small>
	<?php
}
else
{
	?>
		<small class="green">Nombre de Proveedor disponible </small>
	<?php
}
}
// Fin Validación de Nombre de Proveedor
 ?>


 <?php 
// Inicio Validación de Código de Línea
$ValNuevaLinea=strtoupper($_POST['ValNuevaLinea']);// Variable de Productos-Colección.php
if ($ValNuevaLinea!="") {
$sql ="SELECT Cod_Cat_Producto from t_categoria_producto WHERE Cod_Cat_Producto='".$ValNuevaLinea."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Cod_Cat_Producto=$row['Cod_Cat_Producto'];
    }
}
if ($Cod_Cat_Producto==$ValNuevaLinea) {
	?>
		<small class="red">Este código ya existe</small>
	<?php
}
else
{
	?>
		<small class="green">Código Disponible </small>
	<?php
}
}
// Fin Validación de Código de Línea
 ?>

 <?php 
// Inicio Validación de Código de Línea
$ValNomLinea=strtoupper($_POST['ValNomLinea']);// Variable de Productos-Colección.php
if ($ValNomLinea!="") {
$sql ="SELECT Nom_Cat_Producto from t_categoria_producto WHERE Nom_Cat_Producto='".$ValNomLinea."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Nom_Cat_Producto=$row['Nom_Cat_Producto'];
    }
}
if ($Nom_Cat_Producto==$ValNomLinea) {
	?>
		<small class="red">Este nombre ya existe</small>
	<?php
}
else
{
	?>
		<small class="green">Nombre Disponible </small>
	<?php
}
}
// Fin Validación de Código de Línea
 ?>


 <?php 
// Inicio Validación de Código de Subcategoria
$ValNuevaCategoria=strtoupper($_POST['ValNuevaCategoria']);// Variable de Productos-Colección.php
if ($ValNuevaCategoria!="") {
$sql ="SELECT Cod_SubCat_Producto from t_subcategoria_producto WHERE Cod_SubCat_Producto='".$ValNuevaCategoria."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Cod_SubCat_Producto=$row['Cod_SubCat_Producto'];
    }
}
if ($Cod_SubCat_Producto==$ValNuevaCategoria) {
	?>
		<small class="red">Este código ya existe</small>
	<?php
}
else
{
	?>
		<small class="green">Código Disponible </small>
	<?php
}
}
// Fin Validación de Código de Línea
 ?>

 <?php 
// Inicio Validación de Nombre de Subcategoria
$ValNomCategoria=strtoupper($_POST['ValNomCategoria']);// Variable de Productos-Colección.php
if ($ValNomCategoria!="") {
$sql ="SELECT Nom_SubCat_Producto from t_subcategoria_producto WHERE Nom_SubCat_Producto='".$ValNomCategoria."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Nom_SubCat_Producto=$row['Nom_SubCat_Producto'];
    }
}
if ($Nom_SubCat_Producto==$ValNomCategoria) {
	?>
		<small class="red">Este Nombre ya existe</small>
	<?php
}
else
{
	?>
		<small class="green">Nombre Disponible </small>
	<?php
}
}
// Fin Validación de Nombre de Línea
 ?>


 <?php 
// Inicio Validación Documento Cliente 
$ValNuevoCliente=$_POST['ValNuevoCliente'];// Variable de Productos-Colección.php
if ($ValNuevoCliente!="") {
$sql ="SELECT Documento_Cliente from t_clientes WHERE Documento_Cliente='".$ValNuevoCliente."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Documento_Cliente=$row['Documento_Cliente'];
    }
}
if ($Documento_Cliente==$ValNuevoCliente) {
	?>
		<small class="red">Este número de documento ya existe</small>
	<?php
}
else
{
	?>
		<small class="green">Documento Disponible </small>
	<?php
}
}
// Fin Validación de Nombre de Línea
 ?>
