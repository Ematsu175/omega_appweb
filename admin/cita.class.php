<?php
    require_once('../sistema.class.php');

    class Cita extends Sistema{
        function create($data){
            $this->conexion();
            $result=[];
            $sql="insert into cita(fecha_solicitud, observaciones, id_empresa) 
                        values (:fecha_solicitud,:observaciones,:id_empresa);";
            $insertar = $this->con->prepare($sql);
            $insertar->bindParam(':fecha_solicitud', $data['fecha_solicitud'], PDO::PARAM_STR);
            $insertar->bindParam(':observaciones', $data['observaciones'], PDO::PARAM_STR);
            $insertar->bindParam(':id_empresa', $data['id_empresa'], PDO::PARAM_INT);
            $insertar->execute();
            $result = $insertar->rowCount();
            
            return $result;
        }

        function update($id, $data){
            $this->conexion();
            $result = [];
            $sql="update cita set fecha_solicitud=:fecha_solicitud, 
                                  observaciones=:observaciones, 
                                  id_empresa=:id_empresa 
                                  where id_cita=:id_cita;";
            $insertar = $this->con->prepare($sql);
            $insertar->bindParam(':fecha_solicitud', $data['fecha_solicitud'], PDO::PARAM_STR);
            $insertar->bindParam(':observaciones', $data['observaciones'], PDO::PARAM_STR);
            $insertar->bindParam(':id_empresa', $data['id_empresa'], PDO::PARAM_INT);
            $insertar->bindParam(':id_cita', $id, PDO::PARAM_INT);
            $insertar->execute();
            $result = $insertar->rowCount();

            return $result;
        }

        function delete($id){
            $this->conexion();
            $result = [];
            $sql = 'delete from cita where id_cita=:id_cita';
            $borrar = $this->con->prepare($sql);
            $borrar->bindParam('id_cita', $id, PDO::PARAM_INT);
            $borrar->execute();
            $result = $borrar->rowCount();
            return $result;
        }

        function readOne($id){
            $this->conexion();
            $result = [];
            $consulta = "select * from cita where id_cita=:id_cita;";
            $sql = $this->con->prepare($consulta);
            $sql->bindParam("id_cita", $id, PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        function readAll() {
            $this->conexion();
            $result=[];
            $consulta='select c.*, e.empresa from cita c join empresa e on c.id_empresa=e.id_empresa;';
            $sql = $this->con->prepare($consulta);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>