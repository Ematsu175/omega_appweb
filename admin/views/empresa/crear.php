<?php require('views/header.php'); ?>
<h1> <?php if($accion=="crear"):echo('Nuevo');else: echo('Modificar');endif; ?> Empresa </h1>
<form method="post" action="empresa.php?accion=<?php if($accion=="crear"):echo('nuevo');else:echo('modificar&id='.$id);endif; ?>">
    <div class="mb-3">
        <label for="empresa" class="form-label">Nombre de la empresa</label>
        <input type="text" class="form-control" name="data[empresa]" placeholder="Escribe aqui el nombre de la empresa" 
        value="<?php if(isset($empresas['empresa'])):echo($empresas['empresa']);endif; ?>" />
    </div>
    <div class="mb-3">
        <label for="telefono" class="form-label">Telefono</label>
        <input type="number" class="form-control" name="data[telefono]" placeholder="Escribe aqui el telefono" 
        value="<?php if(isset($empresas['telefono'])):echo($empresas['telefono']);endif; ?>" />
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" name="data[email]" placeholder="Escribe aqui el email" 
        value="<?php if(isset($empresas['email'])):echo($empresas['email']);endif; ?>" />
    </div>
    <div class="mb-3">
        <label for="rfc" class="form-label">RFC</label>
        <input type="text" class="form-control" name="data[rfc]" placeholder="Escribe aqui el RFC" 
        value="<?php if(isset($empresas['rfc'])):echo($empresas['rfc']);endif; ?>" />
    </div>
    <div class="mb-3">
        <label for="" >Figura Fiscal</label>
        <select name="data[id_figura_fiscal]" id="id_figura_fiscal" class="form-select">
            <?php foreach($figura_fiscal as $figuras_fiscales): ?>
            <?php 
                $selected="";
                if($empresas['id_figura_fiscal'] == $figuras_fiscales['id_figura_fiscal']){
                    $selected = "selected";
                }
            ?>
            <option value="<?php echo($figuras_fiscales['id_figura_fiscal']); ?>" <?php echo($selected); ?> ><?php echo($figuras_fiscales['figura_fiscal']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <input type="submit" class="btn btn-success" name="data[enviar]" value="Guardar" />
</form>

<?php require('views/footer.php');?>