<?php
    require_once('cita.class.php');
    require_once('empresa.class.php');
    $app = new Cita;
    $appEmpresa = new Empresa;
    $accion = (isset($_GET['accion']))?$_GET['accion']:null;
    $id = (isset($_GET['id']))?$_GET['id']:null;

    switch($accion){
        case 'crear':
            $empresa = $appEmpresa->readAll();
            include('views/cita/crear.php');
            break;
        case 'nuevo':
            $data=$_POST['data'];
            $fecha=$data['fecha_solicitud'];
            $dia_semana=date('w',strtotime($fecha));
            $manana = date('Y-m-d', strtotime('+1 day'));
            if($fecha<$manana ||$dia_semana==0 || $dia_semana==6){
                $mensaje="La fecha seleccionada no es válida. Debe ser al siguiente día y no puede ser sábado o domingo.";
                $tipo="danger";
                $empresa = $appEmpresa->readAll();
                include('views/cita/crear.php');
                echo("No se puede agendar citas sabado o domingos");
                break;            
            }
            $resultado=$app->create($data);
            if($resultado){
                $mensaje="Cita dada de alta correctamente";
                $tipo="success";

            } else {
                $mensaje="Hubo un error al momento de agendar la cita";
                $tipo="danger";
            }
            $citas=$app->readAll();
            include('views/cita/index.php');
            break;

        case 'actualizar':
            $citas=$app->readOne($id);
            $empresa = $appEmpresa->readAll();
            include('views/cita/crear.php');
            break;
        
        case 'modificar':
            $data=$_POST['data'];
            $fecha=$data['fecha_solicitud'];
            $dia_semana=date('w',strtotime($fecha));
            $manana = date('Y-m-d', strtotime('+1 day'));
            $result = $app->update($id,$data);
            if($fecha<$manana ||$dia_semana==0 || $dia_semana==6){
                $mensaje="La fecha seleccionada no es válida. Debe ser al siguiente día y no puede ser sábado o domingo.";
                $tipo="danger";
                $empresa = $appEmpresa->readAll();
                include('views/cita/crear.php');
                echo("No se puede agendar citas sabado o domingos");
                break;            
            }
            //print_r($result);
            if($result){
                $mensaje="Cita actualizada correctamente";
                $tipo="success";

            } else {
                $mensaje="Hubo un error no se pudo actualizar la cita";
                $tipo="danger";
            }
            $citas=$app->readAll();
            include('views/cita/index.php');
            break;

        case 'eliminar':           
            if (!is_null($id)) {
                if(is_numeric($id)){
                    $resultado = $app->delete($id);
                    if ($resultado) {
                        $mensaje = "La cita se elimino correctamente";
                        $tipo = "success";
                    } else {
                        $mensaje = "Error no se elimino la cita";
                        $tipo = "danger";
                    }
                }
            }
            $citas=$app->readAll();
            include('views/cita/index.php');
            
            break;
        default:
            $citas=$app->readAll();
            include('views/cita/index.php');
    }
?>