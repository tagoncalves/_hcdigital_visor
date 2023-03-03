<table class="table table-striped table-bordered" id="solicitudes">
	<thead>
		<tr>
			<th>Est</th>
			<th style="white-space: nowrap;">Fecha<span class="icon-sort"></span></th>
			<th style="white-space: nowrap;">Protocolo<span class="icon-sort"></span></th>
			<th style="white-space: nowrap;" data-placeholder="Seleccione profesional">Solicitante<span class="icon-sort"></span></th>
			<th style="white-space: nowrap;" data-placeholder="Seleccione sector">Sector<span class="icon-sort"></span></th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody id="solicitudesBody">	
		<?php if (!empty($solicitudes)): ?>
			<?php foreach ($solicitudes as $item): ?>
				<tr class="abrirSolicitud" data-id="<?= $item->sector.$item->protocolo ?>">
					<td><span class="icono icon-circle <?= ($item->Estado == 'Final') ? 'iconFinal' : (($item->Estado == 'Parcial') ? 'iconParcial' : 'iconPendiente') ?> "></span></td>
					<td><?= $item->Fecha ?></td>
					<td><?= $item->protocolo ?></td>
					<td><?= $item->Solicitante ?></td>
					<td><?= ($item->sector == '89') ? 'Lab. Gral.' : 'Microb.' ?></td>
					<td class="tdOption">
						<?php if (!empty($item->archivo)): ?>
							<a href="#" class="openPDF" data-url="<?=base_url('estudios/getArchivoEstudio/'.$item->archivo) ?>"><span class="icon-file"></span></a>
						<?php endif; ?>
						<? if($item->Estado == 'Final' || $item->Estado == 'Parcial') : ?>
							<a href="#" class="abrirResultado" data-id="<?= $item->sector.$item->protocolo ?>" data-estado="<?= $item->Estado ?>"><span class="icon-search"></span></a>
						<? endif; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>	
		<?php if (!empty($solPasaje)): ?>
			<?php foreach ($solPasaje as $item): ?>
				<tr class="abrirSolicitud" data-id="<?= $item->sector.$item->protocolo ?>">
					<td><span class="icono icon-circle <?= ($item->Estado == 'Final') ? 'iconFinal' : (($item->Estado == 'Parcial') ? 'iconParcial' : 'iconPendiente') ?> "></span></td>
					<td><?= $item->Fecha ?></td>
					<td><?= $item->protocolo ?></td>
					<td><?= $item->Solicitante ?></td>
					<td><?= ($item->sector == '89') ? 'Lab. Gral.' : 'Microb.' ?></td>
					<td class="tdOption">
						<?php if (!empty($item->archivo)): ?>
							<a href="#" class="openPDF" data-url="<?=base_url('estudios/getArchivoEstudio/'.$item->archivo) ?>"><span class="icon-file"></span></a>
						<?php endif; ?>
						<? if($item->Estado == 'Final' || $item->Estado == 'Parcial') : ?>
							<a href="#" class="abrirResultado" data-id="<?=$item->sector.$item->protocolo ?>" data-estado="<?= $item->Estado ?>"><span class="icon-search"></span></a>
						<? endif; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>				
		<?php if (!empty($estudios)): ?>
			<?php foreach ($estudios as $item): ?>
				<tr class="abrirSolicitud">
					<td><span class="icono-xl iconFinal icon-file"></span></td>
					<td><?= $item['FECPET'] ?></td>
					<td><?= $item['PRO'] ?></td>
					<td><?= $item['SOL'] ?></td>
					<td><?= $item['SEC'] ?></td>
					<td class="tdOption">
						<a href="#" class="abrirInforme" data-id="<?= $item['PRO'] ?>" data-sector="<?= $item['SEC'] ?>"><span class="icon-search"></span></a>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
		<?php if (!empty($archivosant)): ?>
			<?php foreach ($archivosant as $item): ?>
				<tr class="abrirArchivo" data-filename="<?=basename($item[2]) ?>" data-archivo="<?= $item[2] ?>">
					<td><span class="icono-xl iconParcial icon-file"></span></td>
					<td><?=$item[0] ?></td>
					<td></td>
					<td><?=$item[1] ?></td>
					<td></td>
					<td class="tdOption">
						<a href="#"><span class="icon-search"></span></a>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>

		<?php if (!empty($archivos)): ?>
			<?php foreach ($archivos as $item): ?>
				<tr class="abrirAntecedente" data-archivo="<?= $item["archivo"] ?>">
					<td><span class="icono-xl iconPendiente icon-file"></span></td>
					<td><?=$item["fecha"] ?></td>
					<td><?=$item["archivo"] ?></td>
					<td></td>
					<td></td>
					<td class="tdOption">
						<a href="#"><span class="icon-search"></span></a>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>


	</tbody>                             
</table>