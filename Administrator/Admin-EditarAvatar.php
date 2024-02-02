<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

$Aleaotorio=rand(0,9999);

$TxtEdIdUsuario=$_POST['TxtEdIdUsuario'];

$Fotoperfil=$_POST['Fotoperfil'];

if ($TxtEdIdUsuario!="") {
// Actualización de la Actividad

//=====================================================================
$target_dir = "Images/Perfiles/";

$target_file = $target_dir .$Aleaotorio."-". basename($_FILES["Fotoperfil"]["name"]);
//echo($target_file);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["Fotoperfil"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $Valida=header("location:Usuarios.php?Mensaje=10");
        //echo "El archivo no es una imagen.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    $Valida=header("location:Usuarios.php?Mensaje=1");
    //echo "Lo Sentimos, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["Fotoperfil"]["size"] > 10000000) {
    $Valida=header("location:Usuarios.php?Mensaje=2");
    //echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "pdf") {
    $Valida=header("location:Usuarios.php?Mensaje=3");
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    header("location:Usuarios.php?Mensaje=4");
    //$Valida;
// if everything is ok, try to upload file
} else {
    
    if (move_uploaded_file($_FILES["Fotoperfil"]["tmp_name"], $target_file)) {

        $EstadoUsuario=1;
        $sql ="UPDATE t_usuarios SET Img_Perfil='".$target_file."' WHERE Id_Usuario='".$TxtEdIdUsuario."'";  
//echo($sql);
$result = $conexion->query($sql);

header("location:Perfil.php?Mensaje=10&TAB=tabs-1");
   
        //echo "The file ". basename( $_FILES["Fotoperfil"]["name"]). " has been uploaded.";
    } else {
         header("location:Usuarios.php?Mensaje=5");
        //echo "Sorry, there was an error uploading your file.";
    }
}

}

?>