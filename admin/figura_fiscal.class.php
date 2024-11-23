<?php
    require_once('../sistema.class.php');

    class Figura_fiscal extends Sistema{

        function create($data){
            $this->conexion();
            $result=[];
            $sql="insert into figura_fiscal(figura_fiscal) 
                        values (:figura_fiscal);";
            $insertar = $this->con->prepare($sql);
            $insertar->bindParam(':figura_fiscal', $data['figura_fiscal'], PDO::PARAM_STR);
            $insertar->execute();
            $result = $insertar->rowCount();

            return $result;
        }

        function update($id, $data){
            $this->conexion();
            $result = [];
            $sql = 'update figura_fiscal set figura_fiscal=:figura_fiscal
                                       where id_figura_fiscal=:id_figura_fiscal;';
            $modificar = $this->con->prepare($sql);
            $modificar->bindParam(':figura_fiscal', $data['figura_fiscal'], PDO::PARAM_STR);
            $modificar->bindParam('id_figura_fiscal', $id, PDO::PARAM_INT);
            $modificar->execute();
            $result = $modificar->rowCount();

            return $result;

        }

        function delete($id){
            $this->conexion();
            $result = [];
            $sql = 'delete from figura_fiscal where id_figura_fiscal=:id_figura_fiscal;';
            $borrar = $this->con->prepare($sql);
            $borrar->bindParam(':id_figura_fiscal', $id, PDO::PARAM_INT);
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
        function readAll(){
            $this->conexion();
            $result=[];
            $consulta='select * from figura_fiscal;';
            $sql = $this->con->prepare($consulta);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>