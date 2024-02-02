<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];


$R1=$_POST['Select1'];

$sql ="SELECT Cod_SubCat_Producto from t_subcategoria_producto WHERE Id_SubCat_Producto='".$R1."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Ref1=$row['Cod_SubCat_Producto'];
        Echo($Ref1);
    }
}
//header("location:index.php");
 ?>
