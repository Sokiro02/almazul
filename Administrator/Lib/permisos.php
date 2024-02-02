<?php 
//Validación de Permisos
$sql ="SELECT * FROM t_rol_usuario WHERE Id_Rol='".$IdRol."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$Val_Actualizar=$row['Actualizar_TekMaster'];             
        $Val_Editar=$row['Editar_TekMaster'];
        $Val_Eliminar=$row['Eliminar_TekMaster'];
        $Val_Insertar=$row['Insertar_TekMaster'];
        $Val_Ver=$row['Ver_TekMaster'];
        $Menu_Produccion=$row['Menu_Produccion'];
        $Menu_Clientes=$row['Menu_Clientes'];
        $Menu_Proveedores=$row['Menu_Proveedores'];
        $Menu_Insumos=$row['Menu_Insumos'];
        $Menu_Compras=$row['Menu_Compras'];
        $Menu_Sastres=$row['Menu_Sastres'];
        $Menu_Prod_Config=$row['Menu_Prod_Config'];
        $Menu_Prod_Colecciones=$row['Menu_Prod_Colecciones'];
        $Menu_Prod_Crear=$row['Menu_Prod_Crear'];
        $Menu_Galeria=$row['Menu_Galeria'];
        $Menu_CentroDist=$row['Menu_CentroDist'];
        $Menu_Remisiones=$row['Menu_Remisiones'];
        $Menu_Tiendas=$row['Menu_Tiendas'];
        $Menu_Bodegas=$row['Menu_Bodegas'];
        $Per_Config_Hotel=$row['Per_Config_Hotel'];
 }
}

 ?>
 <?php
session_start(); //Iniciamos o Continuamos la sesion
if (isset($_GET['TxtNomTienda'])) //Si llego un Nickname via el formulario lo grabamos en la Sesion
{
    $_SESSION['nicktienda'] = $_GET['TxtNomTienda']; //Nickname Grabado
    $MiTienda=$_SESSION['nicktienda'];
}   


session_start(); //Iniciamos o Continuamos la sesion
if (isset($_GET['TxtTienda'])) //Si llego un Nickname via el formulario lo grabamos en la Sesion
{
    $_SESSION['IdTienda'] = $_GET['TxtTienda']; //Nickname Grabado
    $MyIdTienda=$_SESSION['IdTienda'];
}   

?>

<?php
session_start(); //Iniciamos o Continuamos la sesion
if (isset($_GET['TxtNomTaller'])) //Si llego un Nickname via el formulario lo grabamos en la Sesion
{
    $_SESSION['nicktaller'] = $_GET['TxtNomTaller']; //Nickname Grabado
    $MiTaller=$_SESSION['nicktaller'];
}   


session_start(); //Iniciamos o Continuamos la sesion
if (isset($_GET['TxtTaller'])) //Si llego un Nickname via el formulario lo grabamos en la Sesion
{
    $_SESSION['IdTaller'] = $_GET['TxtTaller']; //Nickname Grabado
    $MyIdTaller=$_SESSION['IdTaller'];
}   

?>

