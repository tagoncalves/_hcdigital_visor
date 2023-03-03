<div class="solicitudEstudios">
    <div class="toolbar">
        <div class="btn-group centerD" role="group">
            <? if(!empty($toolbar)) : ?>
                <?  $buttons = explode("|",$toolbar); 
                    $colores = ["orange","mediumpurple","darkgreen","lightblue","red","yellow"];
                    $i = 0;
                ?>
                <? foreach($buttons as $item) : ?>
                    <? $datos = explode("^",$item); ?>
                    <button type="button" class="btn btn-default tbSectores <?=($i == 0) ? 'active' : ''; ?>" data-sec="<?=$datos[1]; ?>" data-color="<?=$colores[$i]; ?>">
                        <i class="icon-tag" aria-hidden="true" style="color: <?=$colores[$i] ?>;"></i>
                        &nbsp; <?=$datos[0]; ?>
                    </button>
                    <? $i++; ?>
                <? endforeach; ?>
            <? endif; ?>
        </div>  
    </div>

    <br>
    <div class="estudioPanel">
        <div class="widget widget-table action-table">
            <div class="widget-header">
                <h4><i class="icon-tags"></i>&nbsp; Estudios</h4>
            </div>
            <div class="widget-content">
                <table class="table table-striped table-bordered listadoMd" id="SolTable">
                    <thead>
                        <tr>
                            <th class="col-xs-1">&nbsp;</th>
                            <th style="white-space: nowrap;">Estudio</th>
                        </tr>
                    </thead>
                    <tbody>	
                        <?php if (!empty($estudio)): ?>
                            <? $rows = explode("|",$estudio); ?>
                            <?php foreach ($rows as $item): ?>
                                <? $estudio = explode("^",$item); ?>
                                <tr>
                                    <td class="col-xs-1"><input type="checkbox" class="selEstudio" data-protocolo="<?=$estudio[1]; ?>" /></th>
                                    <td><?=$estudio[0] ?></th>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>	
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="form-group col-lg-12 no-padding-lr">
        <label>Indicaciones</label>
        <input type="text" class="span6" id="txtInd" value="" />
    </div>

    <button id="btnGuardarSolicitud" class="btn btn-success derecha">Guardar</button>
</div>