<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id_usuario']) || !isset($_SESSION['roles'][0]['rol'])) {
    die("Error: No se pudo autenticar al usuario. Por favor, inicie sesión nuevamente.");
}

$id_usuario = $_SESSION['id_usuario'];
$rol = $_SESSION['roles'][0]['rol'];

require ('../vendor/autoload.php');
require ('views/header_admin/header_admin.php');
require_once('cita.class.php');

$app=new Cita;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

$mensaje='';
$tipo_mensaje=''; 

try {
    $spreadsheet = new Spreadsheet();
    $activeWorksheet = $spreadsheet->getActiveSheet();

    $activeWorksheet->getColumnDimension('A')->setWidth(15); 
    $activeWorksheet->getColumnDimension('B')->setWidth(20); 
    $activeWorksheet->getColumnDimension('C')->setWidth(30); 
    $activeWorksheet->getColumnDimension('D')->setWidth(25);

    $citas = $app->readAll($id_usuario, $rol);

    if (empty($citas)) {
        throw new Exception("No hay citas disponibles para generar el informe.");
    }

    $activeWorksheet->setCellValue('A1', 'ID');
    $activeWorksheet->setCellValue('B1', 'Fecha Solicitud');
    $activeWorksheet->setCellValue('C1', 'Observaciones');
    $activeWorksheet->setCellValue('D1', 'Empresa');

    $row = 2;
    foreach ($citas as $cita) {
        $activeWorksheet->setCellValue('A' . $row, $cita['id_cita']);
        $activeWorksheet->setCellValue('B' . $row, $cita['fecha_solicitud']);
        $activeWorksheet->setCellValue('C' . $row, $cita['observaciones']);
        $activeWorksheet->setCellValue('D' . $row, $cita['empresa']);
        $row++;
    }

    $writer = new Csv($spreadsheet);
    $writer->save('citas.csv');

    $mensaje = "El archivo CSV ha sido generado con éxito.";
    $tipo_mensaje = "success";

} catch (Exception $e) {
    $mensaje = "Error al generar el archivo: " . $e->getMessage();
    $tipo_mensaje = "danger";
}

?>

<div class="container mt-4">
    <div class="alert alert-<?php echo $tipo_mensaje; ?>" role="alert">
        <?php echo $mensaje; ?>
    </div>
</div>
