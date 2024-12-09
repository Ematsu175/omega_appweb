<?php 
session_start();

// Mostrar el mensaje si existe
if (isset($_SESSION['mensaje'])) {
    echo "<div class='alert alert-warning'>" . $_SESSION['mensaje'] . "</div>";
    unset($_SESSION['mensaje']); // Eliminar el mensaje para que no se muestre nuevamente
}
    require_once('../sistema.class.php');
    //echo "Direccion de una pagina: " . $_SERVER['PHP_SELF'] . "<br>"; 
    
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
                    $_SESSION['mensaje'] = "Bienvenido de nuevo Usuario";
                    
                    // Redirigir a index_usuario.php
                    header("Location: /omega_appweb/admin/index_usuario.php");
                    exit;
                } elseif (in_array('Administrador', $roles)) {
                    $_SESSION['id_usuario'] = $usuario['id_usuario'];
                    $_SESSION['mensaje'] = "Bienvenido Administrador";
        
                    // Redirigir a index_admin.php
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
        
        /*case 'login':
            $correo = $_POST['data']['correo'];
            $contrasena = $_POST['data']['contrasena'];
        
            if ($app->login($correo, $contrasena)) {
                $roles = array_column($_SESSION['roles'], 'rol'); 
                $mensaje = "";
                $tipo = "success";
                $header = "";
        
                $usuario = $app->readOneUser($correo);
                $empresa = $app->readOneEmpresa($usuario['id_usuario']);
                
                if (in_array('Usuario', $roles)) {
                    $_SESSION['id_usuario'] = $usuario['id_usuario']; 
                    $_SESSION['id_empresa'] = $empresa['id_empresa'];
                    $mensaje = "Bienvenido de nuevo Usuario";
                    $header = "views/header_user/header_user.php";
                    $index = "index_usuario.php";
                }
                
                elseif (in_array('Administrador', $roles)) {
                    $usuario = $app->readOneUser($correo);
                    $_SESSION['id_usuario'] = $usuario['id_usuario'];
                    $mensaje = "Bienvenido Administrador";
                    $header = "views/header_admin/header_admin.php";
                    $index = "index_admin.php";
                } else {
                    $mensaje = "No se pudo acceder al sistema";
                }
        
                require_once($header);
                $app->alerta($tipo, $mensaje);
                require_once($index); 
                require_once('views/footer.php');
            } else {
                $mensaje = "Correo o contraseña no válidos <a href='login.php'>[Presione aquí para volver a intentar.]</a>";
                $tipo = "danger";
                require_once('views/header.php');
                $app->alerta($tipo, $mensaje);
            }
            die();*/
        
        case 'logout':
            $app->logout();
            break;
        default:
            include('views/login/index.php');
            break;

    }

    

?>