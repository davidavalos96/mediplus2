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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-vertical needs-validation" action="<?php print_link("pacientes/editarpaciente/$page_id/?csrf_token=$csrf_token"); ?>" method="post">
                            <div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="NUMDOCPAC">N° de Documento <span class="text-danger">*</span></label>
                                        <div id="ctrl-NUMDOCPAC-holder" class=""> 
                                            <input id="ctrl-NUMDOCPAC"  value="<?php  echo $data['NUMDOCPAC']; ?>" type="number" placeholder="Escribir  N° de Documento" step="1"  required="" name="NUMDOCPAC"  class="form-control " />
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="control-label" for="FECHANACPAC">Fecha de Nacimiento <span class="text-danger">*</span></label>
                                            <div id="ctrl-FECHANACPAC-holder" class="input-group"> 
                                                <input id="ctrl-FECHANACPAC" class="form-control datepicker  datepicker"  required="" value="<?php  echo $data['FECHANACPAC']; ?>" type="datetime" name="FECHANACPAC" placeholder="Escribir  Fecha de Nacimiento" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="control-label" for="FECHACERTVTO">Fecha Venc. Certificado <span class="text-danger">*</span></label>
                                                <div id="ctrl-FECHACERTVTO-holder" class="input-group"> 
                                                    <input id="ctrl-FECHACERTVTO" class="form-control datepicker  datepicker"  required="" value="<?php  echo $data['FECHACERTVTO']; ?>" type="datetime" name="FECHACERTVTO" placeholder="Escribir  Fecha Venc. Certificado" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label class="control-label" for="NOMBAPEPAC">Apellido y Nombre <span class="text-danger">*</span></label>
                                                    <div id="ctrl-NOMBAPEPAC-holder" class=""> 
                                                        <input id="ctrl-NOMBAPEPAC"  value="<?php  echo $data['NOMBAPEPAC']; ?>" type="text" placeholder="Escribir  Apellido y Nombre"  required="" name="NOMBAPEPAC"  class="form-control " />
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-5">
                                                        <label class="control-label" for="COORDINADOR">Coordinador <span class="text-danger">*</span></label>
                                                        <div id="ctrl-COORDINADOR-holder" class=""> 
                                                            <input id="ctrl-COORDINADOR"  value="<?php  echo $data['COORDINADOR']; ?>" type="text" placeholder="Escribir  Coordinador"  required="" name="COORDINADOR"  class="form-control " />
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label class="control-label" for="COBERTURA">Cobertura <span class="text-danger">*</span></label>
                                                            <div id="ctrl-COBERTURA-holder" class=""> 
                                                                <select required=""  id="ctrl-COBERTURA" name="COBERTURA"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                    <option value="">Seleccione un valor</option>
                                                                    <?php
                                                                    $rec = $data['COBERTURA'];
                                                                    $COBERTURA_options = $comp_model -> pacientes_COBERTURA_option_list();
                                                                    if(!empty($COBERTURA_options)){
                                                                    foreach($COBERTURA_options as $option){
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
                                                            <label class="control-label" for="PLANOBRASOC">Planobrasoc <span class="text-danger">*</span></label>
                                                            <div id="ctrl-PLANOBRASOC-holder" class=""> 
                                                                <input id="ctrl-PLANOBRASOC"  value="<?php  echo $data['PLANOBRASOC']; ?>" type="text" placeholder="Escribir  Planobrasoc"  required="" name="PLANOBRASOC"  class="form-control " />
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label class="control-label" for="NROAFILIADO">Nroafiliado <span class="text-danger">*</span></label>
                                                                <div id="ctrl-NROAFILIADO-holder" class=""> 
                                                                    <input id="ctrl-NROAFILIADO"  value="<?php  echo $data['NROAFILIADO']; ?>" type="text" placeholder="Escribir  Nroafiliado"  required="" name="NROAFILIADO"  class="form-control " />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label class="control-label" for="DOMICILIO">Domicilio <span class="text-danger">*</span></label>
                                                                    <div id="ctrl-DOMICILIO-holder" class=""> 
                                                                        <input id="ctrl-DOMICILIO"  value="<?php  echo $data['DOMICILIO']; ?>" type="text" placeholder="Escribir  Domicilio"  required="" name="DOMICILIO"  class="form-control " />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label class="control-label" for="barrio">Barrio <span class="text-danger">*</span></label>
                                                                        <div id="ctrl-barrio-holder" class=""> 
                                                                            <select required=""  id="ctrl-barrio" data-load-path="<?php print_link('api/json/pacientes_barrio_option_list') ?>" name="barrio"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                                <?php
                                                                                $rec = $data['barrio'];
                                                                                $barrio_options = $comp_model -> pacientes_barrio_option_list_2($data['LOCALIDAD']);
                                                                                if(!empty($barrio_options)){
                                                                                foreach($barrio_options as $option){
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
                                                                        <label class="control-label" for="LOCALIDAD">Localidad <span class="text-danger">*</span></label>
                                                                        <div id="ctrl-LOCALIDAD-holder" class=""> 
                                                                            <select required=""  id="ctrl-LOCALIDAD" data-load-select-options="barrio" name="LOCALIDAD"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                                <option value="">Seleccione un valor</option>
                                                                                <?php
                                                                                $rec = $data['LOCALIDAD'];
                                                                                $LOCALIDAD_options = $comp_model -> pacientes_LOCALIDAD_option_list();
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
                                                                    <div class="form-group col-md-3">
                                                                        <label class="control-label" for="TELEFONO">Telefono <span class="text-danger">*</span></label>
                                                                        <div id="ctrl-TELEFONO-holder" class=""> 
                                                                            <input id="ctrl-TELEFONO"  value="<?php  echo $data['TELEFONO']; ?>" type="text" placeholder="Escribir  Telefono"  required="" name="TELEFONO"  class="form-control " />
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-7">
                                                                            <label class="control-label" for="EMAIL">Correo Electronico <span class="text-danger">*</span></label>
                                                                            <div id="ctrl-EMAIL-holder" class=""> 
                                                                                <input id="ctrl-EMAIL"  value="<?php  echo $data['EMAIL']; ?>" type="email" placeholder="Escribir  Correo Electronico"  required="" name="EMAIL"  class="form-control " />
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-md-10">
                                                                                <label class="control-label" for="DIAGNOSTICO">Diagnostico <span class="text-danger">*</span></label>
                                                                                <div id="ctrl-DIAGNOSTICO-holder" class=""> 
                                                                                    <input id="ctrl-DIAGNOSTICO"  value="<?php  echo $data['DIAGNOSTICO']; ?>" type="text" placeholder="Escribir  Diagnostico"  required="" name="DIAGNOSTICO"  class="form-control " />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-md-10">
                                                                                    <label class="control-label" for="MEDICODERIV">Medico Derivante <span class="text-danger">*</span></label>
                                                                                    <div id="ctrl-MEDICODERIV-holder" class=""> 
                                                                                        <textarea placeholder="Escribir  Medico Derivante" id="ctrl-MEDICODERIV"  required="" rows="5" name="MEDICODERIV" class=" form-control"><?php  echo $data['MEDICODERIV']; ?></textarea>
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
