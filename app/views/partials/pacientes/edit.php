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
                    <h4 class="record-title">Editar</h4>
                    <div class=""><div></div>
                    </div>
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
                                        <i class="fa fa-user "></i> DATOS DEL PACIENTE
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#TabPage-1-Page2" role="tab" aria-selected="true">
                                        <i class="fa fa-users "></i> GRUPO FAMILIAR
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#TabPage-1-Page3" role="tab" aria-selected="true">
                                        <i class="fa fa-user-md "></i> MEDICOS TRATANTES
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#TabPage-1-Page4" role="tab" aria-selected="true">
                                        <i class="fa fa-ambulance "></i> TEL. EMERGENCIA
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#TabPage-1-Page5" role="tab" aria-selected="true">
                                        <i class="fa fa-clock-o "></i> HORARIOS
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#TabPage-1-Page6" role="tab" aria-selected="true">
                                        <i class="fa fa-folder-open "></i> DOCUMENTACION
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active fade" id="TabPage-1-Page1" role="tabpanel">
                                    <div class=" reset-grids">
                                        <?php  
                                        $this->render_page("pacientes/editarpaciente/$page_id"); 
                                        ?>
                                    </div>
                                </div>
                                <div class="tab-pane  fade" id="TabPage-1-Page2" role="tabpanel">
                                    <div class=" reset-grids">
                                        <?php  
                                        $this->render_page("grupofamiliar/edit/$page_id"); 
                                        ?>
                                    </div>
                                </div>
                                <div class="tab-pane  fade" id="TabPage-1-Page3" role="tabpanel">
                                    <div class=" reset-grids">
                                        <?php  
                                        $this->render_page("medicostratantes/edit/$page_id"); 
                                        ?>
                                    </div>
                                </div>
                                <div class="tab-pane  fade" id="TabPage-1-Page4" role="tabpanel">
                                </div>
                                <div class="tab-pane  fade" id="TabPage-1-Page5" role="tabpanel">
                                    <div class=" ">
                                        <?php  
                                        $this->render_page("terapias_por_tratamiento/list/terapias_por_tratamiento.paciente/$page_id?orderby=terapias_por_tratamiento.Especialidad&ordertype=DESC&limit_count=20"); 
                                        ?>
                                    </div>
                                </div>
                                <div class="tab-pane  fade" id="TabPage-1-Page6" role="tabpanel">
                                    <div class=" ">
                                        <?php  
                                        $this->render_page("docpaciente/list/docpaciente.PACIENTE/$page_id?orderby=docpaciente.TIPODOCUMENTO&ordertype=ASC&limit_count=20"); 
                                        ?>
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
