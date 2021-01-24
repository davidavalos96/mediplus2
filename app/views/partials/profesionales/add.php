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
                <div class="col-md-11 comp-grid">
                    <div class="card ">
                        <div class="card-header p-0 pt-2 px-2">
                            <ul class="nav  nav-tabs   ">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#TabPage-1-Page1" role="tab" aria-selected="true">
                                        <i class="fa fa-user-md "></i> DATOS DEL PROFESIONAL
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active fade" id="TabPage-1-Page1" role="tabpanel">
                                    <?php $this :: display_page_errors(); ?>
                                    <div  class="bg-light p-3 animated fadeIn page-content">
                                        <form id="profesionales-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("profesionales/add?csrf_token=$csrf_token") ?>" method="post">
                                            <div>
                                                <div class="row">
                                                    <div class="form-group col-md-3">
                                                        <label class="control-label" for="FECHAALTA">Fecha de Alta <span class="text-danger">*</span></label>
                                                        <div id="ctrl-FECHAALTA-holder" class="input-group"> 
                                                            <input id="ctrl-FECHAALTA" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('FECHAALTA',date_now()); ?>" type="datetime" name="FECHAALTA" placeholder="Escribir  Fecha de Alta" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label class="control-label" for="FECHABAJA">Fecha de Baja </label>
                                                            <div id="ctrl-FECHABAJA-holder" class="input-group"> 
                                                                <input id="ctrl-FECHABAJA" class="form-control datepicker  datepicker"  value="<?php  echo $this->set_field_value('FECHABAJA',""); ?>" type="datetime" name="FECHABAJA" placeholder="Escribir  Fecha de Baja" data-enable-time="false" data-min-date="" data-max-date="<?php echo date_now(); ?>" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="control-label" for="FECHANACPRO">Fecha de Nacimiento <span class="text-danger">*</span></label>
                                                                <div id="ctrl-FECHANACPRO-holder" class="input-group"> 
                                                                    <input id="ctrl-FECHANACPRO" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('FECHANACPRO',""); ?>" type="datetime" name="FECHANACPRO" placeholder="Escribir  Fecha de Nacimiento" data-enable-time="false" data-min-date="" data-max-date="<?php echo date('d-m-Y', strtotime('-18year')); ?>" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
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
                                                                            $TIPODOCPRO_options = Menu :: $TIPODOCPRO;
                                                                            if(!empty($TIPODOCPRO_options)){
                                                                            foreach($TIPODOCPRO_options as $option){
                                                                            $value = $option['value'];
                                                                            $label = $option['label'];
                                                                            $selected = $this->set_field_selected('TIPODOCPRO', $value, "");
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
                                                                        <input id="ctrl-NRODOCPRO"  value="<?php  echo $this->set_field_value('NRODOCPRO',""); ?>" type="text" placeholder="Escribir  N° de Documento"  required="" name="NRODOCPRO"  class="form-control " />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-8">
                                                                        <label class="control-label" for="NOMBAPEPRO">Apellido y Nombre <span class="text-danger">*</span></label>
                                                                        <div id="ctrl-NOMBAPEPRO-holder" class=""> 
                                                                            <input id="ctrl-NOMBAPEPRO"  value="<?php  echo $this->set_field_value('NOMBAPEPRO',""); ?>" type="text" placeholder="Escribir  Apellido y Nombre"  required="" name="NOMBAPEPRO"  class="form-control " />
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label class="control-label" for="DOMICILIO">Domicilio <span class="text-danger">*</span></label>
                                                                            <div id="ctrl-DOMICILIO-holder" class=""> 
                                                                                <input id="ctrl-DOMICILIO"  value="<?php  echo $this->set_field_value('DOMICILIO',""); ?>" type="text" placeholder="Escribir  Domicilio"  required="" name="DOMICILIO"  class="form-control " />
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-md-3">
                                                                                <label class="control-label" for="BARRIO">Barrio <span class="text-danger">*</span></label>
                                                                                <div id="ctrl-BARRIO-holder" class=""> 
                                                                                    <select required=""  id="ctrl-BARRIO" data-load-path="<?php print_link('api/json/profesionales_BARRIO_option_list') ?>" name="BARRIO"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                                        <option value="">Seleccione un valor</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-md-4">
                                                                                <label class="control-label" for="LOCALIDAD">Localidad <span class="text-danger">*</span></label>
                                                                                <div id="ctrl-LOCALIDAD-holder" class=""> 
                                                                                    <select required=""  id="ctrl-LOCALIDAD" data-load-select-options="BARRIO" name="LOCALIDAD"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                                        <option value="">Seleccione un valor</option>
                                                                                        <?php 
                                                                                        $LOCALIDAD_options = $comp_model -> profesionales_LOCALIDAD_option_list();
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
                                                                                <label class="control-label" for="TELPARTPRO">Telefono Fijo Particular <span class="text-danger">*</span></label>
                                                                                <div id="ctrl-TELPARTPRO-holder" class=""> 
                                                                                    <input id="ctrl-TELPARTPRO"  value="<?php  echo $this->set_field_value('TELPARTPRO',""); ?>" type="text" placeholder="Escribir  Telefono Fijo Particular"  required="" name="TELPARTPRO"  class="form-control " />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-md-3">
                                                                                    <label class="control-label" for="TELCELPRO">Telefono Celular <span class="text-danger">*</span></label>
                                                                                    <div id="ctrl-TELCELPRO-holder" class=""> 
                                                                                        <input id="ctrl-TELCELPRO"  value="<?php  echo $this->set_field_value('TELCELPRO',""); ?>" type="text" placeholder="Escribir  Telefono Celular"  required="" name="TELCELPRO"  class="form-control " />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group col-md-5">
                                                                                        <label class="control-label" for="EMAIL">Correo Electronico <span class="text-danger">*</span></label>
                                                                                        <div id="ctrl-EMAIL-holder" class=""> 
                                                                                            <input id="ctrl-EMAIL"  value="<?php  echo $this->set_field_value('EMAIL',""); ?>" type="email" placeholder="Escribir  Correo Electronico"  required="" name="EMAIL"  class="form-control " />
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group col-md-3">
                                                                                            <label class="control-label" for="NROMATRICULA">N° de Matricula <span class="text-danger">*</span></label>
                                                                                            <div id="ctrl-NROMATRICULA-holder" class=""> 
                                                                                                <input id="ctrl-NROMATRICULA"  value="<?php  echo $this->set_field_value('NROMATRICULA',""); ?>" type="text" placeholder="Escribir  N° de Matricula"  required="" name="NROMATRICULA"  class="form-control " />
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group col-md-3">
                                                                                                <label class="control-label" for="FECHAVTOMAT">Fecha de Venc. Matricula <span class="text-danger">*</span></label>
                                                                                                <div id="ctrl-FECHAVTOMAT-holder" class="input-group"> 
                                                                                                    <input id="ctrl-FECHAVTOMAT" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('FECHAVTOMAT',""); ?>" type="datetime" name="FECHAVTOMAT" placeholder="Escribir  Fecha de Venc. Matricula" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                                                                        <div class="input-group-append">
                                                                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group col-md-4">
                                                                                                    <label class="control-label" for="NRORNP">N° de NRP <span class="text-danger">*</span></label>
                                                                                                    <div id="ctrl-NRORNP-holder" class=""> 
                                                                                                        <input id="ctrl-NRORNP"  value="<?php  echo $this->set_field_value('NRORNP',""); ?>" type="text" placeholder="Escribir  N° de NRP"  required="" name="NRORNP"  class="form-control " />
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="form-group col-md-3">
                                                                                                        <label class="control-label" for="FECHAVTORNP">Fecha Venc. NRP <span class="text-danger">*</span></label>
                                                                                                        <div id="ctrl-FECHAVTORNP-holder" class="input-group"> 
                                                                                                            <input id="ctrl-FECHAVTORNP" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('FECHAVTORNP',""); ?>" type="datetime" name="FECHAVTORNP" placeholder="Escribir  Fecha Venc. NRP" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                                                                                <div class="input-group-append">
                                                                                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="form-group col-md-3">
                                                                                                            <label class="control-label" for="EXEINGRESOSBRUTOS">Ext. Ingresos Brutos <span class="text-danger">*</span></label>
                                                                                                            <div id="ctrl-EXEINGRESOSBRUTOS-holder" class=""> 
                                                                                                                <input id="ctrl-EXEINGRESOSBRUTOS"  value="<?php  echo $this->set_field_value('EXEINGRESOSBRUTOS',""); ?>" type="text" placeholder="Escribir  Ext. Ingresos Brutos"  required="" name="EXEINGRESOSBRUTOS"  class="form-control " />
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="form-group col-md-4">
                                                                                                                <label class="control-label" for="POLIZA">Poliza N° <span class="text-danger">*</span></label>
                                                                                                                <div id="ctrl-POLIZA-holder" class=""> 
                                                                                                                    <input id="ctrl-POLIZA"  value="<?php  echo $this->set_field_value('POLIZA',""); ?>" type="text" placeholder="Escribir  Poliza N°"  required="" name="POLIZA"  class="form-control " />
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
