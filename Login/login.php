<?php
include "../Include/display_error.php";
include "../Administrator/Lib/seguridad.php";
//include ("conexion.php");
$host_db  = "localhost";
$user_db  = "root";
$pass_db  = "";
$db_name  = "almazul";
$tbl_name = "t_usuarios";

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

$sql    = "SELECT Tiempo FROM t_config WHERE Desarrollador='TEKSYSTEM S.A.S'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $MyTime = $row['Tiempo'];
    }
}

if ($conexion->connect_error) {
    die("La conexion falló: " . $conexion->connect_error);
}


$cambiouser= $_GET['cambiouser'];

if ($cambiouser!='') {
    $username = $_GET['cambiouser'];
    $password = 'cambio';
}
else{
    $username = $_POST['txtNombre'];
    $password = $_POST['TxtPass'];
}

$miip = $_POST['miip'];
$miip = trim($miip);
//////////////////////////////////////////////
//AGREGAR SEGURIDAD A LA  CONTRASEÑA
$Password_encriptado = md5($password);

//////////////////////////////////////////////

if ($username == "" or $password == "") {
    $Valida = header("location:index.php?Mensaje=12");
} else {
    $sql    = "SELECT * FROM t_usuarios  WHERE User_Name='" . $username . "'";
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $MyPass    = $row['Pass'];
            $IdEstado  = $row['Estado_id_estado_usuario'];
            $IdNomUser = $row['User_Name'];
            $IdUserReg = $row['Id_Usuario'];
            $IdRol     = $row['Rol_id_Rol'];
        }
    }

   // echo "Password Encriptado: " . $Password_encriptado;
   // echo "<br>";
   // echo "Clave guardada en Base de Datos: " . $MyPass;
   // echo "<br>";
   // echo "Clave guardada en Base de Datos encriptada: " . md5($MyPass);

$session_id = session_id();
//Usuario Activo
    $Activo = 1;
    if ($Password_encriptado == $MyPass && $IdEstado == $Activo && $IdRol == 1) {

        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['start']    = time();
        $_SESSION['IdUser']   = $IdUserReg;
        $IdUser               = $_SESSION['IdUser'];
        $_SESSION['IdRol']    = $IdRol;
        $_SESSION['expire']   = $_SESSION['start'] + (100 * $MyTime);
        $_SESSION['MIIP']     = $miip;

        $id_usuario = $_SESSION['IdUser'];
        $inicio     = $_SESSION['start'];
        $ultimo     = $_SESSION['expire'];
        $usuario    = $_SESSION['username'];

        $consulta  = "SELECT * FROM t_usuarios_activos WHERE Id_Usuario = '" . $IdUser . "'";
        $MiId      = session_id();
        $resultado = $conexion->query($consulta);
        if ($resultado->num_rows > 0) {
            $row    = $resultado->fetch_assoc();
            $update = "UPDATE t_usuarios_activos SET codigo='" . $MiId . "',ip='" . $miip . "' WHERE Id_Usuario='" . $IdUser . "'";
            $resul  = $conexion->query($update);
        } else {
            $sql = "INSERT INTO t_usuarios_activos (Id_Usuario,codigo,start,expire,otros,ip)
        VALUES('" . $id_usuario . "','" . $session_id . "','" . $inicio . "','" . $ultimo . "','" . $usuario . "','" . $miip . "')";
            $resultado = $conexion->query($sql) or die('Error:' . mysqli_error($conexion));
        }

        $seguridad = AgregarLog($IdUser, "Logeado como administrador", "login.php");
        header("location:../Administrator/index.php");


# ===================================================
# =           Inicio de Sesión ROL TALLER           =
# ===================================================

    } elseif ($Password_encriptado == $MyPass && $IdEstado == $Activo && $IdRol == 2) {

        $_SESSION['MIIP']     = trim($miip);
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['start']    = time();
        $_SESSION['IdUser']   = $IdUserReg;
        $_SESSION['IdRol']    = $IdRol;
        $_SESSION['expire']   = $_SESSION['start'] + (100 * $MyTime);
        $IdUser               = $_SESSION['IdUser'];
        $id_usuario           = $_SESSION['IdUser'];
        $inicio               = $_SESSION['start'];
        $ultimo               = $_SESSION['expire'];
        $usuario              = $_SESSION['username'];
        $consulta             = "SELECT * FROM t_usuarios_activos WHERE Id_Usuario = '" . $IdUser . "'";
        $MiId                 = session_id();
        $resultado            = $conexion->query($consulta);
        if ($resultado->num_rows > 0) {
            $row    = $resultado->fetch_assoc();
            $update = "UPDATE t_usuarios_activos SET codigo='" . $MiId . "',ip='" . $miip . "' WHERE Id_Usuario='" . $IdUser . "'";
            $resul  = $conexion->query($update);
        } else {
            $sql = "INSERT INTO t_usuarios_activos (Id_Usuario,codigo,start,expire,otros,ip)
        VALUES('" . $id_usuario . "','" . $session_id . "','" . $inicio . "','" . $ultimo . "','" . $usuario . "','" . $miip . "')";
            $resultado = $conexion->query($sql) or die('Error:' . mysqli_error($conexion));
        }

        header("location:../Administrator/index-talleres.php");
        $seguridad = AgregarLog($IdUser, "Logeado como Rol 2", "login.php");

# ===================================================
# =           Inicio de Sesión ROL VENTAS           =
# ===================================================

    } elseif ($Password_encriptado == $MyPass && $IdEstado == $Activo && $IdRol == 3) {

        $_SESSION['MIIP']     = trim($miip);
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['start']    = time();
        $_SESSION['IdUser']   = $IdUserReg;
        $_SESSION['IdRol']    = $IdRol;
        $_SESSION['expire']   = $_SESSION['start'] + (100 * $MyTime);
        $IdUser               = $_SESSION['IdUser'];
        $id_usuario           = $_SESSION['IdUser'];
        $inicio               = $_SESSION['start'];
        $ultimo               = $_SESSION['expire'];
        $usuario              = $_SESSION['username'];

        $consulta  = "SELECT * FROM t_usuarios_activos WHERE Id_Usuario = '" . $IdUser . "'";
        $MiId      = session_id();
        $resultado = $conexion->query($consulta);
        if ($resultado->num_rows > 0) {
            $row    = $resultado->fetch_assoc();
            $update = "UPDATE t_usuarios_activos SET codigo='" . $MiId . "',ip='" . $miip . "' WHERE Id_Usuario='" . $IdUser . "'";
            $resul  = $conexion->query($update);
        } else {
            $sql = "INSERT INTO t_usuarios_activos (Id_Usuario,codigo,start,expire,otros,ip)
        VALUES('" . $id_usuario . "','" . $session_id . "','" . $inicio . "','" . $ultimo . "','" . $usuario . "','" . $miip . "')";
            $resultado = $conexion->query($sql) or die('Error:' . mysqli_error($conexion));
        }

        $seguridad = AgregarLog($IdUser, "Logeado como Rol 3", "login.php");
        header("location:../Administrator/index-tiendas.php");

# ===========================================================
# =           Inicio de sesión por cambio de Rol Ventas         =
# ===========================================================

 } elseif ($cambiouser!='' && $IdEstado == $Activo && $IdRol == 3) {

        $_SESSION['MIIP']     = trim($miip);
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['start']    = time();
        $_SESSION['IdUser']   = $IdUserReg;
        $_SESSION['IdRol']    = $IdRol;
        $_SESSION['expire']   = $_SESSION['start'] + (100 * $MyTime);
        $IdUser               = $_SESSION['IdUser'];
        $id_usuario           = $_SESSION['IdUser'];
        $inicio               = $_SESSION['start'];
        $ultimo               = $_SESSION['expire'];
        $usuario              = $_SESSION['username'];

        $consulta  = "SELECT * FROM t_usuarios_activos WHERE Id_Usuario = '" . $IdUser . "'";
        $MiId      = session_id();
        $resultado = $conexion->query($consulta);
        if ($resultado->num_rows > 0) {
            $row    = $resultado->fetch_assoc();
            $update = "UPDATE t_usuarios_activos SET codigo='" . $MiId . "',ip='" . $miip . "' WHERE Id_Usuario='" . $IdUser . "'";
            $resul  = $conexion->query($update);
        } else {
            $sql = "INSERT INTO t_usuarios_activos (Id_Usuario,codigo,start,expire,otros,ip)
        VALUES('" . $id_usuario . "','" . $session_id . "','" . $inicio . "','" . $ultimo . "','" . $usuario . "','" . $miip . "')";
            $resultado = $conexion->query($sql) or die('Error:' . mysqli_error($conexion));
        }

        $seguridad = AgregarLog($IdUser, "Logeado como Rol 3", "login.php");
        header("location:../Administrator/index-tiendas.php");

# =============================================================
# =           Inicio de Sesión Cambio de Rol Taller           =
# =============================================================

 } elseif ($cambiouser!='' && $IdEstado == $Activo && $IdRol == 2) {

        $_SESSION['MIIP']     = trim($miip);
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['start']    = time();
        $_SESSION['IdUser']   = $IdUserReg;
        $_SESSION['IdRol']    = $IdRol;
        $_SESSION['expire']   = $_SESSION['start'] + (100 * $MyTime);
        $IdUser               = $_SESSION['IdUser'];
        $id_usuario           = $_SESSION['IdUser'];
        $inicio               = $_SESSION['start'];
        $ultimo               = $_SESSION['expire'];
        $usuario              = $_SESSION['username'];
        $consulta             = "SELECT * FROM t_usuarios_activos WHERE Id_Usuario = '" . $IdUser . "'";
        $MiId                 = session_id();
        $resultado            = $conexion->query($consulta);
        if ($resultado->num_rows > 0) {
            $row    = $resultado->fetch_assoc();
            $update = "UPDATE t_usuarios_activos SET codigo='" . $MiId . "',ip='" . $miip . "' WHERE Id_Usuario='" . $IdUser . "'";
            $resul  = $conexion->query($update);
        } else {
            $sql = "INSERT INTO t_usuarios_activos (Id_Usuario,codigo,start,expire,otros,ip)
        VALUES('" . $id_usuario . "','" . $session_id . "','" . $inicio . "','" . $ultimo . "','" . $usuario . "','" . $miip . "')";
            $resultado = $conexion->query($sql) or die('Error:' . mysqli_error($conexion));
        }

        header("location:../Administrator/index-talleres.php");
        $seguridad = AgregarLog($IdUser, "Logeado como Rol 2", "login.php");

# ========================================================================
# =           Inicio de Sesión por cambio de Rol Administrador           =
# ========================================================================

} elseif ($cambiouser!='' && $IdEstado == $Activo && $IdRol == 1) {
 $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['start']    = time();
        $_SESSION['IdUser']   = $IdUserReg;
        $IdUser               = $_SESSION['IdUser'];
        $_SESSION['IdRol']    = $IdRol;
        $_SESSION['expire']   = $_SESSION['start'] + (100 * $MyTime);
        $_SESSION['MIIP']     = $miip;

        $id_usuario = $_SESSION['IdUser'];
        $inicio     = $_SESSION['start'];
        $ultimo     = $_SESSION['expire'];
        $usuario    = $_SESSION['username'];

        $consulta  = "SELECT * FROM t_usuarios_activos WHERE Id_Usuario = '" . $IdUser . "'";
        $MiId      = session_id();
        $resultado = $conexion->query($consulta);
        if ($resultado->num_rows > 0) {
            $row    = $resultado->fetch_assoc();
            $update = "UPDATE t_usuarios_activos SET codigo='" . $MiId . "',ip='" . $miip . "' WHERE Id_Usuario='" . $IdUser . "'";
            $resul  = $conexion->query($update);
        } else {
            $sql = "INSERT INTO t_usuarios_activos (Id_Usuario,codigo,start,expire,otros,ip)
        VALUES('" . $id_usuario . "','" . $session_id . "','" . $inicio . "','" . $ultimo . "','" . $usuario . "','" . $miip . "')";
            $resultado = $conexion->query($sql) or die('Error:' . mysqli_error($conexion));
        }

        $seguridad = AgregarLog($IdUser, "Logeado como administrador", "login.php");
        header("location:../Administrator/index.php");

# ==============================================
# =           Inicio de Sesión ROL 6           =
# ==============================================


    } elseif ($Password_encriptado == $MyPass && $IdEstado == $Activo && $IdRol == 6) {

        $_SESSION['MIIP']     = trim($miip);
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['start']    = time();
        $_SESSION['IdUser']   = $IdUserReg;
        $_SESSION['IdRol']    = $IdRol;
        $_SESSION['expire']   = $_SESSION['start'] + (100 * $MyTime);
        $IdUser               = $_SESSION['IdUser'];
        $id_usuario           = $_SESSION['IdUser'];
        $inicio               = $_SESSION['start'];
        $ultimo               = $_SESSION['expire'];
        $usuario              = $_SESSION['username'];

        $consulta  = "SELECT * FROM t_usuarios_activos WHERE Id_Usuario = '" . $IdUser . "'";
        $MiId      = session_id();
        $resultado = $conexion->query($consulta);
        if ($resultado->num_rows > 0) {
            $row    = $resultado->fetch_assoc();
            $update = "UPDATE t_usuarios_activos SET codigo='" . $MiId . "',ip='" . $miip . "' WHERE Id_Usuario='" . $IdUser . "'";
            $resul  = $conexion->query($update);
        } else {
            $sql = "INSERT INTO t_usuarios_activos (Id_Usuario,codigo,start,expire,otros,ip)
        VALUES('" . $id_usuario . "','" . $session_id . "','" . $inicio . "','" . $ultimo . "','" . $usuario . "','" . $miip . "')";
            $resultado = $conexion->query($sql) or die('Error:' . mysqli_error($conexion));
        }

        $seguridad = AgregarLog($IdUser, "Logeado como Rol 6", "login.php");
        header("location:../Administrator/Vista-Referencias.php");

    } elseif ($Password_encriptado == $MyPass && $IdEstado == $Activo && $IdRol == 7) {

        $_SESSION['MIIP']     = trim($miip);
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['start']    = time();
        $_SESSION['IdUser']   = $IdUserReg;
        $_SESSION['IdRol']    = $IdRol;
        $_SESSION['expire']   = $_SESSION['start'] + (100 * $MyTime);
        $IdUser               = $_SESSION['IdUser'];
        $id_usuario           = $_SESSION['IdUser'];
        $inicio               = $_SESSION['start'];
        $ultimo               = $_SESSION['expire'];
        $usuario              = $_SESSION['username'];

        $consulta  = "SELECT * FROM t_usuarios_activos WHERE Id_Usuario = '" . $IdUser . "'";
        $MiId      = session_id();
        $resultado = $conexion->query($consulta);
        if ($resultado->num_rows > 0) {
            $row    = $resultado->fetch_assoc();
            $update = "UPDATE t_usuarios_activos SET codigo='" . $MiId . "',ip='" . $miip . "' WHERE Id_Usuario='" . $IdUser . "'";
            $resul  = $conexion->query($update);
        } else {
            $sql = "INSERT INTO t_usuarios_activos (Id_Usuario,codigo,start,expire,otros,ip)
        VALUES('" . $id_usuario . "','" . $session_id . "','" . $inicio . "','" . $ultimo . "','" . $usuario . "','" . $miip . "')";
            $resultado = $conexion->query($sql) or die('Error:' . mysqli_error($conexion));
        }

        $seguridad = AgregarLog($IdUser, "Logeado como Rol 6", "login.php");
        header("location:../Administrator/ordenes-timeline.php");

    } else {
        header("location:index.php?Mensaje=14");
    }
    mysqli_close($conexion);
}
