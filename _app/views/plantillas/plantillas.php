
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
                <div class="span12">  
                    <div class="widget">
                        <div class="widget-header"> 
                            <i class="icon-user-md"></i>
                            <h3>Plantillas</h3>                   
                        </div>
                        <!-- /widget-header -->
                        <div class="widget-content">
                            <button type="submit" class="btn btn-success">Nueva Plantilla</button>
                            <br /><br />
                            <table class="table table-striped table-bordered" id="plantillas">
                                <thead>
                                    <tr>
                                        <th>Titulo</th>
                                        <th style="white-space: nowrap;">Especialidad<span class="fa fa-fw fa-sort"></span></th>
                                        <th style="white-space: nowrap;">Creador<span class="fa fa-fw fa-sort"></span></th>                            
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>	
                                    <tr>
                                        <td>Neonatologia</td>
                                        <td>104 - Pediatria</td>
                                        <td>Facundo Albesa</td>
                                        <td><i class="icono icon-remove"></i><i class="icono icon-zoom-in"></i></td>
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
            </div><!-- fin .row -->
        <div><!-- fin .container -->
    </div><!-- fin .main-inner -->
</div> <!-- fin .main -->