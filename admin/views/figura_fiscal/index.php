<?php require ('views/header_admin/header_admin.php') ?>
    <h1>Figuras Fiscales</h1>
    <?php if(isset($mensaje)):$app->alerta($tipo,$mensaje); endif; ?>
    <div style="padding-left: 50px;">
        <a href="figura_fiscal.php?accion=crear" class="btn btn-success" style="width: 200px;">Nuevo</a>
    </div>
    <table class="table table-hover table-dark" style="width: 900%; max-width: 1400px; margin: 0 auto;">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Figuras Fiscales</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($figura_fiscal as $figuras_fiscales):?>
            <tr>
                <th scope="row"><?php echo $figuras_fiscales['id_figura_fiscal']; ?></th>
                <td><?php echo $figuras_fiscales['figura_fiscal']; ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <a href="figura_fiscal.php?accion=actualizar&id=<?php echo $figuras_fiscales['id_figura_fiscal']; ?>" class="btn btn-warning">Actualizar</a>
                        <a href="figura_fiscal.php?accion=eliminar&id=<?php echo $figuras_fiscales['id_figura_fiscal']; ?>" class="btn btn-danger">Eliminar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
<?php require ('views/footer.php') ?>