<section class="sitio-main">
	<div class="account-container">	
		<div class="content clearfix">		
			<form action="<?= base_url("/user/selectConsul") ?>" method="post" autocomplete="off" >		
				<h2>Seleccione Consultorio</h2>		
				<div class="login-fields">				
					<?php if (isset($error)) : ?>	
						<br />
						<div class="alert alert-danger" role="alert">
							<?= $error ?>
						</div>
					<?php endif; ?>
					<br />			
					<p>Por favor, seleccione la ubicacion donde se encuentra.
					<?php if($this->session->userdata('consul') != "-") : ?>
						<br />Su ubicacion actual es: <?=$this->session->userdata('consul')  ?>
					<?php endif; ?>
					</p>
					
					<div class="control-group">											
						<label class="control-label" for="cboUbicacion">Oficina:</label>
						<div class="controls">
							<select name="cboUbicacion" id="cboUbicacion" class="span3">
								<?php if (!empty($consultorios)): ?>
									<?php foreach ($consultorios as $item): ?>
										<option value="<?=$item["id"] ?>"><?=$item["oficina"]; ?></option>
									<?php endforeach; ?>
								<?php endif; ?>	
							</select>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
					
					<div class="control-group">											
						<label class="control-label" for="cboBox">Consultorio:</label>
						<div class="controls">
							<select name="cboBox" id="cboBox" class="span3">
								
							</select>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
				</div> <!-- /login-fields -->
				<div class="login-actions">
					<button id="btn-confirmar" class="button btn btn-danger btn-large" disabled="true">Confirmar</button>
				</div> <!-- .actions -->
				<?php if($this->session->userdata('consul') != "-") : ?>
					<h4><a href="<?=base_url("") ?>">Cancelar</a></h4>
				<?php endif; ?>
				
			</form>
		</div> <!-- /content -->
	</div> <!-- /account-container -->
	
	<?php if($this->session->userdata('consul') == "-") : ?>
		<div id="consul" data-msg="1"></div>
	<?php endif; ?>
</section>