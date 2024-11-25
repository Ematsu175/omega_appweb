<?php require ('views/header_admin/header_admin.php') ?>
    <h1>Usuarios</h1>
    <?php if(isset($mensaje)):$app->alerta($tipo,$mensaje); endif; ?>
    <div style="padding-left: 60px;">
        <a href="usuario.php?accion=crear" class="btn btn-success" style="width: 200px;">Nuevo</a>
    </div>
    <table class="table table-hover table-dark" style="width: 900%; max-width: 1400px; margin: 0 auto;">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Usuario</th>
                <th scope="col">Opciones</th>

            </tr>
        </thead>
        <tbody>
        <?php foreach($usuario as $usuarios):?>
            <tr>
                <th scope="row"><?php echo $usuarios['id_usuario']; ?></th>
                <th scope="row"><?php echo $usuarios['correo']; ?></th>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <a href="usuario.php?accion=actualizar&id=<?php echo $usuarios['id_usuario']; ?>" class="btn btn-warning">Actualizar</a>
                        <a href="usuario.php?accion=eliminar&id=<?php echo $usuarios['id_usuario']; ?>" class="btn btn-danger">Eliminar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    
<?php require ('views/footer.php') ?>