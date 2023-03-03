<div class="alert alert-danger" id="msjTurError" role="alert" style="display: none;">
</div>	
<div class="alert alert-success" id="msjTurMsg" role="alert" style="display: none;">
</div>

<div id="disponibilidad-filtro">
	<form class="form-inline">
		<label>
			Fecha desde: <br /><input id="fecha-desde" name="fecha-desde" type="date" class="input-small" />
		</label>
		<label>
			Fecha hasta: <br /><input id="fecha-hasta" name="fecha-hasta" type="date" class="input-small" />
		</label>
		<button type="submit" class="btn btn-success" id="btn-buscar-disponibilidad">Buscar</button>
    </form>
</div>
<div id="disponibilidad-lista">
	<table class="table table-striped" id="disponibilidad-table">
		<thead>
			<tr><th>&nbsp;</th><th> Fecha <span class="icon-sort"></span></th><th style="white-space: nowrap"> Hora <span class="icon-sort"></span></th><th> Profesional <span class="icon-sort"></span></th><th> Especialidad <span class="icon-sort"></span></th></tr>
		</thead>
		<tbody>	
			<? if (!empty($disponibilidad)): ?>
				<? foreach($disponibilidad as $key=>$item): ?>					
					<tr><td><input type="checkbox" name="turno<?=$key?>" /> </td><td><?= $item[1] ?></td><td><?= $item[2] ?></td><td><?= $item[0] . " - " . $item[3] ?></td><td><?= $servicio ?></td></tr>
				<? endforeach; ?>
			<? endif; ?>
		</tbody>
	</table>
</div>
<div class="form-actions">
	<button type="submit"  id="btn-dar-turnos" class="btn btn-success">Guardar</button> 
	<button type="button" name="cancelar" class="btn">Cancelar</button>
</div> <!-- /form-actions -->