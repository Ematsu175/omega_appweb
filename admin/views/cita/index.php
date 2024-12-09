<?php
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
    <table class="table table-hover table-dark">
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha Solicitud</th>
            <th>Observaciones</th>
            <th>Empresa</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($citas as $cita): ?>
        <tr>
            <td><?php echo $cita['id_cita']; ?></td>
            <td><?php echo $cita['fecha_solicitud']; ?></td>
            <td><?php echo htmlspecialchars($cita['observaciones']); ?></td>
            <td><?php echo $cita['empresa']; ?></td>
            <td>
                <a href="cita.php?accion=actualizar&id=<?php echo $cita['id_cita']; ?>" class="btn btn-warning">Actualizar</a>
                <a href="cita.php?accion=eliminar&id=<?php echo $cita['id_cita']; ?>" class="btn btn-danger">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
    require ('views/footer.php'); 
?>