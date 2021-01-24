<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("horarios_paciente/add");
$can_edit = ACL::is_allowed("horarios_paciente/edit");
$can_view = ACL::is_allowed("horarios_paciente/view");
$can_delete = ACL::is_allowed("horarios_paciente/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Ver</h4>
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
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['codSesion']) ? urlencode($data['codSesion']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-codSesion">
                                        <th class="title"> Codsesion: </th>
                                        <td class="value"> <?php echo $data['codSesion']; ?></td>
                                    </tr>
                                    <tr  class="td-tratamiento">
                                        <th class="title"> Tratamiento: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['tratamiento']; ?>" 
                                                data-pk="<?php echo $data['codSesion'] ?>" 
                                                data-url="<?php print_link("horarios_paciente/editfield/" . urlencode($data['codSesion'])); ?>" 
                                                data-name="tratamiento" 
                                                data-title="Escribir  Tratamiento" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['tratamiento']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-dia">
                                        <th class="title"> Dia: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/horarios_paciente_dia_option_list'); ?>' 
                                                data-value="<?php echo $data['dia']; ?>" 
                                                data-pk="<?php echo $data['codSesion'] ?>" 
                                                data-url="<?php print_link("horarios_paciente/editfield/" . urlencode($data['codSesion'])); ?>" 
                                                data-name="dia" 
                                                data-title="Seleccione un valor" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['dia']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-desde">
                                        <th class="title"> Desde: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php 
                                                $dependent_field = (!empty($data['tratamiento']) ? urlencode($data['tratamiento']) : null);
                                                print_link('api/json/horarios_paciente_desde_option_list/'.$dependent_field); 
                                                ?>' 
                                                data-value="<?php echo $data['desde']; ?>" 
                                                data-pk="<?php echo $data['codSesion'] ?>" 
                                                data-url="<?php print_link("horarios_paciente/editfield/" . urlencode($data['codSesion'])); ?>" 
                                                data-name="desde" 
                                                data-title="Escribir  Desde" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="time" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['desde']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-hasta">
                                        <th class="title"> Hasta: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['hasta']; ?>" 
                                                data-pk="<?php echo $data['codSesion'] ?>" 
                                                data-url="<?php print_link("horarios_paciente/editfield/" . urlencode($data['codSesion'])); ?>" 
                                                data-name="hasta" 
                                                data-title="Escribir  Hasta" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="time" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['hasta']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-consultorio">
                                        <th class="title"> Consultorio: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['consultorio']; ?>" 
                                                data-pk="<?php echo $data['codSesion'] ?>" 
                                                data-url="<?php print_link("horarios_paciente/editfield/" . urlencode($data['codSesion'])); ?>" 
                                                data-name="consultorio" 
                                                data-title="Escribir  Consultorio" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['consultorio']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-cantSesiones">
                                        <th class="title"> Cantsesiones: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['cantSesiones']; ?>" 
                                                data-pk="<?php echo $data['codSesion'] ?>" 
                                                data-url="<?php print_link("horarios_paciente/editfield/" . urlencode($data['codSesion'])); ?>" 
                                                data-name="cantSesiones" 
                                                data-title="Escribir  Cantsesiones" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['cantSesiones']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-date_deleted">
                                        <th class="title"> Date Deleted: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['date_deleted']; ?>" 
                                                data-pk="<?php echo $data['codSesion'] ?>" 
                                                data-url="<?php print_link("horarios_paciente/editfield/" . urlencode($data['codSesion'])); ?>" 
                                                data-name="date_deleted" 
                                                data-title="Escribir  Date Deleted" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['date_deleted']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-is_deleted">
                                        <th class="title"> Is Deleted: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['is_deleted']; ?>" 
                                                data-pk="<?php echo $data['codSesion'] ?>" 
                                                data-url="<?php print_link("horarios_paciente/editfield/" . urlencode($data['codSesion'])); ?>" 
                                                data-name="is_deleted" 
                                                data-title="Escribir  Is Deleted" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['is_deleted']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-dias_codDia">
                                        <th class="title"> Dias Coddia: </th>
                                        <td class="value"> <?php echo $data['dias_codDia']; ?></td>
                                    </tr>
                                    <tr  class="td-dias_nombre">
                                        <th class="title"> Dias Nombre: </th>
                                        <td class="value"> <?php echo $data['dias_nombre']; ?></td>
                                    </tr>
                                    <tr  class="td-dias_date_deleted">
                                        <th class="title"> Dias Date Deleted: </th>
                                        <td class="value"> <?php echo $data['dias_date_deleted']; ?></td>
                                    </tr>
                                    <tr  class="td-dias_is_deleted">
                                        <th class="title"> Dias Is Deleted: </th>
                                        <td class="value"> <?php echo $data['dias_is_deleted']; ?></td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
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
                                                <?php if($can_edit){ ?>
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("horarios_paciente/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("horarios_paciente/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="¿Esta seguro que quiere eliminar este registro ?" data-display-style="modal">
                                                    <i class="fa fa-times"></i> Delete
                                                </a>
                                                <?php } ?>
                                            </div>
                                            <?php
                                            }
                                            else{
                                            ?>
                                            <!-- Empty Record Message -->
                                            <div class="text-muted p-3">
                                                <i class="fa fa-ban"></i> ningún record fue encontrado
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
