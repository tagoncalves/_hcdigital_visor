



<div class="account-container">	

	<div class="content clearfix">		
	
		<form action="#" method="post">		
		
			<h1>Iniciar Sesion</h1>		
			
			<div class="login-fields">				
				<p>Ingrese su matricula y contrase&ntilde;a.</p>
				
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
					<label for="identity">Usuario:</label>
					<input type="text" id="username" name="username" value="" placeholder="Matricula" class="login username-field" />
				</div> <!-- /field -->
				
				<div class="field">
					<label for="password">Contrase&ntilde;a:</label>
					<input type="password" id="password" name="password" value="" placeholder="Contrase&ntilde;a" class="login password-field"/>
				</div> <!-- /password -->
				
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<!--pan class="login-checkbox">
					<input id="remember" name="remember" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
					<label class="choice" for="Field">Keep me signed in</label>
				</span-->
									
				<button class="button btn btn-success btn-large">Ingresar</button>
				
			</div> <!-- .actions -->
			
			
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->



<div class="login-extra">
	<a href="forgot_password">Olvid&eacute; mi Contrase&ntilde;a</a>
</div> <!-- /login-extra -->