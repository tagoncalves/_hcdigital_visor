
<section class="sitio-main">
	<div class="account-container">	
		<div class="content clearfix">			
			<form  action="<?= base_url("user/cambiarPassword") ?>" method="POST" autocomplete="off">
				<h1>Cambiar Contrase&ntilde;a</h1>
				<div class="login-fields">	
					<?php if (validation_errors()) : ?>
						<div class="alert alert-danger" role="alert">
							<?= validation_errors() ?>
						</div>								
					<?php endif; ?>
					<?php if (isset($error)) : ?>								
						<div class="alert alert-danger" role="alert">
							<?= $error ?>
						</div>
					<?php endif; ?>
					<div class="field">
						<label for="password">Contrase&ntilde;a Actual:</label>
						<input type="password" placeholder="Actual Contrase&ntilde;a" id="oldPassowrd" name="oldPassword" class="login password-field"/>
					</div>
					<div class="field">
						<label for="password">Nueva Contrase&ntilde;a:</label>
						<input type="password" placeholder="Nueva Contrase&ntilde;a" id="newPassowrd" name="newPassword" class="login password-field"/>
					</div>
					<div class="field">
						<label for="password">Repetir Contrase&ntilde;a:</label>
						<input type="password" placeholder="Repetir Contrase&ntilde;a" id="new2Passowrd" name="new2Password" class="login password-field"/>
					</div>
				</div>
				<div class="login-actions">		
					<button type="submit" class="button btn btn-success btn-large" value="login" />Cambiar</button>
				</div>
			</form>			
		</div>
	</div>		
</section>

