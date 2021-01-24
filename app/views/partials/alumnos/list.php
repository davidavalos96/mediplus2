<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("alumnos/add");
$can_edit = ACL::is_allowed("alumnos/edit");
$can_view = ACL::is_allowed("alumnos/view");
$can_delete = ACL::is_allowed("alumnos/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "list-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data From Controller
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_footer = $this->show_footer;
$show_pagination = $this->show_pagination;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Alumnos</h4>
                </div>
                <div class="col-sm-3 ">
                    <?php if($can_add){ ?>
                    <?php $modal_id = "modal-" . random_str(); ?>
                    <a href="<?php print_link("alumnos/add") ?>"  class="btn btn btn-primary my-1 open-page-modal">
                        <i class="fa fa-plus"></i>                                  
                        Agregar nuevo 
                    </a>
                    <div data-backdrop="true" id="<?php  echo $modal_id ?>" class="modal fade"  role="dialog" aria-labelledby="<?php  echo $modal_id ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-body p-0 ">
                                </div>
                                <div style="top: 5px; right:5px; z-index: 999;" class="position-absolute">
                                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">&times;</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('alumnos'); ?>" method="get">
                        <div class="input-group">
                            <input value="<?php echo get_value('search'); ?>" class="form-control" type="text" name="search"  placeholder="Buscar" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 comp-grid">
                        <div class="">
                            <!-- Page bread crumbs components-->
                            <?php
                            if(!empty($field_name) || !empty($_GET['search'])){
                            ?>
                            <hr class="sm d-block d-sm-none" />
                            <nav class="page-header-breadcrumbs mt-2" aria-label="breadcrumb">
                                <ul class="breadcrumb m-0 p-1">
                                    <?php
                                    if(!empty($field_name)){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('alumnos'); ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <?php echo (get_value("tag") ? get_value("tag")  :  make_readable($field_name)); ?>
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold">
                                        <?php echo (get_value("label") ? get_value("label")  :  make_readable(urldecode($field_value))); ?>
                                    </li>
                                    <?php 
                                    }   
                                    ?>
                                    <?php
                                    if(get_value("search")){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('alumnos'); ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-capitalize">
                                        Buscar
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold"><?php echo get_value("search"); ?></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </nav>
                            <!--End of Page bread crumbs components-->
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        <div  class="">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-md-12 comp-grid">
                        <?php $this :: display_page_errors(); ?>
                        <div  class=" animated fadeIn page-content">
                            <div id="alumnos-list-records">
                                <div id="page-report-body" class="table-responsive">
                                    <table class="table  table-striped table-sm text-left">
                                        <thead class="table-header bg-light">
                                            <tr>
                                                <?php if($can_delete){ ?>
                                                <th class="td-checkbox">
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                        <input class="toggle-check-all custom-control-input" type="checkbox" />
                                                        <span class="custom-control-label"></span>
                                                    </label>
                                                </th>
                                                <?php } ?>
                                                <th class="td-sno">#</th>
                                                <th  class="td-Id"> Id</th>
                                                <th  class="td-FEC_ALTA"> Fec Alta</th>
                                                <th  class="td-FEC_BAJA"> Fec Baja</th>
                                                <th  class="td-USUARIO"> Usuario</th>
                                                <th  class="td-DOCUMENTO"> Documento</th>
                                                <th  class="td-NOMBRE"> Nombre</th>
                                                <th  class="td-APELLIDO"> Apellido</th>
                                                <th  class="td-DOMICILIO"> Domicilio</th>
                                                <th  class="td-CP"> Cp</th>
                                                <th  class="td-LOCALIDAD"> Localidad</th>
                                                <th  class="td-TELEFONO"> Telefono</th>
                                                <th  class="td-EMAIL"> Email</th>
                                                <th  class="td-F_NACIMIENTO"> F Nacimiento</th>
                                                <th  class="td-L_NACIMIENTO"> L Nacimiento</th>
                                                <th  class="td-ESC_ORIGEN"> Esc Origen</th>
                                                <th class="td-btn"></th>
                                            </tr>
                                        </thead>
                                        <?php
                                        if(!empty($records)){
                                        ?>
                                        <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                            <!--record-->
                                            <?php
                                            $counter = 0;
                                            foreach($records as $data){
                                            $rec_id = (!empty($data['Id']) ? urlencode($data['Id']) : null);
                                            $counter++;
                                            ?>
                                            <tr>
                                                <?php if($can_delete){ ?>
                                                <th class=" td-checkbox">
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                        <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['Id'] ?>" type="checkbox" />
                                                            <span class="custom-control-label"></span>
                                                        </label>
                                                    </th>
                                                    <?php } ?>
                                                    <th class="td-sno"><?php echo $counter; ?></th>
                                                    <td class="td-Id"><a href="<?php print_link("alumnos/view/$data[Id]") ?>"><?php echo $data['Id']; ?></a></td>
                                                    <td class="td-FEC_ALTA">
                                                        <span <?php if($can_edit){ ?> data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                            data-value="<?php echo $data['FEC_ALTA']; ?>" 
                                                            data-pk="<?php echo $data['Id'] ?>" 
                                                            data-url="<?php print_link("alumnos/editfield/" . urlencode($data['Id'])); ?>" 
                                                            data-name="FEC_ALTA" 
                                                            data-title="Escribir  Fec Alta" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="flatdatetimepicker" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['FEC_ALTA']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-FEC_BAJA">
                                                        <span <?php if($can_edit){ ?> data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                            data-value="<?php echo $data['FEC_BAJA']; ?>" 
                                                            data-pk="<?php echo $data['Id'] ?>" 
                                                            data-url="<?php print_link("alumnos/editfield/" . urlencode($data['Id'])); ?>" 
                                                            data-name="FEC_BAJA" 
                                                            data-title="Escribir  Fec Baja" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="flatdatetimepicker" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['FEC_BAJA']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-USUARIO">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['USUARIO']; ?>" 
                                                            data-pk="<?php echo $data['Id'] ?>" 
                                                            data-url="<?php print_link("alumnos/editfield/" . urlencode($data['Id'])); ?>" 
                                                            data-name="USUARIO" 
                                                            data-title="Escribir  Usuario" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['USUARIO']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-DOCUMENTO">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['DOCUMENTO']; ?>" 
                                                            data-pk="<?php echo $data['Id'] ?>" 
                                                            data-url="<?php print_link("alumnos/editfield/" . urlencode($data['Id'])); ?>" 
                                                            data-name="DOCUMENTO" 
                                                            data-title="Escribir  Documento" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['DOCUMENTO']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-NOMBRE">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['NOMBRE']; ?>" 
                                                            data-pk="<?php echo $data['Id'] ?>" 
                                                            data-url="<?php print_link("alumnos/editfield/" . urlencode($data['Id'])); ?>" 
                                                            data-name="NOMBRE" 
                                                            data-title="Escribir  Nombre" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['NOMBRE']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-APELLIDO">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['APELLIDO']; ?>" 
                                                            data-pk="<?php echo $data['Id'] ?>" 
                                                            data-url="<?php print_link("alumnos/editfield/" . urlencode($data['Id'])); ?>" 
                                                            data-name="APELLIDO" 
                                                            data-title="Escribir  Apellido" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['APELLIDO']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-DOMICILIO">
                                                        <span <?php if($can_edit){ ?> data-pk="<?php echo $data['Id'] ?>" 
                                                            data-url="<?php print_link("alumnos/editfield/" . urlencode($data['Id'])); ?>" 
                                                            data-name="DOMICILIO" 
                                                            data-title="Escribir  Domicilio" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="textarea" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['DOMICILIO']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-CP">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['CP']; ?>" 
                                                            data-pk="<?php echo $data['Id'] ?>" 
                                                            data-url="<?php print_link("alumnos/editfield/" . urlencode($data['Id'])); ?>" 
                                                            data-name="CP" 
                                                            data-title="Escribir  Cp" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['CP']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-LOCALIDAD">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['LOCALIDAD']; ?>" 
                                                            data-pk="<?php echo $data['Id'] ?>" 
                                                            data-url="<?php print_link("alumnos/editfield/" . urlencode($data['Id'])); ?>" 
                                                            data-name="LOCALIDAD" 
                                                            data-title="Escribir  Localidad" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['LOCALIDAD']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-TELEFONO">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['TELEFONO']; ?>" 
                                                            data-pk="<?php echo $data['Id'] ?>" 
                                                            data-url="<?php print_link("alumnos/editfield/" . urlencode($data['Id'])); ?>" 
                                                            data-name="TELEFONO" 
                                                            data-title="Escribir  Telefono" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['TELEFONO']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-EMAIL"><a href="<?php print_link("mailto:$data[EMAIL]") ?>"><?php echo $data['EMAIL']; ?></a></td>
                                                    <td class="td-F_NACIMIENTO">
                                                        <span <?php if($can_edit){ ?> data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                            data-value="<?php echo $data['F_NACIMIENTO']; ?>" 
                                                            data-pk="<?php echo $data['Id'] ?>" 
                                                            data-url="<?php print_link("alumnos/editfield/" . urlencode($data['Id'])); ?>" 
                                                            data-name="F_NACIMIENTO" 
                                                            data-title="Escribir  F Nacimiento" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="flatdatetimepicker" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['F_NACIMIENTO']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-L_NACIMIENTO">
                                                        <span <?php if($can_edit){ ?> data-pk="<?php echo $data['Id'] ?>" 
                                                            data-url="<?php print_link("alumnos/editfield/" . urlencode($data['Id'])); ?>" 
                                                            data-name="L_NACIMIENTO" 
                                                            data-title="Escribir  L Nacimiento" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="textarea" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['L_NACIMIENTO']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-ESC_ORIGEN">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['ESC_ORIGEN']; ?>" 
                                                            data-pk="<?php echo $data['Id'] ?>" 
                                                            data-url="<?php print_link("alumnos/editfield/" . urlencode($data['Id'])); ?>" 
                                                            data-name="ESC_ORIGEN" 
                                                            data-title="Escribir  Esc Origen" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['ESC_ORIGEN']; ?> 
                                                        </span>
                                                    </td>
                                                    <th class="td-btn">
                                                        <?php if($can_view){ ?>
                                                        <a class="btn btn-sm btn-success has-tooltip" title="Ver registro" href="<?php print_link("alumnos/view/$rec_id"); ?>">
                                                            <i class="fa fa-eye"></i> View
                                                        </a>
                                                        <?php } ?>
                                                        <?php if($can_edit){ ?>
                                                        <a class="btn btn-sm btn-info has-tooltip" title="Editar este registro" href="<?php print_link("alumnos/edit/$rec_id"); ?>">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>
                                                        <?php } ?>
                                                        <?php if($can_delete){ ?>
                                                        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Eliminar este registro" href="<?php print_link("alumnos/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="¿Esta seguro que quiere eliminar este registro ?" data-display-style="modal">
                                                            <i class="fa fa-times"></i>
                                                            Delete
                                                        </a>
                                                        <?php } ?>
                                                    </th>
                                                </tr>
                                                <?php 
                                                }
                                                ?>
                                                <!--endrecord-->
                                            </tbody>
                                            <tbody class="search-data" id="search-data-<?php echo $page_element_id; ?>"></tbody>
                                            <?php
                                            }
                                            ?>
                                        </table>
                                        <?php 
                                        if(empty($records)){
                                        ?>
                                        <h4 class="bg-light text-center border-top text-muted animated bounce  p-3">
                                            <i class="fa fa-ban"></i> No existen registros
                                        </h4>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    if( $show_footer && !empty($records)){
                                    ?>
                                    <div class=" border-top mt-2">
                                        <div class="row justify-content-center">    
                                            <div class="col-md-auto justify-content-center">    
                                                <div class="p-3 d-flex justify-content-between">    
                                                    <?php if($can_delete){ ?>
                                                    <button data-prompt-msg="¿Está seguro de que desea eliminar estos registros?" data-display-style="modal" data-url="<?php print_link("alumnos/delete/{sel_ids}/?csrf_token=$csrf_token&redirect=$current_page"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                                                        <i class="fa fa-times"></i> Eliminar seleccionado
                                                    </button>
                                                    <?php } ?>
                                                    <div class="dropup export-btn-holder mx-1">
                                                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-save"></i> Export
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
                                                            <a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                                                <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
                                                                </a>
                                                                <?php $export_pdf_link = $this->set_current_page_link(array('format' => 'pdf')); ?>
                                                                <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                                                                    <img src="<?php print_link('assets/images/pdf.png') ?>" class="mr-2" /> PDF
                                                                    </a>
                                                                    <?php $export_word_link = $this->set_current_page_link(array('format' => 'word')); ?>
                                                                    <a class="dropdown-item export-link-btn" data-format="word" href="<?php print_link($export_word_link); ?>" target="_blank">
                                                                        <img src="<?php print_link('assets/images/doc.png') ?>" class="mr-2" /> WORD
                                                                        </a>
                                                                        <?php $export_csv_link = $this->set_current_page_link(array('format' => 'csv')); ?>
                                                                        <a class="dropdown-item export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                                                                            <img src="<?php print_link('assets/images/csv.png') ?>" class="mr-2" /> CSV
                                                                            </a>
                                                                            <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                                                                            <a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                                                                <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col">   
                                                                    <?php
                                                                    if($show_pagination == true){
                                                                    $pager = new Pagination($total_records, $record_count);
                                                                    $pager->route = $this->route;
                                                                    $pager->show_page_count = true;
                                                                    $pager->show_record_count = true;
                                                                    $pager->show_page_limit =true;
                                                                    $pager->limit_count = $this->limit_count;
                                                                    $pager->show_page_number_list = true;
                                                                    $pager->pager_link_range=5;
                                                                    $pager->render();
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
