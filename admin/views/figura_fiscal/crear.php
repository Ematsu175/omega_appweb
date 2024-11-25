<?php require('views/header.php'); ?>
<h1> <?php if($accion=="crear"):echo('Nueva');else: echo('Modificar');endif; ?> Figura Fiscal </h1>
<form method="post" action="figura_fiscal.php?accion=<?php if($accion=="crear"):echo('nuevo');else:echo('modificar&id='.$id);endif; ?>">
    <div class="mb-3">
        <label for="figura_fiscal" class="form-label">Figura Fiscal</label>
        <input type="text" class="form-control" name="data[figura_fiscal]" placeholder="Escribe aqui el correo de la figura fiscal" 
        value="<?php if(isset($figura_fiscal['figura_fiscal'])):echo($figura_fiscal['figura_fiscal']);endif; ?>" />
    </div>
    
    <input type="submit" class="btn btn-success" name="data[enviar]" value="Guardar" />
</form>

<?php require('views/footer.php');?>