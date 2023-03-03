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
					<p>Por favor, ingrese el numero del consultorio donde se encuentra.</p>

					<div class="field">
						<label for="nroConsul">Usuario:</label>
						<input autocomplete="off" min="1" max="20" type="number" id="nroConsul" name="nroConsul" value="<?=$this->session->userdata('consul') ?>" placeholder="0" class="login username-field" />
					</div> <!-- /field -->
				</div> <!-- /login-fields -->
				<div class="login-actions">		
					<button class="button btn btn-success btn-large">Seleccionar</button>
				</div> <!-- .actions -->
			</form>
		</div> <!-- /content -->
	</div> <!-- /account-container -->
</section>