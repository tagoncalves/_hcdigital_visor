
<div class="main">
	<div class="main-inner">
		<div class="container-fluid">
			<div class="row-fluid">
                <div class="span8">  
                    <div class="widget">
                        <div class="widget-header"> 
                            <i class="icon-user-md"></i>
                            <h3>Plantilla</h3>                   
                        </div>
                        <!-- /widget-header -->
                        <div class="widget-content">
                            <form class="form-inline" id="form-plantillas">																								
								<label for="campo-nombre">
									Nombre: <br />
                                    <input type="text" class="input-xxlarge" id="campo-nombre" value="" />
                                </label>                
                                               
                                <label  for="campo-tipo">
									Tipo: <br />
									<select name="tipo-campo" id="campo-tipo">
                                        <option value="TEXT">Texto</option>
                                        <option value="NUMBER">Numero</option>
                                        <option value="LIST">Lista</option>
                                        <option value="BOOLEAN">Verdadero - Falso</option>
                                        <option value="OPTION">Opciones</option>
                                    </select>
                                    
								</label>
                                
                                <label  for="campo-tamano">
                                    Tamaño: <br />
                                    <select name="campo-tamano" id="campo-tamano">
                                        <option value="S">Chico</option>
                                        <option value="M">Mediano</option>
                                        <option value="L">Grande</option>
                                        <option value="XL">Multilinea</option>                                        
                                    </select>
                                    
                                </label>
                                <label  for="campo-obligatorio">
									Obligatorio: <br />
									<input type="checkbox" name="campo-obligatorio" id="campo-obligatorio" />
                                </label>
                                <br />
                                
                                <label  for="campo-valores">
									Valor:  <br />
									<input type="text" name="campo-valor" id="campo-valor" class="input-xxlarge"/><br />
                                    <i>Para campos campos tipo lista, indicar opciones separados por punto y coma (;)</i>
                                </label>
                                
                                
                                <br />
								<button id="btn-agregar-campo" class="btn btn-success" type="button">Agregar</button>
							</form> <!-- /form-inline -->
							<p></p>
                            <table class="table table-striped table-bordered" id="plantillas">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Tipo</th>
                                        <th>Tamaño</th>
                                        <th>Obligatorio</th>
                                        <th>Valores</th>
                                        
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>	
                                    <tr>
                                        <td>Nombre</td>
                                        <td>Tipo</td>
                                        <td>Tamaño</td>
                                        <td>Obligatorio</td>
                                        <td>Valores</td>
                                        
                                        <td>&nbsp;</td>
                                    <tr/>
                                    <?php if(isset($plantillas)) : ?>

                                        <?php foreach($plantillas as $i => $plantilla): ?>


                                        <?php endforeach; ?>

                                    <?php endif; ?>
                                </tbody>                             
                            </table>
                        </div>
                    </div>
                </div>
                <div class="span4">  
                    <div class="widget">
                        <div class="widget-header"> 
                            <i class="icon-user-md"></i>
                            <h3>Campos Pre existente</h3>                   
                        </div>
                        <!-- /widget-header -->
                        <div class="widget-content">
                            <table class="table table-striped table-bordered" id="campos">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Tipo</th>
                                        <th>Tamaño</th>
                                        <th>Obligatorio</th>
                                        <th>Valores</th>
                                        
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>	
                                    <tr>
                                        <td>Nombre</td>
                                        <td>Tipo</td>
                                        <td>Tamaño</td>
                                        <td>Obligatorio</td>
                                        <td>Valores</td>
                                        
                                        <td>&nbsp;</td>
                                    <tr/>
                                    <?php if(isset($campos)) : ?>

                                        <?php foreach($campos as $i => $campo): ?>


                                        <?php endforeach; ?>

                                    <?php endif; ?>
                                </tbody>                             
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- fin .row -->
        <div><!-- fin .container -->
    </div><!-- fin .main-inner -->
</div> <!-- fin .main -->