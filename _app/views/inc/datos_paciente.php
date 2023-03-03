
<div class="tabbable">
	<ul class="nav nav-tabs">
		  <li class="active"><a href="#paciente" data-toggle="tab">Datos</a></li>
		  <li><a href="#diagnostico" data-toggle="tab">Diagnostico</a></li>
		  <li><a href="#antecedentes" data-toggle="tab">Antecedentes</a></li>
		  
	</ul>
	
	<div class="tab-content">
		<div class="tab-pane active" id="paciente" data-ingreso="<?=$saf?>">
			<div class="form">
				<fieldset>
					<div class="control-group">											
						<label class="control-label" for="paciente-nombre">Paciente</label>
						<div class="controls">
							<input type="text" class="span5" id="paciente-nombre" value="<?=$ingreso[0] ?>" readonly />
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->		
					<div class="control-group">											
						<label class="control-label" for="paciente-entidad">Entidad</label>
						<div class="controls">
							<input type="text" class="span5" id="paciente-entidad" value="<?=$ingreso[1] . " - " . $ingreso[2] ?>" readonly />
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<div class="control-group">											
						<label class="control-label" for="paciente-afiliado">Afiliado</label>
						<div class="controls">
							<input type="text" class="span5" id="paciente-afiliado" value="<?=$ingreso[10] ?>" readonly />
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					
					<div class="form-actions">						
						<button name="volver" class="btn btn-sm">Volver</button>
					</div> <!-- /form-actions -->
				</fieldset>
			</div>
		</div>
		<div class="tab-pane" id="diagnostico">
			<form id="form-diagnostico" class="form">
				<input type="hidden" name="diag-id" value="<?=$id?>" />
				<input type="hidden" name="diag-ingreso" value="<?=$saf?>" />
				<input type="hidden" name="diag-hc" value="<?=$hc?>" />
				<input type="hidden" name="diag-turno" value="<?=$turno?>" />
				<fieldset>
					<div class="control-group">											
						<label class="control-label" for="firstname">Tipo de Consulta</label>
						<div class="controls">
							<select name="diag-tipo">
								<option value="C" <?=($diagnostico[0] == 'C' ? 'selected' : '')?>>Consulta</option>
								<option value="U" <?=($diagnostico[0] == 'U' ? 'selected' : '')?>>Urgencia</option>
								<option value="D" <?=($diagnostico[0] == 'D' ? 'selected' : '')?>>Demanda espontanea</option>
							</select>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<div class="control-group">											
						<label class="control-label" for="diag-motivo">Motivo de Consulta:</label>
						<div class="controls">
							<textarea class="fullsize" id="diag-motivo" name="diag-motivo" placeholder="Ingrese motivo de consulta"><?=$diagnostico[1] ?></textarea>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<div class="control-group">											
						<label class="control-label" for="diag-diagnostico">Diagnostico:</label>
						<div class="controls">
							<textarea class="fullsize" id="diag-diagnostico" name="diag-diagnostico" placeholder="Ingrese Diagnostico"><?=$diagnostico[2] ?></textarea>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<div class="control-group">											
						<label class="control-label" for="diag-plan">Plan y Tratamiento:</label>
						<div class="controls">
							<textarea class="fullsize" id="diag-plan" name="diag-plan" placeholder="Ingrese plan y tratamiento"><?=$diagnostico[3] ?></textarea>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Guardar</button> 
						<button class="btn">Cancelar</button>
					</div> <!-- /form-actions -->
				</fieldset>
			</form>
		</div>
		<div class="tab-pane" id="antecedentes">
			<?=print_r($antecedentes_mamo)  ?>

			<table class="table table-striped" id="antecedentes-table">
				<thead>
					<tr><th> Fecha </th><th> Profesional</th><th> Especialidad</th></tr>
				</thead>
				<tbody>					
					<?php
						foreach ($antecedentes as $i => $val) 
						{
							echo '<tr data-toggle="modal" data-target="#myModal" data-ingreso="' . $antecedentes[$i][5] . '"><td>' . $antecedentes[$i][0] . '</td><td>' . $antecedentes[$i][4] . '</td><td>' . $antecedentes[$i][2] . ' - ' . $antecedentes[$i][3] . '</td></tr>';
						}					
					?>

					<?php
						foreach ($antecedentes_mamo as $i => $val) 
						{
							echo '<tr><td>' . $val . '</td><td>' . "" . '</td><td>' . "" . ' - ' . "" . '</td></tr>';
						}					
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="myModalLabel">Diagn&oacute;stico</h3>
	</div>
	<div class="modal-body">

	
	
	
	
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>	
	</div>
</div>

