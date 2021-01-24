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
                                        <i class="fa fa-book "></i> DATOS DE LA COBERTURA
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active fade" id="TabPage-1-Page1" role="tabpanel">
                                    <?php $this :: display_page_errors(); ?>
                                    <div  class="bg-light p-3 animated fadeIn page-content">
                                        <form id="cobertura-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("cobertura/add?csrf_token=$csrf_token") ?>" method="post">
                                            <div>
                                                <div class="row">
                                                    <div class="form-group col-md-3">
                                                        <label class="control-label" for="TIPODOCUMENTO">Tipodocumento <span class="text-danger">*</span></label>
                                                        <div id="ctrl-TIPODOCUMENTO-holder" class=""> 
                                                            <select required=""  id="ctrl-TIPODOCUMENTO" name="TIPODOCUMENTO"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                <option value="">Seleccione un valor</option>
                                                                <?php
                                                                $TIPODOCUMENTO_options = Menu :: $TIPODOCUMENTO;
                                                                if(!empty($TIPODOCUMENTO_options)){
                                                                foreach($TIPODOCUMENTO_options as $option){
                                                                $value = $option['value'];
                                                                $label = $option['label'];
                                                                $selected = $this->set_field_selected('TIPODOCUMENTO', $value, "");
                                                                ?>
                                                                <option <?php echo $selected ?> value="<?php echo $value ?>">
                                                                    <?php echo $label ?>
                                                                </option>                                   
                                                                <?php
                                                                }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label class="control-label" for="NRODOCUMENTO">Nrodocumento <span class="text-danger">*</span></label>
                                                        <div id="ctrl-NRODOCUMENTO-holder" class=""> 
                                                            <input id="ctrl-NRODOCUMENTO"  value="<?php  echo $this->set_field_value('NRODOCUMENTO',"0"); ?>" type="number" placeholder="Escribir  Nrodocumento" step="1"  required="" name="NRODOCUMENTO"  class="form-control " />
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label class="control-label" for="CONTACTO">Contacto <span class="text-danger">*</span></label>
                                                            <div id="ctrl-CONTACTO-holder" class=""> 
                                                                <input id="ctrl-CONTACTO"  value="<?php  echo $this->set_field_value('CONTACTO',""); ?>" type="text" placeholder="Escribir  Contacto"  required="" name="CONTACTO"  class="form-control " />
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-5">
                                                                <label class="control-label" for="NOMBCOBERTURA">Nombcobertura <span class="text-danger">*</span></label>
                                                                <div id="ctrl-NOMBCOBERTURA-holder" class=""> 
                                                                    <input id="ctrl-NOMBCOBERTURA"  value="<?php  echo $this->set_field_value('NOMBCOBERTURA',""); ?>" type="text" placeholder="Escribir  Nombcobertura"  required="" name="NOMBCOBERTURA"  class="form-control " />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-5">
                                                                    <label class="control-label" for="DOMICILIO">Domicilio <span class="text-danger">*</span></label>
                                                                    <div id="ctrl-DOMICILIO-holder" class=""> 
                                                                        <input id="ctrl-DOMICILIO"  value="<?php  echo $this->set_field_value('DOMICILIO',""); ?>" type="text" placeholder="Escribir  Domicilio"  required="" name="DOMICILIO"  class="form-control " />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label class="control-label" for="LOCALIDAD">Localidad <span class="text-danger">*</span></label>
                                                                        <div id="ctrl-LOCALIDAD-holder" class=""> 
                                                                            <select required=""  id="ctrl-LOCALIDAD" data-load-path="<?php print_link('api/json/cobertura_LOCALIDAD_option_list') ?>" name="LOCALIDAD"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                                <option value="">Seleccione un valor</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label class="control-label" for="PROVINCIA">Provincia <span class="text-danger">*</span></label>
                                                                        <div id="ctrl-PROVINCIA-holder" class=""> 
                                                                            <select required=""  id="ctrl-PROVINCIA" data-load-select-options="LOCALIDAD" name="PROVINCIA"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                                <option value="">Seleccione un valor</option>
                                                                                <?php 
                                                                                $PROVINCIA_options = $comp_model -> cobertura_PROVINCIA_option_list();
                                                                                if(!empty($PROVINCIA_options)){
                                                                                foreach($PROVINCIA_options as $option){
                                                                                $value = (!empty($option['value']) ? $option['value'] : null);
                                                                                $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                                $selected = $this->set_field_selected('PROVINCIA',$value, "");
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
                                                                        <label class="control-label" for="CODPOSTAL">Codpostal <span class="text-danger">*</span></label>
                                                                        <div id="ctrl-CODPOSTAL-holder" class=""> 
                                                                            <input id="ctrl-CODPOSTAL"  value="<?php  echo $this->set_field_value('CODPOSTAL',""); ?>" type="text" placeholder="Escribir  Codpostal"  required="" name="CODPOSTAL"  class="form-control " />
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label class="control-label" for="TELEFONO">Telefono <span class="text-danger">*</span></label>
                                                                            <div id="ctrl-TELEFONO-holder" class=""> 
                                                                                <input id="ctrl-TELEFONO"  value="<?php  echo $this->set_field_value('TELEFONO',""); ?>" type="text" placeholder="Escribir  Telefono"  required="" name="TELEFONO"  class="form-control " />
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-md-7">
                                                                                <label class="control-label" for="EMAIL">Email <span class="text-danger">*</span></label>
                                                                                <div id="ctrl-EMAIL-holder" class=""> 
                                                                                    <input id="ctrl-EMAIL"  value="<?php  echo $this->set_field_value('EMAIL',""); ?>" type="email" placeholder="Escribir  Email"  required="" name="EMAIL"  class="form-control " />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-md-7">
                                                                                    <label class="control-label" for="EMERGENCIA">Emergencia <span class="text-danger">*</span></label>
                                                                                    <div id="ctrl-EMERGENCIA-holder" class=""> 
                                                                                        <input id="ctrl-EMERGENCIA"  value="<?php  echo $this->set_field_value('EMERGENCIA',""); ?>" type="text" placeholder="Escribir  Emergencia"  required="" name="EMERGENCIA"  class="form-control " />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group col-md-3">
                                                                                        <label class="control-label" for="TELEFONOEMERG">Telefono <span class="text-danger">*</span></label>
                                                                                        <div id="ctrl-TELEFONOEMERG-holder" class=""> 
                                                                                            <input id="ctrl-TELEFONOEMERG"  value="<?php  echo $this->set_field_value('TELEFONOEMERG',""); ?>" type="text" placeholder="Escribir  Telefono"  required="" name="TELEFONOEMERG"  class="form-control " />
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group col-md-10">
                                                                                            <label class="control-label" for="OBSERVAC">Observaciones </label>
                                                                                            <div id="ctrl-OBSERVAC-holder" class=""> 
                                                                                                <textarea placeholder="Escribir  Observaciones" id="ctrl-OBSERVAC"  rows="5" name="OBSERVAC" class=" form-control"><?php  echo $this->set_field_value('OBSERVAC',""); ?></textarea>
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
