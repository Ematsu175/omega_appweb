<?php
    include 'config.class.php';
    class Sistema{
        var $con;
        function conexion(){
            $this->con = new PDO(SGBD.':host='.DBHOST.';port='.DBPORT.';dbname='.DBNAME.'', DBUSER, DBPASS);
        }

        function alerta($tipo, $mensaje){
            include('views/alert.php');
        }

        function getRol($correo){
            $this->conexion();
            $data = [];
            if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
                $sql="select r.rol from usuario u inner join usuario_rol ur on u.id_usuario = ur.id_usuario
                        inner join rol r on ur.id_rol = r.id_rol where u.correo=:correo;";
                $roles = $this->con->prepare($sql);
                $roles->bindParam('correo', $correo, PDO::PARAM_STR);
                $roles->execute();
                $data = $roles->fetchAll(PDO::FETCH_ASSOC);

            }
            return $data;
        }

        function getPrivilegios($correo){
            $this->conexion();
            $data = [];
            if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
                $sql = "select p.permiso 
                        from usuario u join usuario_rol ur on u.id_usuario = ur.id_usuario 
                        join rol r on ur.id_rol = r.id_rol 
                        join rol_permiso rp on r.id_rol = rp.id_rol 
                        join permiso p on rp.id_permiso = p.id_permiso 
                        where u.correo=:correo;";
                $privilegios =$this->con->prepare($sql);
                $privilegios->bindParam('correo', $correo, PDO::PARAM_STR);
                $privilegios->execute();
                $data = $privilegios->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }
        function login($correo, $contrasena){
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $contrasena = md5($contrasena);
            $acceso = false;
            if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $this->conexion();
                $sql = 'select * from usuario 
                        where correo=:correo and contrasena=:contrasena;';
                $login = $this->con->prepare($sql);
                $login->bindParam('correo', $correo, PDO::PARAM_STR);
                $login->bindParam('contrasena', $contrasena, PDO::PARAM_STR);
                $login->execute();
                $resultado = $login->fetchAll(PDO::FETCH_ASSOC);
                if(isset($resultado[0])){
                    $acceso = true;
                    $_SESSION['correo'] = $correo;
                    $_SESSION['validado'] = $acceso;
                    $roles = $this->getRol($correo);
                    $privilegios = $this->getPrivilegios($correo);
                    $_SESSION['roles']=$roles;
                    $_SESSION['privilegios']= $privilegios;
                    return $acceso;
                } 
                
            }
            $_SESSION['validado'] = false;
            return $acceso;
        }
        function logout(){
            session_start();
            session_unset();
            session_destroy();
            header('Location: /omega_appweb/index.html');
            exit();
        }

        function checkRol($rol){
            if(isset($_SESSION['roles'])){
                $roles = $_SESSION['roles'];
                if(!in_array($rol, $roles)){
                    $mensaje = "Error usted no tiene el rol adecuado";
                    $tipo = "danger";
                    //require_once('views/header/alert.php');
                    $this->alerta($tipo, $mensaje);
                    //die();
                }
                
            } else {
                $mensaje = "Requiere iniciar sesión. <a href='login.php'>[Presione aqí para volver a entrar]</a>";
                $tipo = "danger";
                require_once('views/header.php');
                $this->alerta($tipo, $mensaje);
                //require_once('views/footer.php');
                die();
            }
            
        }

        function readOneUser($correo){
            $this->conexion();
            $result=[];
            $consulta='select id_usuario from usuario where correo=:correo';
            $sql = $this->con->prepare($consulta);
            $sql->bindParam("correo",$correo,PDO::PARAM_STR);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        function readOneEmpresa($id_usuario) {
            $this->conexion();
            $result = [];
            $consulta = 'SELECT e.id_empresa, e.empresa AS empresa 
                         FROM usuario_empresa ue
                         JOIN empresa e ON ue.id_empresa = e.id_empresa
                         WHERE ue.id_usuario = :id_usuario;';
            $sql = $this->con->prepare($consulta);
            $sql->bindParam("id_usuario", $id_usuario, PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        
        /*function readOneEmpresa($id_usuario){
            $this->conexion();
            $result=[];
            $consulta='select id_empresa from usuario_empresa where id_usuario=:id_usuario;';
            $sql = $this->con->prepare($consulta);
            $sql->bindParam("id_usuario",$id_usuario,PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result;
        }*/
        

    }
?>