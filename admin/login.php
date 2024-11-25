<?php 
    require_once('../sistema.class.php');
    //echo "Direccion de una pagina: " . $_SERVER['PHP_SELF'] . "<br>"; 
    
    $accion = (isset($_GET['accion']))?$_GET['accion']:null;
    $id = (isset($_GET['id']))?$_GET['id']:null;

    $app = new Sistema;
    switch($accion){
        case 'login':
            $correo=$_POST['data']['correo'];
            $contrasena=$_POST['data']['contrasena'];
        
            if($app->login($correo, $contrasena)){
                $roles=array_column($_SESSION['roles'], 'rol'); // Extrae los valores de 'rol'
                $mensaje="";
                $tipo="success";
                $header="";
        
                if (in_array('Administrador', $roles)) {
                    $mensaje="Bienvenido Administrador";
                    $header="views/header_admin/header_admin.php";
                } elseif (in_array('Usuario', $roles)) {
                    $mensaje="Bienvenido de nuevo Usuario";
                    $header="views/header_user/header_user.php";
                } else {
                    $mensaje="No se pudo acceder al sistema";
                }
        
                require_once($header);
                //require_once('views/header_user/header_user.php');
                $app->alerta($tipo, $mensaje);
                //echo $mensaje; 
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