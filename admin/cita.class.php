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

        function update($id, $data) {
            $this->conexion();
            $fecha = $data['fecha_solicitud'];
            $result = [];
        
            try {
                $this->con->beginTransaction();
                $dia_semana = date('w', strtotime($fecha));
                $hoy = date('Y-m-d');
                $manana = date('Y-m-d', strtotime('+1 day'));
                if ($fecha <= $manana || $dia_semana == 0 || $dia_semana == 6) {
                    throw new Exception("La fecha seleccionada no es válida. Debe ser al siguiente día y no puede ser sábado o domingo.");
                }
                $totalCitas = $this->checkCitasPorFecha($fecha); 
                if ($totalCitas >= 3) {
                    throw new Exception("Ya hay tres citas programadas para este día. No se pueden agendar más citas.");
                }
                $sql = "UPDATE cita SET fecha_solicitud=:fecha_solicitud, 
                                        observaciones=:observaciones, 
                                        id_empresa=:id_empresa 
                                        WHERE id_cita=:id_cita;";
                $insertar = $this->con->prepare($sql);
                $insertar->bindParam(':fecha_solicitud', $data['fecha_solicitud'], PDO::PARAM_STR);
                $insertar->bindParam(':observaciones', $data['observaciones'], PDO::PARAM_STR);
                $insertar->bindParam(':id_empresa', $data['id_empresa'], PDO::PARAM_INT);
                $insertar->bindParam(':id_cita', $id, PDO::PARAM_INT);
                $insertar->execute();
                $result = $insertar->rowCount();
                if ($result > 0) {
                    $this->con->commit(); 
                } else {
                    $this->con->rollback();
                    $result = 0;
                }
            } catch (Exception $e) {
                if ($this->con->inTransaction()) {
                    $this->con->rollback();
                }
                $result = $e->getMessage();
            }
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
        function readAll($id_usuario = null, $rol = null) {
            $this->conexion();
            $result = [];
            if ($rol == 'Administrador') {
                $consulta = 'SELECT c.id_cita, c.fecha_solicitud, c.observaciones, e.empresa 
                             FROM cita c
                             JOIN empresa e ON c.id_empresa = e.id_empresa
                             ORDER BY c.fecha_solicitud DESC;';
            } elseif ($rol == 'Usuario' && $id_usuario !== null) {
                $consulta = 'SELECT c.id_cita, c.fecha_solicitud, c.observaciones, e.empresa 
                             FROM cita c
                             JOIN empresa e ON c.id_empresa = e.id_empresa
                             WHERE c.id_empresa = (
                                 SELECT id_empresa 
                                 FROM usuario_empresa 
                                 WHERE id_usuario = :id_usuario
                             )
                             ORDER BY c.fecha_solicitud DESC;';
            } else {
                throw new Exception('Error: El rol o ID de usuario no es válido.');
            }
        
            $sql = $this->con->prepare($consulta);
        
            if ($rol == 'Usuario' && $id_usuario !== null) {
                $sql->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            }
        
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            //print_r($result);
        
            return $result;
        }
        
   
        function checkCitasPorFecha($fecha_solicitud) {
            $this->conexion();
            $result = [];
            $consulta = "SELECT COUNT(*) as total_citas FROM cita WHERE fecha_solicitud = :fecha_solicitud";
            $sql = $this->con->prepare($consulta);
            $sql->bindParam(":fecha_solicitud", $fecha_solicitud, PDO::PARAM_STR);
            $sql->execute();
            
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result['total_citas'];
        }


    }
?>