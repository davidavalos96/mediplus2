<?php
$comp_model = new SharedController;
$page_element_id = "add-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="add"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Agregar nuevo</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form id="turnos-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("turnos/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="row">
                                    <div class="form-group col-md-5">
                                        <label class="control-label" for="IDPROFESIONAL">Profesional <span class="text-danger">*</span></label>
                                        <div id="ctrl-IDPROFESIONAL-holder" class=""> 
                                            <select required=""  id="ctrl-IDPROFESIONAL" name="IDPROFESIONAL"  placeholder="Seleccione un valor"    class="custom-select" >
                                                <option value="">Seleccione un valor</option>
                                                <?php 
                                                $IDPROFESIONAL_options = $comp_model -> turnos_IDPROFESIONAL_option_list();
                                                if(!empty($IDPROFESIONAL_options)){
                                                foreach($IDPROFESIONAL_options as $option){
                                                $value = (!empty($option['value']) ? $option['value'] : null);
                                                $label = (!empty($option['label']) ? $option['label'] : $value);
                                                $selected = $this->set_field_selected('IDPROFESIONAL',$value, "");
                                                ?>
                                                <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                    <?php echo $label; ?>
                                                </option>
                                                <?php
                                                }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label class="control-label" for="IDPACIENTE">Paciente <span class="text-danger">*</span></label>
                                        <div id="ctrl-IDPACIENTE-holder" class=""> 
                                            <select required=""  id="ctrl-IDPACIENTE" name="IDPACIENTE"  placeholder="Seleccione un valor"    class="custom-select" >
                                                <option value="">Seleccione un valor</option>
                                                <?php 
                                                $IDPACIENTE_options = $comp_model -> turnos_IDPACIENTE_option_list();
                                                if(!empty($IDPACIENTE_options)){
                                                foreach($IDPACIENTE_options as $option){
                                                $value = (!empty($option['value']) ? $option['value'] : null);
                                                $label = (!empty($option['label']) ? $option['label'] : $value);
                                                $selected = $this->set_field_selected('IDPACIENTE',$value, "");
                                                ?>
                                                <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                    <?php echo $label; ?>
                                                </option>
                                                <?php
                                                }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="IDESPECIALIDAD">Especialidad <span class="text-danger">*</span></label>
                                        <div id="ctrl-IDESPECIALIDAD-holder" class=""> 
                                            <select required=""  id="ctrl-IDESPECIALIDAD" name="IDESPECIALIDAD"  placeholder="Seleccione un valor"    class="custom-select" >
                                                <option value="">Seleccione un valor</option>
                                                <?php 
                                                $IDESPECIALIDAD_options = $comp_model -> turnos_IDESPECIALIDAD_option_list();
                                                if(!empty($IDESPECIALIDAD_options)){
                                                foreach($IDESPECIALIDAD_options as $option){
                                                $value = (!empty($option['value']) ? $option['value'] : null);
                                                $label = (!empty($option['label']) ? $option['label'] : $value);
                                                $selected = $this->set_field_selected('IDESPECIALIDAD',$value, "");
                                                ?>
                                                <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                    <?php echo $label; ?>
                                                </option>
                                                <?php
                                                }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="FECHATURNO">Fecha <span class="text-danger">*</span></label>
                                        <div id="ctrl-FECHATURNO-holder" class="input-group"> 
                                            <input id="ctrl-FECHATURNO" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('FECHATURNO',""); ?>" type="datetime" name="FECHATURNO" placeholder="Escribir  Fecha" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="control-label" for="HSTURNO">Hora <span class="text-danger">*</span></label>
                                            <div id="ctrl-HSTURNO-holder" class="input-group"> 
                                                <input id="ctrl-HSTURNO" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('HSTURNO',""); ?>" type="time" name="HSTURNO" placeholder="Escribir  Hora" data-enable-time="true" data-min-date="" data-max-date=""  data-alt-format="H:i" data-date-format="H:i:S" data-inline="false" data-no-calendar="true" data-mode="single" /> 
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-clock"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label class="control-label" for="IDCONSULTORIO">Idconsultorio <span class="text-danger">*</span></label>
                                                <div id="ctrl-IDCONSULTORIO-holder" class=""> 
                                                    <select required=""  id="ctrl-IDCONSULTORIO" name="IDCONSULTORIO"  placeholder="Seleccione un valor"    class="custom-select" >
                                                        <option value="">Seleccione un valor</option>
                                                        <?php 
                                                        $IDCONSULTORIO_options = $comp_model -> turnos_IDCONSULTORIO_option_list();
                                                        if(!empty($IDCONSULTORIO_options)){
                                                        foreach($IDCONSULTORIO_options as $option){
                                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                                        $selected = $this->set_field_selected('IDCONSULTORIO',$value, "");
                                                        ?>
                                                        <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                            <?php echo $label; ?>
                                                        </option>
                                                        <?php
                                                        }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label class="control-label" for="TIPOTURNO">Tipo de Turno <span class="text-danger">*</span></label>
                                                <div id="ctrl-TIPOTURNO-holder" class=""> 
                                                    <select required=""  id="ctrl-TIPOTURNO" name="TIPOTURNO"  placeholder="Seleccione un valor"    class="custom-select" >
                                                        <option value="">Seleccione un valor</option>
                                                        <?php 
                                                        $TIPOTURNO_options = $comp_model -> turnos_TIPOTURNO_option_list();
                                                        if(!empty($TIPOTURNO_options)){
                                                        foreach($TIPOTURNO_options as $option){
                                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                                        $selected = $this->set_field_selected('TIPOTURNO',$value, "");
                                                        ?>
                                                        <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                            <?php echo $label; ?>
                                                        </option>
                                                        <?php
                                                        }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label class="control-label" for="ESTADOTURNO">Estado <span class="text-danger">*</span></label>
                                                <div id="ctrl-ESTADOTURNO-holder" class=""> 
                                                    <select required=""  id="ctrl-ESTADOTURNO" name="ESTADOTURNO"  placeholder="Seleccione un valor"    class="custom-select" >
                                                        <option value="">Seleccione un valor</option>
                                                        <?php 
                                                        $ESTADOTURNO_options = $comp_model -> turnos_ESTADOTURNO_option_list();
                                                        if(!empty($ESTADOTURNO_options)){
                                                        foreach($ESTADOTURNO_options as $option){
                                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                                        $selected = $this->set_field_selected('ESTADOTURNO',$value, "");
                                                        ?>
                                                        <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                            <?php echo $label; ?>
                                                        </option>
                                                        <?php
                                                        }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="control-label" for="CANTSESIONES">Cantsesiones <span class="text-danger">*</span></label>
                                                <div id="ctrl-CANTSESIONES-holder" class=""> 
                                                    <input id="ctrl-CANTSESIONES"  value="<?php  echo $this->set_field_value('CANTSESIONES',""); ?>" type="number" placeholder="Escribir  Cantsesiones" step="1"  required="" name="CANTSESIONES"  class="form-control " />
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="control-label" for="DURACION">Duracion <span class="text-danger">*</span></label>
                                                    <div id="ctrl-DURACION-holder" class="input-group"> 
                                                        <input id="ctrl-DURACION" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('DURACION',""); ?>" type="time" name="DURACION" placeholder="Escribir  Duracion" data-enable-time="true" data-min-date="" data-max-date=""  data-alt-format="H:i" data-date-format="H:i:S" data-inline="false" data-no-calendar="true" data-mode="single" /> 
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><i class="fa fa-clock"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-10">
                                                        <label class="control-label" for="OBSERVACION">Observacion <span class="text-danger">*</span></label>
                                                        <div id="ctrl-OBSERVACION-holder" class=""> 
                                                            <textarea placeholder="Escribir  Observacion" id="ctrl-OBSERVACION"  required="" rows="5" name="OBSERVACION" class=" form-control"><?php  echo $this->set_field_value('OBSERVACION',""); ?></textarea>
                                                            <!--<div class="invalid-feedback animated bounceIn text-center">Por favor ingrese el texto</div>-->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group form-submit-btn-holder text-center mt-3">
                                                    <div class="form-ajax-status"></div>
                                                    <button class="btn btn-primary" type="submit">
                                                        Entregar
                                                        <i class="fa fa-send"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
