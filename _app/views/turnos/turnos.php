	
	<div class="main">
		<div class="main-inner">
			<div class="container">
				<div class="row">
					
					<div class="span5">
						<div class="widget">
							<div class="widget-header"> <i class="icon-list-alt"></i>
								<h3>Cargar Diagnostico</h3>
							</div>
							<!-- /widget-header -->
							<div class="widget-content widget-content-form">
								<form class="form">
									<fieldset>
										<div class="control-group">											
											<label class="control-label" for="lastname">Servicio</label>
											<div class="controls controls-row">
												<input class="span1" name="codServicio" placeholder="Cod." />
												<input class="span4" name="servicio" placeholder="Servicio" />
											</div> <!-- /controls -->
										</div> 
										<!-- /control-group -->

										<div class="control-group">											
											<label class="control-label" for="lastname">Medico</label>
											<div class="controls">
												<input class="span1" id="txt-matricula" name="matricula" placeholder="Cod." />
												<input class="span4" id="txt-profesional" name="profesional" placeholder="Medico"/>
											</div> <!-- /controls -->				
										</div> 
										<!-- /control-group -->
										
										<div class="form-actions">
											<button type="submit" class="btn btn-primary">Cargar</button> 
											<button class="btn">Limpiar</button>
										</div> 
										<!-- /form-actions -->
									</fieldset>
								</form>
						
							</div>
							<!-- /widget-content --> 
						</div>
						<!-- /widget -->
					</div>
					<!-- /span5 -->
					
					<div id="calendar-container" class="span7">
					  
						<!-- /widget -->
						<div class="widget widget-nopad">
							<div class="widget-header"> <i class="icon-list-alt"></i>
								<h3>Turnos</h3>
							</div>
							<!-- /widget-header -->
							<div class="widget-content">
								<div id='calendar'>
								</div>
							</div>
							<!-- /widget-content --> 
						</div>
						<!-- /widget --> 
					</div>
				</div>
				<!-- /row --> 
			</div>
			<!-- /container --> 
		</div>
		<!-- /main-inner --> 
	</div>
	<!-- /main -->
