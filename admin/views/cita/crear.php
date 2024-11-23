<?php require('views/header.php'); ?>
<h1> <?php if($accion=="crear"):echo('Nueva');else: echo('Modificar');endif; ?> Cita </h1>
<form method="post" action="cita.php?accion=<?php if($accion=="crear"):echo('nuevo');else:echo('modificar&id='.$id);endif; ?>">
    <div class="mb-3">
        <label for="fecha" class="form-label">Fecha</label>
        <input type="date" class="form-control" name="data[fecha_solicitud]" placeholder="Escribe aqui la fecha" 
        value="<?php if(isset($citas['fecha_creacion'])):echo($citas['fecha_creacion']);endif; ?>" />
    </div>
    <div class="mb-3">
        <label for="observaciones" class="form-label">Observasiones</label>
        <input type="text" class="form-control" name="data[observaciones]" placeholder="Escribe las observaciones" 
        value="<?php if(isset($citas['observaciones'])):echo($citas['observaciones']);endif; ?>" />
    </div>
    <div class="mb-3">
        <label for="" >Empresa</label>
        <select name="data[id_empresa]" id="id_empresa" class="form-select">
            <?php foreach($empresa as $empresas): ?>
            <?php 
                $selected="";
                if($citas['id_empresa'] == $empresas['id_empresa']){
                    $selected = "selected";
                }
            ?>
            <option value="<?php echo($empresas['id_empresa']); ?>" <?php echo($selected); ?> ><?php echo($empresas['empresa']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <input type="submit" class="btn btn-success" name="data[enviar]" value="Guardar" />
</form>

