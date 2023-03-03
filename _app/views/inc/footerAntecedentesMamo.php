<fieldset>
        <? if($visor != "1") : ?>
            <button id="btnGuardarMamoHC" type="button" class="btn btn-success">Guardar</button> 
        <? endif; ?>
        <button id="btnCloseModalMamo" data-visor="<?= $visor ?>" type="button" class="btn btn-default">Cerrar</button> 
</fieldset>