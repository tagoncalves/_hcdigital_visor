<html>
	<body style="font-size: 8px; font-family: Arial;">
	
		<div style="border-style: solid; border-width: 1px;">
			<div style="border-bottom-style: solid; border-bottom-width: 1px;">
				<div style="text-align: center; font-weight: bold; font-size: 16px; margin-top: 5px;">PARTE QUIRURGICO</div>
				<div style="text-align: right; font-size: 10px; margin: 5px;"><?=date("d/m/Y"); ?></div>
			</div>
			<div style="border-bottom-style: solid; border-bottom-width: 1px;">
				<div style="margin: 10px; line-height: 2; margin-bottom: 5px; margin-top: 5px;">
					<? $paciente = explode("^",$pac); ?>
					<? $diag = explode("^",$diagnostico); ?>
					<div style="width: 74%; float: left;">
						<b>PACIENTE:</b> <?=$paciente[0]; ?> <br />
						<b>COBERTURA:</b> <?=$paciente[3]; ?> <br />
						<b>HORA DE INICIO:</b> <?=$diag[1]; ?> <br />
					</div>
					<div style="width: 25%; float: left;">
						<b>NRO. REGISTRO:</b> <?=$hc; ?> <br />
						<b>AFILIADO:</b> <?=$paciente[4]; ?> <br />
						<b>HORA DE FINALIZACION:</b> <?=$diag[2]; ?> <br />
					</div>
					<div style="clear:both;"></div>
					<b>DIAGNOSTICO PREOPERATORIO:</b> <?=$diag[0]; ?> <br />
					<b>DIAGNOSTICO DE EGRESO:</b> <?=$diag[3]; ?> <br />
				</div>
			</div>
			<div style="margin: 10px;">
				<? $profs = explode("^",$profesionales); ?>
				<div style="font-weight: bold; font-size: 10px;">CUERPO MEDICO: </div><br />
				<div style="width: 50%; float: left; line-height: 2;">
					<b>INSTRUMENTADOR:</b> <?=$profs[0]; ?> <br />
					<b>ANESTESIA:</b> <?=$profs[1]; ?> <br />
					<b>ASISTENTE 1:</b> <?=$profs[4]; ?> <br />
					<b>MONITORISTA:</b> <?=$profs[6]; ?> <br />
				</div>
				<div style="width: 49%; float: left; line-height: 2;">
					<b>ANESTESISTA:</b> <?=$profs[2]; ?> <br />
					<b>TRANSFUSIONISTA:</b> <?=$profs[3]; ?> <br />
					<b>ASISTENTE 2:</b> <?=$profs[5]; ?> <br />
				</div>
				<br style="clear:both;"><br />
				
				<? $titu = explode("^",$titulo); ?>
				
				<div style="font-weight: bold; font-size: 10px;">DETALLE DE CIRUGIA: </div><br />
				<div style="font-weight: bold; font-size: 10px; text-align: center;"><?=$titu[1]; ?></div><br />
				<div style="margin: 20px; text-align: justify; line-height: 2; margin-bottom: 5px; margin-top: 5px; height: 180px;">
					<?=$rtb; ?>
				</div>
				
				<? $proc = explode("^",$procedimiento); ?>
				
				<div style="width: 50%; float: left; line-height: 2;">
					<b>SUTURAS:</b> <?=$proc[0]; ?> <br />
					<b>CONDICION POST-OPERATORIA:</b> <?=$proc[2]; ?> <br />
				</div>
				<div style="width: 49%; float: left; line-height: 2;">
					<b>DRENAJE:</b> <?=$proc[1]; ?> <br />
					<b>BIOPSIA:</b> <?= ($proc[3] == "1" ? "SI" : "NO"); ?> <br />
				</div>
				<br style="clear:both;" />
				
				<? $honor = explode("|",$honorarios); ?>
				
				<div style="font-weight: bold; font-size: 10px;">HONORARIOS: </div><br />
				<div style="height: 120px;">
					<table border="0" width="100%">
						<tr style="font-weight: bold;"><td>HONORARIO</td><td>CANTIDAD</td><td>VIA DE ABORDAJE</td><td>UNIDAD</td><td>COD. SLL</td></tr>
						<?php foreach ($honor as $item): ?>
							<? $itm = explode("^",$item); ?>
							
							<tr><td><?=$itm[0]; ?></td><td><?=$itm[1]; ?></td><td><?=$itm[2]; ?></td><td><?=$itm[3]; ?></td><td><?=$itm[4]; ?></td></tr>
						<?php endforeach; ?>
					</table>
				</div>
				
				<br />
				<div style="height: 100px; text-align: justify; line-height: 2; ">
					Con relacion a las practicas medicas que efectue durante la presente internacion, declaro: A) que las realizo ejerciendo libremente
					mi profesion, sin dependencia juridica de la Clinica Las Lomas; B) que no tengo vinculo o relacion alguna con la Clinica Las Lomas;
					C) que mis servicios profesionales no han sido contratados por la Clinica Las Lomas; que asumo integra y plenamente la
					responsabilidad emergente de dichas practicas y por consecuencias que de ellas de deriven; E) que por consiguiente desligo a la
					Clinica Las Lomas de toda responsabilidad y me obligo a mantener indemne a esta por las consecuencias resultantes de mis actos.
				</div>
				<br />
				
				<? $prof = explode("^", $profesional); ?>
	
				<div style="height: 100px; width: 100%;">
					<div style="width: 33%; display: inline-block; text-align: center; float:left; padding-top: 60px;" >
						<?=$prof[1]; ?>
						<hr style="width: 200px;"/>
						NOMBRE Y APELLIDO DEL MEDICO
					</div>
					
					<div style="width: 33%; display: inline-block; text-align: center; float:left; padding-top: 71px;" >
						<hr style="width: 200px;"/>
						FIRMA
					</div>
					
					
					<div style="width: 33%; display: inline-block; text-align: center; float:left; padding-top: 60px;" >
						<?=$prof[0]; ?>
						<hr style="width: 200px;"/>
						MATRICULA DEL PROFESIONAL
					</div>
				</div>
			</div>
		</div>
		<div style="margin-top: 4px">SANATORIO LAS LOMAS - Av. Diego Carman 555 - San Isidro (1642) - Tel: 4129-5500 / 4708-5000</div>
	</body>
</html>