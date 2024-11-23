<?php
    require_once('figura_fiscal.class.php');
    $app = new Figura_fiscal;
    $accion = (isset($_GET['accion']))?$_GET['accion']:null;
    $id = (isset($_GET['id']))?$_GET['id']:null;

    switch($accion){
        case 'crear':
            $figura_fiscal = $app->readAll();
            include('views/figura_fiscal/crear.php');
            break;
        case 'nuevo':
            $data=$_POST['data'];
            $resultado=$app->create($data);
            if($resultado){
                $mensaje="Figura fiscal dada de alta correctamente";
                $tipo="success";

            } else {
                $mensaje="Hubo un error al momento de agregar la figura fiscal";
                $tipo="danger";
            }
            $figura_fiscal=$app->readAll();
            include('views/figura_fiscal/index.php');
            break;

        case 'actualizar':
            $figura_fiscal=$app->readOne($id);
            include('views/figura_fiscal/crear.php');
            break;
        
        case 'modificar':
            $data=$_POST['data'];
            $result = $app->update($id,$data);
            //print_r($data);
            if($result){
                $mensaje="Figura fiscal actualizada correctamente";
                $tipo="success";

            } else {
                $mensaje="Hubo un error no se pudo actualizar la figura fiscal";
                $tipo="danger";
            }
            $figura_fiscal=$app->readAll();
            include('views/figura_fiscal/index.php');
            break;

        case 'eliminar':           
            if (!is_null($id)) {
                if(is_numeric($id)){
                    $resultado = $app->delete($id);
                    if ($resultado) {
                        $mensaje = "la figura fiscal se elimino correctamente";
                        $tipo = "success";
                    } else {
                        $mensaje = "Error no se elimino la empresa";
                        $tipo = "danger";
                    }
                }
            }
            $figura_fiscal=$app->readAll();
            include('views/figura_fiscal/index.php');
            
            break;
        default:
            $figura_fiscal=$app->readAll();
            include('views/figura_fiscal/index.php');
    }
?>