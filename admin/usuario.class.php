<?php
    require_once('../sistema.class.php');

    class Usuario extends Sistema{

        function create($data) {
            $this->conexion();
            try {
                // Iniciar transacción
                $this->con->beginTransaction();
        
                // Insertar en la tabla usuario
                $sqlUsuario = "INSERT INTO usuario (correo, contrasena) VALUES (:correo, MD5(:contrasena))";
                $stmtUsuario = $this->con->prepare($sqlUsuario);
                $stmtUsuario->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
                $stmtUsuario->bindParam(':contrasena', $data['contrasena'], PDO::PARAM_STR);
                $stmtUsuario->execute();
                $idUsuario = $this->con->lastInsertId(); // Obtener el ID del último usuario insertado
        
                // Insertar en la tabla empresa
                $sqlEmpresa = "INSERT INTO empresa (empresa, telefono, email, rfc, id_figura_fiscal) 
                               VALUES (:empresa, :telefono, :email, :rfc, :id_figura_fiscal)";
                $stmtEmpresa = $this->con->prepare($sqlEmpresa);
                $stmtEmpresa->bindParam(':empresa', $data['empresa'], PDO::PARAM_STR);
                $stmtEmpresa->bindParam(':telefono', $data['telefono'], PDO::PARAM_STR);
                $stmtEmpresa->bindParam(':email', $data['correo'], PDO::PARAM_STR);
                $stmtEmpresa->bindParam(':rfc', $data['rfc'], PDO::PARAM_STR);
                $stmtEmpresa->bindParam(':id_figura_fiscal', $data['id_figura_fiscal'], PDO::PARAM_INT);
                $stmtEmpresa->execute();
                $idEmpresa = $this->con->lastInsertId(); // Obtener el ID de la última empresa insertada
        
                // Insertar en la tabla usuario_empresa
                $sqlUsuarioEmpresa = "INSERT INTO usuario_empresa (id_usuario, id_empresa) 
                                      VALUES (:id_usuario, :id_empresa)";
                $stmtUsuarioEmpresa = $this->con->prepare($sqlUsuarioEmpresa);
                $stmtUsuarioEmpresa->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
                $stmtUsuarioEmpresa->bindParam(':id_empresa', $idEmpresa, PDO::PARAM_INT);
                $stmtUsuarioEmpresa->execute();
        
                // Insertar en la tabla usuario_rol
                $sqlUsuarioRol = "INSERT INTO usuario_rol (id_usuario, id_rol) 
                                  VALUES (:id_usuario, :id_rol)";
                $stmtUsuarioRol = $this->con->prepare($sqlUsuarioRol);
                $stmtUsuarioRol->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
                $stmtUsuarioRol->bindValue(':id_rol', 1, PDO::PARAM_INT); // ID del rol "Usuario"
                $stmtUsuarioRol->execute();
        
                // Confirmar transacción
                $this->con->commit();
                return true;
            } catch (Exception $e) {
                // Revertir transacción en caso de error
                $this->con->rollBack();
                error_log("Error al crear el usuario: " . $e->getMessage());
                return false;
            }
        }

        function update($id, $data) {
            $this->conexion();
            try {
                // Iniciar la transacción
                $this->con->beginTransaction();
        
                // Actualizar datos en la tabla usuario
                $sqlUsuario = "UPDATE usuario 
                               SET correo = :correo, 
                                   contrasena = MD5(:contrasena) 
                               WHERE id_usuario = :id_usuario";
                $stmtUsuario = $this->con->prepare($sqlUsuario);
                $stmtUsuario->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
                $stmtUsuario->bindParam(':contrasena', $data['contrasena'], PDO::PARAM_STR);
                $stmtUsuario->bindParam(':id_usuario', $id, PDO::PARAM_INT);
                $stmtUsuario->execute();
        
                // Actualizar datos en la tabla empresa
                $sqlEmpresa = "UPDATE empresa 
                               SET empresa = :empresa, 
                                   telefono = :telefono, 
                                   email = :email, 
                                   rfc = :rfc, 
                                   id_figura_fiscal = :id_figura_fiscal 
                               WHERE id_empresa = (
                                   SELECT id_empresa 
                                   FROM usuario_empresa 
                                   WHERE id_usuario = :id_usuario
                               )";
                $stmtEmpresa = $this->con->prepare($sqlEmpresa);
                $stmtEmpresa->bindParam(':empresa', $data['empresa'], PDO::PARAM_STR);
                $stmtEmpresa->bindParam(':telefono', $data['telefono'], PDO::PARAM_STR);
                $stmtEmpresa->bindParam(':email', $data['correo'], PDO::PARAM_STR);
                $stmtEmpresa->bindParam(':rfc', $data['rfc'], PDO::PARAM_STR);
                $stmtEmpresa->bindParam(':id_figura_fiscal', $data['id_figura_fiscal'], PDO::PARAM_INT);
                $stmtEmpresa->bindParam(':id_usuario', $id, PDO::PARAM_INT);
                $stmtEmpresa->execute();
        
                // Confirmar la transacción
                $this->con->commit();
        
                return true;
            } catch (Exception $e) {
                // Revertir la transacción en caso de error
                $this->con->rollBack();
                error_log("Error al actualizar el usuario: " . $e->getMessage());
                return false;
            }
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

        function readEmpresaByUsuario($id_usuario) {
            $this->conexion();
            $consulta = "SELECT e.* 
                         FROM empresa e 
                         JOIN usuario_empresa ue ON e.id_empresa = ue.id_empresa
                         WHERE ue.id_usuario = :id_usuario";
            $sql = $this->con->prepare($consulta);
            $sql->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC);
        }
    }
?>