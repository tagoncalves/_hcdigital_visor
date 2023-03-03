<section class="sitio-main">
	<div class="account-container">	
		<div class="content clearfix">		
			<form action="<?= base_url("/user/selectServicio") ?>" method="post" autocomplete="off" >		
				<h1>Seleccione servicio</h1>		
				<div class="login-fields">				
					<?php if (isset($error)) : ?>
						<br />
						<div class="alert alert-danger" role="alert">
							<?= $error ?>
						</div>
					<?php endif; ?>
					<br />			
					<p>Por favor, seleccione la especialidad con la que desea trabajar.</p>
					
					<div class="control-group">											
						<label class="control-label" for="cboServicio">Servicios Disponibles</label>
						<div class="controls">
							<select name="cboServicio" id="cboServicio" class="span3">
								<?php if (!empty($servicios)): ?>
									<?php foreach ($servicios as $item): ?>
										<option value="<?=$item["id"]."^".$item["sector"]; ?>"><?=$item["id"]." - ".$item["sector"]; ?></option>
									<?php endforeach; ?>
								<?php endif; ?>	
							</select>
						</div> <!-- /controls -->				
					</div> <!-- /control-group -->
				</div> <!-- /login-fields -->
				<div class="login-actions">		
					<button class="button btn btn-success btn-large">Seleccionar</button>
				</div> <!-- .actions -->
			</form>
		</div> <!-- /content -->
	</div> <!-- /account-container -->
</section>