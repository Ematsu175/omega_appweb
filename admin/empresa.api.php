<?php
    require_once('empresa.class.php');
    header("Content-type: application/json; charset=utf-8");
    $app = new Empresa;
    //$app->checkRol('Administrador');
    $accion = (isset($_GET['accion']))?$_GET['accion']:null;
    $accion=$_SERVER['REQUEST_METHOD'];
    $id = (isset($_GET['id']))?$_GET['id']:null;
    $data=[];
    switch($accion){

        case 'POST':
            $datos=$_POST;
            if(!is_null($id) && is_numeric($id)){
                $result = $app->update($id, $datos);
            } else {
                $result = $app->create($datos);
            }
            if($result == 1){
                $data['mensaje']="La empresa se ha guardado correctamente";
            } else{
                $data['mensaje']="Ocurrio algun error con el servicio";
            }
            
            break;
        

        case 'DELETE':           
            if (!is_null($id)) {
                if(is_numeric($id)){
                    $resultado = $app->delete($id);
                    if ($resultado) {
                        $mensaje = "La empresa se elimino correctamente";
                        
                    } else {
                        $mensaje = "Error no se elimino la empresa";
                        
                    }
                }
            }
            $data['mensaje']=$mensaje;
            
            break;
        
        default:
            if(!is_null($id) && is_numeric($id)){
                $empresas=$app->readOne($id);
            } else {
                $empresas=$app->readAll();
            }
            
            $data=$empresas;

    }

    echo json_encode($data);

?>