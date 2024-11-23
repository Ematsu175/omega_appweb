<?php
    require_once('empresa.class.php');
    require_once('figura_fiscal.class.php');
    $app = new Empresa;
    $appFiguraFiscal = new Figura_fiscal;
    $accion = (isset($_GET['accion']))?$_GET['accion']:null;
    $id = (isset($_GET['id']))?$_GET['id']:null;

    switch($accion){
        case 'crear':
            $figura_fiscal = $appFiguraFiscal->readAll();
            include('views/empresa/crear.php');
            break;
        case 'nuevo':
            $data=$_POST['data'];
            $resultado=$app->create($data);
            if($resultado){
                $mensaje="Empresa dada de alta correctamente";
                $tipo="success";

            } else {
                $mensaje="Hubo un error al momento de agregar la empresa";
                $tipo="danger";
            }
            $empresas=$app->readAll();
            include('views/empresa/index.php');
            break;

        case 'actualizar':
            $empresas=$app->readOne($id);
            $figura_fiscal = $appFiguraFiscal->readAll();
            include('views/empresa/crear.php');
            break;
        
        case 'modificar':
            $data=$_POST['data'];
            $result = $app->update($id,$data);
            //print_r($result);
            if($result){
                $mensaje="empresa actualizado correctamente";
                $tipo="success";

            } else {
                $mensaje="Hubo un error no se pudo actualizar la empresa";
                $tipo="danger";
            }
            $empresas=$app->readAll();
            include('views/empresa/index.php');
            break;

        case 'eliminar':           
            if (!is_null($id)) {
                if(is_numeric($id)){
                    $resultado = $app->delete($id);
                    if ($resultado) {
                        $mensaje = "la empresa se elimino correctamente";
                        $tipo = "success";
                    } else {
                        $mensaje = "Error no se elimino la empresa";
                        $tipo = "danger";
                    }
                }
            }
            $empresas=$app->readAll();
            include('views/empresa/index.php');
            
            break;
        default:
            $empresas=$app->readAll();
            include('views/empresa/index.php');
    }
?>