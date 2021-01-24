<?php
$comp_model = new SharedController;
$page_element_id = "edit-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="edit"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-7 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-vertical needs-validation" action="<?php print_link("grupofamiliar/edit/$page_id/?csrf_token=$csrf_token"); ?>" method="post">
                            <div>
                                <div class="row">
                                    <div class="form-group col-md-11">
                                        <label class="control-label" for="NOMBREMADRE">Apellido y Nombre de la Madre <span class="text-danger">*</span></label>
                                        <div id="ctrl-NOMBREMADRE-holder" class=""> 
                                            <input id="ctrl-NOMBREMADRE"  value="<?php  echo $data['NOMBREMADRE']; ?>" type="text" placeholder="Escribir  Apellido y Nombre de la Madre"  required="" name="NOMBREMADRE"  class="form-control " />
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="control-label" for="DIRECCIONMADRE">Dirección <span class="text-danger">*</span></label>
                                            <div id="ctrl-DIRECCIONMADRE-holder" class=""> 
                                                <input id="ctrl-DIRECCIONMADRE"  value="<?php  echo $data['DIRECCIONMADRE']; ?>" type="text" placeholder="Escribir  Dirección"  required="" name="DIRECCIONMADRE"  class="form-control " />
                                                </div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="control-label" for="LOCALIDADMADRE">Localidad <span class="text-danger">*</span></label>
                                                <div id="ctrl-LOCALIDADMADRE-holder" class=""> 
                                                    <select required=""  id="ctrl-LOCALIDADMADRE" data-load-path="<?php print_link('api/json/grupofamiliar_LOCALIDADMADRE_option_list') ?>" name="LOCALIDADMADRE"  placeholder="Seleccione un valor"    class="custom-select" >
                                                        <?php
                                                        $rec = $data['LOCALIDADMADRE'];
                                                        $LOCALIDADMADRE_options = $comp_model -> grupofamiliar_LOCALIDADMADRE_option_list($data['PROVINCIAMADRE']);
                                                        if(!empty($LOCALIDADMADRE_options)){
                                                        foreach($LOCALIDADMADRE_options as $option){
                                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                                        $selected = ( $value == $rec ? 'selected' : null );
                                                        ?>
                                                        <option 
                                                            <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $label; ?>
                                                        </option>
                                                        <?php
                                                        }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="control-label" for="PROVINCIAMADRE">Provincia <span class="text-danger">*</span></label>
                                                <div id="ctrl-PROVINCIAMADRE-holder" class=""> 
                                                    <select required=""  id="ctrl-PROVINCIAMADRE" data-load-select-options="LOCALIDADMADRE" name="PROVINCIAMADRE"  placeholder="Seleccione un valor"    class="custom-select" >
                                                        <option value="">Seleccione un valor</option>
                                                        <?php
                                                        $rec = $data['PROVINCIAMADRE'];
                                                        $PROVINCIAMADRE_options = $comp_model -> grupofamiliar_PROVINCIAMADRE_option_list();
                                                        if(!empty($PROVINCIAMADRE_options)){
                                                        foreach($PROVINCIAMADRE_options as $option){
                                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                                        $selected = ( $value == $rec ? 'selected' : null );
                                                        ?>
                                                        <option 
                                                            <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $label; ?>
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
                                                    <input id="ctrl-CPMADRE"  value="<?php  echo $data['CPMADRE']; ?>" type="number" placeholder="Escribir  Cod. Postal" step="1"  required="" name="CPMADRE"  class="form-control " />
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="control-label" for="TELFIJOMADRE">Telefono Particular Fijo <span class="text-danger">*</span></label>
                                                    <div id="ctrl-TELFIJOMADRE-holder" class=""> 
                                                        <input id="ctrl-TELFIJOMADRE"  value="<?php  echo $data['TELFIJOMADRE']; ?>" type="text" placeholder="Escribir  Telefono Particular Fijo"  required="" name="TELFIJOMADRE"  class="form-control " />
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label class="control-label" for="TELCELMADRE">Telefono Celular <span class="text-danger">*</span></label>
                                                        <div id="ctrl-TELCELMADRE-holder" class=""> 
                                                            <input id="ctrl-TELCELMADRE"  value="<?php  echo $data['TELCELMADRE']; ?>" type="text" placeholder="Escribir  Telefono Celular"  required="" name="TELCELMADRE"  class="form-control " />
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label class="control-label" for="TELLABORALMADRE">Telefono Laboral <span class="text-danger">*</span></label>
                                                            <div id="ctrl-TELLABORALMADRE-holder" class=""> 
                                                                <input id="ctrl-TELLABORALMADRE"  value="<?php  echo $data['TELLABORALMADRE']; ?>" type="text" placeholder="Escribir  Telefono Laboral"  required="" name="TELLABORALMADRE"  class="form-control " />
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-11">
                                                                <label class="control-label" for="EMAILMADRE">Correo Electronico <span class="text-danger">*</span></label>
                                                                <div id="ctrl-EMAILMADRE-holder" class=""> 
                                                                    <input id="ctrl-EMAILMADRE"  value="<?php  echo $data['EMAILMADRE']; ?>" type="email" placeholder="Escribir  Correo Electronico"  required="" name="EMAILMADRE"  class="form-control " />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-11">
                                                                    <label class="control-label" for="NOMBREPADRE">Apellido y Nombre del Padre <span class="text-danger">*</span></label>
                                                                    <div id="ctrl-NOMBREPADRE-holder" class=""> 
                                                                        <input id="ctrl-NOMBREPADRE"  value="<?php  echo $data['NOMBREPADRE']; ?>" type="text" placeholder="Escribir  Apellido y Nombre del Padre"  required="" name="NOMBREPADRE"  class="form-control " />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label class="control-label" for="DIRECCIONPADRE">Direccion <span class="text-danger">*</span></label>
                                                                        <div id="ctrl-DIRECCIONPADRE-holder" class=""> 
                                                                            <input id="ctrl-DIRECCIONPADRE"  value="<?php  echo $data['DIRECCIONPADRE']; ?>" type="text" placeholder="Escribir  Direccion"  required="" name="DIRECCIONPADRE"  class="form-control " />
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label class="control-label" for="LOCALIDADPADRE">Localidad <span class="text-danger">*</span></label>
                                                                            <div id="ctrl-LOCALIDADPADRE-holder" class=""> 
                                                                                <select required=""  id="ctrl-LOCALIDADPADRE" data-load-path="<?php print_link('api/json/grupofamiliar_LOCALIDADPADRE_option_list') ?>" name="LOCALIDADPADRE"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                                    <?php
                                                                                    $rec = $data['LOCALIDADPADRE'];
                                                                                    $LOCALIDADPADRE_options = $comp_model -> grupofamiliar_LOCALIDADPADRE_option_list($data['PROVINCIAPADRE']);
                                                                                    if(!empty($LOCALIDADPADRE_options)){
                                                                                    foreach($LOCALIDADPADRE_options as $option){
                                                                                    $value = (!empty($option['value']) ? $option['value'] : null);
                                                                                    $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                                    $selected = ( $value == $rec ? 'selected' : null );
                                                                                    ?>
                                                                                    <option 
                                                                                        <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $label; ?>
                                                                                    </option>
                                                                                    <?php
                                                                                    }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label class="control-label" for="PROVINCIAPADRE">Provincia <span class="text-danger">*</span></label>
                                                                            <div id="ctrl-PROVINCIAPADRE-holder" class=""> 
                                                                                <select required=""  id="ctrl-PROVINCIAPADRE" data-load-select-options="LOCALIDADPADRE" name="PROVINCIAPADRE"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                                    <option value="">Seleccione un valor</option>
                                                                                    <?php
                                                                                    $rec = $data['PROVINCIAPADRE'];
                                                                                    $PROVINCIAPADRE_options = $comp_model -> grupofamiliar_PROVINCIAPADRE_option_list();
                                                                                    if(!empty($PROVINCIAPADRE_options)){
                                                                                    foreach($PROVINCIAPADRE_options as $option){
                                                                                    $value = (!empty($option['value']) ? $option['value'] : null);
                                                                                    $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                                    $selected = ( $value == $rec ? 'selected' : null );
                                                                                    ?>
                                                                                    <option 
                                                                                        <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $label; ?>
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
                                                                                <input id="ctrl-CPPADRE"  value="<?php  echo $data['CPPADRE']; ?>" type="number" placeholder="Escribir  Cod Postal" step="1"  required="" name="CPPADRE"  class="form-control " />
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-md-3">
                                                                                <label class="control-label" for="TELFIJOPADRE">Telefono Particular Fijo <span class="text-danger">*</span></label>
                                                                                <div id="ctrl-TELFIJOPADRE-holder" class=""> 
                                                                                    <input id="ctrl-TELFIJOPADRE"  value="<?php  echo $data['TELFIJOPADRE']; ?>" type="text" placeholder="Escribir  Telefono Particular Fijo"  required="" name="TELFIJOPADRE"  class="form-control " />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-md-3">
                                                                                    <label class="control-label" for="TELCELPADRE">Telefono Celular <span class="text-danger">*</span></label>
                                                                                    <div id="ctrl-TELCELPADRE-holder" class=""> 
                                                                                        <input id="ctrl-TELCELPADRE"  value="<?php  echo $data['TELCELPADRE']; ?>" type="text" placeholder="Escribir  Telefono Celular"  required="" name="TELCELPADRE"  class="form-control " />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group col-md-3">
                                                                                        <label class="control-label" for="TELLABORALPADRE">Telefono Laboral <span class="text-danger">*</span></label>
                                                                                        <div id="ctrl-TELLABORALPADRE-holder" class=""> 
                                                                                            <input id="ctrl-TELLABORALPADRE"  value="<?php  echo $data['TELLABORALPADRE']; ?>" type="text" placeholder="Escribir  Telefono Laboral"  required="" name="TELLABORALPADRE"  class="form-control " />
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group col-md-11">
                                                                                            <label class="control-label" for="EMAILPADRE">Correo Electronico <span class="text-danger">*</span></label>
                                                                                            <div id="ctrl-EMAILPADRE-holder" class=""> 
                                                                                                <input id="ctrl-EMAILPADRE"  value="<?php  echo $data['EMAILPADRE']; ?>" type="email" placeholder="Escribir  Correo Electronico"  required="" name="EMAILPADRE"  class="form-control " />
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-ajax-status"></div>
                                                                                        <div class="form-group text-center">
                                                                                            <button class="btn btn-primary" type="submit">
                                                                                                Actualizar
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
