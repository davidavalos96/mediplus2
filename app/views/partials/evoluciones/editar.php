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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-vertical needs-validation" action="<?php print_link("evoluciones/editar/$page_id/?csrf_token=$csrf_token"); ?>" method="post">
                            <div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="fecha">Fecha <span class="text-danger">*</span></label>
                                        <div id="ctrl-fecha-holder" class="input-group"> 
                                            <input id="ctrl-fecha" class="form-control datepicker  datepicker"  required="" value="<?php  echo $data['fecha']; ?>" type="datetime" name="fecha" placeholder="Escribir  Fecha" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label" for="tratamiento">Tratamiento <span class="text-danger">*</span></label>
                                            <div id="ctrl-tratamiento-holder" class=""> 
                                                <select required=""  id="ctrl-tratamiento" data-load-select-options="tipo_evolucion,profesional" name="tratamiento"  placeholder="Seleccione un valor"    class="custom-select" >
                                                    <option value="">Seleccione un valor</option>
                                                    <?php
                                                    $rec = $data['tratamiento'];
                                                    $tratamiento_options = $comp_model -> evoluciones_tratamiento_option_list();
                                                    if(!empty($tratamiento_options)){
                                                    foreach($tratamiento_options as $option){
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
                                        <div class="form-group col-md-5">
                                            <label class="control-label" for="tipo_evolucion">Tipo Evolucion <span class="text-danger">*</span></label>
                                            <div id="ctrl-tipo_evolucion-holder" class=""> 
                                                <select required=""  id="ctrl-tipo_evolucion" data-load-path="<?php print_link('api/json/evoluciones_tipo_evolucion_option_list') ?>" name="tipo_evolucion"  placeholder="Seleccione un valor"    class="custom-select" >
                                                    <?php
                                                    $rec = $data['tipo_evolucion'];
                                                    $tipo_evolucion_options = $comp_model -> evoluciones_tipo_evolucion_option_list($data['tratamiento']);
                                                    if(!empty($tipo_evolucion_options)){
                                                    foreach($tipo_evolucion_options as $option){
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
                                        <div class="form-group col-md-5">
                                            <label class="control-label" for="profesional">Profesional <span class="text-danger">*</span></label>
                                            <div id="ctrl-profesional-holder" class=""> 
                                                <select required=""  id="ctrl-profesional" data-load-path="<?php print_link('api/json/evoluciones_profesional_option_list') ?>" name="profesional"  placeholder="Seleccione un valor"    class="custom-select" >
                                                    <?php
                                                    $rec = $data['profesional'];
                                                    $profesional_options = $comp_model -> evoluciones_profesional_option_list($data['tratamiento']);
                                                    if(!empty($profesional_options)){
                                                    foreach($profesional_options as $option){
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
                                        <div class="form-group col-md-10">
                                            <label class="control-label" for="evolucion">Evolucion <span class="text-danger">*</span></label>
                                            <div id="ctrl-evolucion-holder" class=""> 
                                                <textarea placeholder="Escribir  Evolucion" id="ctrl-evolucion"  required="" rows="5" name="evolucion" class="htmleditor form-control"><?php  echo $data['evolucion']; ?></textarea>
                                                <!--<div class="invalid-feedback animated bounceIn text-center">Por favor ingrese el texto</div>-->
                                            </div>
                                        </div>
                                        <input id="ctrl-usuario"  value="<?php  echo $data['usuario']; ?>" type="hidden" placeholder="Escribir  Usuario"  required="" name="usuario"  class="form-control " />
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
                                <div class=""><script>
                                    function limpiarControles(){
                                    $("#ctrl-profesional").empty();
                                    $("#ctrl-tipo_evolucion").empty();
                                    $("#ctrl-tratamiento").empty();    
                                    }
                                    agregarOpcion(idControl,valor,texto){
                                    $("#ctrl-"+idControl).append("<option value='"+valor+"'>"+texto+"</option>");
                                    }
                                    $(document).ready(function(){
                                    var idProfesional     = $("#ctrl-profesional").val();
                                    var nombreProfesional = $("#ctrl-profesional").text();
                                    var idTratamiento     = $("#ctrl-tratamiento").val();
                                    var desTratamiento    = $("#ctrl-tratamiento").text();
                                    var idTipoEvolucion   = $("#ctrl-tipo_evolucion").val();
                                    var desTipoEvolucion  = $("#ctrl-tipo_evolucion").text();
                                    limpiarControles();
                                    agregarOpcion("profesional",idProfesional,nombreProfesional);
                                    agregarOpcion("tratamiento",idTratamiento,desTratamiento);
                                    agregarOpcion("tipo_evolucion",idTipoEvolucion,desTipoEvolucion);
                                    });
                                </script></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
