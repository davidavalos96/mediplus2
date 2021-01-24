<?php 
$page_id = null;
$comp_model = new SharedController;
$current_page = $this->set_current_page_link();
?>
<div>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <h4 >Tablero</h4>
                </div>
            </div>
        </div>
    </div>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-3 col-sm-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_pacientes();  ?>
                    <a class="animated zoomIn record-count card bg-success text-white"  href="<?php print_link("pacientes/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-group fa-2x"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Pacientes</div>
                                    <small class="">Registrados</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_tratamientos();  ?>
                    <a class="animated zoomIn record-count card bg-purple  text-white"  href="<?php print_link("tratamientos/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-slideshare fa-2x"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Tratamientos</div>
                                    <small class="">Asignados</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_pacientes_2();  ?>
                    <a class="animated zoomIn record-count card bg-danger text-white"  href="<?php print_link("grupofamiliar/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-user-times fa-2x"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Pacientes</div>
                                    <small class="">Sin evolucionar</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_facturas();  ?>
                    <a class="animated zoomIn record-count card bg-warning text-white"  href="<?php print_link("localidades/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-dollar fa-2x"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Facturas</div>
                                    <small class="">Impagas</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div  class="">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-md-12 comp-grid">
                    <div class="card reset-grids">
                        <?php  
                        $this->render_page("turnos/turnos_del_dia_gral?limit_count=20"); 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
