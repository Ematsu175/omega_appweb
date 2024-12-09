<?php 
session_start();

if (isset($_SESSION['mensaje'])) {
    echo "<div class='alert alert-warning'>" . $_SESSION['mensaje'] . "</div>";
    unset($_SESSION['mensaje']); 
}
    require_once('../sistema.class.php');
    
    $accion = (isset($_GET['accion']))?$_GET['accion']:null;
    $id = (isset($_GET['id']))?$_GET['id']:null;

    $app = new Sistema;
    switch($accion){
        case 'login':
            $correo = $_POST['data']['correo'];
            $contrasena = $_POST['data']['contrasena'];
        
            if ($app->login($correo, $contrasena)) {
                $roles = array_column($_SESSION['roles'], 'rol'); 
                $mensaje = "";
                $tipo = "success";
        
                $usuario = $app->readOneUser($correo);
                $empresa = $app->readOneEmpresa($usuario['id_usuario']);
        
                if (in_array('Usuario', $roles)) {
                    $_SESSION['id_usuario'] = $usuario['id_usuario']; 
                    $_SESSION['id_empresa'] = $empresa['id_empresa'];
                    $_SESSION['empresa_nombre'] = $empresa['empresa'];
                    $_SESSION['mensaje'] = "Bienvenido de nuevo Usuario";
                    header("Location: /omega_appweb/admin/index_usuario.php");
                    exit;
                } elseif (in_array('Administrador', $roles)) {
                    $_SESSION['id_usuario'] = $usuario['id_usuario'];
                    $_SESSION['mensaje'] = "Bienvenido Administrador";
        
                    header("Location: /omega_appweb/admin/index_admin.php");
                    exit;
                } else {
                    $_SESSION['mensaje'] = "No se pudo acceder al sistema";
                    header("Location: login.php");
                    exit;
                }
            } else {
                $mensaje = "Correo o contraseña no válidos <a href='login.php'>[Presione aquí para volver a intentar.]</a>";
                $tipo = "danger";
                require_once('views/header.php');
                $app->alerta($tipo, $mensaje);
            }
            die();
        
        case 'logout':
            $app->logout();
            break;
        default:
            include('views/login/index.php');
            break;

    }

    

?>