<?php
include ("conexion.php");

// Configuración de los parámetros de la cookie de sesión
$lifetime = 86400 * 30;
session_set_cookie_params($lifetime);

session_start();

// Asigna el valor de $_SESSION['IdUser'] a $IdUser
$IdUser = isset($_SESSION['IdUser']) ? $_SESSION['IdUser'] : null;

if (isset($_COOKIE['contador'])) { 
    // Caduca en un año 
    setcookie('contador', $_COOKIE['contador'] + 1, time() + 365 * 24 * 60 * 60); 
    $mensaje = 'Número de visitas: ' . $_COOKIE['contador']; 
} else { 
    // Caduca en un año 
    setcookie('contador', 1, time() + 365 * 24 * 60 * 60); 
    $mensaje = 'Bienvenido a nuestra página web'; 
}

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $consulta = "SELECT * FROM t_usuarios_activos WHERE Id_Usuario = '".$IdUser."'";
    $MiId = session_id();
    $resultado = $conexion->query($consulta);
    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {   
            $codigo_session = trim($row['codigo']);
            $nombre_usuario = $row['otros'];
            $inicio = $row['start'];
            $fin = $row['expire'];
            $ip = $row['ip'];
            if ($MiId != $codigo_session) {
                session_destroy();
                header("location:../Login/index.php?Mensaje=3&ip='".$ip."'");
                exit;
            }
        }
    } else {
        session_destroy();
        header("location:../Login/index.php?Mensaje=2");
        exit;
    }
} else {
    session_destroy();
    header("location:../Login/index.php?Mensaje=2");
    exit;
}
?>
