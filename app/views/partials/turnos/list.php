<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("turnos/add");
$can_edit = ACL::is_allowed("turnos/edit");
$can_view = ACL::is_allowed("turnos/view");
$can_delete = ACL::is_allowed("turnos/delete");
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
<section class="page ajax-page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Turnos</h4>
                </div>
                <div class="col-sm-3 ">
                    <?php if($can_add){ ?>
                    <a  class="btn btn btn-primary my-1" href="<?php print_link("turnos/add") ?>">
                        <i class="fa fa-plus"></i>                              
                        Agregar nuevo 
                    </a>
                    <?php } ?>
                </div>
                <div class="col-sm-4 ">
                    <input autocomplete="off" data-page-id="<?php echo $page_element_id ?>" data-page="<?php print_link($current_page); ?>" value="<?php echo get_value('search'); ?>" class="form-control ajax-page-search" type="text" name="search"  placeholder="Buscar" />
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
                                        <a class="text-decoration-none" href="<?php print_link('turnos'); ?>">
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
                                        <a class="text-decoration-none" href="<?php print_link('turnos'); ?>">
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
                            <div id="turnos-list-records">
                                <div id="page-report-body" class="table-responsive">
                                    <?php Html::ajaxpage_spinner(); ?>
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
                                                <th  class="td-ID"> Id</th>
                                                <th  class="td-IDPROFESIONAL"> Idprofesional</th>
                                                <th  class="td-IDPACIENTE"> Idpaciente</th>
                                                <th  class="td-IDESPECIALIDAD"> Idespecialidad</th>
                                                <th  class="td-FECHATURNO"> Fechaturno</th>
                                                <th  class="td-HSTURNO"> Hsturno</th>
                                                <th  class="td-ESTADOTURNO"> Estadoturno</th>
                                                <th  class="td-TIPOTURNO"> Tipoturno</th>
                                                <th  class="td-OBSERVACION"> Observacion</th>
                                                <th  class="td-IDCONSULTORIO"> Idconsultorio</th>
                                                <th  class="td-DURACION"> Duracion</th>
                                                <th  class="td-auxiliar"> Auxiliar</th>
                                                <th  class="td-CANTSESIONES"> Cantsesiones</th>
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
                                            $rec_id = (!empty($data['ID']) ? urlencode($data['ID']) : null);
                                            $counter++;
                                            ?>
                                            <tr>
                                                <?php if($can_delete){ ?>
                                                <th class=" td-checkbox">
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                        <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['ID'] ?>" type="checkbox" />
                                                            <span class="custom-control-label"></span>
                                                        </label>
                                                    </th>
                                                    <?php } ?>
                                                    <th class="td-sno"><?php echo $counter; ?></th>
                                                    <td class="td-ID"><a href="<?php print_link("turnos/view/$data[ID]") ?>"><?php echo $data['ID']; ?></a></td>
                                                    <td class="td-IDPROFESIONAL">
                                                        <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/turnos_IDPROFESIONAL_option_list'); ?>' 
                                                            data-value="<?php echo $data['IDPROFESIONAL']; ?>" 
                                                            data-pk="<?php echo $data['ID'] ?>" 
                                                            data-url="<?php print_link("turnos/editfield/" . urlencode($data['ID'])); ?>" 
                                                            data-name="IDPROFESIONAL" 
                                                            data-title="Seleccione un valor" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="select" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['IDPROFESIONAL']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-IDPACIENTE">
                                                        <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/turnos_IDPACIENTE_option_list'); ?>' 
                                                            data-value="<?php echo $data['IDPACIENTE']; ?>" 
                                                            data-pk="<?php echo $data['ID'] ?>" 
                                                            data-url="<?php print_link("turnos/editfield/" . urlencode($data['ID'])); ?>" 
                                                            data-name="IDPACIENTE" 
                                                            data-title="Seleccione un valor" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="select" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['IDPACIENTE']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-IDESPECIALIDAD">
                                                        <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/turnos_IDESPECIALIDAD_option_list'); ?>' 
                                                            data-value="<?php echo $data['IDESPECIALIDAD']; ?>" 
                                                            data-pk="<?php echo $data['ID'] ?>" 
                                                            data-url="<?php print_link("turnos/editfield/" . urlencode($data['ID'])); ?>" 
                                                            data-name="IDESPECIALIDAD" 
                                                            data-title="Seleccione un valor" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="select" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['IDESPECIALIDAD']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-FECHATURNO">
                                                        <span <?php if($can_edit){ ?> data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                            data-value="<?php echo $data['FECHATURNO']; ?>" 
                                                            data-pk="<?php echo $data['ID'] ?>" 
                                                            data-url="<?php print_link("turnos/editfield/" . urlencode($data['ID'])); ?>" 
                                                            data-name="FECHATURNO" 
                                                            data-title="Escribir  Fecha" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="flatdatetimepicker" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['FECHATURNO']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-HSTURNO">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['HSTURNO']; ?>" 
                                                            data-pk="<?php echo $data['ID'] ?>" 
                                                            data-url="<?php print_link("turnos/editfield/" . urlencode($data['ID'])); ?>" 
                                                            data-name="HSTURNO" 
                                                            data-title="Escribir  Hora" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="time" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['HSTURNO']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-ESTADOTURNO">
                                                        <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/turnos_ESTADOTURNO_option_list'); ?>' 
                                                            data-value="<?php echo $data['ESTADOTURNO']; ?>" 
                                                            data-pk="<?php echo $data['ID'] ?>" 
                                                            data-url="<?php print_link("turnos/editfield/" . urlencode($data['ID'])); ?>" 
                                                            data-name="ESTADOTURNO" 
                                                            data-title="Seleccione un valor" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="select" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['ESTADOTURNO']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-TIPOTURNO">
                                                        <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/turnos_TIPOTURNO_option_list'); ?>' 
                                                            data-value="<?php echo $data['TIPOTURNO']; ?>" 
                                                            data-pk="<?php echo $data['ID'] ?>" 
                                                            data-url="<?php print_link("turnos/editfield/" . urlencode($data['ID'])); ?>" 
                                                            data-name="TIPOTURNO" 
                                                            data-title="Seleccione un valor" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="select" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['TIPOTURNO']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-OBSERVACION">
                                                        <span <?php if($can_edit){ ?> data-pk="<?php echo $data['ID'] ?>" 
                                                            data-url="<?php print_link("turnos/editfield/" . urlencode($data['ID'])); ?>" 
                                                            data-name="OBSERVACION" 
                                                            data-title="Escribir  Observacion" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="textarea" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['OBSERVACION']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-IDCONSULTORIO">
                                                        <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/turnos_IDCONSULTORIO_option_list'); ?>' 
                                                            data-value="<?php echo $data['IDCONSULTORIO']; ?>" 
                                                            data-pk="<?php echo $data['ID'] ?>" 
                                                            data-url="<?php print_link("turnos/editfield/" . urlencode($data['ID'])); ?>" 
                                                            data-name="IDCONSULTORIO" 
                                                            data-title="Seleccione un valor" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="select" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['IDCONSULTORIO']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-DURACION">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['DURACION']; ?>" 
                                                            data-pk="<?php echo $data['ID'] ?>" 
                                                            data-url="<?php print_link("turnos/editfield/" . urlencode($data['ID'])); ?>" 
                                                            data-name="DURACION" 
                                                            data-title="Escribir  Duracion" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="time" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['DURACION']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-auxiliar"> <?php echo $data['auxiliar']; ?></td>
                                                    <td class="td-CANTSESIONES">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['CANTSESIONES']; ?>" 
                                                            data-pk="<?php echo $data['ID'] ?>" 
                                                            data-url="<?php print_link("turnos/editfield/" . urlencode($data['ID'])); ?>" 
                                                            data-name="CANTSESIONES" 
                                                            data-title="Escribir  Cantsesiones" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['CANTSESIONES']; ?> 
                                                        </span>
                                                    </td>
                                                    <th class="td-btn">
                                                        <?php if($can_view){ ?>
                                                        <a class="btn btn-sm btn-success has-tooltip page-modal" title="Ver registro" href="<?php print_link("turnos/view/$rec_id"); ?>">
                                                            <i class="fa fa-eye"></i> Ver
                                                        </a>
                                                        <?php } ?>
                                                        <?php if($can_edit){ ?>
                                                        <a class="btn btn-sm btn-info has-tooltip page-modal" title="Editar este registro" href="<?php print_link("turnos/edit/$rec_id"); ?>">
                                                            <i class="fa fa-edit"></i> Editar
                                                        </a>
                                                        <?php } ?>
                                                        <?php if($can_delete){ ?>
                                                        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Eliminar este registro" href="<?php print_link("turnos/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="¿Seguro que quieres borrar este registro?" data-display-style="modal">
                                                            <i class="fa fa-times"></i>
                                                            Borrar
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
                                            <i class="fa fa-ban"></i> ningún record fue encontrado
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
                                                    <button data-prompt-msg="¿Está seguro de que desea eliminar estos registros?" data-display-style="modal" data-url="<?php print_link("turnos/delete/{sel_ids}/?csrf_token=$csrf_token&redirect=$current_page"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                                                        <i class="fa fa-times"></i> Eliminar seleccionado
                                                    </button>
                                                    <?php } ?>
                                                    <div class="dropup export-btn-holder mx-1">
                                                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-save"></i> Exportar
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
