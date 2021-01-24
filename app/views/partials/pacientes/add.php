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
                    <div class="card ">
                        <div class="card-header p-0 pt-2 px-2">
                            <ul class="nav  nav-tabs   ">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#TabPage-1-Page1" role="tab" aria-selected="true">
                                        <i class="fa fa-user "></i> DATOS DEL PACIENTE
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active fade" id="TabPage-1-Page1" role="tabpanel">
                                    <?php $this :: display_page_errors(); ?>
                                    <div  class="bg-light p-3 animated fadeIn page-content">
                                        <form id="pacientes-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("pacientes/add?csrf_token=$csrf_token") ?>" method="post">
                                            <div>
                                                <div class="row">
                                                    <div class="form-group col-md-3">
                                                        <label class="control-label" for="NUMDOCPAC">N° de Documento <span class="text-danger">*</span></label>
                                                        <div id="ctrl-NUMDOCPAC-holder" class=""> 
                                                            <input id="ctrl-NUMDOCPAC"  value="<?php  echo $this->set_field_value('NUMDOCPAC',"0"); ?>" type="number" placeholder="Escribir  N° de Documento" step="1"  required="" name="NUMDOCPAC"  data-url="api/json/pacientes_NUMDOCPAC_value_exist/" data-loading-msg="Comprobando disponibilidad ..." data-available-msg="Disponible" data-unavailable-msg="No disponible" class="form-control  ctrl-check-duplicate" />
                                                                <div class="check-status"></div> 
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label class="control-label" for="FECHANACPAC">Fecha de Nacimiento <span class="text-danger">*</span></label>
                                                            <div id="ctrl-FECHANACPAC-holder" class="input-group"> 
                                                                <input id="ctrl-FECHANACPAC" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('FECHANACPAC',""); ?>" type="datetime" name="FECHANACPAC" placeholder="Escribir  Fecha de Nacimiento" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="control-label" for="FECHACERTVTO">Fecha Venc. Certificado <span class="text-danger">*</span></label>
                                                                <div id="ctrl-FECHACERTVTO-holder" class="input-group"> 
                                                                    <input id="ctrl-FECHACERTVTO" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('FECHACERTVTO',""); ?>" type="datetime" name="FECHACERTVTO" placeholder="Escribir  Fecha Venc. Certificado" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-5">
                                                                    <label class="control-label" for="NOMBAPEPAC">Apellido y Nombre <span class="text-danger">*</span></label>
                                                                    <div id="ctrl-NOMBAPEPAC-holder" class=""> 
                                                                        <input id="ctrl-NOMBAPEPAC"  value="<?php  echo $this->set_field_value('NOMBAPEPAC',""); ?>" type="text" placeholder="Escribir  Apellido y Nombre"  required="" name="NOMBAPEPAC"  class="form-control " />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-5">
                                                                        <label class="control-label" for="COORDINADOR">Coordinador <span class="text-danger">*</span></label>
                                                                        <div id="ctrl-COORDINADOR-holder" class=""> 
                                                                            <select required=""  id="ctrl-COORDINADOR" name="COORDINADOR"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                                <option value="">Seleccione un valor</option>
                                                                                <?php 
                                                                                $COORDINADOR_options = $comp_model -> pacientes_COORDINADOR_option_list();
                                                                                if(!empty($COORDINADOR_options)){
                                                                                foreach($COORDINADOR_options as $option){
                                                                                $value = (!empty($option['value']) ? $option['value'] : null);
                                                                                $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                                $selected = $this->set_field_selected('COORDINADOR',$value, "");
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
                                                                    <div class="form-group col-md-3">
                                                                        <label class="control-label" for="COBERTURA">Cobertura <span class="text-danger">*</span></label>
                                                                        <div id="ctrl-COBERTURA-holder" class=""> 
                                                                            <select required=""  id="ctrl-COBERTURA" name="COBERTURA"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                                <option value="">Seleccione un valor</option>
                                                                                <?php 
                                                                                $COBERTURA_options = $comp_model -> pacientes_COBERTURA_option_list();
                                                                                if(!empty($COBERTURA_options)){
                                                                                foreach($COBERTURA_options as $option){
                                                                                $value = (!empty($option['value']) ? $option['value'] : null);
                                                                                $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                                $selected = $this->set_field_selected('COBERTURA',$value, "");
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
                                                                    <div class="form-group col-md-3">
                                                                        <label class="control-label" for="PLANOBRASOC">Plan <span class="text-danger">*</span></label>
                                                                        <div id="ctrl-PLANOBRASOC-holder" class=""> 
                                                                            <input id="ctrl-PLANOBRASOC"  value="<?php  echo $this->set_field_value('PLANOBRASOC',""); ?>" type="text" placeholder="Escribir  Plan"  required="" name="PLANOBRASOC"  class="form-control " />
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label class="control-label" for="NROAFILIADO">N° de Afiliado <span class="text-danger">*</span></label>
                                                                            <div id="ctrl-NROAFILIADO-holder" class=""> 
                                                                                <input id="ctrl-NROAFILIADO"  value="<?php  echo $this->set_field_value('NROAFILIADO',""); ?>" type="text" placeholder="Escribir  N° de Afiliado"  required="" name="NROAFILIADO"  class="form-control " />
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-md-4">
                                                                                <label class="control-label" for="DOMICILIO">Domicilio <span class="text-danger">*</span></label>
                                                                                <div id="ctrl-DOMICILIO-holder" class=""> 
                                                                                    <input id="ctrl-DOMICILIO"  value="<?php  echo $this->set_field_value('DOMICILIO',""); ?>" type="text" placeholder="Escribir  Domicilio"  required="" name="DOMICILIO"  class="form-control " />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-md-3">
                                                                                    <label class="control-label" for="barrio">Barrio <span class="text-danger">*</span></label>
                                                                                    <div id="ctrl-barrio-holder" class=""> 
                                                                                        <select required=""  id="ctrl-barrio" data-load-path="<?php print_link('api/json/pacientes_barrio_option_list') ?>" name="barrio"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                                            <option value="">Seleccione un valor</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-md-3">
                                                                                    <label class="control-label" for="LOCALIDAD">Localidad <span class="text-danger">*</span></label>
                                                                                    <div id="ctrl-LOCALIDAD-holder" class=""> 
                                                                                        <select required=""  id="ctrl-LOCALIDAD" data-load-select-options="barrio" name="LOCALIDAD"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                                            <option value="">Seleccione un valor</option>
                                                                                            <?php 
                                                                                            $LOCALIDAD_options = $comp_model -> pacientes_LOCALIDAD_option_list();
                                                                                            if(!empty($LOCALIDAD_options)){
                                                                                            foreach($LOCALIDAD_options as $option){
                                                                                            $value = (!empty($option['value']) ? $option['value'] : null);
                                                                                            $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                                            $selected = $this->set_field_selected('LOCALIDAD',$value, "");
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
                                                                                <div class="form-group col-md-3">
                                                                                    <label class="control-label" for="TELEFONO">Telefono <span class="text-danger">*</span></label>
                                                                                    <div id="ctrl-TELEFONO-holder" class=""> 
                                                                                        <input id="ctrl-TELEFONO"  value="<?php  echo $this->set_field_value('TELEFONO',""); ?>" type="text" placeholder="Escribir  Telefono"  required="" name="TELEFONO"  class="form-control " />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group col-md-7">
                                                                                        <label class="control-label" for="EMAIL">Correo Electronico <span class="text-danger">*</span></label>
                                                                                        <div id="ctrl-EMAIL-holder" class=""> 
                                                                                            <input id="ctrl-EMAIL"  value="<?php  echo $this->set_field_value('EMAIL',""); ?>" type="email" placeholder="Escribir  Correo Electronico"  required="" name="EMAIL"  class="form-control " />
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group col-md-10">
                                                                                            <label class="control-label" for="MEDICODERIV">Medico Derivante <span class="text-danger">*</span></label>
                                                                                            <div id="ctrl-MEDICODERIV-holder" class=""> 
                                                                                                <input id="ctrl-MEDICODERIV"  value="<?php  echo $this->set_field_value('MEDICODERIV',""); ?>" type="text" placeholder="Escribir  Medico Derivante"  required="" name="MEDICODERIV"  class="form-control " />
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group col-md-10">
                                                                                                <label class="control-label" for="DIAGNOSTICO">Diagnostico <span class="text-danger">*</span></label>
                                                                                                <div id="ctrl-DIAGNOSTICO-holder" class=""> 
                                                                                                    <textarea placeholder="Escribir  Diagnostico" id="ctrl-DIAGNOSTICO"  required="" rows="5" name="DIAGNOSTICO" class=" form-control"><?php  echo $this->set_field_value('DIAGNOSTICO',""); ?></textarea>
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
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
