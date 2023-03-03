<div class="main" >
	<div class="main-inner">
		<div class="perfil-container">
			<? if(isset($ok)) : ?>
				<p class="alert alert-success"><?=$ok; ?></p>
			<? endif; ?>

			<? if(isset($error)) : ?>
				<p class="alert alert-danger"><?=$error; ?></p>
			<? endif; ?>
		
			<div class="widget perfil-widget">
				<div class="widget-header"> 
					<i class="icon-user"></i>
					<h3>Foto de perfil</h3>																
				</div> <!-- /widget-header -->
				<div class="widget-content">

					<div class="avatar" style="background-image: url(<?=$img; ?>)"></div>
					
					<hr />
					<form action="<?=base_url("user/uploadImage"); ?>" method="post" enctype="multipart/form-data" style="padding-top: 0.5rem">
						<p>Cambiar imagen de perfil:</p>
						
						<div style="width: 75%; float: left;">
							<input type="file" name="fileToUpload" id="fileToUpload">
							<br /><i>Puede ser formato JPG o PNG.</i>
						</div>
						<input type="submit" value="Subir imagen" name="submit" style="float: right">
						
					</form>
				</div>			
			</div>
			
			<div class="widget perfil-widget">
				<div class="widget-header"> 
					<i class="icon-user"></i>
					<h3>Perfil Profesional</h3>																
				</div> <!-- /widget-header -->
				<div class="widget-content">
					<form action="<?=base_url("user/setPerfilProfesional"); ?>" method="post">
						<div class="control-group">											
							<label class="control-label" for="txtPerfil">Actualizar perfil:</label>
							<div class="controls">
								<textarea id="txtPerfil" name="txtPerfil" placeholder="" style="min-height: 80px; min-width: 98%; max-width: 98%;" ><?=$txt?></textarea>														
							</div> <!-- /controls -->				
						</div>
						
						<button type="submit" class="btn btn-success" id="btnGuardarPerfil">Guardar</button>
					</form>
				</div>			
			</div>
		</div>
	</div>
</div>