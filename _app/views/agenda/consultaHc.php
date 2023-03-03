
<div class="main" >

	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span6">
					<div id="consulta-hc" class="widget">
						<div class="widget-header"> 
							<i class="icon-user-md"></i>
							<h3>Consulta de Historia Cl&iacute;nica</h3>
						</div>
						<!-- /widget-header -->
						<div class="widget-content">
							<div class="form-inline">																								
								<label for="paciente-nacimiento">
									HC <br />
									<input type="text" class="input-small" id="paciente-hc" value="" />
								</label>
								<label  for="paciente-edad">
									Nombre <br />
									<input type="text" class="input-large" id="paciente-nombre" value="" />
								</label>
								<label  for="paciente-edad">
									DNI <br />
									<input type="text" class="input-small" id="paciente-dni" value="" />
								</label>
								<button id="btn-buscar" class="btn btn-success" type="submit">Buscar</button>
							</div> <!-- /form-inline -->
							<p></p>
							
							<h4>PACIENTES</h4>
							<p></p>
							
							<div id="contResPaciente">
								<table class="table table-striped table-bordered" id="resPaciente">
									<thead>
										<tr><th>Nro. HC</th><th>Paciente</th><th>DNI</th></tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
							</div>
							
							<p></p>

							<div id="frameAntecedentes" style="display: none;">
								<h4>ANTECEDENTES</h4>
								<p></p>
					
								<table class="table table-striped table-bordered" id="antecedentes-table">
									<thead>
										<th>Fecha <span class="icon-sort"></span></th>
										<th class="filter-select" data-placeholder="Selecione profesional"> Profesional <span class="icon-sort"></span></th>
										<th class="filter-select" data-placeholder="Selecione especialidad">Especialidad <span class="icon-sort"></th>
									</thead>
									<tbody>
										
									</tbody>
								</table>
							</div>
						</div>
						<!-- /widget-content --> 
					</div>
					<!-- /widget --> 	
				</div>
				<!-- /span6 -->
				<div class="span6">
					<div class="widget" id="visorAnt" style="display: none;" >
						<div class="widget-header"> 
							<i class="icon-list-alt"></i>
							<h3></h3>
							
							<button type="button" id="btn-cerrar-antecedente">
								<span class="icon-remove"> </span> 
							</button>
							
						</div>
						<!-- /widget-header -->
						<div class="widget-content">
							
						</div>
						
						<!-- /widget-content --> 
					</div>
					<!-- /widget -->				
				</div>
				<!-- /span6 --> 
			</div>
			<!-- /row --> 
		</div>
		<!-- /container --> 
	</div>
	<!-- /main-inner --> 
</div>
<!-- /main -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">					
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
				<h4 class="modal-title" id="myModalLabel"></h4>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>	
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="myModalPDF" tabindex="-1" role="dialog" aria-labelledby="myModalLabelPDF" aria-hidden="true">
	<div class="modal-dialog modal-lg">					
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
				<h4 class="modal-title" id="myModalLabelPDF"></h4>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>	
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="myModalMamo" tabindex="-1" role="dialog" aria-labelledby="myModalLabelMamo" aria-hidden="true" style="display:none;">
	<div class="modal-dialog modal-lg">					
		<div class="modal-content">
			<div class="modal-header" style="background-color: #dff0d8; color: #468847;">
				<h4 class="modal-title" id="myModalLabelMamo"></h4>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
