<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("docpaciente/add");
$can_edit = ACL::is_allowed("docpaciente/edit");
$can_view = ACL::is_allowed("docpaciente/view");
$can_delete = ACL::is_allowed("docpaciente/delete");
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
                        $rec_id = (!empty($data['CODDOCUMENTO']) ? urlencode($data['CODDOCUMENTO']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-CODDOCUMENTO">
                                        <th class="title"> Coddocumento: </th>
                                        <td class="value"> <?php echo $data['CODDOCUMENTO']; ?></td>
                                    </tr>
                                    <tr  class="td-TIPODOCUMENTO">
                                        <th class="title"> Tipodocumento: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/docpaciente_TIPODOCUMENTO_option_list'); ?>' 
                                                data-value="<?php echo $data['TIPODOCUMENTO']; ?>" 
                                                data-pk="<?php echo $data['CODDOCUMENTO'] ?>" 
                                                data-url="<?php print_link("docpaciente/editfield/" . urlencode($data['CODDOCUMENTO'])); ?>" 
                                                data-name="TIPODOCUMENTO" 
                                                data-title="Seleccione un valor" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['TIPODOCUMENTO']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-PACIENTE">
                                        <th class="title"> Paciente: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['PACIENTE']; ?>" 
                                                data-pk="<?php echo $data['CODDOCUMENTO'] ?>" 
                                                data-url="<?php print_link("docpaciente/editfield/" . urlencode($data['CODDOCUMENTO'])); ?>" 
                                                data-name="PACIENTE" 
                                                data-title="Escribir  Paciente" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['PACIENTE']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-ARCHIVO">
                                        <th class="title"> Archivo: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['ARCHIVO']; ?>" 
                                                data-pk="<?php echo $data['CODDOCUMENTO'] ?>" 
                                                data-url="<?php print_link("docpaciente/editfield/" . urlencode($data['CODDOCUMENTO'])); ?>" 
                                                data-name="ARCHIVO" 
                                                data-title="Vistazo" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['ARCHIVO']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-tipo_doc_paciente_CODTIPODOCUMENTO">
                                        <th class="title"> Tipo Doc Paciente Codtipodocumento: </th>
                                        <td class="value"> <?php echo $data['tipo_doc_paciente_CODTIPODOCUMENTO']; ?></td>
                                    </tr>
                                    <tr  class="td-tipo_doc_paciente_descripcion">
                                        <th class="title"> Tipo Doc Paciente Descripcion: </th>
                                        <td class="value"> <?php echo $data['tipo_doc_paciente_descripcion']; ?></td>
                                    </tr>
                                    <tr  class="td-tipo_doc_paciente_pa">
                                        <th class="title"> Tipo Doc Paciente Pa: </th>
                                        <td class="value"> <?php echo $data['tipo_doc_paciente_pa']; ?></td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
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
                                                <?php if($can_edit){ ?>
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("docpaciente/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> Editar
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("docpaciente/delete/$rec_id/?csrf_token=$csrf_token"); ?>" data-prompt-msg="¿Seguro que quieres borrar este registro?" data-display-style="modal">
                                                    <i class="fa fa-times"></i> Borrar
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
