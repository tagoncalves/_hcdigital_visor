
<form class="form">
	<fieldset>
		<div class="control-group">											
			<label class="control-label" for="modal-tipo">Tipo de Consulta</label>
			<div class="controls">
				<select id="modal-tipo" readonly>
					<option value="C" <?=($diagnostico[0] == 'C' ? 'selected' : '')?>>Consulta</option>
					<option value="U" <?=($diagnostico[0] == 'U' ? 'selected' : '')?>>Urgencia</option>
					<option value="D" <?=($diagnostico[0] == 'D' ? 'selected' : '')?>>Demanda espontanea</option>
				</select>
			</div> <!-- /controls -->				
		</div> <!-- /control-group -->
		<div class="control-group">											
			<label class="control-label" for="modal-motivo">Motivo de Consulta / Enfermedad actual:</label>
			<div class="controls">
				<textarea class="fullsize" readonly id="modal-diagnostico" ><?=(isset($diagnostico[3]) ? $diagnostico[3] : '')?></textarea>
			</div> <!-- /controls -->				
		</div> <!-- /control-group -->
		<div class="control-group">											
			<label class="control-label" for="modal-objetivos">Datos Objetivos:</label>
			<div class="controls">
				<textarea class="fullsize" readonly id="modal-objetivos" ><?=(isset($diagnostico[4]) ? $diagnostico[4] : '')?></textarea>
			</div> <!-- /controls -->				
		</div> <!-- /control-group -->
		
		
		<div class="control-group">											
			<label class="control-label" for="modal-plan">Plan y Tratamiento:</label>
			<div class="controls">
				<textarea class="fullsize" readonly id="modal-plan"><?=(isset($diagnostico[2]) ? $diagnostico[2] : '')?></textarea>
			</div> <!-- /controls -->				
		</div> <!-- /control-group -->
		<div class="control-group">											
			<label class="control-label" for="modal-diagnostico">Diagnostico:</label>
			<div class="controls">				
				<textarea class="fullsize" readonly id="modal-motivo" ><?=(isset($diagnostico[1]) ? $diagnostico[1] : '')?></textarea>
			</div> <!-- /controls -->				
		</div> <!-- /control-group -->
	</fieldset>
</form>