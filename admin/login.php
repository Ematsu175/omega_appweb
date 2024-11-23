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
            //echo($app->login($correo, $contrasena));
            if($app->login($correo, $contrasena)){
                $mensaje = "Bienvenido al sistema";
                $tipo = "success";
                //$app->checkRol('Administrador');
                require_once('views/header_user/header_user.php');
                $app->alerta($tipo, $mensaje);
                echo('Bienvenido al sistema');
                //plantillas personalizadas de bienvenida
                require_once('views/footer.php');
            } else {
                $mensaje = "Correo o contraseña no validos <a href='login.php'>[Presione aqui para volver a intentar.]</a>";
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