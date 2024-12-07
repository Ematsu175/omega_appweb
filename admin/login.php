<?php 
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
                $header = "";
        
                // Obtener información del usuario y empresa
                $usuario = $app->readOneUser($correo);
                $empresa = $app->readOneEmpresa($usuario['id_usuario']);
                
                // Si el rol es Usuario, asignar directamente valores a $_SESSION
                if (in_array('Usuario', $roles)) {
                    $_SESSION['id_usuario'] = $usuario['id_usuario']; // Almacenar directamente el valor
                    $_SESSION['id_empresa'] = $empresa['id_empresa']; // Almacenar directamente el valor
                    $mensaje = "Bienvenido de nuevo Usuario";
                    $header = "views/header_user/header_user.php";
                    $index = "index_usuario.php";
                }
                // Si el rol es Administrador
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
            die();
        
        case 'logout':
            $app->logout();
            break;
        default:
            include('views/login/index.php');
            break;

    }

    

?>