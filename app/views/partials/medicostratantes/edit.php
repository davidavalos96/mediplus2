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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-vertical needs-validation" action="<?php print_link("medicostratantes/edit/$page_id/?csrf_token=$csrf_token"); ?>" method="post">
                            <div>
                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <label class="control-label" for="NOMBREPEDIATRA">Apellido y Nombre del Pediatra <span class="text-danger">*</span></label>
                                        <div id="ctrl-NOMBREPEDIATRA-holder" class=""> 
                                            <input id="ctrl-NOMBREPEDIATRA"  value="<?php  echo $data['NOMBREPEDIATRA']; ?>" type="text" placeholder="Escribir  Apellido y Nombre del Pediatra"  required="" name="NOMBREPEDIATRA"  class="form-control " />
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="control-label" for="TELEFONOPEDIATRA">Telefono <span class="text-danger">*</span></label>
                                            <div id="ctrl-TELEFONOPEDIATRA-holder" class=""> 
                                                <input id="ctrl-TELEFONOPEDIATRA"  value="<?php  echo $data['TELEFONOPEDIATRA']; ?>" type="text" placeholder="Escribir  Telefono"  required="" name="TELEFONOPEDIATRA"  class="form-control " />
                                                </div>
                                            </div>
                                            <div class="form-group col-md-7">
                                                <label class="control-label" for="EMAILPEDIATRA">Correo Electronico <span class="text-danger">*</span></label>
                                                <div id="ctrl-EMAILPEDIATRA-holder" class=""> 
                                                    <input id="ctrl-EMAILPEDIATRA"  value="<?php  echo $data['EMAILPEDIATRA']; ?>" type="email" placeholder="Escribir  Correo Electronico"  required="" name="EMAILPEDIATRA"  class="form-control " />
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-10">
                                                    <label class="control-label" for="NOMBRENEUROLOGO">Apellido y Nombre del Neurologo <span class="text-danger">*</span></label>
                                                    <div id="ctrl-NOMBRENEUROLOGO-holder" class=""> 
                                                        <input id="ctrl-NOMBRENEUROLOGO"  value="<?php  echo $data['NOMBRENEUROLOGO']; ?>" type="text" placeholder="Escribir  Apellido y Nombre del Neurologo"  required="" name="NOMBRENEUROLOGO"  class="form-control " />
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label class="control-label" for="TELEFONONEUROLOGO">Telefono <span class="text-danger">*</span></label>
                                                        <div id="ctrl-TELEFONONEUROLOGO-holder" class=""> 
                                                            <input id="ctrl-TELEFONONEUROLOGO"  value="<?php  echo $data['TELEFONONEUROLOGO']; ?>" type="text" placeholder="Escribir  Telefono"  required="" name="TELEFONONEUROLOGO"  class="form-control " />
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-7">
                                                            <label class="control-label" for="EMAILNEUROLOGO">Correo Electronico <span class="text-danger">*</span></label>
                                                            <div id="ctrl-EMAILNEUROLOGO-holder" class=""> 
                                                                <input id="ctrl-EMAILNEUROLOGO"  value="<?php  echo $data['EMAILNEUROLOGO']; ?>" type="email" placeholder="Escribir  Correo Electronico"  required="" name="EMAILNEUROLOGO"  class="form-control " />
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
