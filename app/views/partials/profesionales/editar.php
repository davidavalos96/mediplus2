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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-vertical needs-validation" action="<?php print_link("profesionales/editar/$page_id/?csrf_token=$csrf_token"); ?>" method="post">
                            <div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="FECHAALTA">Fecha de Alta <span class="text-danger">*</span></label>
                                        <div id="ctrl-FECHAALTA-holder" class="input-group"> 
                                            <input id="ctrl-FECHAALTA" class="form-control datepicker  datepicker"  required="" value="<?php  echo $data['FECHAALTA']; ?>" type="datetime" name="FECHAALTA" placeholder="Escribir  Fecha de Alta" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="control-label" for="FECHABAJA">Fecha de Baja <span class="text-danger">*</span></label>
                                            <div id="ctrl-FECHABAJA-holder" class="input-group"> 
                                                <input id="ctrl-FECHABAJA" class="form-control datepicker  datepicker"  required="" value="<?php  echo $data['FECHABAJA']; ?>" type="datetime" name="FECHABAJA" placeholder="Escribir  Fecha de Baja" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="control-label" for="TIPODOCPRO">Tipo de Doc. <span class="text-danger">*</span></label>
                                                <div id="ctrl-TIPODOCPRO-holder" class=""> 
                                                    <select required=""  id="ctrl-TIPODOCPRO" name="TIPODOCPRO"  placeholder="Seleccione un valor"    class="custom-select" >
                                                        <option value="">Seleccione un valor</option>
                                                        <?php
                                                        $TIPODOCPRO_options = Menu :: $TIPODOCPRO2;
                                                        $field_value = $data['TIPODOCPRO'];
                                                        if(!empty($TIPODOCPRO_options)){
                                                        foreach($TIPODOCPRO_options as $option){
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
                                                <label class="control-label" for="NRODOCPRO">N° de Documento <span class="text-danger">*</span></label>
                                                <div id="ctrl-NRODOCPRO-holder" class=""> 
                                                    <input id="ctrl-NRODOCPRO"  value="<?php  echo $data['NRODOCPRO']; ?>" type="text" placeholder="Escribir  N° de Documento"  required="" name="NRODOCPRO"  class="form-control " />
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="control-label" for="FECHANACPRO">Fecha de Nacimiento <span class="text-danger">*</span></label>
                                                    <div id="ctrl-FECHANACPRO-holder" class="input-group"> 
                                                        <input id="ctrl-FECHANACPRO" class="form-control datepicker  datepicker"  required="" value="<?php  echo $data['FECHANACPRO']; ?>" type="datetime" name="FECHANACPRO" placeholder="Escribir  Fecha de Nacimiento" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-8">
                                                        <label class="control-label" for="NOMBAPEPRO">Apellido y Nombre <span class="text-danger">*</span></label>
                                                        <div id="ctrl-NOMBAPEPRO-holder" class=""> 
                                                            <input id="ctrl-NOMBAPEPRO"  value="<?php  echo $data['NOMBAPEPRO']; ?>" type="text" placeholder="Escribir  Apellido y Nombre"  required="" name="NOMBAPEPRO"  class="form-control " />
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-5">
                                                            <label class="control-label" for="DOMICILIO">Domicilio <span class="text-danger">*</span></label>
                                                            <div id="ctrl-DOMICILIO-holder" class=""> 
                                                                <input id="ctrl-DOMICILIO"  value="<?php  echo $data['DOMICILIO']; ?>" type="text" placeholder="Escribir  Domicilio"  required="" name="DOMICILIO"  class="form-control " />
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="control-label" for="BARRIO">Barrio </label>
                                                                <div id="ctrl-BARRIO-holder" class=""> 
                                                                    <select  id="ctrl-BARRIO" data-load-path="<?php print_link('api/json/profesionales_BARRIO_option_list') ?>" name="BARRIO"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                        <?php
                                                                        $rec = $data['BARRIO'];
                                                                        $BARRIO_options = $comp_model -> profesionales_BARRIO_option_list($data['LOCALIDAD']);
                                                                        if(!empty($BARRIO_options)){
                                                                        foreach($BARRIO_options as $option){
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
                                                                    <select required=""  id="ctrl-LOCALIDAD" data-load-select-options="BARRIO" name="LOCALIDAD"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                        <option value="">Seleccione un valor</option>
                                                                        <?php
                                                                        $rec = $data['LOCALIDAD'];
                                                                        $LOCALIDAD_options = $comp_model -> profesionales_LOCALIDAD_option_list();
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
                                                                <label class="control-label" for="TELPARTPRO">Telefono Fijo Particular <span class="text-danger">*</span></label>
                                                                <div id="ctrl-TELPARTPRO-holder" class=""> 
                                                                    <input id="ctrl-TELPARTPRO"  value="<?php  echo $data['TELPARTPRO']; ?>" type="text" placeholder="Escribir  Telefono Fijo Particular"  required="" name="TELPARTPRO"  class="form-control " />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label class="control-label" for="TELCELPRO">Telefono Celular <span class="text-danger">*</span></label>
                                                                    <div id="ctrl-TELCELPRO-holder" class=""> 
                                                                        <input id="ctrl-TELCELPRO"  value="<?php  echo $data['TELCELPRO']; ?>" type="text" placeholder="Escribir  Telefono Celular"  required="" name="TELCELPRO"  class="form-control " />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-5">
                                                                        <label class="control-label" for="EMAIL">Correo Electronico <span class="text-danger">*</span></label>
                                                                        <div id="ctrl-EMAIL-holder" class=""> 
                                                                            <input id="ctrl-EMAIL"  value="<?php  echo $data['EMAIL']; ?>" type="email" placeholder="Escribir  Correo Electronico"  required="" name="EMAIL"  class="form-control " />
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label class="control-label" for="NROMATRICULA">Matricula N° <span class="text-danger">*</span></label>
                                                                            <div id="ctrl-NROMATRICULA-holder" class=""> 
                                                                                <input id="ctrl-NROMATRICULA"  value="<?php  echo $data['NROMATRICULA']; ?>" type="text" placeholder="Escribir  Matricula N°"  required="" name="NROMATRICULA"  class="form-control " />
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-md-3">
                                                                                <label class="control-label" for="FECHAVTOMAT">Fecha Venc. Matricula <span class="text-danger">*</span></label>
                                                                                <div id="ctrl-FECHAVTOMAT-holder" class="input-group"> 
                                                                                    <input id="ctrl-FECHAVTOMAT" class="form-control datepicker  datepicker"  required="" value="<?php  echo $data['FECHAVTOMAT']; ?>" type="datetime" name="FECHAVTOMAT" placeholder="Escribir  Fecha Venc. Matricula" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                                                        <div class="input-group-append">
                                                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-md-2">
                                                                                    <label class="control-label" for="NRORNP">N° de RNP <span class="text-danger">*</span></label>
                                                                                    <div id="ctrl-NRORNP-holder" class=""> 
                                                                                        <input id="ctrl-NRORNP"  value="<?php  echo $data['NRORNP']; ?>" type="text" placeholder="Escribir  N° de RNP"  required="" name="NRORNP"  class="form-control " />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group col-md-3">
                                                                                        <label class="control-label" for="FECHAVTORNP">Fecha de Venc. NRP <span class="text-danger">*</span></label>
                                                                                        <div id="ctrl-FECHAVTORNP-holder" class="input-group"> 
                                                                                            <input id="ctrl-FECHAVTORNP" class="form-control datepicker  datepicker"  required="" value="<?php  echo $data['FECHAVTORNP']; ?>" type="datetime" name="FECHAVTORNP" placeholder="Escribir  Fecha de Venc. NRP" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                                                                <div class="input-group-append">
                                                                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group col-md-3">
                                                                                            <label class="control-label" for="EXEINGRESOSBRUTOS">Ext. Ingresos Brutos <span class="text-danger">*</span></label>
                                                                                            <div id="ctrl-EXEINGRESOSBRUTOS-holder" class="input-group"> 
                                                                                                <input id="ctrl-EXEINGRESOSBRUTOS" class="form-control datepicker  datepicker"  required="" value="<?php  echo $data['EXEINGRESOSBRUTOS']; ?>" type="datetime" name="EXEINGRESOSBRUTOS" placeholder="Escribir  Ext. Ingresos Brutos" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                                                                    <div class="input-group-append">
                                                                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group col-md-3">
                                                                                                <label class="control-label" for="POLIZA">Vencimiento Poliza <span class="text-danger">*</span></label>
                                                                                                <div id="ctrl-POLIZA-holder" class="input-group"> 
                                                                                                    <input id="ctrl-POLIZA" class="form-control datepicker  datepicker"  required="" value="<?php  echo $data['POLIZA']; ?>" type="datetime" name="POLIZA" placeholder="Escribir  Vencimiento Poliza" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                                                                        <div class="input-group-append">
                                                                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                                                        </div>
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
