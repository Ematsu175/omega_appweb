<?php
    require_once('../sistema.class.php');

    class Usuario extends Sistema{

        function create($data){
            $this->conexion();
            $result=[];
            $sql="insert into usuario(correo, contrasena) 
                        values (:correo, md5(:contrasena));";
            $insertar = $this->con->prepare($sql);
            $insertar->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
            $insertar->bindParam(':contrasena', $data['contrasena'], PDO::PARAM_STR);
            $insertar->execute();
            $result = $insertar->rowCount();

            return $result;
        }

        function update($id, $data){
            $this->conexion();
            $result = [];
            $sql = 'update usuario set correo=:correo,
                                       contrasena=MD5(:contrasena)
                                       where id_usuario=:id_usuario;';
            $modificar = $this->con->prepare($sql);
            $modificar->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
            $modificar->bindParam(':contrasena', $data['contrasena'], PDO::PARAM_STR);
            $modificar->bindParam('id_usuario', $id, PDO::PARAM_INT);
            $modificar->execute();
            $result = $modificar->rowCount();

            return $result;

        }

        function delete($id){
            $this->conexion();
            $result = [];
            $sql = 'delete from usuario where id_usuario=:id_usuario;';
            $borrar = $this->con->prepare($sql);
            $borrar->bindParam(':id_usuario', $id, PDO::PARAM_INT);
            $borrar->execute();
            $result = $borrar->rowCount();

            return $result;
        }

        function readOne($id){
            $this->conexion();
            $result = [];
            $consulta = "select * from usuario where id_usuario=:id_usuario;";
            $sql = $this->con->prepare($consulta);
            $sql->bindParam("id_usuario", $id, PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        function readAll(){
            $this->conexion();
            $result=[];
            $consulta='select * from usuario;';
            $sql = $this->con->prepare($consulta);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>