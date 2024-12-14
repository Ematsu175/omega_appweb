<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['mensaje'] = "Hay una sesión activa.";
    header("Location: /omega_appweb/admin/login.php");
    exit;
}
require('usuario.class.php');
require('figura_fiscal.class.php');
require('empresa.class.php');
$app = new Usuario;
$appFiguraFiscal = new Figura_fiscal;
$appEmpresa = new Empresa;
$accion = (isset($_GET['accion'])) ? $_GET['accion'] : null;
$id = (isset($_GET['id'])) ? $_GET['id'] : null;

switch ($accion) {
    case 'crear':
        $usuario = $app->readAll();
        $figura_fiscal = $appFiguraFiscal->readAll();
        include('views/usuario/crear.php');
        break;
    case 'nuevo':
        $data = $_POST['data'];
        $resultado = $app->create($data);

        if ($resultado) {
            $mensaje = "Usuario dado de alta correctamente";
            $tipo = "success";
        } else {
            $mensaje = "Hubo un error al momento de agregar al usuario";
            $tipo = "danger";
        }

        $usuario = $app->readAll();
        $figura_fiscal = $appFiguraFiscal->readAll();
        $empresa = $appEmpresa->readAll();
        include('views/usuario/index.php');
        break;

    case 'crearUsuario':
        $usuario = $app->readAll();
        $figura_fiscal = $appFiguraFiscal->readAll();
        include('registration.php');
        break;
    case 'nuevoUsuario':
        $data = $_POST['data'];
        $resultado = $app->create($data);

        if ($resultado) {
            $mensaje = "Usuario dado de alta correctamente";
            $tipo = "success";
        } else {
            $mensaje = "Hubo un error al momento de agregar al usuario";
            $tipo = "danger";
        }

        $usuario = $app->readAll();
        $figura_fiscal = $appFiguraFiscal->readAll();
        $empresa = $appEmpresa->readAll();
        $app->alerta($tipo, $mensaje);
        include('views/login/index.php');
        break;

    case 'actualizar':
        $usuario = $app->readOne($id);
        $figura_fiscal = $appFiguraFiscal->readAll();
        $empresa = $app->readEmpresaByUsuario($id);
        include('views/usuario/crear.php');
        break;

    case 'modificar':
        $data = $_POST['data'];
        $result = $app->update($id, $data);

        if ($result) {
            $mensaje = "Usuario actualizado correctamente";
            $tipo = "success";
        } else {
            $mensaje = "Hubo un error, no se pudo actualizar el usuario";
            $tipo = "danger";
        }

        $usuario = $app->readAll();
        $figura_fiscal = $appFiguraFiscal->readAll();
        $empresa = $appEmpresa->readAll();
        include('views/usuario/index.php');
        break;


    case 'eliminar':
        if (!is_null($id)) {
            if (is_numeric($id)) {
                $resultado = $app->delete($id);
                if ($resultado) {
                    $mensaje = "El usuario se elimino correctamente";
                    $tipo = "success";
                } else {
                    $mensaje = "Error no se elimino el usuario";
                    $tipo = "danger";
                }
            }
        }
        $usuario = $app->readAll();
        include('views/usuario/index.php');

        break;
    default:
        $usuario = $app->readAll();
        include('views/usuario/index.php');
}
?>