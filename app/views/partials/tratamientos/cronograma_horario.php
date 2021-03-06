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
                    <h4 class="record-title">CRONOGRAMA DE HORARIOS</h4>
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
                <div class="col-md-3 comp-grid">
                </div>
                <div class="col-sm-7 comp-grid">
                    <div class="card ">
                        <div class="card-header p-0 pt-2 px-2">
                            <ul class="nav  nav-tabs   ">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#TabPage-1-Page1" role="tab" aria-selected="true">
                                        <i class="fa fa-clock-o "></i> CRONOGRAMA DEL PACIENTE
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active fade" id="TabPage-1-Page1" role="tabpanel">
                                    <?php $this :: display_page_errors(); ?>
                                    <div  class="bg-light p-3 animated fadeIn page-content">
                                        <div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label class="control-label" for="paciente">Paciente <span class="text-danger">*</span></label>
                                                    <div id="ctrl-paciente-holder" class=""> 
                                                        <select required=""  id="ctrl-paciente" name="paciente"  placeholder="Seleccione un valor"    class="selectize" >
                                                            <option value="">Seleccione un valor</option>
                                                            <?php 
                                                            $paciente_options = $comp_model -> tratamientos_paciente_option_list();
                                                            if(!empty($paciente_options)){
                                                            foreach($paciente_options as $option){
                                                            $value = (!empty($option['value']) ? $option['value'] : null);
                                                            $label = (!empty($option['label']) ? $option['label'] : $value);
                                                            $selected = $this->set_field_selected('paciente',$value, "");
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
                                            </div>
                                            <div class="form-group form-submit-btn-holder text-center mt-3">
                                                <div class="form-ajax-status"></div>
                                                <button class="btn btn-primary" onClick="generarReporte()">
                                                    Generar Reporte
                                                    <i class="fa fa-print"></i>
                                                </button>
                                            </div>
                                            <script>
                                                function generarReporte(){
                                                var id = $("#ctrl-paciente").val()
                                                if(id.length > 0){
                                                alert("el id del paciente es "+id);
                                                }
                                                else{
                                                alert("Debe seleccionar un paciente antes de generar el reporte");
                                                }
                                                }
                                            </script>
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
