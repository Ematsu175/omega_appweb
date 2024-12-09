<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    

    // Verificar si el usuario ha iniciado sesión
    if (!isset($_SESSION['id_usuario'])) {
        // Si no hay sesión, redirigir al login
        $_SESSION['mensaje'] = "Hay una sesión activa.";
        header("Location: /omega_appweb/admin/login.php");
        exit;
    }
    
    // Extraer los valores necesarios
    //print_r($_SESSION);
    $id_usuario = $_SESSION['id_usuario'];
    $rol = $_SESSION['roles'][0]['rol'];
    
    // Verificación de depuración (puedes eliminar esto después de verificar)
    /*echo "<pre>";
    print_r($_SESSION);
    echo "ID Usuario: $id_usuario, Rol: $rol";
    echo "</pre>";*/
    
    // Cargar clases y manejar lógica de acciones
    require_once('cita.class.php');
    require_once('empresa.class.php');
    
    $app = new Cita;
    $appEmpresa = new Empresa;
    $accion = (isset($_GET['accion'])) ? $_GET['accion'] : null;
    $id = (isset($_GET['id'])) ? $_GET['id'] : null;   

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
                $citas=$app->readAll($id_usuario,$rol);
                include('views/cita/index.php');
                echo("No se puede agendar citas sabado o domingos");
                break;            
            }
            $totalCitas=$app->checkCitasPorFecha($fecha);
            if ($totalCitas>=3) {
                $mensaje = "Ya hay tres citas programadas para este día. No se pueden agendar más citas.";
                $tipo = "danger";
                $empresa = $appEmpresa->readAll();
                $citas = $app->readAll($id_usuario, $rol);
                include('views/cita/index.php');
                echo("No se pueden agendar más de tres citas para este día.");
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
            $citas=$app->readAll($id_usuario, $rol);
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
            $totalCitas = $app->checkCitasPorFecha($fecha);

            if ($totalCitas >= 3) {
                $mensaje = "Ya hay tres citas programadas para este día. No se pueden actualizar la cita para ese día.";
                $tipo = "danger";
                $citas = $app->readAll($id_usuario, $rol);
                include('views/cita/index.php');
                break; 
            }
            
            if($fecha<$manana ||$dia_semana==0 || $dia_semana==6){
                $mensaje="La fecha seleccionada no es válida. Debe ser al siguiente día y no puede ser sábado o domingo.";
                $tipo="danger";
                $citas=$app->readAll($id_usuario, $rol);
                include('views/cita/index.php');
                echo("No se puede agendar citas sabado o domingos");
                break;            
            }
            //print_r($result);
            $result = $app->update($id,$data);
            if($result){
                $mensaje="Cita actualizada correctamente";
                $tipo="success";

            } else {
                $mensaje="Hubo un error no se pudo actualizar la cita";
                $tipo="danger";
            }
            $citas=$app->readAll($id_usuario, $rol);
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
            $citas=$app->readAll($id_usuario, $rol);
            include('views/cita/index.php');
            
            break;
        default:
        //echo('entra al default');
            try {
                $citas = $app->readAll($id_usuario, $rol); 
                //print_r($citas);
                include('views/cita/index.php');
            } catch (Exception $e) {
                die('Error: ' . $e->getMessage());
            }
            break;
        
        
        
    }
?>