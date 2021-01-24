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
                <div class="col-md-7 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form id="medicostratantes-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="<?php print_link("medicostratantes/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="NOMBREPEDIATRA">Apellido y Nombre del Pediatra <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input id="ctrl-NOMBREPEDIATRA"  value="<?php  echo $this->set_field_value('NOMBREPEDIATRA',""); ?>" type="text" placeholder="Escribir  Apellido y Nombre del Pediatra"  required="" name="NOMBREPEDIATRA"  class="form-control " />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="TELEFONOPEDIATRA">Telefono <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input id="ctrl-TELEFONOPEDIATRA"  value="<?php  echo $this->set_field_value('TELEFONOPEDIATRA',""); ?>" type="text" placeholder="Escribir  Telefono"  required="" name="TELEFONOPEDIATRA"  class="form-control " />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-7">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="EMAILPEDIATRA">Correo Electronico <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <input id="ctrl-EMAILPEDIATRA"  value="<?php  echo $this->set_field_value('EMAILPEDIATRA',""); ?>" type="email" placeholder="Escribir  Correo Electronico"  required="" name="EMAILPEDIATRA"  class="form-control " />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-10">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="NOMBRENEUROLOGO">Apellido y Nombre del Neurologo <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <input id="ctrl-NOMBRENEUROLOGO"  value="<?php  echo $this->set_field_value('NOMBRENEUROLOGO',""); ?>" type="text" placeholder="Escribir  Apellido y Nombre del Neurologo"  required="" name="NOMBRENEUROLOGO"  class="form-control " />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label" for="TELEFONONEUROLOGO">Telefono <span class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="">
                                                                    <input id="ctrl-TELEFONONEUROLOGO"  value="<?php  echo $this->set_field_value('TELEFONONEUROLOGO',""); ?>" type="text" placeholder="Escribir  Telefono"  required="" name="TELEFONONEUROLOGO"  class="form-control " />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-7">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" for="EMAILNEUROLOGO">Correo Electronico <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="">
                                                                        <input id="ctrl-EMAILNEUROLOGO"  value="<?php  echo $this->set_field_value('EMAILNEUROLOGO',""); ?>" type="email" placeholder="Escribir  Correo Electronico"  required="" name="EMAILNEUROLOGO"  class="form-control " />
                                                                        </div>
                                                                    </div>
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
                            </section>
