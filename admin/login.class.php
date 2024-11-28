<?php
    require_once('../sistema.class.php');

    class Login extends Sistema{
        

        function readOne($correo){
            $this->conexion();
            $result=[];
            $consulta='select id_usuario from usuario where correo=:correo';
            $sql = $this->con->prepare($consulta);
            $sql->bindParam("id_usuario",$correo,PDO::PARAM_STR);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

    }
?>