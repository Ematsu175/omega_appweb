<?php
    require_once('../sistema.class.php');

    class Empresa extends Sistema{
        function create($data){
            $this->conexion();
            $result=[];
            $sql="insert into empresa(empresa, telefono, email, rfc, id_figura_fiscal) 
                        values (:empresa,:telefono,:email,:rfc,:id_figura_fiscal);";
            $insertar = $this->con->prepare($sql);
            $insertar->bindParam(':empresa', $data['empresa'], PDO::PARAM_STR);
            $insertar->bindParam(':telefono', $data['telefono'], PDO::PARAM_STR_CHAR);
            $insertar->bindParam(':email', $data['email'], PDO::PARAM_STR);
            $insertar->bindParam(':rfc', $data['rfc'], PDO::PARAM_STR);
            $insertar->bindParam(':id_figura_fiscal', $data['id_figura_fiscal'], PDO::PARAM_INT);
            $insertar->execute();
            $result = $insertar->rowCount();

            return $result;
        }

        function update($id, $data){
            $this->conexion();
            $result = [];
            $sql = 'update empresa set empresa=:empresa,
                                       telefono=:telefono,
                                       email=:email,
                                       rfc=:rfc,
                                       id_figura_fiscal=:id_figura_fiscal
                                       where id_empresa=:id_empresa;';
            $modificar = $this->con->prepare($sql);
            $modificar->bindParam('empresa', $data['empresa'], PDO::PARAM_STR);
            $modificar->bindParam('telefono', $data['telefono'], PDO::PARAM_STR_CHAR);
            $modificar->bindParam('email', $data['email'], PDO::PARAM_STR);
            $modificar->bindParam('rfc', $data['rfc'], PDO::PARAM_STR);
            $modificar->bindParam('id_figura_fiscal', $data['id_figura_fiscal'], PDO::PARAM_INT);
            $modificar->bindParam('id_empresa', $id, PDO::PARAM_INT);
            $modificar->execute();
            $result = $modificar->rowCount();

            return $result;

        }

        function delete($id){
            $this->conexion();
            $result = [];
            $sql = 'delete from empresa where id_empresa=:id_empresa';
            $borrar = $this->con->prepare($sql);
            $borrar->bindParam('id_empresa', $id, PDO::PARAM_INT);
            $borrar->execute();
            $result = $borrar->rowCount();

            return $result;
        }

        function readOne($id){
            $this->conexion();
            $result = [];
            $consulta = "select * from empresa where id_empresa=:id_empresa;";
            $sql = $this->con->prepare($consulta);
            $sql->bindParam("id_empresa", $id, PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        function readAll() {
            $this->conexion();
            $result=[];
            $consulta='select e.*,f.figura_fiscal from empresa e join figura_fiscal f on e.id_figura_fiscal=f.id_figura_fiscal;';
            $sql = $this->con->prepare($consulta);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>