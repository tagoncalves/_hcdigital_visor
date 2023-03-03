
<?

$punciones = explode("^",$diagnostico['preguntas'][5]);
$operaciones = explode("^",$diagnostico['preguntas'][6]);
$tratamiento  = explode("^",$diagnostico['preguntas'][2]);

?>

<form class="form">
	<!--<fieldset>
		<button type="button" class="btn btn-warning">HC. Mamografia</button> 
	</fieldset>
	<div style="clear:both"></div> -->
	
	<fieldset>
		
		<div class="control-group">											
			<label class="control-label" for="mamo-diagnostico">Motivo de Consulta:</label>
			<div class="controls">
				<textarea style="text-transform: uppercase;" class="fullsize" id="mamo-diagnostico" name="mamo-diagnostico" placeholder="Ingrese motivo de consulta" readonly><?=$diagnostico['diagnostico'][0]?></textarea>														
			</div> <!-- /controls -->				
		</div> <!-- /control-group -->
		
		<div class="control-group">											
			<label class="control-label" for="mamo-antecedentes">Antecedentes Familiares:</label>
			<div class="controls">
				<textarea style="text-transform: uppercase;" class="fullsize" id="mamo-antecedentes" name="mamo-antecedentes" placeholder="Ingrese antecedentes familiares" readonly><?=$diagnostico['diagnostico'][1]?></textarea>
			</div> <!-- /controls -->				
		</div> <!-- /control-group -->
	</fieldset>
	<fieldset>
		<p><h4>Preguntas</h4></p>
		<div class="form-inline">
		
			<div class="controls span1" style="margin:0;width:25%">
				<label class="control-label" for="mamo-hijos">Hijos: </label>
				<input id="mamo-hijos" type="checkbox" name="mamo-hijos" class="cmn-toggle cmn-toggle-round" <?=($diagnostico['preguntas'][0]==1)? 'checked' : ''?>/>
				<label for="mamo-hijos"></label>
			</div>		
			<div class="controls span1" style="margin:0;width:25%" >
				<label class="control-label" for="mamo-hormonas">Hormonas: </label>
				<input id="mamo-hormonas" type="checkbox" name="mamo-hormonas" class="cmn-toggle cmn-toggle-round" <?=($diagnostico['preguntas'][3]==1)? 'checked' : ''?>/>
				<label for="mamo-hormonas"></label>
			</div>	
			<div class="controls span1" style="margin:0;width:25%">
				<label class="control-label" for="mamo-lactancia">Lactancia: </label>
				<input id="mamo-lactancia" type="checkbox" name="mamo-lactancia" class="cmn-toggle cmn-toggle-round" <?=($diagnostico['preguntas'][1]==1)? 'checked' : ''?>/>
				<label for="mamo-lactancia"></label>
			</div>	
			<div class="controls span1" style="margin:0;width:25%">
				<label class="control-label" for="mamo-menopausia">Menopausia: </label>
				<input id="mamo-menopausia" type="checkbox" name="mamo-menopausia" class="cmn-toggle cmn-toggle-round" <?=($diagnostico['preguntas'][4]==1)? 'checked' : ''?>/>
				<label for="mamo-menopausia"></label>
			</div>
		</div>
		<div style="clear:both"></div> 
		<hr />
		<div class="form-inline">
			<div class="controls span1" style="margin:0;width:25%">
				<label class="control-label" for="mamo-operaciones">Oper. Realizadas: </label>
				<input id="mamo-operaciones" type="checkbox" name="mamo-operaciones" class="cmn-toggle cmn-toggle-round"  <?=($operaciones[0] == 1) ? 'checked' : ''?>  />
				<label for="mamo-operaciones"></label>
			</div>	
			
			<div class="controls span1" style="margin:0;width:30%">
				<label class="control-label" for="mamo-fecoper">Fecha: </label><br />
				<div class="input-append date">
					<input id="mamo-fecoper" name="mamo-fecoper"  class="input-small" readonly  value="<?=$operaciones[1]?>"/><span class="add-on" style="margin:0"><i class="icon-th"></i></span>
				</div>
			</div>
			<div class="controls span1" style="margin:0;width:20%">
				<label class="control-label" for="mamo-operiz">Mama iz.: </label>
				<input id="mamo-operiz" type="checkbox" name="mamo-operiz" class="cmn-toggle cmn-toggle-round" <?=($operaciones[2] == 1) ? 'checked' : ''?>/>
				<label for="mamo-operiz"></label>
			</div>	
			<div class="controls span1" style="margin:0;width:20%">
				<label class="control-label" for="mamo-operaciones">Mama der.: </label>
				<input id="mamo-operder" type="checkbox" name="mamo-operder" class="cmn-toggle cmn-toggle-round" <?=($operaciones[3] == 1) ? 'checked' : ''?>/>
				<label for="mamo-operder"></label>
			</div>	
		
		</div>
		<div style="clear:both"></div> 
		<hr />
		<div class="form-inline">
			<div class="controls span1" style="margin:0;width:25%">
				<label class="control-label" for="mamo-punciones">Punciones: </label>
				<input id="mamo-punciones" type="checkbox" name="mamo-punciones" class="cmn-toggle cmn-toggle-round" <?=($punciones[0] == 1) ? 'checked' : ''?> />
				<label for="mamo-punciones"></label>
			</div>	

			<div class="controls span1" style="margin:0;width:30%">
				<label class="control-label" for="mamo-fecpun">Fecha: </label><br />
				<div class="input-append date">
					<input id="mamo-fecpun" name="mamo-fecpun"  class="input-small" readonly  value=" <?=$punciones[1]?>"/><span class="add-on" style="margin:0"><i class="icon-th"></i></span>
				</div>
			</div>
			<div class="controls span1" style="margin:0;width:20%">
				<label class="control-label" for="mamo-puniz">Mama iz.: </label>
				<input id="mamo-puniz" type="checkbox" name="mamo-puniz" class="cmn-toggle cmn-toggle-round" <?=($punciones[2] == 1) ? 'checked' : ''?>/>
				<label for="mamo-puniz"></label>
			</div>	
			<div class="controls span1" style="margin:0;width:20%">
				<label class="control-label" for="mamo-punder">Mama der.: </label>
				<input id="mamo-punder" type="checkbox" name="mamo-punder" class="cmn-toggle cmn-toggle-round" <?=($punciones[3] == 1) ? 'checked' : ''?>/>
				<label for="mamo-punder"></label>
			</div>	
			
			<div class="control-group">											
				<label class="control-label" for="mamo-diagnostico">Observacion:</label>
				<div class="controls">
					<textarea style="text-transform: uppercase;" class="fullsize" id="mamo-puncionObs" readonly name="mamo-puncionObs" placeholder=""><?=$punciones[4]?></textarea>														
				</div> <!-- /controls -->				
			</div>

		</div>
		<div style="clear:both"> </div>
		<hr />
		<div class="form-inline">
		
			<div class="controls span1" style="margin:0;width:25%">
				<label class="control-label" for="mamo-tratamiento">Tratamiento: </label>
				<input id="mamo-tratamiento" type="checkbox" name="mamo-tratamiento" class="cmn-toggle cmn-toggle-round" <?=($tratamiento[0]==1)? 'checked' : ''?>/>
				<label for="mamo-tratamiento"></label>
			</div>	
		</div>
		<div style="clear:both"></div>
		
		<div class="controls span1" style="margin:0;width:25%">
			<label class="control-label" for="mamo-tamoxifeno">Tamoxifeno: </label>
			<input id="mamo-tamoxifeno" type="checkbox" name="mamo-tamoxifeno" class="cmn-toggle cmn-toggle-round" <?=($tratamiento[1]==1)? 'checked' : ''?>/>
			<label for="mamo-tamoxifeno"></label>
		</div>		
		
		<div class="controls span1" style="margin:0;width:25%" >
			<label class="control-label" for="mamo-quimioterapia">Quimioterapia: </label>
			<input id="mamo-quimioterapia" type="checkbox" name="mamo-quimioterapia" class="cmn-toggle cmn-toggle-round" <?=($tratamiento[2]==1)? 'checked' : ''?>/>
			<label for="mamo-quimioterapia"></label>
		</div>	
		<div class="controls span1" style="margin:0;width:25%">
			<label class="control-label" for="mamo-radioterapia">Radioterapia: </label>
			<input id="mamo-radioterapia" type="checkbox" name="mamo-radioterapia" class="cmn-toggle cmn-toggle-round" <?=($tratamiento[3]==1)? 'checked' : ''?>/>
			<label for="mamo-radioterapia"></label>
		</div>	
		<div class="controls span1" style="margin:0;width:25%">
			<label class="control-label" for="mamo-acelerador">Acelerador Lineal: </label>
			<input id="mamo-acelerador" type="checkbox" name="mamo-acelerador" class="cmn-toggle cmn-toggle-round" <?=($tratamiento[4]==1)? 'checked' : ''?>/>
			<label for="mamo-acelerador"></label>
		</div>
		<div class="controls span1" style="margin:0;width:25%">
			<label class="control-label" for="mamo-neoadyuvancia">Neoadyuvancia: </label>
			<input id="mamo-neoadyuvancia" type="checkbox" name="mamo-neoadyuvancia" class="cmn-toggle cmn-toggle-round" <?=($tratamiento[5]==1)? 'checked' : ''?>/>
			<label for="mamo-neoadyuvancia"></label>
		</div>

		<div class="controls span1" style="margin:0;width:25%">
			<label class="control-label" for="mamo-otros">Otros: </label>
			<input style="text-transform: uppercase;" id="mamo-otros" type="text" name="mamo-otros" class="input-medium" value="<?=$tratamiento[6]?>" readonly/>															
		</div>

		<div style="clear:both"></div> 
		
		
		
	</fieldset>
</form>
											
									