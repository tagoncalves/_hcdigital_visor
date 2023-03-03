<section class="sitio-main">
	<div class="account-container">	
		<div class="content clearfix">		
			<form action="#" method="post" autocomplete="off" >		
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
						<input autocomplete="off" type="text" id="username" name="username" value="" placeholder="Matricula" class="login username-field" />
					</div> <!-- /field -->
					<div class="field">
						<label for="password">Contrase&ntilde;a:</label>
						<input autocomplete="off" type="text" id="password" name="password" value="" placeholder="Contrase&ntilde;a" class="login password-field"/>
					</div> <!-- /password -->
				</div> <!-- /login-fields -->
				<div class="login-actions">		
					<button class="button btn btn-success btn-large">Ingresar</button>
				</div> <!-- .actions -->
			</form>
		</div> <!-- /content -->
	</div> <!-- /account-container -->
</section>
<script type="text/javascript">
	 window.onload = function(){                                              
		setTimeout(function(){  
			
			
			document.getElementById('password').type = 'password';
			document.getElementById('username').value = '';
			document.getElementById('password').value = '';
			document.getElementById('password').removeAttribute('readonly');
		},10);		
	   
	  } 
</script>