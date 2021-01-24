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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("tratamientos/formeditar/$page_id/?csrf_token=$csrf_token"); ?>" method="post">
                            <div>
                                <div class="row">
                                    <div class="form-group col-md-5">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="fecha_finalizacion">Fecha Finalizacion <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input id="ctrl-fecha_finalizacion" class="form-control datepicker  datepicker"  required="" value="<?php  echo $data['fecha_finalizacion']; ?>" type="datetime" name="fecha_finalizacion" placeholder="Escribir  Fecha Finalizacion" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="fecha_inicio">Fecha Inicio <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input id="ctrl-fecha_inicio" class="form-control datepicker  datepicker"  required="" value="<?php  echo $data['fecha_inicio']; ?>" type="datetime" name="fecha_inicio" placeholder="Escribir  Fecha Inicio" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-10">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="estrategiaTerapeutica">Estrategia Terapeutica <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <select required=""  id="ctrl-estrategiaTerapeutica" name="estrategiaTerapeutica"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                <option value="">Seleccione un valor</option>
                                                                <?php
                                                                $rec = $data['estrategiaTerapeutica'];
                                                                $estrategiaTerapeutica_options = $comp_model -> tratamientos_estrategiaTerapeutica_option_list();
                                                                if(!empty($estrategiaTerapeutica_options)){
                                                                foreach($estrategiaTerapeutica_options as $option){
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
                                                </div>
                                            </div>
                                            <div class="form-group col-md-10">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="paciente">Paciente <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <select required=""  id="ctrl-paciente" name="paciente"  placeholder="Seleccione un valor"    class="custom-select" >
                                                                <option value="">Seleccione un valor</option>
                                                                <?php
                                                                $rec = $data['paciente'];
                                                                $paciente_options = $comp_model -> tratamientos_paciente_option_list();
                                                                if(!empty($paciente_options)){
                                                                foreach($paciente_options as $option){
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
