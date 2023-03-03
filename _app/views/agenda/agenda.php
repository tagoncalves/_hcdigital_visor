<div id="volver-agenda">
	<a href="#"><i class="icon-user-md"></i> Agenda</a>
</div>
<div class="main">
	<div class="main-inner">
		<input type="hidden" id="userEnf" value="<?= $this->session->userdata('enfermeria') ?>" />

		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span4" id="columna-agenda">
					<div id="agenda" class="widget widget-table action-table">
						<div class="widget-header">
							<i class="icon-user-md"></i>
							<h3>Agenda</h3>
							<div class="filtros-agenda">
								<label for="chk-pendientes">Solo Pendientes</label>
								<input id="chk-pendientes" type="checkbox" name="pendientes" class="cmn-toggle cmn-toggle-round" />
								<label for="chk-pendientes"></label>
							</div>
						</div>
						<!-- /widget-header -->
						<div class="widget-content">
							<table class="table table-striped table-bordered" id="agenda-table">
								<thead>
									<tr>
										<th class="col-xs-1">&nbsp;</th>
										<th class="col-xs-2">Nro. HC</th>
										<th class="col-xs-5">Paciente</th>
										<th class="col-xs-1">Turno</th>
										<th class="col-xs-1">Ingreso</th>
										<th class="col-xs-1">&nbsp;</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>
						</div>
						<!-- /widget-content -->

						<div class="widget" id="frReferencias">
							<div class="widget-header">
								<i class="icon-list-alt"></i>
								<h3>Referencias</h3>
							</div><!-- /widget-header -->
							<div class="widget-content">
								<div class="form-inline">
									<label>
										<i class="icono icon-circle pacColorNo"></i>
										Turno Pac.
									</label>

									<label>
										<i class="icono icon-circle pacColorPend"></i>
										En Sala Esp.
									</label>

									<label>
										<i class="icono icon-circle pacColorST"></i>
										Sobreturno
									</label>

									<label>
										<i class="icono icon-circle pacColorEsp"></i>
										Espontaneo
									</label>

									<label>
										<i class="icono icon-circle pacColorOk"></i>
										Pac. Evolucionado
									</label>
								</div>
							</div>
						</div><!-- /.frReferencias -->
					</div>
					<!-- /widget -->
				</div>
				<!-- /span4 -->
				<div class="span8 row-fluid" id="columna-paciente">
					<div class="span5">
						<div class="widget" id="datos-ficha">
							<div class="widget-header">
								<i class="icon-list-alt"></i>
								<h3>Datos del Paciente</h3>
							</div>
							<!-- /widget-header -->
							<div class="widget-content">
								<div id="paciente"></div>
								<div class="form">
									<button type="submit" class="btn btn-success" id="btn-llamar-paciente" data-hc="" data-est="0">Llamar Paciente</button>
									<hr style="margin: 5px 0 !important;" />

									<p class="frame-telemedicina" style="display: none;">Paciente por consulta de telemedicina</p>

									<input type="hidden" id="paciente-registra" value="" />
									<fieldset>
										<div class="control-group">
											<label class="control-label" for="paciente-nombre">Paciente</label>
											<div class="controls">
												<input type="text" class="span3" id="paciente-nombre" value="" readonly />
											</div> <!-- /controls -->
										</div> <!-- /control-group -->
										<div class="control-group">
											<label class="control-label" for="paciente-entidad">Entidad</label>
											<div class="controls">
												<input type="text" class="span3" id="paciente-entidad" value="" readonly />
											</div> <!-- /controls -->
										</div> <!-- /control-group -->

										<div class="form-inline">
											<label for="paciente-afiliado">
												Afiliado<br />
												<input type="text" class="input-medium" id="paciente-Afiliado" value="" readonly />
											</label>

											<label for="paciente-documento">
												Documento<br />
												<input type="text" class="input-small" id="paciente-documento" value="" readonly />
											</label>
										</div> <!-- /form-inline -->
										<div class="form-inline">
											<label for="paciente-nacimiento">
												Fec. Nacimiento<br />
												<input type="text" class="input-small" id="paciente-nacimiento" value="" readonly />
											</label>
											<label for="paciente-edad">
												Edad <br />
												<input type="text" class="input-mini" id="paciente-edad" value="" readonly />
											</label>

											<label for="paciente-telefono">
												Telefono <br />
												<input type="text" class="input-small" id="paciente-telefono" value="" readonly />
											</label>

											<label id="frPacienteEmail" for="paciente-email" style="display: none;">
												Email <br />
												<input type="text" class="span3" id="paciente-email" value="" readonly />
											</label>
										</div> <!-- /control-group -->

										<div id="rowPac2">
											<hr style="margin: 5px 0 !important;" />
											<? if ($this->session->userdata('enfermeria') != "1") : ?>
												<? if ($this->session->userdata('id_servicio') != "35" && $this->session->userdata('id_servicio') != "19") : ?>
													<!--p>
														<h5>Problemas</h5>
													</p-->
												<? else : ?>
													<!--p>
														<h5>Hallazgos</h5>
													</p-->
												<? endif; ?>
												<form class="form-inline" id="form-problemas">
													<label>
														Fecha: <br />
														<!--input id="fecha-problema" name="fecha-problema" type="date" class="input-small" readonly /-->
														<div class="input-append date">
															<input Id="fecha-problema" name="fecha-problema" class="input-small" readonly /><span class="add-on"><i class="icon-th"></i></span>
														</div>
													</label>
													<label>
														<? if ($this->session->userdata('id_servicio') != "35" && $this->session->userdata('id_servicio') != "19") : ?>
															Problema:
														<? else : ?>
															Hallazgo:
														<? endif; ?>

														<br /><input id="texto-problema" name="texto-problema" type="text" class="input-xlarge" />
													</label>
													<button type="submit" class="btn btn-success" id="btn-guardar-problema">Guardar</button>
												</form>
												<div id="problemas">
													<table class="table table-striped table-bordered" id="problemas-table">
														<thead>
															<tr>
																<th> Fecha <span class="icon-sort"></span></th>
																<? if ($this->session->userdata('id_servicio') != "35" && $this->session->userdata('id_servicio') != "19") : ?>
																	<th> Problema <span class="icon-sort"></span></th>
																<? else : ?>
																	<th> Hallazgo <span class="icon-sort"></span></th>
																<? endif; ?>

																<th> Estado <span class="icon-sort"></span></th>
															</tr>
														</thead>
														<tbody>
														</tbody>
													</table>
												</div>
											<? endif; ?>
										</div> <!-- /.rowPac2 -->
									</fieldset>
								</div>
							</div>
						</div>
					</div>
					<div class="span7">

						<div class="widget" id="datos-paciente">
							<div class="widget-header">
								<i class="icon-list-alt"></i>
								<h3>Datos del Paciente</h3>

								<button type="button" id="btn-cerrar-paciente">
									<span class="icon-remove"> </span>
								</button>

							</div>
							<!-- /widget-header -->
							<div class="widget-content">
								<!--h4 id="header-paciente"></h4>
								<br /-->
								<div class="tabbable">
									<ul class="nav nav-tabs" id="diag-menu">
										<? if ($this->session->userdata('enfermeria') != "1") : ?>
											<? if ($this->session->userdata('id_servicio') != "35" && $this->session->userdata('id_servicio') != "19") : ?>
												<li id="tab-diagnostico"><a href="#diagnostico" data-toggle="tab">Consulta</a></li>
											<? else : ?>
												<li id="tab-mamografia"><a href="#mamografia" data-toggle="tab">Estudio mamario</a></li>
											<? endif; ?>

											<li id="tab-antecedentes"><a href="#antecedentes" data-toggle="tab">Antecedentes</a></li>
											<li id="tab-uploader"><a href="#uploader" data-toggle="tab">Adjuntar Estudios</a></li>
											<li id="tab-turnos"><a href="#" id="dar-turno">Dar turno</a></li>
											<li id="tab-estudios"><a href="#estudiosTab" data-toggle="tab">Estudios</a></li>
										<? else : ?>
											<li id="tab-evolucionenf"><a href="#evolucionEnf" data-toggle="tab">Evolucion</a></li>
											<li id="tab-antecedentes"><a href="#antecedentes" data-toggle="tab">Antecedentes</a></li>
											<li id="tab-estudios"><a href="#estudiosTab" data-toggle="tab">Estudios</a></li>
										<? endif; ?>

										<!--<li id="tab-solicitudes" ><a href="#solicitudesTab" data-toggle="tab">Sol. Estudios</a></li>-->
										<!--li id="tab-postit" ><a href="#" id="notas">Notas</a></li-->
									</ul>

									<div class="tab-content">

										<div class="tab-pane" id="diagnostico">
											<form id="form-diagnostico" class="form">
												<input type="hidden" name="diag-id" value="" />
												<input type="hidden" name="diag-ingreso" value="" />
												<input type="hidden" name="diag-hc" value="" />
												<input type="hidden" name="diag-turno" value="" />
												<fieldset>
													<div class="control-group">
														<label class="control-label" for="diag-tipo">Tipo de Consulta</label>
														<div class="controls">
															<select name="diag-tipo" id="motivoOp">
																<option value="C">Consulta</option>
																<option value="U">Urgencia</option>
																<option value="D">Demanda espontanea</option>
															</select>
														</div> <!-- /controls -->
													</div> <!-- /control-group -->
													<div class="control-group">
														<label class="control-label" for="diag-motivo">Motivo de Consulta / Enfermedad actual:</label>
														<div class="controls">
															<textarea class="fullsize" id="diag-diagnostico" name="diag-diagnostico" placeholder="Ingrese motivo de consulta"></textarea>
														</div> <!-- /controls -->
													</div> <!-- /control-group -->
													<div class="control-group">
														<label class="control-label" for="diag-plan">Datos Objetivos:</label>
														<div class="controls">
															<textarea class="fullsize" id="diag-objetivos" name="diag-objetivos" placeholder="Ingrese datos objetivos"></textarea>
														</div> <!-- /controls -->
													</div> <!-- /control-group -->
													<div class="control-group">
														<label class="control-label" for="diag-plan">Plan y Tratamiento:</label>
														<div class="controls">
															<textarea class="fullsize" id="diag-plan" name="diag-plan" placeholder="Ingrese plan y tratamiento"></textarea>
														</div> <!-- /controls -->
													</div> <!-- /control-group -->
													<div class="control-group">
														<label class="control-label" for="diag-diagnostico">Diagnostico:</label>
														<div class="controls">
															<textarea class="fullsize" id="diag-motivo" name="diag-motivo" placeholder="Ingrese diagnotico"></textarea>
														</div> <!-- /controls -->
													</div> <!-- /control-group -->
													<div class="form-actions">
														<button type="submit" class="btn btn-success">Guardar</button>
														<button type="button" name="cancelar" class="btn">Cancelar</button>
													</div> <!-- /form-actions -->


												</fieldset>
											</form>
										</div>

										<div class="tab-pane" id="evolucionEnf">
											<form id="form-evolucionenf" class="form">
												<input type="hidden" name="diag-turno" value="" />
												<input type="hidden" name="diag-ingreso" value="" />
												<input type="hidden" name="diag-hc" value="" />
												<fieldset>
													<div class="control-group">
														<label class="control-label" for="diag-evolucion">Evolucion:</label>
														<div class="controls">
															<textarea class="fullsize" id="diag-evolucion" name="diag-evolucion" placeholder="Ingrese evolucion" rows="10"></textarea>
														</div> <!-- /controls -->
													</div> <!-- /control-group -->
													<div class="form-actions">
														<button type="submit" class="btn btn-success">Guardar</button>
														<button type="button" name="cancelar" class="btn">Cancelar</button>
													</div> <!-- /form-actions -->
												</fieldset>
											</form>
										</div>

										<div class="tab-pane" id="mamografia">
											<form id="form-mamografia" class="form">
												<input type="hidden" name="mamo-id" value="" />
												<input type="hidden" name="mamo-ingreso" value="" />
												<input type="hidden" name="mamo-hc" value="" />
												<input type="hidden" name="mamo-turno" value="" />

												<fieldset style="text-align: right;">
													<button type="button" name="visorHcMamo" class="btn btn-sm btn-warning">HC. Mamaria</button>
												</fieldset>
												<div style="clear:both"></div>
												<br />

												<fieldset>
													<div class="control-group">
														<label class="control-label" for="mamo-diagnostico">Motivo de Consulta:</label>
														<div class="controls">
															<textarea style="text-transform: uppercase;" class="fullsize" id="mamo-diagnostico" name="mamo-diagnostico" placeholder="Ingrese motivo de consulta"></textarea>
														</div> <!-- /controls -->
													</div> <!-- /control-group -->

													<div class="control-group">
														<label class="control-label" for="mamo-antecedentes">Antecedentes Familiares:</label>
														<div class="controls">
															<textarea style="text-transform: uppercase;" class="fullsize" id="mamo-antecedentes" name="mamo-antecedentes" placeholder="Ingrese antecedentes familiares"></textarea>
														</div> <!-- /controls -->
													</div> <!-- /control-group -->
												</fieldset>
												<fieldset>
													<p>
														<h4>Preguntas</h4>
													</p>
													<div class="form-inline">

														<div class="controls span1" style="margin:0;width:25%">
															<label class="control-label" for="mamo-hijos">Hijos: </label>
															<input id="mamo-hijos" type="checkbox" name="mamo-hijos" class="cmn-toggle cmn-toggle-round" />
															<label for="mamo-hijos"></label>
														</div>
														<div class="controls span1" style="margin:0;width:25%">
															<label class="control-label" for="mamo-hormonas">Hormonas: </label>
															<input id="mamo-hormonas" type="checkbox" name="mamo-hormonas" class="cmn-toggle cmn-toggle-round" />
															<label for="mamo-hormonas"></label>
														</div>
														<div class="controls span1" style="margin:0;width:25%">
															<label class="control-label" for="mamo-lactancia">Lactancia: </label>
															<input id="mamo-lactancia" type="checkbox" name="mamo-lactancia" class="cmn-toggle cmn-toggle-round" />
															<label for="mamo-lactancia"></label>
														</div>
														<div class="controls span1" style="margin:0;width:25%">
															<label class="control-label" for="mamo-menopausia">Menopausia: </label>
															<input id="mamo-menopausia" type="checkbox" name="mamo-menopausia" class="cmn-toggle cmn-toggle-round" />
															<label for="mamo-menopausia"></label>
														</div>
													</div>
													<div style="clear:both"></div>
													<hr />
													<div class="form-inline">
														<div class="controls span1" style="margin:0;width:25%">
															<label class="control-label" for="mamo-operaciones">Oper. Realizadas: </label>
															<input id="mamo-operaciones" type="checkbox" name="mamo-operaciones" class="cmn-toggle cmn-toggle-round" />
															<label for="mamo-operaciones"></label>
														</div>
														<span id="campos-mamo-operacion" style="display:none">
															<div class="controls span1" style="margin:0;width:30%">
																<label class="control-label" for="mamo-fecoper">Fecha: </label><br />
																<div class="input-append date">
																	<input id="mamo-fecoper" name="mamo-fecoper" class="input-small" readonly /><span class="add-on" style="margin:0"><i class="icon-th"></i></span>
																</div>
															</div>
															<div class="controls span1" style="margin:0;width:20%">
																<label class="control-label" for="mamo-operiz">Mama iz.: </label>
																<input id="mamo-operiz" type="checkbox" name="mamo-operiz" class="cmn-toggle cmn-toggle-round" />
																<label for="mamo-operiz"></label>
															</div>
															<div class="controls span1" style="margin:0;width:20%">
																<label class="control-label" for="mamo-operaciones">Mama der.: </label>
																<input id="mamo-operder" type="checkbox" name="mamo-operder" class="cmn-toggle cmn-toggle-round" />
																<label for="mamo-operder"></label>
															</div>
														</span>
													</div>
													<div style="clear:both"></div>
													<hr />
													<div class="form-inline">
														<div class="controls span1" style="margin:0;width:25%">
															<label class="control-label" for="mamo-punciones">Punciones: </label>
															<input id="mamo-punciones" type="checkbox" name="mamo-punciones" class="cmn-toggle cmn-toggle-round" />
															<label for="mamo-punciones"></label>
														</div>
														<span id="campos-mamo-puncion" style="display:none">
															<div class="controls span1" style="margin:0;width:30%">
																<label class="control-label" for="mamo-fecpun">Fecha: </label><br />
																<div class="input-append date">
																	<input id="mamo-fecpun" name="mamo-fecpun" class="input-small" readonly /><span class="add-on" style="margin:0"><i class="icon-th"></i></span>
																</div>
															</div>
															<div class="controls span1" style="margin:0;width:20%">
																<label class="control-label" for="mamo-puniz">Mama iz.: </label>
																<input id="mamo-puniz" type="checkbox" name="mamo-puniz" class="cmn-toggle cmn-toggle-round" />
																<label for="mamo-puniz"></label>
															</div>
															<div class="controls span1" style="margin:0;width:20%">
																<label class="control-label" for="mamo-punder">Mama der.: </label>
																<input id="mamo-punder" type="checkbox" name="mamo-punder" class="cmn-toggle cmn-toggle-round" />
																<label for="mamo-punder"></label>
															</div>

															<div class="control-group">
																<label class="control-label" for="mamo-diagnostico">Observacion:</label>
																<div class="controls">
																	<textarea style="text-transform: uppercase;" class="fullsize" id="mamo-puncionObs" name="mamo-puncionObs" placeholder=""></textarea>
																</div> <!-- /controls -->
															</div>
														</span>
													</div>
													<div style="clear:both"> </div>
													<hr />
													<div class="form-inline">

														<div class="controls span1" style="margin:0;width:25%">
															<label class="control-label" for="mamo-tratamiento">Tratamiento: </label>
															<input id="mamo-tratamiento" type="checkbox" name="mamo-tratamiento" class="cmn-toggle cmn-toggle-round" />
															<label for="mamo-tratamiento"></label>
														</div>
													</div>
													<div style="clear:both"></div>
													<div class="form-inline" id="grupoTratamientoMamo" style="display:none">
														<div class="controls span1" style="margin:0;width:25%">
															<label class="control-label" for="mamo-tamoxifeno">Tamoxifeno: </label>
															<input id="mamo-tamoxifeno" type="checkbox" name="mamo-tamoxifeno" class="cmn-toggle cmn-toggle-round" />
															<label for="mamo-tamoxifeno"></label>
														</div>

														<div class="controls span1" style="margin:0;width:25%">
															<label class="control-label" for="mamo-quimioterapia">Quimioterapia: </label>
															<input id="mamo-quimioterapia" type="checkbox" name="mamo-quimioterapia" class="cmn-toggle cmn-toggle-round" />
															<label for="mamo-quimioterapia"></label>
														</div>
														<div class="controls span1" style="margin:0;width:25%">
															<label class="control-label" for="mamo-radioterapia">Radioterapia: </label>
															<input id="mamo-radioterapia" type="checkbox" name="mamo-radioterapia" class="cmn-toggle cmn-toggle-round" />
															<label for="mamo-radioterapia"></label>
														</div>
														<div class="controls span1" style="margin:0;width:25%">
															<label class="control-label" for="mamo-acelerador">Acelerador Lineal: </label>
															<input id="mamo-acelerador" type="checkbox" name="mamo-acelerador" class="cmn-toggle cmn-toggle-round" />
															<label for="mamo-acelerador"></label>
														</div>
														<div class="controls span1" style="margin:0;width:25%">
															<label class="control-label" for="mamo-neoadyuvancia">Neoadyuvancia: </label>
															<input id="mamo-neoadyuvancia" type="checkbox" name="mamo-neoadyuvancia" class="cmn-toggle cmn-toggle-round" />
															<label for="mamo-neoadyuvancia"></label>
														</div>
														<div class="controls span1" style="margin:0;width:25%">
															<label class="control-label" for="mamo-otros">Otros: </label>
															<input style="text-transform: uppercase;" id="mamo-otros" type="text" name="mamo-otros" class="input-medium" />
														</div>
													</div>
													<div style="clear:both"></div>
													<div class="form-actions">
														<button type="submit" class="btn btn-success">Guardar</button>
														<button type="button" name="cancelar" class="btn">Cancelar</button>
													</div> <!-- /form-actions -->


												</fieldset>
											</form>
										</div>

										<div class="tab-pane" id="antecedentes">
											<table class="table table-striped table-bordered" id="antecedentes-table">
												<thead>
													<tr>
														<th>Fecha <span class="icon-sort"></span></th>
														<th class="filter-select" data-placeholder="Seleccione profesional"> Profesional <span class="icon-sort"></span></th>
														<!--th> Especialidad <span class="icon-sort"></span></th-->
														<th class="filter-select" data-placeholder="Seleccione especialidad">Especialidad <span class="icon-sort"></th>
													</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
										</div>
										<div class="tab-pane" id="uploader">
											<!-- Standar Form -->
											<form action="<?= base_url("/agenda/do_upload") ?>" method="post" enctype="multipart/form-data" id="js-upload-form">
												<input type="hidden" name="hc-adjuntos" value="" />
												<input type="hidden" name="ingreso-adjuntos" value="" />
												<input type="hidden" name="afiliado-adjuntos" value="" />
												<input type="hidden" name="entidad-adjuntos" value="" />
												<div class="control-group">
													<label class="control-label">Tipo de estudio:</label>
													<div class="controls">
														<select class="fullsize" name="tipo-estudio" id="tipo-estudio">
															<option selected value="">Seleccione tipo de estudio</option>
															<option value="ESTUDIOS_EXTERNOS">ESTUDIOS EXTERNOS</option>
															<option value="ESTUDIOS_COMPLEMENTARIOS">ESTUDIOS COMPLEMENTARIOS</option>
															<option value="ADJUNTO">Otros Estudios</option>
														</select>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Seleccione archivo a adjuntar:</label>
													<div class="input-append input-prepend upload-group">
														<span class="btn btn-default btn-file btn-success">Buscar <input type="file" name="files[]" id="js-upload-files" /></span>
														<input class="input-file" id="appendedInputButtons" type="text" readonly />
														<button class="btn" type="submit"><span class="icon-upload"></span></button>
														<button class="btn" id="limpiar-adjunto" type="button"><span class="icon-trash"></span></button>
													</div>
													<span class="help-block">Seleccione los archivos que desea adjuntar a la consulta</span>
												</div>
											</form>
											<br />
											<!-- Drop Zone -->

											<!--div class="upload-drop-zone" id="drop-zone">
												Arrastre su archivo aqu&iacute;
											</div-->

											<!-- Progress Bar -->
											<div id="progreso" class="progress">
												<div class="bar" style="width: 0;"></div>
											</div>

											<!-- Upload Finished -->
											<div id="js-upload-finished" class="js-upload-finished">
												<h4>Archivos procesados</h4>
												<ul class="unstyled">

													<ul>
											</div>
										</div>

										<div class="tab-pane" id="estudiosTab">

										</div>

										<div class="tab-pane" id="solicitudesTab">

										</div>
									</div>
									<!-- /tab-content -->
								</div>
							</div>
							<!-- /widget-content -->
						</div>
						<!-- /widget -->
					</div>

				</div>
				<div class="span4" id="columna-antecedentes" style="display:none;">
					<div class="widget" id="datos-visor">
						<div class="widget-header">
							<i class="icon-user-md"></i>
							<h3>Visor</h3>
							<button type="button" id="btn-cerrar-visor">
								<span class="icon-remove"> </span>
							</button>
						</div>
						<!-- /widget-header -->
						<div class="widget-content setOverflow">

						</div>
						<!-- /widget-content -->
					</div>
					<!-- /widget -->
				</div>
				<!-- /span4 -->

				<!-- /span8 -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /main-inner -->

	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;">
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

	<div class="modal fade" id="myModalPDF" tabindex="-1" role="dialog" aria-labelledby="myModalLabelPDF" aria-hidden="true" style="display:none;">
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

</div>
<!-- /main -->