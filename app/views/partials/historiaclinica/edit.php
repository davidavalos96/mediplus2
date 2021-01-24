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
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Editar Historia Clinica</h4>
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
                                    <a class="nav-link active" data-toggle="tab" href="#TabPage-2-Page1" role="tab" aria-selected="true">
                                        <i class="fa fa-slideshare "></i> EVOLUCIONES
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#TabPage-2-Page2" role="tab" aria-selected="true">
                                        <i class="fa fa-user-md "></i> INDICACIONES MEDICAS
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#TabPage-2-Page3" role="tab" aria-selected="true">
                                        <i class="fa fa-binoculars "></i> PLAN TERAPEUTICO
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#TabPage-2-Page4" role="tab" aria-selected="true">
                                        <i class="fa fa-cubes "></i> INFORMES Y DOCUMENTOS
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#TabPage-2-Page5" role="tab" aria-selected="true">
                                        <i class="fa fa-suitcase "></i> ESTUDIOS
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#TabPage-2-Page6" role="tab" aria-selected="true">
                                        <i class="fa fa-users "></i> ANTECEDENTES FAM.
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active fade" id="TabPage-2-Page1" role="tabpanel">
                                    <div class=" ">
                                        <?php  
                                        $this->render_page("evoluciones/list/evoluciones.paciente/$page_id?orderby=evoluciones.fecha&ordertype=DESC&limit_count=20"); 
                                        ?>
                                    </div>
                                </div>
                                <div class="tab-pane  fade" id="TabPage-2-Page2" role="tabpanel">
                                    <div class=" ">
                                        <?php  
                                        $this->render_page("indicacion_medica/list/indicacion_medica.paciente/$page_id?limit_count=20"); 
                                        ?>
                                    </div>
                                </div>
                                <div class="tab-pane  fade" id="TabPage-2-Page3" role="tabpanel">
                                    <div class=" ">
                                        <?php  
                                        $this->render_page("v_plan_terapeutico/list/v_plan_terapeutico.paciente/$page_id?orderby=v_plan_terapeutico.prestacion&ordertype=ASC&limit_count=20"); 
                                        ?>
                                    </div>
                                </div>
                                <div class="tab-pane  fade" id="TabPage-2-Page4" role="tabpanel">
                                    <div class=" ">
                                        <?php  
                                        $this->render_page("informesoc/list/informesoc.paciente/$page_id?orderby=informesoc.fecha&ordertype=DESC&limit_count=20"); 
                                        ?>
                                    </div>
                                </div>
                                <div class="tab-pane  fade" id="TabPage-2-Page5" role="tabpanel">
                                    <div class=" ">
                                        <?php  
                                        $this->render_page("estudios_solicitados/list?limit_count=20"); 
                                        ?>
                                    </div>
                                </div>
                                <div class="tab-pane  fade" id="TabPage-2-Page6" role="tabpanel">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
