<div class="sticky-wrapper">
	<div class="widget">
		<div class="widget-header">
			<i class="icon-list-alt"></i>
			<h3>Resultados de Estudios</h3>
		</div>
		<div class="widget-content">
			<div class="resultadoMicro" >
				<?php if (!empty($resultado)): ?>		
					
					<?php
						$bPrimero = false;
						$bComen = false;
						$sObserv = "";
						$sPrueba = "";
						$bMicro = false;
					?>
					
					<?php foreach ($resultado as $item): ?>
						<?php if ($item->prueba <> ""): ?>
							<!--PRUEBA-->
							<?php if ($bPrimero == true): ?>
								<?php if ($item->prueba != $sPrueba): ?>
									<?php if ($bComen == true): ?>
										<br><div class="tabPer2"><i><?=$sObserv ?></i></div>
									<?php endif; ?>
									
									<? if ($item->observacion != ""): ?>
										<?php
											$sObserv = $item->observacion;
											$bComen = True;
										?>
									<?php else: ?>
										<?php
											$sObserv = "";
											$bComen = false;
										?>
									<?php endif; ?>
								<?php endif; ?>
								
								<?php $sPrueba = $item->prueba; ?>
							<?php else: ?>
								<strong>Muestra Analizada: </strong> <?=$item->muestra ?>
								<br>
								<?php
									$sPrueba = $item->prueba;
									$bPrimero = True;
								?>
							<?php endif; ?>
							
							<br><div class="tabPer"><strong><?= $item->prueba ?></strong></div>
							
							<?php If ($item->resultado != "-") : ?>
								<br><div class="tabPer2"><?= $item->resultado ?></div>
							<?php endif; ?>
							
						<?php elseif ($item->medio != "") : ?>
							<!--MEDIO DE CULTIVO-->
							<br class="tabPer"><?=$item->resultado ?>
							<?php $bMicro = False; ?>
							
						<?php elseif ($item->antibiotico != "") : ?>
							
							<!--ANTIBIOGRAMA-->
							<?php If ($bMicro == False) : ?>
								<!--SI ES EL PRIMERO-->
								
								<?php $bMicro = True; ?>
								<br><div class="tabPer2"><?=$item->Antibiograma ?></div>
							<?php endif; ?>
							
							<!--sTemp = Rs("antibiotico")
							RellenarString sTemp, " ", CantPuntos-->
							<br><div class="tabPer2"><?= $item->resultado ?></div>
						<?php endif; ?>
					<?php endforeach; ?>
					
					<?php If ($bComen == true) : ?>
						<br><div class="tabPer2"><i><?=$sObserv ?></i></div>
					<?php endif; ?>
				<?php endif; ?>		
			</div>
		</div><!-- /.panel-body -->
	</div><!-- /.widget -->
</div><!-- /.sticky-wrapper -->
