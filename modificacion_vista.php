<?php require "layout_top.php";?>
<fieldset>
	<legend>Procesar formulario</legend>
	<form method="post" action="">
	<div class="alert alert-danger">
			1<?php
                foreach ($persona as $p) {
                    printf("%s %s %s", $p->nombre, $p->apellido, $p->fechnac);}
            ?>2
		</div>
		<?php if($form->tieneErrores()):?>
		<div class="alert alert-danger">
			Se encontraron errores al procesar el formulario.
		</div>
		<?php endif;?>
		<?php $tiene_error = $form->tieneError('nombre') ? "has-error" : "";?>
		<div class="form-group <?php echo $tiene_error;?>">
			<label class="control-label" for="nombre">Nombre </label>
			<input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $form->getValor("nombre");?>">
			<span class="help-block"><?php echo $form->getError('nombre');?></span>
		</div>

		<?php $tiene_error = $form->tieneError('apellido') ? "has-error" : "";?>
		<div class="form-group <?php echo $tiene_error;?>">
			<label class="control-label" for="apellido">apellido </label>
			<input type="text" class="form-control" name="apellido" id="apellido" value="<?php echo $form->getValor("apellido");?>">
			<span class="help-block"><?php echo $form->getError('apellido');?></span>
		</div>
		
		<?php $tiene_error = $form->tieneError('fecha') ? "has-error" : "";?>
		<div class="form-group <?php echo $tiene_error;?>">
			<label class="control-label" for="fecha">fecha </label>
			<input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo $form->getValor("fecha");?>">
			<span class="help-block"><?php echo $form->getError('fecha');?></span>
		</div>

		<?php $tiene_error = $form->tieneError('categoria') ? "has-error" : "";?>
		<div class="form-group <?php echo $tiene_error;?>">
			<label class="control-label" for="categoria">Categoría</label>
			<select class="form-control" name="categoria" id="categoria">
				<option value=""></option> 
				<?php foreach($form->categorias as $key => $item):?>
					<option value="<?php echo $key;?>" <?php echo $form->getSelected('categoria', $key);?>><?php echo $item;?></option> 
				<?php endforeach;?>
			</select>
			<span class="help-block"><?php echo $form->getError('categoria');?></span>
		</div>

		<?php $tiene_error = $form->tieneError('vigente') ? "has-error" : "";?>
		<div class="<?php echo $tiene_error;?>">
			<div class="checkbox">
			<label>
				<input type="checkbox" name="vigente" id="vigente" value="1" <?php echo $form->getChecked('vigente');?>>
			Vigente
			</label>
		</div>
		
		
		<p><button type="submit" class="btn btn-primary">Procesar formulario</button></p>
	</form>
</fieldset>
<?php require "layout_bottom.php";?>