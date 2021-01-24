<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("grupofamiliar/add");
$can_edit = ACL::is_allowed("grupofamiliar/edit");
$can_view = ACL::is_allowed("grupofamiliar/view");
$can_delete = ACL::is_allowed("grupofamiliar/delete");
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
                        $rec_id = (!empty($data['CODGRUPOFAM']) ? urlencode($data['CODGRUPOFAM']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-CODGRUPOFAM">
                                        <th class="title"> Codgrupofam: </th>
                                        <td class="value"> <?php echo $data['CODGRUPOFAM']; ?></td>
                                    </tr>
                                    <tr  class="td-PACIENTE">
                                        <th class="title"> Paciente: </th>
                                        <td class="value"> <?php echo $data['PACIENTE']; ?></td>
                                    </tr>
                                    <tr  class="td-NOMBREMADRE">
                                        <th class="title"> Nombremadre: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['NOMBREMADRE']; ?>" 
                                                data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                data-name="NOMBREMADRE" 
                                                data-title="Escribir  Apellido y Nombre de la Madre" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['NOMBREMADRE']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-DIRECCIONMADRE">
                                        <th class="title"> Direccionmadre: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['DIRECCIONMADRE']; ?>" 
                                                data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                data-name="DIRECCIONMADRE" 
                                                data-title="Escribir  Dirección" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['DIRECCIONMADRE']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-LOCALIDADMADRE">
                                        <th class="title"> Localidadmadre: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php 
                                                $dependent_field = (!empty($data['PROVINCIAMADRE']) ? urlencode($data['PROVINCIAMADRE']) : null);
                                                print_link('api/json/grupofamiliar_LOCALIDADMADRE_option_list/'.$dependent_field); 
                                                ?>' 
                                                data-value="<?php echo $data['LOCALIDADMADRE']; ?>" 
                                                data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                data-name="LOCALIDADMADRE" 
                                                data-title="Seleccione un valor" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['LOCALIDADMADRE']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-EMAILMADRE">
                                        <th class="title"> Emailmadre: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['EMAILMADRE']; ?>" 
                                                data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                data-name="EMAILMADRE" 
                                                data-title="Escribir  Correo Electronico" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="email" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['EMAILMADRE']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-NOMBREPADRE">
                                        <th class="title"> Nombrepadre: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['NOMBREPADRE']; ?>" 
                                                data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                data-name="NOMBREPADRE" 
                                                data-title="Escribir  Apellido y Nombre del Padre" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['NOMBREPADRE']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-DIRECCIONPADRE">
                                        <th class="title"> Direccionpadre: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['DIRECCIONPADRE']; ?>" 
                                                data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                data-name="DIRECCIONPADRE" 
                                                data-title="Escribir  Direccion" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['DIRECCIONPADRE']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-LOCALIDADPADRE">
                                        <th class="title"> Localidadpadre: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php 
                                                $dependent_field = (!empty($data['PROVINCIAPADRE']) ? urlencode($data['PROVINCIAPADRE']) : null);
                                                print_link('api/json/grupofamiliar_LOCALIDADPADRE_option_list/'.$dependent_field); 
                                                ?>' 
                                                data-value="<?php echo $data['LOCALIDADPADRE']; ?>" 
                                                data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                data-name="LOCALIDADPADRE" 
                                                data-title="Seleccione un valor" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['LOCALIDADPADRE']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-CPPADRE">
                                        <th class="title"> Cppadre: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['CPPADRE']; ?>" 
                                                data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                data-name="CPPADRE" 
                                                data-title="Escribir  Cod Postal" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['CPPADRE']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-CPMADRE">
                                        <th class="title"> Cpmadre: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['CPMADRE']; ?>" 
                                                data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                data-name="CPMADRE" 
                                                data-title="Escribir  Cod. Postal" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['CPMADRE']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-TELFIJOMADRE">
                                        <th class="title"> Telfijomadre: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['TELFIJOMADRE']; ?>" 
                                                data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                data-name="TELFIJOMADRE" 
                                                data-title="Escribir  Telefono Particular Fijo" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['TELFIJOMADRE']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-TELFIJOPADRE">
                                        <th class="title"> Telfijopadre: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['TELFIJOPADRE']; ?>" 
                                                data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                data-name="TELFIJOPADRE" 
                                                data-title="Escribir  Telefono Particular Fijo" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['TELFIJOPADRE']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-TELCELMADRE">
                                        <th class="title"> Telcelmadre: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['TELCELMADRE']; ?>" 
                                                data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                data-name="TELCELMADRE" 
                                                data-title="Escribir  Telefono Celular" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['TELCELMADRE']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-TELCELPADRE">
                                        <th class="title"> Telcelpadre: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['TELCELPADRE']; ?>" 
                                                data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                data-name="TELCELPADRE" 
                                                data-title="Escribir  Telefono Celular" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['TELCELPADRE']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-TELLABORALPADRE">
                                        <th class="title"> Tellaboralpadre: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['TELLABORALPADRE']; ?>" 
                                                data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                data-name="TELLABORALPADRE" 
                                                data-title="Escribir  Telefono Laboral" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['TELLABORALPADRE']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-TELLABORALMADRE">
                                        <th class="title"> Tellaboralmadre: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['TELLABORALMADRE']; ?>" 
                                                data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                data-name="TELLABORALMADRE" 
                                                data-title="Escribir  Telefono Laboral" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['TELLABORALMADRE']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-PROVINCIAMADRE">
                                        <th class="title"> Provinciamadre: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/grupofamiliar_PROVINCIAMADRE_option_list'); ?>' 
                                                data-value="<?php echo $data['PROVINCIAMADRE']; ?>" 
                                                data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                data-name="PROVINCIAMADRE" 
                                                data-title="Seleccione un valor" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['PROVINCIAMADRE']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-PROVINCIAPADRE">
                                        <th class="title"> Provinciapadre: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/grupofamiliar_PROVINCIAPADRE_option_list'); ?>' 
                                                data-value="<?php echo $data['PROVINCIAPADRE']; ?>" 
                                                data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                data-name="PROVINCIAPADRE" 
                                                data-title="Seleccione un valor" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['PROVINCIAPADRE']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-EMAILPADRE">
                                        <th class="title"> Emailpadre: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['EMAILPADRE']; ?>" 
                                                data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                data-name="EMAILPADRE" 
                                                data-title="Escribir  Correo Electronico" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="email" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['EMAILPADRE']; ?> 
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
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("grupofamiliar/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> Editar
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("grupofamiliar/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="¿Seguro que quieres borrar este registro?" data-display-style="modal">
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
