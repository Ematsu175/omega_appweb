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
                $roles=array_column($_SESSION['roles'], 'rol'); 
                $mensaje="";
                $tipo="success";
                $header="";

                $usuario=$app->readOneUser($correo);
                //print_r($usuario);
                
        
                if (in_array('Administrador', $roles)) {
                    $mensaje="Bienvenido Administrador";
                    $header="views/header_admin/header_admin.php";
                    $index="index_admin.php";
                } elseif (in_array('Usuario', $roles)) {
                    $_SESSION['id_usuario']=$usuario;
                    $empresa=$app->readOneEmpresa($usuario['id_usuario']);
                    $_SESSION['id_empresa']=$empresa;
                    $mensaje="Bienvenido de nuevo Usuario";
                    $header="views/header_user/header_user.php";
                    $index="index_usuario.php";
                } else {
                    $mensaje="No se pudo acceder al sistema";
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