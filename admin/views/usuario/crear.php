<?php require ('views/header_admin/header_admin.php') ?>
<h1> <?php if($accion=="crear"):echo('Nuevo');else: echo('Modificar');endif; ?> Usuario </h1>
<form method="post" action="usuario.php?accion=modificar&id=<?php echo $id; ?>">
    <div class="mb-3">
        <label for="correo">Correo</label>
        <input type="email" name="data[correo]" id="correo" class="form-control" 
               value="<?php echo isset($usuario['correo']) ? htmlspecialchars($usuario['correo']) : ''; ?>" required>
    </div>
    <div class="mb-3">
        <label for="contrasena">Contraseña</label>
        <input type="password" name="data[contrasena]" id="contrasena" class="form-control" 
               placeholder="Escribe una nueva contraseña (opcional)">
    </div>
    <div class="mb-3">
        <label for="empresa">Empresa</label>
        <input type="text" name="data[empresa]" id="empresa" class="form-control" 
               value="<?php echo isset($empresa['empresa']) ? htmlspecialchars($empresa['empresa']) : ''; ?>" required>
    </div>
    <div class="mb-3">
        <label for="telefono">Teléfono</label>
        <input type="text" name="data[telefono]" id="telefono" class="form-control" 
               value="<?php echo isset($empresa['telefono']) ? htmlspecialchars($empresa['telefono']) : ''; ?>" required>
    </div>
    <div class="mb-3">
        <label for="rfc">RFC</label>
        <input type="text" name="data[rfc]" id="rfc" class="form-control" 
               value="<?php echo isset($empresa['rfc']) ? htmlspecialchars($empresa['rfc']) : ''; ?>" required>
    </div>
    <div class="mb-3">
        <label for="id_figura_fiscal">Figura Fiscal</label>
        <select name="data[id_figura_fiscal]" id="id_figura_fiscal" class="form-select" required>
            <?php foreach ($figura_fiscal as $figura): ?>
                <option value="<?php echo $figura['id_figura_fiscal']; ?>"
                    <?php echo isset($empresa['id_figura_fiscal']) && $empresa['id_figura_fiscal'] == $figura['id_figura_fiscal'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($figura['figura_fiscal']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <input type="submit" class="btn btn-success" name="data[enviar]" value="Guardar" />
</form>

<?php require('views/footer.php');?>