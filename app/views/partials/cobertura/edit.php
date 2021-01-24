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
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-vertical needs-validation" action="<?php print_link("cobertura/edit/$page_id/?csrf_token=$csrf_token"); ?>" method="post">
                            <div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="TIPODOCUMENTO">Tipodocumento <span class="text-danger">*</span></label>
                                        <div id="ctrl-TIPODOCUMENTO-holder" class=""> 
                                            <select required=""  id="ctrl-TIPODOCUMENTO" name="TIPODOCUMENTO"  placeholder="Seleccione un valor"    class="custom-select" >
                                                <option value="">Seleccione un valor</option>
                                                <?php
                                                $TIPODOCUMENTO_options = Menu :: $TIPODOCUMENTO;
                                                $field_value = $data['TIPODOCUMENTO'];
                                                if(!empty($TIPODOCUMENTO_options)){
                                                foreach($TIPODOCUMENTO_options as $option){
                                                $value = $option['value'];
                                                $label = $option['label'];
                                                $selected = ( $value == $field_value ? 'selected' : null );
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
                                            <input id="ctrl-NRODOCUMENTO"  value="<?php  echo $data['NRODOCUMENTO']; ?>" type="number" placeholder="Escribir  Nrodocumento" step="1"  required="" name="NRODOCUMENTO"  class="form-control " />
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="control-label" for="CONTACTO">Contacto <span class="text-danger">*</span></label>
                                            <div id="ctrl-CONTACTO-holder" class=""> 
                                                <input id="ctrl-CONTACTO"  value="<?php  echo $data['CONTACTO']; ?>" type="text" placeholder="Escribir  Contacto"  required="" name="CONTACTO"  class="form-control " />
                                                </div>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label class="control-label" for="NOMBCOBERTURA">Nombcobertura <span class="text-danger">*</span></label>
                                                <div id="ctrl-NOMBCOBERTURA-holder" class=""> 
                                                    <input id="ctrl-NOMBCOBERTURA"  value="<?php  echo $data['NOMBCOBERTURA']; ?>" type="text" placeholder="Escribir  Nombcobertura"  required="" name="NOMBCOBERTURA"  class="form-control " />
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label class="control-label" for="DOMICILIO">Domicilio <span class="text-danger">*</span></label>
                                                    <div id="ctrl-DOMICILIO-holder" class=""> 
                                                        <input id="ctrl-DOMICILIO"  value="<?php  echo $data['DOMICILIO']; ?>" type="text" placeholder="Escribir  Domicilio"  required="" name="DOMICILIO"  class="form-control " />
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label" for="LOCALIDAD">Localidad <span class="text-danger">*</span></label>
                                                        <div id="ctrl-LOCALIDAD-holder" class=""> 
                                                            <select required=""  id="ctrl-LOCALIDAD" data-load-path="<?php print_link('api/json/cobertura_LOCALIDAD_option_list') ?>" name="LOCALIDAD"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                <?php
                                                                $rec = $data['LOCALIDAD'];
                                                                $LOCALIDAD_options = $comp_model -> cobertura_LOCALIDAD_option_list($data['PROVINCIA']);
                                                                if(!empty($LOCALIDAD_options)){
                                                                foreach($LOCALIDAD_options as $option){
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
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label" for="PROVINCIA">Provincia <span class="text-danger">*</span></label>
                                                        <div id="ctrl-PROVINCIA-holder" class=""> 
                                                            <select required=""  id="ctrl-PROVINCIA" data-load-select-options="LOCALIDAD" name="PROVINCIA"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                <option value="">Seleccione un valor</option>
                                                                <?php
                                                                $rec = $data['PROVINCIA'];
                                                                $PROVINCIA_options = $comp_model -> cobertura_PROVINCIA_option_list();
                                                                if(!empty($PROVINCIA_options)){
                                                                foreach($PROVINCIA_options as $option){
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
                                                        <label class="control-label" for="CODPOSTAL">Codpostal <span class="text-danger">*</span></label>
                                                        <div id="ctrl-CODPOSTAL-holder" class=""> 
                                                            <input id="ctrl-CODPOSTAL"  value="<?php  echo $data['CODPOSTAL']; ?>" type="text" placeholder="Escribir  Codpostal"  required="" name="CODPOSTAL"  class="form-control " />
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label class="control-label" for="TELEFONO">Telefono <span class="text-danger">*</span></label>
                                                            <div id="ctrl-TELEFONO-holder" class=""> 
                                                                <input id="ctrl-TELEFONO"  value="<?php  echo $data['TELEFONO']; ?>" type="text" placeholder="Escribir  Telefono"  required="" name="TELEFONO"  class="form-control " />
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-7">
                                                                <label class="control-label" for="EMAIL">Email <span class="text-danger">*</span></label>
                                                                <div id="ctrl-EMAIL-holder" class=""> 
                                                                    <input id="ctrl-EMAIL"  value="<?php  echo $data['EMAIL']; ?>" type="email" placeholder="Escribir  Email"  required="" name="EMAIL"  class="form-control " />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-7">
                                                                    <label class="control-label" for="EMERGENCIA">Emergencia <span class="text-danger">*</span></label>
                                                                    <div id="ctrl-EMERGENCIA-holder" class=""> 
                                                                        <input id="ctrl-EMERGENCIA"  value="<?php  echo $data['EMERGENCIA']; ?>" type="text" placeholder="Escribir  Emergencia"  required="" name="EMERGENCIA"  class="form-control " />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label class="control-label" for="TELEFONOEMERG">Telefono <span class="text-danger">*</span></label>
                                                                        <div id="ctrl-TELEFONOEMERG-holder" class=""> 
                                                                            <input id="ctrl-TELEFONOEMERG"  value="<?php  echo $data['TELEFONOEMERG']; ?>" type="text" placeholder="Escribir  Telefono"  required="" name="TELEFONOEMERG"  class="form-control " />
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-10">
                                                                            <label class="control-label" for="OBSERVAC">Observaciones </label>
                                                                            <div id="ctrl-OBSERVAC-holder" class=""> 
                                                                                <textarea placeholder="Escribir  Observaciones" id="ctrl-OBSERVAC"  rows="5" name="OBSERVAC" class=" form-control"><?php  echo $data['OBSERVAC']; ?></textarea>
                                                                                <!--<div class="invalid-feedback animated bounceIn text-center">Por favor ingrese el texto</div>-->
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
