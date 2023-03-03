<form class="form">
	<fieldset>
        <ul id="mamoHC-tabs" class="nav nav-tabs">
            <li role="presentation" class="active"><a href="#mamoAntecedentesTab">Antecedentes</a></li>
            <li role="presentation"><a href="#mamoFormaClinicaTab">Forma Clinica</a></li>
            <li role="presentation"><a href="#mamoPuncionCirugiaTab">Puncion/Cirugia de mama</a></li>
            <li role="presentation"><a href="#mamoEstudiosTab">Estudios Realizados</a></li>
        </ul>

        <div id="mamoTabContent" class="tab-content">
			<div id="mamoAntecedentesTab" class="tab-pane active" role="tabpanel">
                <h4>Antecedentes personales y Familiares</h4>
                <br />
                
                <? $antecedentes = explode("|", $datos["antecedentes"]); ?>
                <? $eg = explode("|", $datos["eg"]); ?>
                <? $fc = explode("^", $datos["fc"]); ?>
                <? $puncion = explode("^", $datos["puncion"]); ?>
                <? $cirugia = explode("^", $datos["cirugia"]); ?>
                <? $estudios = explode("|", $datos["estudios"]); ?>
                <div>
                    <label style="float: left;">Antecedentes familiares de cancer de mama u ovarios:</label>
                    <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                        <label>
                            <input type="radio" name="optMamoAnt" id="optMamoAnt1" value="si" 
                                <?= ((empty($antecedentes[0])) ? "" : 
                                    ($antecedentes[0] == "SI") ? "checked" : "") 
                                ?>
                            >
                            Si
                        </label>
                    </div>
                        
                    <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                        <label>
                            <input type="radio" name="optMamoAnt" id="optMamoAnt2" value="no"
                                <?= ((empty($antecedentes)) ? "" : 
                                    ($antecedentes[0] == "NO") ? "checked" : "") 
                                ?>
                            >
                            No
                        </label>
                    </div>

                    <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                        <label>
                            <input type="radio" name="optMamoAnt" id="optMamoAnt3" value="ignora"
                                <?= ((empty($antecedentes)) ? "" : 
                                    ($antecedentes[0] == "IGNORA") ? "checked" : "") 
                                ?>
                            >
                            Ignora
                        </label>
                    </div>
                </div>
                
                <div style="clear:both"></div>

                <? ((!empty($antecedentes[1])) ? $quien = explode("^", $antecedentes[1]) : $quien = "")?>

                <div class="widget" id="frMamoQuien" style="margin-top: 10px;">
                    <div class="widget-header"> 
                        <i class="icon-list-alt"></i>
                        <h3>Quien</h3>																
                    </div><!-- /widget-header -->
                    <div class="widget-content" style="padding: 10px;">
                        <!-- Madre -->
                        <div class="controls span1" style="margin: 0; width: 15%;">
                            <label class="control-label" for="mamoHC-Madre">Madre: </label>
                            <input id="mamoHC-Madre" name="mamoHC-Madre" class="cmn-toggle cmn-toggle-round" type="checkbox"
                                <?= ((empty($quien)) ? "" : ($quien[0] == "1") ? "checked" : "") ?>
                            >
                            <label for="mamoHC-Madre"></label>
                        </div>

                        <!-- Padre -->
                        <div class="controls span1" style="margin: 0; width: 15%;">
                            <label class="control-label" for="mamoHC-Padre">Padre: </label>
                            <input id="mamoHC-Padre" name="mamoHC-Padre" class="cmn-toggle cmn-toggle-round" type="checkbox"
                                <?= ((empty($quien)) ? "" : ($quien[1] == "1") ? "checked" : "") ?>
                            >
                            <label for="mamoHC-Padre"></label>
                        </div>

                        <!-- Hermana -->
                        <div class="controls span1" style="margin: 0; width: 15%;">
                            <label class="control-label" for="mamoHC-Hermana">Hermana: </label>
                            <input id="mamoHC-Hermana" name="mamoHC-Hermana" class="cmn-toggle cmn-toggle-round" type="checkbox"
                                <?= ((empty($quien)) ? "" : ($quien[2] == "1") ? "checked" : "") ?>
                            >
                            <label for="mamoHC-Hermana"></label>
                        </div>

                        <!-- Hermano -->
                        <div class="controls span1" style="margin: 0; width: 15%;">
                            <label class="control-label" for="mamoHC-Hermano">Hermano: </label>
                            <input id="mamoHC-Hermano" name="mamoHC-Hermano" class="cmn-toggle cmn-toggle-round" type="checkbox"
                                <?= ((empty($quien)) ? "" : ($quien[3] == "1") ? "checked" : "") ?>
                            >
                            <label for="mamoHC-Hermano"></label>
                        </div>

                        <!-- Abuela -->
                        <div class="controls span1" style="margin: 0; width: 15%;">
                            <label class="control-label" for="mamoHC-Abuela">Abuela: </label>
                            <input id="mamoHC-Abuela" name="mamoHC-Abuela" class="cmn-toggle cmn-toggle-round" type="checkbox"
                                <?= ((empty($quien)) ? "" : ($quien[4] == "1") ? "checked" : "") ?>
                            >
                            <label for="mamoHC-Abuela"></label>
                        </div>

                        <!-- Abuelo -->
                        <div class="controls span1" style="margin: 0; width: 15%;">
                            <label class="control-label" for="mamoHC-Abuelo">Abuelo: </label>
                            <input id="mamoHC-Abuelo" name="mamoHC-Abuelo" class="cmn-toggle cmn-toggle-round" type="checkbox"
                                <?= ((empty($quien)) ? "" : ($quien[5] == "1") ? "checked" : "") ?>
                            >
                            <label for="mamoHC-Abuelo"></label>
                        </div>

                        <!-- Tios -->
                        <div class="controls span1" style="margin: 0; width: 15%;">
                            <label class="control-label" for="mamoHC-Tios">Tios/as: </label>
                            <input id="mamoHC-Tios" name="mamoHC-Tios" class="cmn-toggle cmn-toggle-round" type="checkbox"
                                <?= ((empty($quien)) ? "" : ($quien[6] == "1") ? "checked" : "") ?>
                            >
                            <label for="mamoHC-Tios"></label>
                        </div>

                        <!-- Primos -->
                        <div class="controls span1" style="margin: 0; width: 15%;">
                            <label class="control-label" for="mamoHC-Primos">Primos/as: </label>
                            <input id="mamoHC-Primos" name="mamoHC-Primos" class="cmn-toggle cmn-toggle-round" type="checkbox"
                                <?= ((empty($quien)) ? "" : ($quien[7] == "1") ? "checked" : "") ?>
                            >
                            <label for="mamoHC-Primos"></label>
                        </div>

                        <!-- input: Todos -->
                        <div class="controls span1" style="margin:0; width: 30%">
                            <label class="control-label" for="mamoHC-fliaOtros">Otros: </label>
                            <input style="text-transform: uppercase;" id="mamoHC-fliaOtros" type="text" name="mamoHC-otros" class="input-medium" value="<?= ((!empty($quien)) ? $quien[8] : "") ?>" />															
                        </div>
                    </div>
                </div>

                <? ((!empty($antecedentes[2])) ? $tipoCancer = explode("^", $antecedentes[2]) : $tipoCancer = "")?>
                
                <div class="widget" id="frMamoTipoCancer">
                    <div class="widget-header"> 
                        <i class="icon-list-alt"></i>
                        <h3>Tipo de cancer</h3>																
                    </div><!-- /widget-header -->
                    <div class="widget-content" style="padding: 10px;">
                        <!-- Cancer de Mama -->
                        <div class="controls span1" style="margin: 0; width: 33%;">
                            <label class="control-label" for="mamoHC-CancerMama">Cancer de mama: </label>
                            <input id="mamoHC-CancerMama" name="mamoHC-CancerMama" class="cmn-toggle cmn-toggle-round" type="checkbox"
                                <?= ((empty($tipoCancer)) ? "" : ($tipoCancer[0] == "1") ? "checked" : "") ?>
                            >
                            <label for="mamoHC-CancerMama"></label>
                        </div>

                        <!-- Cancer de Ovario -->
                        <div class="controls span1" style="margin: 0; width: 33%;">
                            <label class="control-label" for="mamoHC-CancerOvario">Cancer de ovario: </label>
                            <input id="mamoHC-CancerOvario" name="mamoHC-CancerOvario" class="cmn-toggle cmn-toggle-round" type="checkbox"
                                <?= ((empty($tipoCancer)) ? "" : ($tipoCancer[1] == "1") ? "checked" : "") ?>
                            >
                            <label for="mamoHC-CancerOvario"></label>
                        </div>

                        <div class="controls span1" style="margin:0; width: 33%">
                            <label class="control-label" for="mamoHC-CancerOtro">Otro: </label>
                            <input style="text-transform: uppercase;" id="mamoHC-CancerOtro" type="text" name="mamoHC-otros" class="input-medium" value="<?= ((!empty($tipoCancer)) ? $tipoCancer[2] : "") ?>"/>
                        </div>
                    </div>
                </div>

                <? ((!empty($eg[1])) ? $egDetalle = explode("^", $eg[1]) : $egDetalle = "")?>
                <? ((!empty($eg[3])) ? $egFlia = explode("^", $eg[3]) : $egFlia = "")?>

                <div class="widget" id="frEstudioGenetico">
                    <div class="widget-header"> 
                        <i class="icon-list-alt"></i>
                        <h3>Estudio Genetico</h3>																
                    </div><!-- /widget-header -->
                    <div class="widget-content" style="padding: 10px;">
                        
                        <!-- Estudio Genetico -->
                        <div class="controls span1" style="margin: 0; width: 33%;">
                            <label class="control-label" for="mamoHC-EstGenetico">Estudio Genetico: </label>
                            <input id="mamoHC-EstGenetico" name="mamoHC-EstGenetico" class="cmn-toggle cmn-toggle-round" type="checkbox"
                                <?= ((empty($eg[0])) ? "" : ($eg[0] == "1") ? "checked" : "") ?>
                            >
                            <label for="mamoHC-EstGenetico"></label>
                        </div>
                        
                        <div style="clear:both"></div>
                        <hr style="margin-top: 9px; margin-bottom: 9px;" />

                        <h4 style="margin-bottom: 5px;">¿Cual?</h4>

                        <!-- Brca1 -->
                        <div class="controls span1" style="margin: 0; width: 20%;">
                            <label class="control-label" for="mamoHC-Brca1">Brca1: </label>
                            <input id="mamoHC-Brca1" name="mamoHC-Brca1" class="cmn-toggle cmn-toggle-round" type="checkbox"
                                <?= ((empty($egDetalle[0])) ? "" : ($egDetalle[0] == "1") ? "checked" : "") ?>
                            >
                            <label for="mamoHC-Brca1"></label>
                        </div>

                        <!-- Brca2 -->
                        <div class="controls span1" style="margin: 0; width: 20%;">
                            <label class="control-label" for="mamoHC-Brca2">Brca2: </label>
                            <input id="mamoHC-Brca2" name="mamoHC-Brca2" class="cmn-toggle cmn-toggle-round" type="checkbox"
                                <?= ((empty($egDetalle[1])) ? "" : ($egDetalle[1] == "1") ? "checked" : "") ?>
                            >
                            <label for="mamoHC-Brca2"></label>
                        </div>

                        <div class="controls span1" style="margin:0; width: 60%">
                            <label class="control-label" for="mamoHC-BrcaOtro">Otro: </label>
                            <input style="text-transform: uppercase;" id="mamoHC-BrcaOtro" type="text" name="mamoHC-BrcaOtro" class="input-medium" value="<?= ((!empty($egDetalle)) ? $egDetalle[2] : "") ?>"/>															
                        </div>

                        <div style="clear:both"></div>
                        <hr style="margin-top: 9px; margin-bottom: 9px;" />

                        <h4 style="margin-bottom: 5px;">Motivo de realización del estudio genético:</h4>
                        
                        <!-- MotEG1 -->
                        <div class="controls span1" style="margin: 0; width: 50%;">
                            <label class="control-label" for="mamoHC-MotEG1">Ant. personal de cancer de mama: </label>
                            <input id="mamoHC-MotEG1" name="mamoHC-MotEG1" class="cmn-toggle cmn-toggle-round" type="checkbox"
                                <?= ((empty($egDetalle[3])) ? "" : ($egDetalle[3] == "1") ? "checked" : "") ?>
                            >
                            <label for="mamoHC-MotEG1"></label>
                        </div>

                        <!-- MotEG2 -->
                        <div class="controls span1" style="margin: 0; width: 49%;">
                            <label class="control-label" for="mamoHC-MotEG2">Ant. personal de cáncer de ovario: </label>
                            <input id="mamoHC-MotEG2" name="mamoHC-MotEG2" class="cmn-toggle cmn-toggle-round" type="checkbox"
                                <?= ((empty($egDetalle[4])) ? "" : ($egDetalle[4] == "1") ? "checked" : "") ?>
                            >
                            <label for="mamoHC-MotEG2"></label>
                        </div>

                        <!-- MotEG3 -->
                        <div class="controls span1" style="margin: 0; width: 50%;">
                            <label class="control-label" for="mamoHC-MotEG3">Ant. familiar de Brca: </label>
                            <input id="mamoHC-MotEG3" name="mamoHC-MotEG3" class="cmn-toggle cmn-toggle-round" type="checkbox"
                                <?= ((empty($egDetalle[5])) ? "" : ($egDetalle[5] == "1") ? "checked" : "") ?>
                            >
                            <label for="mamoHC-MotEG3"></label>
                        </div>

                        <!-- MotEG4 -->
                        <div class="controls span1" style="margin: 0; width: 49%;">
                            <label class="control-label" for="mamoHC-MotEG4">Ant. familiar de cancer: </label>
                            <input id="mamoHC-MotEG4" name="mamoHC-MotEG4" class="cmn-toggle cmn-toggle-round" type="checkbox"
                                <?= ((empty($egDetalle[6])) ? "" : ($egDetalle[6] == "1") ? "checked" : "") ?>
                            >
                            <label for="mamoHC-MotEG4"></label>
                        </div>

                        <div class="controls span1" style="margin:0; width: 60%">
                            <label class="control-label" for="mamoHC-BrcaOtroMot">Otro: </label>
                            <input style="text-transform: uppercase;" id="mamoHC-BrcaOtroMot" type="text" name="mamoHC-BrcaOtroMot" class="input-medium" value="<?= ((!empty($egDetalle)) ? $egDetalle[7] : "") ?>"/>															
                        </div>
                    </div>
                </div>

                <div class="widget" id="frEstudioGeneticoFlia">
                    <div class="widget-header"> 
                        <i class="icon-list-alt"></i>
                        <h3>Estudio Genetico de familiar</h3>																
                    </div><!-- /widget-header -->
                    <div class="widget-content" style="padding: 10px;">
                        <!-- Estudio Genetico Familiar -->
                        <div class="controls span1" style="margin: 0; width: 33%;">
                            <label class="control-label" for="mamoHC-EstGeneticoFlia">Estudio Genetico: </label>
                            <input id="mamoHC-EstGeneticoFlia" name="mamoHC-EstGeneticoFlia" class="cmn-toggle cmn-toggle-round" type="checkbox"
                                <?= ((empty($eg[2])) ? "" : ($eg[2] == "1") ? "checked" : "") ?>
                            >
                            <label for="mamoHC-EstGeneticoFlia"></label>
                        </div>
                        
                        <div style="clear:both"></div>
                        <hr style="margin-top: 9px; margin-bottom: 9px;" />

                        <h4 style="margin-bottom: 5px;">¿Cual?</h4>

                        <!-- Brca1Flia -->
                        <div class="controls span1" style="margin: 0; width: 20%;">
                            <label class="control-label" for="mamoHC-Brca1Flia">Brca1: </label>
                            <input id="mamoHC-Brca1Flia" name="mamoHC-Brca1Flia" class="cmn-toggle cmn-toggle-round" type="checkbox"
                                <?= ((empty($egFlia[0])) ? "" : ($egFlia[0] == "1") ? "checked" : "") ?>
                            >
                            <label for="mamoHC-Brca1Flia"></label>
                        </div>

                        <!-- Brca2Flia -->
                        <div class="controls span1" style="margin: 0; width: 20%;">
                            <label class="control-label" for="mamoHC-Brca2Flia">Brca2: </label>
                            <input id="mamoHC-Brca2Flia" name="mamoHC-Brca2Flia" class="cmn-toggle cmn-toggle-round" type="checkbox"
                                <?= ((empty($egFlia[1])) ? "" : ($egFlia[1] == "1") ? "checked" : "") ?>
                            >
                            <label for="mamoHC-Brca2Flia"></label>
                        </div>

                        <div class="controls span1" style="margin:0; width: 60%">
                            <label class="control-label" for="mamoHC-BrcaOtroFlia">Otro: </label>
                            <input style="text-transform: uppercase;" id="mamoHC-BrcaOtroFlia" type="text" name="mamoHC-BrcaOtroFlia" class="input-medium" value="<?= ((!empty($egDetalle[2])) ? $egDetalle[2] : "") ?>"/>															
                        </div>
                    </div>
                </div>
            </div>

            <div id="mamoFormaClinicaTab" class="tab-pane" role="tabpanel">
                
                <div class="widget" id="frFormaClinicaMamo" style="margin-top: 10px;">
                    <div class="widget-header"> 
                        <i class="icon-list-alt"></i>
                        <h3>Forma clinica de diagnostico</h3>																
                    </div>
                    <div class="widget-content" style="padding: 10px;">

                        <div class="controls span1" style="margin:0; width: 25%">
                            <label class="control-label" for="mamoHC-fecdiag">Fecha diag.: </label>
                            <div class="input-append date mamo">
                                <?
                                    if(!empty($fc[0])){
                                        $fecha = substr($fc[0], 6, 2)."/".substr($fc[0], 4, 2)."/".substr($fc[0], 0, 4);
                                    }else{
                                        $fecha = "";
                                    } 
                                ?>

                                <input id="mamoHC-fecdiag" name="mamoHC-fecdiag" class="input-small" readonly="" value="<?=$fecha;?>"><span class="add-on"><i class="icon-th"></i></span>
                            </div>
                        </div>

                        <div class="controls span1" style="margin:0; width: 60%">
                            <label class="control-label" for="mamoHC-Edad">Edad: </label>
                            <input style="text-transform: uppercase;" id="mamoHC-Edad" type="text" name="mamoHC-Edad" class="input-small" value="<?= ((!empty($fc[1])) ? $fc[1] : "") ?>"/>
                        </div>

                        <div style="clear:both"></div>
                        <hr style="margin-top: 9px; margin-bottom: 9px;" />
                        <h4 style="margin-bottom: 5px;">Forma de diagnostico</h4>

                        <div>
                            <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                                <label>
                                    <input type="radio" name="optMamoFormaDiag" id="optMamoFormaDiag1" value="0"
                                        <?= ((empty($fc[2])) ? "" : 
                                            ($fc[2] == "0") ? "checked" : "") 
                                        ?>
                                    >
                                    Sintomatología Clinica
                                </label>
                            </div>
                                
                            <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                                <label>
                                    <input type="radio" name="optMamoFormaDiag" id="optMamoFormaDiag2" value="1"
                                        <?= ((empty($fc[2])) ? "" : 
                                            ($fc[2] == "1") ? "checked" : "") 
                                        ?>
                                    >
                                    Sin sintomatologia; C. ginecologico
                                </label>
                            </div>

                            <div style="clear:both"></div>

                            <br />
                            <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                                <label>
                                    <input type="radio" name="optMamoFormaDiag" id="optMamoFormaDiag3" value="2"
                                        <?= ((empty($fc[2])) ? "" : 
                                            ($fc[2] == "2") ? "checked" : "") 
                                        ?>
                                    >
                                    Otros
                                </label>
                            </div>

                            <input style="text-transform: uppercase;" id="mamoHC-Formaotra" type="text" name="mamoHC-Formaotra" class="input-medium" value="<?= ((!empty($fc[3])) ? $fc[3] : "") ?>"/>
                        </div>

                        <div style="clear:both"></div>
                        <hr style="margin-top: 9px; margin-bottom: 9px;" />
                        <h4 style="margin-bottom: 5px;">Si asintomatico</h4>

                        <!-- MotFD1 -->
                        <div class="controls span1" style="margin: 0; width: 50%;">
                            <label class="control-label" for="mamoHC-MotFD1">Imagen en la ecografía: </label>
                            <input id="mamoHC-MotFD1" name="mamoHC-MotFD1" class="cmn-toggle cmn-toggle-round" type="checkbox"
                                <?= ((empty($fc[4])) ? "" : ($fc[4] == "1") ? "checked" : "") ?>
                            >
                            <label for="mamoHC-MotFD1"></label>
                        </div>

                        <!-- MotFD2 -->
                        <div class="controls span1" style="margin: 0; width: 49%;">
                            <label class="control-label" for="mamoHC-MotFD2">Imagen en la mamografía: </label>
                            <input id="mamoHC-MotFD2" name="mamoHC-MotFD2" class="cmn-toggle cmn-toggle-round" type="checkbox"
                                <?= ((empty($fc[5])) ? "" : ($fc[5] == "1") ? "checked" : "") ?>
                            >
                            <label for="mamoHC-MotFD2"></label>
                        </div>

                        <!-- MotFD3 -->
                        <div class="controls span1" style="margin: 0; width: 50%;">
                            <label class="control-label" for="mamoHC-MotFD3">Imagen en la tomosintesis: </label>
                            <input id="mamoHC-MotFD3" name="mamoHC-MotFD3" class="cmn-toggle cmn-toggle-round" type="checkbox"
                                <?= ((empty($fc[6])) ? "" : ($fc[6] == "1") ? "checked" : "") ?>
                            >
                            <label for="mamoHC-MotFD3"></label>
                        </div>

                        <!-- MotFD4 -->
                        <div class="controls span1" style="margin: 0; width: 49%;">
                            <label class="control-label" for="mamoHC-MotFD4">Imagen en la RMN: </label>
                            <input id="mamoHC-MotFD4" name="mamoHC-MotFD4" class="cmn-toggle cmn-toggle-round" type="checkbox"
                                <?= ((empty($fc[7])) ? "" : ($fc[7] == "1") ? "checked" : "") ?>
                            >
                            <label for="mamoHC-MotFD4"></label>
                        </div>

                        <div class="controls span1" style="margin:0; width: 60%">
                            <label class="control-label" for="mamoHC-FdOtro">Otro: </label>
                            <input style="text-transform: uppercase;" id="mamoHC-FdOtro" type="text" name="mamoHC-FdOtro" class="input-medium" value="<?= ((!empty($fc[8])) ? $fc[8] : "") ?>"/>
                        </div>

                        <div style="clear:both"></div>
                        <hr style="margin-top: 9px; margin-bottom: 9px;" />
                        <h4 style="margin-bottom: 5px;">Si sintomatico</h4>

                        <!-- MotFD5 -->
                        <div class="controls span1" style="margin: 0; width: 49%;">
                            <label class="control-label" for="mamoHC-MotFD5">Imagen en la mamografía: </label>
                            <input id="mamoHC-MotFD5" name="mamoHC-MotFD5" class="cmn-toggle cmn-toggle-round" type="checkbox"
                                <?= ((empty($fc[9])) ? "" : ($fc[9] == "1") ? "checked" : "") ?>
                            >
                            <label for="mamoHC-MotFD5"></label>
                        </div>

                        <!-- MotFD6 -->
                        <div class="controls span1" style="margin: 0; width: 50%;">
                            <label class="control-label" for="mamoHC-MotFD6">Imagen en la tomosintesis: </label>
                            <input id="mamoHC-MotFD6" name="mamoHC-MotFD6" class="cmn-toggle cmn-toggle-round" type="checkbox"
                                <?= ((empty($fc[10])) ? "" : ($fc[10] == "1") ? "checked" : "") ?>
                            >
                            <label for="mamoHC-MotFD6"></label>
                        </div>

                        <!-- MotFD7 -->
                        <div class="controls span1" style="margin: 0; width: 49%;">
                            <label class="control-label" for="mamoHC-MotFD7">Imagen en la RMN: </label>
                            <input id="mamoHC-MotFD7" name="mamoHC-MotFD7" class="cmn-toggle cmn-toggle-round" type="checkbox"
                                <?= ((empty($fc[11])) ? "" : ($fc[11] == "1") ? "checked" : "") ?>
                            >
                            <label for="mamoHC-MotFD7"></label>
                        </div>

                        <div class="controls span1" style="margin:0; width: 60%">
                            <label class="control-label" for="mamoHC-FdOtro2">Otro: </label>
                            <input style="text-transform: uppercase;" id="mamoHC-FdOtro2" type="text" name="mamoHC-FdOtro2" class="input-medium" value="<?= ((!empty($fc[12])) ? $fc[12] : "") ?>"/>															
                        </div>
                    </div>
                </div>
            </div>
            <div id="mamoPuncionCirugiaTab" class="tab-pane" role="tabpanel">

                <div class="widget" id="frEstudioGeneticoFlia">
                    <div class="widget-header"> 
                        <i class="icon-list-alt"></i>
                        <h3>Puncion de mama</h3>																
                    </div><!-- /widget-header -->
                    <div class="widget-content" style="padding: 10px;">
                        <div>
                            <label style="float: left;">Antecedentes de Puncion:</label>
                            <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                                <label>
                                    <input type="radio" name="optMamoAntPunc" id="optMamoAntPunc1" value="si"
                                        <?= ((empty($puncion[0])) ? "" : 
                                            ($puncion[0] == "SI") ? "checked" : "") 
                                        ?>
                                    >
                                    Si
                                </label>
                            </div>
                                
                            <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                                <label>
                                    <input type="radio" name="optMamoAntPunc" id="optMamoAntPunc2" value="no"
                                        <?= ((empty($puncion[0])) ? "" : 
                                            ($puncion[0] == "NO") ? "checked" : "") 
                                        ?>
                                    >
                                    No
                                </label>
                            </div>

                            <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                                <label>
                                    <input type="radio" name="optMamoAntPunc" id="optMamoAntPunc3" value="ignora"
                                        <?= ((empty($puncion[0])) ? "" : 
                                            ($puncion[0] == "IGNORA") ? "checked" : "") 
                                        ?>
                                    >
                                    Ignora
                                </label>
                            </div>
                        </div>
                        <div style="clear:both"></div>

                        <div class="controls span1" style="margin:0; width: 25%">
                            <label class="control-label" for="mamoHC-fecDiagPunc">Fecha diag.: </label>
                            <div class="input-append date mamo">
                                <?
                                    if(!empty($puncion[1])){
                                        $fecha = substr($puncion[1], 6, 2)."/".substr($puncion[1], 4, 2)."/".substr($puncion[1], 0, 4);
                                    }else{
                                        $fecha = "";
                                    } 
                                ?>
                                <input id="mamoHC-fecDiagPunc" name="mamoHC-fecDiagPunc" class="input-small" readonly="" value="<?=$fecha ?>"><span class="add-on"><i class="icon-th"></i></span>
                            </div>
                        </div>

                        <div style="clear:both"></div>
                        <hr style="margin-top: 9px; margin-bottom: 9px;" />
                        <h4 style="margin-bottom: 5px;">Tipo:</h4>

                        <div>
                            <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                                <label>
                                    <input type="radio" name="optTipoPunc" id="optTipoPunc1" value="paaf" 
                                        <?= ((empty($puncion[2])) ? "" : 
                                            ($puncion[2] == "PAAF") ? "checked" : "") 
                                        ?>
                                    >
                                    Paaf
                                </label>
                            </div>
                                
                            <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                                <label>
                                    <input type="radio" name="optTipoPunc" id="optTipoPunc2" value="core"
                                        <?= ((empty($puncion[2])) ? "" : 
                                            ($puncion[2] == "CORE") ? "checked" : "") 
                                        ?>
                                    >
                                    Core
                                </label>
                            </div>

                            <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                                <label>
                                    <input type="radio" name="optTipoPunc" id="optTipoPunc3" value="ctrlecografico"
                                        <?= ((empty($puncion[2])) ? "" : 
                                            ($puncion[2] == "CTRLECOGRAFICO") ? "checked" : "") 
                                        ?>
                                    >
                                    C/Ctrl. Ecografico
                                </label>
                            </div>

                            <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                                <label>
                                    <input type="radio" name="optTipoPunc" id="optTipoPunc4" value="mammotome"
                                        <?= ((empty($puncion[2])) ? "" : 
                                            ($puncion[2] == "MAMMOTOME") ? "checked" : "") 
                                        ?>
                                    >
                                    Mammotome
                                </label>
                            </div>

                            <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                                <label>
                                    <input type="radio" name="optTipoPunc" id="optTipoPunc5" value="suros"
                                        <?= ((empty($puncion[2])) ? "" : 
                                            ($puncion[2] == "SUROS") ? "checked" : "") 
                                        ?>
                                    >
                                    Suros
                                </label>
                            </div>

                            <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                                <label>
                                    <input type="radio" name="optTipoPunc" id="optTipoPunc6" value="estereotaxico"
                                        <?= ((empty($puncion[2])) ? "" : 
                                            ($puncion[2] == "ESTEREOTAXICO") ? "checked" : "") 
                                        ?>
                                    >
                                    Estereotaxico
                                </label>
                            </div>

                            <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                                <label>
                                    <input type="radio" name="optTipoPunc" id="optTipoPunc7" value="resonancia"
                                        <?= ((empty($puncion[2])) ? "" : 
                                            ($puncion[2] == "RESONANCIA") ? "checked" : "") 
                                        ?>
                                    >
                                    Resonancia
                                </label>
                            </div>
                        </div>

                        <div style="clear:both"></div>
                        <hr style="margin-top: 9px; margin-bottom: 9px;" />
                        <h4 style="margin-bottom: 5px;">Localizacion:</h4>

                        <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                            <label>
                                <input type="radio" name="optLocPunc" id="optLocPunc1" value="izq" 
                                    <?= ((empty($puncion[3])) ? "" : 
                                        ($puncion[3] == "IZQ") ? "checked" : "") 
                                    ?>
                                >
                                Mama Izquierda
                            </label>
                        </div>

                        <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                            <label>
                                <input type="radio" name="optLocPunc" id="optLocPunc2" value="der"
                                    <?= ((empty($puncion[3])) ? "" : 
                                        ($puncion[3] == "DER") ? "checked" : "") 
                                    ?>
                                >
                                Mama Derecha
                            </label>
                        </div>

                        <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                            <label>
                                <input type="radio" name="optLocPunc" id="optLocPunc3" value="amb"
                                    <?= ((empty($puncion[3])) ? "" : 
                                        ($puncion[3] == "AMB") ? "checked" : "") 
                                    ?>
                                >
                                Ambas
                            </label>
                        </div>

                        <div style="clear:both"></div>
                        <hr style="margin-top: 9px; margin-bottom: 9px;" />
                        <h4 style="margin-bottom: 5px;">Resultado:</h4>

                        <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                            <label>
                                <input type="radio" name="optResPunc" id="optResPunc1" value="benigno"
                                    <?= ((empty($puncion[4])) ? "" : 
                                        ($puncion[4] == "BENIGNO") ? "checked" : "") 
                                    ?>
                                >
                                Benigno
                            </label>
                        </div>

                        <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                            <label>
                                <input type="radio" name="optResPunc" id="optResPunc2" value="maligno"
                                    <?= ((empty($puncion[4])) ? "" : 
                                        ($puncion[4] == "MALIGNO") ? "checked" : "") 
                                    ?>
                                >
                                Maligno
                            </label>
                        </div>

                        <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                            <label>
                                <input type="radio" name="optResPunc" id="optResPunc3" value="otros"
                                    <?= ((empty($puncion[4])) ? "" : 
                                        ($puncion[4] == "OTROS") ? "checked" : "") 
                                    ?>
                                >
                                Otros
                            </label>
                        </div>

                        <input style="text-transform: uppercase;" id="txtResPunc" type="text" name="txtResPunc" class="input-medium" value="<?= ((!empty($puncion[5])) ? $puncion[5] : "") ?>"/>
                    </div>
                </div>

                <div class="widget" id="frEstudioGeneticoFlia">
                    <div class="widget-header"> 
                        <i class="icon-list-alt"></i>
                        <h3>Cirugia de mama</h3>																
                    </div><!-- /widget-header -->
                    <div class="widget-content" style="padding: 10px;">
                        <div>
                            <label style="float: left;">Antecedentes quirurgicos:</label>
                            <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                                <label>
                                    <input type="radio" name="optCirAnt" id="optCirAnt1" value="si" 
                                        <?= ((empty($cirugia[0])) ? "" : 
                                            ($cirugia[0] == "SI") ? "checked" : "") 
                                        ?>
                                    >
                                    Si
                                </label>
                            </div>
                                
                            <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                                <label>
                                    <input type="radio" name="optCirAnt" id="optCirAnt2" value="no"
                                        <?= ((empty($cirugia[0])) ? "" : 
                                            ($cirugia[0] == "NO") ? "checked" : "") 
                                        ?>
                                    >
                                    No
                                </label>
                            </div>

                            <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                                <label>
                                    <input type="radio" name="optCirAnt" id="optCirAnt3" value="ignora"
                                        <?= ((empty($cirugia[0])) ? "" : 
                                            ($cirugia[0] == "IGNORA") ? "checked" : "") 
                                        ?>
                                    >
                                    Ignora
                                </label>
                            </div>
                        </div>
                        <div style="clear:both"></div>

                        <div class="controls span1" style="margin:0; width: 25%">
                            <label class="control-label" for="mamoHC-FecCir">Fecha diag.: </label>
                            <div class="input-append date mamo">
                                <?
                                    if(!empty($cirugia[1])){
                                        $fecha = substr($cirugia[1], 6, 2)."/".substr($cirugia[1], 4, 2)."/".substr($cirugia[1], 0, 4);
                                    }else{
                                        $fecha = "";
                                    } 
                                ?>

                                <input id="mamoHC-FecCir" name="mamoHC-FecCir" class="input-small" readonly="" value="<?=$fecha ?>"><span class="add-on"><i class="icon-th"></i></span>
                            </div>
                        </div>

                        <div style="clear:both"></div>
                        <hr style="margin-top: 9px; margin-bottom: 9px;" />
                        <h4 style="margin-bottom: 5px;">Tipo:</h4>

                        <div>
                            <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                                <label>
                                    <input type="radio" name="optTipoCir" id="optTipoCir1" value="nodulectomia" 
                                        <?= ((empty($cirugia[2])) ? "" : 
                                            ($cirugia[2] == "NODULECTOMIA") ? "checked" : "") 
                                        ?>
                                    >
                                    Nodulectomia
                                </label>
                            </div>
                                
                            <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                                <label>
                                    <input type="radio" name="optTipoCir" id="optTipoCir2" value="cuadrentectomia"
                                        <?= ((empty($cirugia[2])) ? "" : 
                                            ($cirugia[2] == "CUADRENTECTOMIA") ? "checked" : "") 
                                        ?>
                                    >
                                    Cuadrentectomia
                                </label>
                            </div>

                            <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                                <label>
                                    <input type="radio" name="optTipoCir" id="optTipoCir3" value="mastectomia"
                                        <?= ((empty($cirugia[2])) ? "" : 
                                            ($cirugia[2] == "MASTECTOMIA") ? "checked" : "") 
                                        ?>
                                    >
                                    Mastectomia
                                </label>
                            </div>

                            <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                                <label>
                                    <input type="radio" name="optTipoCir" id="optTipoCir4" value="otros"
                                        <?= ((empty($cirugia[2])) ? "" : 
                                            ($cirugia[2] == "OTROS") ? "checked" : "") 
                                        ?>
                                    >
                                    Otros
                                </label>
                            </div>

                            <input style="text-transform: uppercase;" id="txtTipoCir" type="text" name="txtTipoCir" class="input-small" value="<?= ((!empty($cirugia[3])) ? $cirugia[3] : "") ?>"/>
                        </div>

                        <div style="clear:both"></div>
                        <hr style="margin-top: 9px; margin-bottom: 9px;" />
                        <h4 style="margin-bottom: 5px;">Resultados anatompatologicos:</h4>

                        <div style="padding-left: 10px;">
                            <h5 style="margin-bottom: 5px;">De la congelacion:</h5>

                            <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                                <label>
                                    <input type="radio" name="optResCong" id="optResCong1" value="benigno"
                                        <?= ((empty($cirugia[4])) ? "" : 
                                            ($cirugia[4] == "BENIGNO") ? "checked" : "") 
                                        ?>
                                    >
                                    Benigno
                                </label>
                            </div>

                            <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                                <label>
                                    <input type="radio" name="optResCong" id="optResCong2" value="maligno"
                                        <?= ((empty($cirugia[4])) ? "" : 
                                            ($cirugia[4] == "MALIGNO") ? "checked" : "") 
                                        ?>
                                    >
                                    Maligno
                                </label>
                            </div>

                            <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                                <label>
                                    <input type="radio" name="optResCong" id="optResCong3" value="otros"
                                        <?= ((empty($cirugia[4])) ? "" : 
                                            ($cirugia[4] == "OTROS") ? "checked" : "") 
                                        ?>
                                    >
                                    Otros
                                </label>
                            </div>

                            <input style="text-transform: uppercase;" id="txtResCong" type="text" name="txtResCong" class="input-medium" value="<?= ((!empty($cirugia[5])) ? $cirugia[5] : "") ?>"/>

                            <h5 style="margin-bottom: 5px;">De la pieza quirurgica:</h5>

                            <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                                <label>
                                    <input type="radio" name="optMamoPQ" id="optMamoPQ1" value="benigno"
                                        <?= ((empty($cirugia[6])) ? "" : 
                                            ($cirugia[6] == "BENIGNO") ? "checked" : "") 
                                        ?>
                                    >
                                    Benigno
                                </label>
                            </div>

                            <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                                <label>
                                    <input type="radio" name="optMamoPQ" id="optMamoPQ2" value="maligno"
                                        <?= ((empty($cirugia[6])) ? "" : 
                                            ($cirugia[6] == "MALIGNO") ? "checked" : "") 
                                        ?>
                                    >
                                    Maligno
                                </label>
                            </div>

                            <div class="radio" style="float: left; margin-right: 10px; margin-left: 10px;">
                                <label>
                                    <input type="radio" name="optMamoPQ" id="optMamoPQ3" value="otros"
                                        <?= ((empty($cirugia[6])) ? "" : 
                                            ($cirugia[6] == "OTROS") ? "checked" : "") 
                                        ?>
                                    >
                                    Otros
                                </label>
                            </div>

                            <input style="text-transform: uppercase;" id="txtMamoPQ" type="text" name="mamoHC-Edad" class="input-medium" value="<?= ((!empty($cirugia[7])) ? $cirugia[7] : "") ?>"/>
                        </div>
                    </div>
                </div>
            </div>

            <div id="mamoEstudiosTab" class="tab-pane" role="tabpanel">
                
                <? if($visor != "1") : ?>
                    <fieldset>
                        <div class="form-inline">
                            <label for="paciente-nacimiento">
                                Fecha: <br>
                                <div class="input-append date mamo">
                                    <input id="mamoHC-fecEstudio" name="mamoHC-fecEstudio" class="input-small" readonly="" style="margin: 0;"><span class="add-on" style="margin: 0;"><i class="icon-th"></i></span>
                                </div>	
                            </label>

                            <label for="paciente-nacimiento">
                                Estudio <br>
                                <select class="input-medium" id="cboEstudiosMamo" >
                                    <option>ECOGRAFIA</option>
                                    <option>MAMOGRAFIA</option>
                                    <option>TOMOSINTESIS</option>
                                    <option>RMN</option>
                                </select>	
                            </label>

                            <label for="paciente-edad">
                                Mama der. <br>
                                <select class="input-small" id="cboMamaDer">
                                    <option>0</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4-A</option>
                                    <option>4-B</option>
                                    <option>4-C</option>
                                    <option>5</option>
                                    <option>6</option>
                                </select>
                            </label>
                            
                            <label for="paciente-telefono">
                                Mama izq. <br>
                                <select class="input-small" id="cboMamaIzq">
                                    <option>0</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4-A</option>
                                    <option>4-B</option>
                                    <option>4-C</option>
                                    <option>5</option>
                                    <option>6</option>
                                </select>
                            </label>

                            <label for="paciente-nacimiento">
                                &nbsp;<br>
                                <button type="button" class="btn btn-success" id="btnAddEstMamo">Agregar</button> 
                            </label>
                        </div>
                    </fieldset>
                <? endif;?>
                    
                <table class="table table-striped table-bordered" id="estudiosMamografia">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th style="white-space: nowrap;">Estudio</th>
                            <th style="white-space: nowrap;">Mama izq.</th>
                            <th style="white-space: nowrap;">Mama der.</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>	
                        <? foreach($estudios as $row) : ?>
                            <? if(!empty($arr)) : ?>
                                <? $arr = explode("^", $row); ?>
                                <?= "<tr><td>".$arr[0]."</td><td>".$arr[1]."</td><td>".$arr[2]."</td><td>".$arr[0]."</td><td></td></tr>"; ?>
                            <? endif;  ?>
                        <? endforeach ?>            
                    </tbody>                             
                </table>
            </div>
        </div> 
	</fieldset>
</form>