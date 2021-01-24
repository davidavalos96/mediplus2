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
                                        <i class="fa fa-book "></i> DATOS DEL TRATAMIENTO
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active fade" id="TabPage-1-Page1" role="tabpanel">
                                    <?php $this :: display_page_errors(); ?>
                                    <div  class="bg-light p-3 animated fadeIn page-content">
                                        <form id="tratamientos-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("tratamientos/add?csrf_token=$csrf_token") ?>" method="post">
                                            <div>
                                                <div class="row">
                                                    <div class="form-group col-md-5">
                                                        <label class="control-label" for="fecha_inicio">Fecha de Inicio <span class="text-danger">*</span></label>
                                                        <div id="ctrl-fecha_inicio-holder" class="input-group"> 
                                                            <input id="ctrl-fecha_inicio" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('fecha_inicio',""); ?>" type="datetime" name="fecha_inicio" placeholder="Escribir  Fecha de Inicio" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-5">
                                                            <label class="control-label" for="fecha_finalizacion">Fecha de Finalizacion <span class="text-danger">*</span></label>
                                                            <div id="ctrl-fecha_finalizacion-holder" class="input-group"> 
                                                                <input id="ctrl-fecha_finalizacion" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('fecha_finalizacion',""); ?>" type="datetime" name="fecha_finalizacion" placeholder="Escribir  Fecha de Finalizacion" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-10">
                                                                <label class="control-label" for="estrategiaTerapeutica">Estrategiaterapeutica <span class="text-danger">*</span></label>
                                                                <div id="ctrl-estrategiaTerapeutica-holder" class=""> 
                                                                    <select required=""  id="ctrl-estrategiaTerapeutica" name="estrategiaTerapeutica"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                        <option value="">Seleccione un valor</option>
                                                                        <?php 
                                                                        $estrategiaTerapeutica_options = $comp_model -> tratamientos_estrategiaTerapeutica_option_list();
                                                                        if(!empty($estrategiaTerapeutica_options)){
                                                                        foreach($estrategiaTerapeutica_options as $option){
                                                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                        $selected = $this->set_field_selected('estrategiaTerapeutica',$value, "");
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
                                                            <div class="form-group col-md-10">
                                                                <label class="control-label" for="paciente">Paciente <span class="text-danger">*</span></label>
                                                                <div id="ctrl-paciente-holder" class=""> 
                                                                    <select required=""  id="ctrl-paciente" name="paciente"  placeholder="Seleccione un valor"    class="custom-select" >
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
