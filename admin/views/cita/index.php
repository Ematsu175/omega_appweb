<?php
    session_start(); 
    if (isset($_SESSION['roles'])) {
        $roles = array_column($_SESSION['roles'], 'rol');
        if (in_array('Administrador', $roles)) {
            require('views/header_admin/header_admin.php');
        } elseif (in_array('Usuario', $roles)) {
            require('views/header_user/header_user.php');
        } else {
            die('Acceso no autorizado.');
        }
    } else {
        header('Location: login.php');
        exit;
    }
?>
    <h1>Citas</h1>
    <?php if(isset($mensaje)):$app->alerta($tipo,$mensaje); endif; ?>
    <div style="padding-left: 75px">
        <a href="cita.php?accion=crear" class="btn btn-success" style="width: 200px;">Nuevo</a>
    </div>
    <table class="table table-hover table-dark" style="width: 90%; max-width: 1400px; margin: 0 auto;">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Fecha Solicitud</th>
                <th scope="col">Observaciones</th>
                <th scope="col">Empresa</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($citas as $cita):?>
            <tr>
                <th scope="row"><?php echo $cita['id_cita']; ?></th>
                <td><?php echo $cita['fecha_solicitud']; ?></td>
                <td><?php echo $cita['observaciones']; ?></td>
                <td><?php echo $cita['empresa']; ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <a href="cita.php?accion=actualizar&id=<?php echo $cita['id_cita']; ?>" class="btn btn-warning">Actualizar</a>
                        <a href="cita.php?accion=eliminar&id=<?php echo $cita['id_cita']; ?>" class="btn btn-danger">Eliminar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
<?php
    print_r($_SESSION);
    require ('views/footer.php'); 
?>