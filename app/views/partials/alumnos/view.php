<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("alumnos/add");
$can_edit = ACL::is_allowed("alumnos/edit");
$can_view = ACL::is_allowed("alumnos/view");
$can_delete = ACL::is_allowed("alumnos/delete");
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
                        $rec_id = (!empty($data['Id']) ? urlencode($data['Id']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-Id">
                                        <th class="title"> Id: </th>
                                        <td class="value"> <?php echo $data['Id']; ?></td>
                                    </tr>
                                    <tr  class="td-FEC_ALTA">
                                        <th class="title"> Fec Alta: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-FEC_BAJA">
                                        <th class="title"> Fec Baja: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-USUARIO">
                                        <th class="title"> Usuario: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-DOCUMENTO">
                                        <th class="title"> Documento: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-NOMBRE">
                                        <th class="title"> Nombre: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-APELLIDO">
                                        <th class="title"> Apellido: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-DOMICILIO">
                                        <th class="title"> Domicilio: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-CP">
                                        <th class="title"> Cp: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-LOCALIDAD">
                                        <th class="title"> Localidad: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-TELEFONO">
                                        <th class="title"> Telefono: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-EMAIL">
                                        <th class="title"> Email: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['EMAIL']; ?>" 
                                                data-pk="<?php echo $data['Id'] ?>" 
                                                data-url="<?php print_link("alumnos/editfield/" . urlencode($data['Id'])); ?>" 
                                                data-name="EMAIL" 
                                                data-title="Escribir  Email" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="email" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['EMAIL']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-F_NACIMIENTO">
                                        <th class="title"> F Nacimiento: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-L_NACIMIENTO">
                                        <th class="title"> L Nacimiento: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-ESC_ORIGEN">
                                        <th class="title"> Esc Origen: </th>
                                        <td class="value">
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
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("alumnos/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("alumnos/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="¿Esta seguro que quiere eliminar este registro ?" data-display-style="modal">
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
