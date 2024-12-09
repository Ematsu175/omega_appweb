<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['id_usuario'])) {
        $_SESSION['mensaje'] = "Hay una sesión activa.";
        header("Location: /omega_appweb/admin/login.php");
        exit;
    }
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
<h1> <?php if($accion=="crear"):echo('Nueva');else: echo('Modificar');endif; ?> Cita </h1>
<?php if(isset($mensaje)):$app->alerta($tipo,$mensaje); endif; ?>
<form method="post" action="cita.php?accion=<?php if($accion=="crear"):echo('nuevo');else:echo('modificar&id='.$id);endif; ?>">
    <div class="mb-3">
        <label for="fecha" class="form-label">Fecha</label>
        <input type="date" class="form-control" name="data[fecha_solicitud]" id="fecha" 
            min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" 
            placeholder="Escribe aquí la fecha" value="<?php echo isset($citas['fecha_solicitud']) ? $citas['fecha_solicitud'] : ''; ?>"/>
        <span id="fecha-error" style="color: red; display: none;"></span>
    </div>
    <div class="mb-3">
        <label for="observaciones" class="form-label">Observaciones</label>
        <input type="text" class="form-control" name="data[observaciones]" placeholder="Escribe las observaciones" 
        value="<?php echo isset($citas['observaciones']) ? htmlspecialchars($citas['observaciones']) : ''; ?>" />
    </div>
    <div class="mb-3">
    <label for="id_empresa">Empresa</label>
    <select name="data[id_empresa]" id="id_empresa" class="form-select" 
        <?php echo in_array('Usuario', $roles) ? 'disabled' : ''; ?>>
        <?php if (in_array('Usuario', $roles)): ?>
            <option value="<?php echo $_SESSION['id_empresa']; ?>" selected>
                <?php echo $_SESSION['empresa_nombre']; ?>
            </option>
        <?php else: ?>
            <?php foreach ($empresa as $empresas): ?>
                <?php 
                    $selected = "";
                    if (isset($citas['id_empresa']) && $citas['id_empresa'] == $empresas['id_empresa']) {
                        $selected = "selected";
                    }
                ?>
                <option value="<?php echo $empresas['id_empresa']; ?>" <?php echo $selected; ?>>
                    <?php echo $empresas['empresa']; ?>
                </option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select>
    <?php if (in_array('Usuario', $roles)): ?>
        <input type="hidden" name="data[id_empresa]" value="<?php echo $_SESSION['id_empresa']; ?>" />
    <?php endif; ?>
</div>


    <input type="submit" class="btn btn-success" name="data[enviar]" value="Guardar" />
</form>
<?php
    //print_r($_SESSION);
    require ('views/footer.php'); 
?>