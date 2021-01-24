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
                <div class="col-md-7 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form id="grupofamiliar-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("grupofamiliar/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="row">
                                    <div class="form-group col-md-11">
                                        <label class="control-label" for="NOMBREMADRE">Apellido y Nombre de la Madre <span class="text-danger">*</span></label>
                                        <div id="ctrl-NOMBREMADRE-holder" class=""> 
                                            <input id="ctrl-NOMBREMADRE"  value="<?php  echo $this->set_field_value('NOMBREMADRE',""); ?>" type="text" placeholder="Escribir  Apellido y Nombre de la Madre"  required="" name="NOMBREMADRE"  class="form-control " />
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="control-label" for="DIRECCIONMADRE">Dirección <span class="text-danger">*</span></label>
                                            <div id="ctrl-DIRECCIONMADRE-holder" class=""> 
                                                <input id="ctrl-DIRECCIONMADRE"  value="<?php  echo $this->set_field_value('DIRECCIONMADRE',""); ?>" type="text" placeholder="Escribir  Dirección"  required="" name="DIRECCIONMADRE"  class="form-control " />
                                                </div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="control-label" for="LOCALIDADMADRE">Localidad <span class="text-danger">*</span></label>
                                                <div id="ctrl-LOCALIDADMADRE-holder" class=""> 
                                                    <select required=""  id="ctrl-LOCALIDADMADRE" data-load-path="<?php print_link('api/json/grupofamiliar_LOCALIDADMADRE_option_list') ?>" name="LOCALIDADMADRE"  placeholder="Seleccione un valor"    class="custom-select" >
                                                        <option value="">Seleccione un valor</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="control-label" for="PROVINCIAMADRE">Provincia <span class="text-danger">*</span></label>
                                                <div id="ctrl-PROVINCIAMADRE-holder" class=""> 
                                                    <select required=""  id="ctrl-PROVINCIAMADRE" data-load-select-options="LOCALIDADMADRE" name="PROVINCIAMADRE"  placeholder="Seleccione un valor"    class="custom-select" >
                                                        <option value="">Seleccione un valor</option>
                                                        <?php 
                                                        $PROVINCIAMADRE_options = $comp_model -> grupofamiliar_PROVINCIAMADRE_option_list();
                                                        if(!empty($PROVINCIAMADRE_options)){
                                                        foreach($PROVINCIAMADRE_options as $option){
                                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                                        $selected = $this->set_field_selected('PROVINCIAMADRE',$value, "");
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
                                                <label class="control-label" for="CPMADRE">Cod. Postal <span class="text-danger">*</span></label>
                                                <div id="ctrl-CPMADRE-holder" class=""> 
                                                    <input id="ctrl-CPMADRE"  value="<?php  echo $this->set_field_value('CPMADRE',""); ?>" type="number" placeholder="Escribir  Cod. Postal" step="1"  required="" name="CPMADRE"  class="form-control " />
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="control-label" for="TELFIJOMADRE">Telefono Particular Fijo <span class="text-danger">*</span></label>
                                                    <div id="ctrl-TELFIJOMADRE-holder" class=""> 
                                                        <input id="ctrl-TELFIJOMADRE"  value="<?php  echo $this->set_field_value('TELFIJOMADRE',""); ?>" type="text" placeholder="Escribir  Telefono Particular Fijo"  required="" name="TELFIJOMADRE"  class="form-control " />
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label class="control-label" for="TELCELMADRE">Telefono Celular <span class="text-danger">*</span></label>
                                                        <div id="ctrl-TELCELMADRE-holder" class=""> 
                                                            <input id="ctrl-TELCELMADRE"  value="<?php  echo $this->set_field_value('TELCELMADRE',""); ?>" type="text" placeholder="Escribir  Telefono Celular"  required="" name="TELCELMADRE"  class="form-control " />
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label class="control-label" for="TELLABORALMADRE">Telefono Laboral <span class="text-danger">*</span></label>
                                                            <div id="ctrl-TELLABORALMADRE-holder" class=""> 
                                                                <input id="ctrl-TELLABORALMADRE"  value="<?php  echo $this->set_field_value('TELLABORALMADRE',""); ?>" type="text" placeholder="Escribir  Telefono Laboral"  required="" name="TELLABORALMADRE"  class="form-control " />
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-11">
                                                                <label class="control-label" for="EMAILMADRE">Correo Electronico <span class="text-danger">*</span></label>
                                                                <div id="ctrl-EMAILMADRE-holder" class=""> 
                                                                    <input id="ctrl-EMAILMADRE"  value="<?php  echo $this->set_field_value('EMAILMADRE',""); ?>" type="email" placeholder="Escribir  Correo Electronico"  required="" name="EMAILMADRE"  class="form-control " />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-11">
                                                                    <label class="control-label" for="NOMBREPADRE">Apellido y Nombre del Padre <span class="text-danger">*</span></label>
                                                                    <div id="ctrl-NOMBREPADRE-holder" class=""> 
                                                                        <input id="ctrl-NOMBREPADRE"  value="<?php  echo $this->set_field_value('NOMBREPADRE',""); ?>" type="text" placeholder="Escribir  Apellido y Nombre del Padre"  required="" name="NOMBREPADRE"  class="form-control " />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label class="control-label" for="DIRECCIONPADRE">Direccion <span class="text-danger">*</span></label>
                                                                        <div id="ctrl-DIRECCIONPADRE-holder" class=""> 
                                                                            <input id="ctrl-DIRECCIONPADRE"  value="<?php  echo $this->set_field_value('DIRECCIONPADRE',""); ?>" type="text" placeholder="Escribir  Direccion"  required="" name="DIRECCIONPADRE"  class="form-control " />
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label class="control-label" for="LOCALIDADPADRE">Localidad <span class="text-danger">*</span></label>
                                                                            <div id="ctrl-LOCALIDADPADRE-holder" class=""> 
                                                                                <select required=""  id="ctrl-LOCALIDADPADRE" data-load-path="<?php print_link('api/json/grupofamiliar_LOCALIDADPADRE_option_list') ?>" name="LOCALIDADPADRE"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                                    <option value="">Seleccione un valor</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label class="control-label" for="PROVINCIAPADRE">Provincia <span class="text-danger">*</span></label>
                                                                            <div id="ctrl-PROVINCIAPADRE-holder" class=""> 
                                                                                <select required=""  id="ctrl-PROVINCIAPADRE" data-load-select-options="LOCALIDADPADRE" name="PROVINCIAPADRE"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                                    <option value="">Seleccione un valor</option>
                                                                                    <?php 
                                                                                    $PROVINCIAPADRE_options = $comp_model -> grupofamiliar_PROVINCIAPADRE_option_list();
                                                                                    if(!empty($PROVINCIAPADRE_options)){
                                                                                    foreach($PROVINCIAPADRE_options as $option){
                                                                                    $value = (!empty($option['value']) ? $option['value'] : null);
                                                                                    $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                                    $selected = $this->set_field_selected('PROVINCIAPADRE',$value, "");
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
                                                                            <label class="control-label" for="CPPADRE">Cod Postal <span class="text-danger">*</span></label>
                                                                            <div id="ctrl-CPPADRE-holder" class=""> 
                                                                                <input id="ctrl-CPPADRE"  value="<?php  echo $this->set_field_value('CPPADRE',""); ?>" type="number" placeholder="Escribir  Cod Postal" step="1"  required="" name="CPPADRE"  class="form-control " />
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-md-3">
                                                                                <label class="control-label" for="TELFIJOPADRE">Telefono Particular Fijo <span class="text-danger">*</span></label>
                                                                                <div id="ctrl-TELFIJOPADRE-holder" class=""> 
                                                                                    <input id="ctrl-TELFIJOPADRE"  value="<?php  echo $this->set_field_value('TELFIJOPADRE',""); ?>" type="text" placeholder="Escribir  Telefono Particular Fijo"  required="" name="TELFIJOPADRE"  class="form-control " />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-md-3">
                                                                                    <label class="control-label" for="TELCELPADRE">Telefono Celular <span class="text-danger">*</span></label>
                                                                                    <div id="ctrl-TELCELPADRE-holder" class=""> 
                                                                                        <input id="ctrl-TELCELPADRE"  value="<?php  echo $this->set_field_value('TELCELPADRE',""); ?>" type="text" placeholder="Escribir  Telefono Celular"  required="" name="TELCELPADRE"  class="form-control " />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group col-md-3">
                                                                                        <label class="control-label" for="TELLABORALPADRE">Telefono Laboral <span class="text-danger">*</span></label>
                                                                                        <div id="ctrl-TELLABORALPADRE-holder" class=""> 
                                                                                            <input id="ctrl-TELLABORALPADRE"  value="<?php  echo $this->set_field_value('TELLABORALPADRE',""); ?>" type="text" placeholder="Escribir  Telefono Laboral"  required="" name="TELLABORALPADRE"  class="form-control " />
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group col-md-11">
                                                                                            <label class="control-label" for="EMAILPADRE">Correo Electronico <span class="text-danger">*</span></label>
                                                                                            <div id="ctrl-EMAILPADRE-holder" class=""> 
                                                                                                <input id="ctrl-EMAILPADRE"  value="<?php  echo $this->set_field_value('EMAILPADRE',""); ?>" type="email" placeholder="Escribir  Correo Electronico"  required="" name="EMAILPADRE"  class="form-control " />
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
