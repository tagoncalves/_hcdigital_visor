<div class="sticky-wrapper">
	<div class="widget">
		<div class="widget-header">
			<i class="icon-list-alt"></i>
			<h3>Detalle de solicitud</h3>
		</div>
		<div class="widget-content">
			<div class="form-inline">
				<?php if (!empty($cabecera)): ?>
					
					<label for="solicitud-fecha">
						Fecha y Hora
						<br>
						<input type="text" class="input-small" id="solicitud-fecha" name="solicitud-fecha" value="<?= date_format(date_create($cabecera->Fecha), 'd-m-Y H-i') ?>" readonly />
					</label>
					
					<label for="solicitud-solicitante">
						Solicitante
						<br>
						<input type="text" class="form-control input-sm" id="solicitud-solicitante" name="solicitud-solicitante" value="<?= str_replace("-"," - ",$cabecera->Solicitante) ?>" readonly />
					</label>
					

					<label for="solicitud-sector">
						Sector
						<br>
						<input type="text" class="input-small" id="solicitud-sector" name="solicitud-sector" value="<?= ($cabecera->sector == '89') ? 'Laboratorio Gral.' : 'Microbiologia' ?>" readonly />
					</label>
				<?php endif; ?>
			</div>
		</div><!-- /.panel-body -->
	</div><!-- /.widget -->
</div><!-- /.panel -->