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
                                        <i class="fa fa-book "></i> DATOS DE LA EVOLUCION
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active fade" id="TabPage-1-Page1" role="tabpanel">
                                    <?php $this :: display_page_errors(); ?>
                                    <div  class="bg-light p-3 animated fadeIn page-content">
                                        <form id="evoluciones-agregar_evolucion_terapeuta-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("evoluciones/agregar_evolucion_terapeuta?csrf_token=$csrf_token") ?>" method="post">
                                            <div>
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label" for="fecha">Fecha <span class="text-danger">*</span></label>
                                                        <div id="ctrl-fecha-holder" class="input-group"> 
                                                            <input id="ctrl-fecha" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('fecha',""); ?>" type="datetime" name="fecha" placeholder="Escribir  Fecha" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="control-label" for="tratamiento">Tratamiento <span class="text-danger">*</span></label>
                                                            <div id="ctrl-tratamiento-holder" class=""> 
                                                                <input id="ctrl-tratamiento"  value="<?php  echo $this->set_field_value('tratamiento',""); ?>" type="number" placeholder="Escribir  Tratamiento" step="1"  required="" data-load-select-options="tipo_evolucion,profesional" name="tratamiento"  class="form-control " />
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-5">
                                                                <label class="control-label" for="tipo_evolucion">Tipo Evolucion <span class="text-danger">*</span></label>
                                                                <div id="ctrl-tipo_evolucion-holder" class=""> 
                                                                    <select required=""  id="ctrl-tipo_evolucion" data-load-path="<?php print_link('api/json/evoluciones_tipo_evolucion_option_list') ?>" name="tipo_evolucion"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                        <option value="">Seleccione un valor</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-5">
                                                                <label class="control-label" for="profesional">Profesional <span class="text-danger">*</span></label>
                                                                <div id="ctrl-profesional-holder" class=""> 
                                                                    <select required=""  id="ctrl-profesional" data-load-path="<?php print_link('api/json/evoluciones_profesional_option_list') ?>" data-load-select-options="via_comunicacion" name="profesional"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                        <option value="">Seleccione un valor</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label class="control-label" for="paciente">Paciente <span class="text-danger">*</span></label>
                                                            <div id="ctrl-paciente-holder" class=""> 
                                                                <select required=""  id="ctrl-paciente" name="paciente"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                    <option value="">Seleccione un valor</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-10">
                                                                <label class="control-label" for="evolucion">Evolucion <span class="text-danger">*</span></label>
                                                                <div id="ctrl-evolucion-holder" class=""> 
                                                                    <textarea placeholder="Escribir  Evolucion" id="ctrl-evolucion"  required="" rows="5" name="evolucion" class=" form-control"><?php  echo $this->set_field_value('evolucion',""); ?></textarea>
                                                                    <!--<div class="invalid-feedback animated bounceIn text-center">Por favor ingrese el texto</div>-->
                                                                </div>
                                                            </div>
                                                            <input id="ctrl-usuario"  value="<?php  echo $this->set_field_value('usuario',USER_ID); ?>" type="hidden" placeholder="Escribir  Usuario"  required="" name="usuario"  class="form-control " />
                                                                <div class="row">
                                                                    <div class="form-group col-md-3">
                                                                        <label class="control-label" for="via_comunicacion">Via Comunicacion <span class="text-danger">*</span></label>
                                                                        <div id="ctrl-via_comunicacion-holder" class=""> 
                                                                            <select required=""  id="ctrl-via_comunicacion" data-load-path="<?php print_link('api/json/evoluciones_via_comunicacion_option_list') ?>" name="via_comunicacion"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                                <option value="">Seleccione un valor</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label class="control-label" for="otra_via">Otra Via </label>
                                                                        <div id="ctrl-otra_via-holder" class=""> 
                                                                            <input id="ctrl-otra_via"  value="<?php  echo $this->set_field_value('otra_via',""); ?>" type="text" placeholder="Escribir  Otra Via"  name="otra_via"  class="form-control " />
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label class="control-label" for="firma">Firma <span class="text-danger">*</span></label>
                                                                            <div id="ctrl-firma-holder" class=""> 
                                                                                <select required=""  id="ctrl-firma" name="firma"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                                    <option value="">Seleccione un valor</option>
                                                                                </select>
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
