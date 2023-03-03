<?=$diagnostico ?>
<form class="form">
	<fieldset>
		<div class="form-inline">																								
			<label for="nro-informe">
				Nro. Informe<br />
				<input type="text" class="input-small" id="nro-informe" value="" readonly />
			</label>
			
			<label  for="nro-hc">
				HC: <br />
				<input type="text" class="input-small" id="nro-hc" value="" readonly />
			</label>
			
			<label  for="fechaInforme">
				Fecha: <br />
				<input type="text" class="input-small" id="fechaInforme" value="" readonly />
			</label>
			
			<label  for="edadInforme">
				Edad: <br />
				<input type="text" class="input-mini" id="edadInforme" value="" readonly />
			</label>
		</div> <!-- /control-group -->
	
		<div class="control-group">											
			<label class="control-label" for="pacNombre">Nombre</label>
			<div class="controls">
				<input type="text" class="span4" id="pacNombre" value="" readonly />
			</div> <!-- /controls -->				
		</div> <!-- /control-group -->		
		
		<div class="control-group">											
			<label class="control-label" for="entidadInf">Entidad</label>
			<div class="controls">
				<input type="text" class="span4" id="entidadInf" value="" readonly />
			</div> <!-- /controls -->				
		</div> <!-- /control-group -->	
		
		<div class="control-group">											
			<label class="control-label" for="profInforme">Profesional</label>
			<div class="controls">
				<input type="text" class="span4" id="profInforme" value="" readonly />
			</div> <!-- /controls -->				
		</div> <!-- /control-group -->
		
		<div class="control-group">											
			<label class="control-label" for="prescriptorInf">Prescriptor</label>
			<div class="controls">
				<input type="text" class="span4" id="prescriptorInf" value="" readonly />
			</div> <!-- /controls -->				
		</div> <!-- /control-group -->	
		
	</fieldset>
</form>