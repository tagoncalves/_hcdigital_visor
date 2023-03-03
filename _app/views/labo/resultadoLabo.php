<div class="sticky-wrapper">
	<div class="widget">
		<div class="widget-header">
			<i class="icon-list-alt"></i>
			<h3>Resultados de Estudios</h3>
		</div>
		<div class="widget-content">
			<table class="table table-striped table-hover pointer table-responsive table-condensed no-margin-b" id="resultados">
				<thead>
					<tr>
						<th style="white-space: nowrap;">Prueba</th>
						<th style="white-space: nowrap;">Resultado</th>
						<th style="white-space: nowrap;">Referencia</th>
					</tr>
				</thead>
				<tbody id="resultadosBody">	
					<?php
						$temp = "";
						$cat = "";
					?>
					
					<?php if (!empty($resultado)): ?>
						<?php foreach ($resultado as $item): ?>
							
							<?php 
								$temp = explode("^", $item->orden); 
								$temp = $temp[1];
							?>
							
							<?php if ($temp != $cat): ?>
								<tr><td class="tituloLab" colspan="3"><?=$temp ?></td></tr>
								<?php $cat = $temp ?>
							<?php else: ?>	
								<tr>
									<td><?= $item->prueba ?></td>
									<td><?= $item->resultado ?></td>
									<td><?= $item->referencia ?></td>
								</tr>
								<?php if ($item->comentario != ""): ?>
									<tr><td class="comentarioLabo" colspan="3"><?= $item->comentario ?></td></tr>
								<?php endif; ?>	
							<?php endif; ?>	
							
						<?php endforeach; ?>
					<?php endif; ?>				
				</tbody>                             
			</table>
		</div>
	</div><!-- /.widget -->
</div><!-- /.panel -->