<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("pacientes/add");
$can_edit = ACL::is_allowed("pacientes/edit");
$can_view = ACL::is_allowed("pacientes/view");
$can_delete = ACL::is_allowed("pacientes/delete");
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
                        $rec_id = (!empty($data['idPaciente']) ? urlencode($data['idPaciente']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-idPaciente">
                                        <th class="title"> Idpaciente: </th>
                                        <td class="value"> <?php echo $data['idPaciente']; ?></td>
                                    </tr>
                                    <tr  class="td-NOMBAPEPAC">
                                        <th class="title"> Nombre y Apellido:: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['NOMBAPEPAC']; ?>" 
                                                data-pk="<?php echo $data['idPaciente'] ?>" 
                                                data-url="<?php print_link("pacientes/editfield/" . urlencode($data['idPaciente'])); ?>" 
                                                data-name="NOMBAPEPAC" 
                                                data-title="Escribir  Apellido y Nombre" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['NOMBAPEPAC']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-FECHANACPAC">
                                        <th class="title"> Fecha de Nacimiento: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['FECHANACPAC']; ?>" 
                                                data-pk="<?php echo $data['idPaciente'] ?>" 
                                                data-url="<?php print_link("pacientes/editfield/" . urlencode($data['idPaciente'])); ?>" 
                                                data-name="FECHANACPAC" 
                                                data-title="Escribir  Fecha de Nacimiento" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['FECHANACPAC']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-NUMDOCPAC">
                                        <th class="title"> N° de Documento: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['NUMDOCPAC']; ?>" 
                                                data-pk="<?php echo $data['idPaciente'] ?>" 
                                                data-url="<?php print_link("pacientes/editfield/" . urlencode($data['idPaciente'])); ?>" 
                                                data-name="NUMDOCPAC" 
                                                data-title="Escribir  N° de Documento" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['NUMDOCPAC']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-DOMICILIO">
                                        <th class="title"> Dirección: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['DOMICILIO']; ?>" 
                                                data-pk="<?php echo $data['idPaciente'] ?>" 
                                                data-url="<?php print_link("pacientes/editfield/" . urlencode($data['idPaciente'])); ?>" 
                                                data-name="DOMICILIO" 
                                                data-title="Escribir  Domicilio" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['DOMICILIO']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-barrio">
                                        <th class="title"> Barrio: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php 
                                                $dependent_field = (!empty($data['LOCALIDAD']) ? urlencode($data['LOCALIDAD']) : null);
                                                print_link('api/json/pacientes_barrio_option_list/'.$dependent_field); 
                                                ?>' 
                                                data-value="<?php echo $data['barrio']; ?>" 
                                                data-pk="<?php echo $data['idPaciente'] ?>" 
                                                data-url="<?php print_link("pacientes/editfield/" . urlencode($data['idPaciente'])); ?>" 
                                                data-name="barrio" 
                                                data-title="Seleccione un valor" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['barrio']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-LOCALIDAD">
                                        <th class="title"> Localidad: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/pacientes_LOCALIDAD_option_list'); ?>' 
                                                data-value="<?php echo $data['LOCALIDAD']; ?>" 
                                                data-pk="<?php echo $data['idPaciente'] ?>" 
                                                data-url="<?php print_link("pacientes/editfield/" . urlencode($data['idPaciente'])); ?>" 
                                                data-name="LOCALIDAD" 
                                                data-title="Seleccione un valor" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['LOCALIDAD']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-FECHACERTVTO">
                                        <th class="title"> Fechacertvto: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['FECHACERTVTO']; ?>" 
                                                data-pk="<?php echo $data['idPaciente'] ?>" 
                                                data-url="<?php print_link("pacientes/editfield/" . urlencode($data['idPaciente'])); ?>" 
                                                data-name="FECHACERTVTO" 
                                                data-title="Escribir  Fecha Venc. Certificado" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['FECHACERTVTO']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-COORDINADOR">
                                        <th class="title"> Coordinador: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/pacientes_COORDINADOR_option_list'); ?>' 
                                                data-value="<?php echo $data['COORDINADOR']; ?>" 
                                                data-pk="<?php echo $data['idPaciente'] ?>" 
                                                data-url="<?php print_link("pacientes/editfield/" . urlencode($data['idPaciente'])); ?>" 
                                                data-name="COORDINADOR" 
                                                data-title="Seleccione un valor" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['COORDINADOR']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-COBERTURA">
                                        <th class="title"> Cobertura: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/pacientes_COBERTURA_option_list'); ?>' 
                                                data-value="<?php echo $data['COBERTURA']; ?>" 
                                                data-pk="<?php echo $data['idPaciente'] ?>" 
                                                data-url="<?php print_link("pacientes/editfield/" . urlencode($data['idPaciente'])); ?>" 
                                                data-name="COBERTURA" 
                                                data-title="Seleccione un valor" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['COBERTURA']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-PLANOBRASOC">
                                        <th class="title"> Planobrasoc: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['PLANOBRASOC']; ?>" 
                                                data-pk="<?php echo $data['idPaciente'] ?>" 
                                                data-url="<?php print_link("pacientes/editfield/" . urlencode($data['idPaciente'])); ?>" 
                                                data-name="PLANOBRASOC" 
                                                data-title="Escribir  Plan" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['PLANOBRASOC']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-NROAFILIADO">
                                        <th class="title"> Nroafiliado: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['NROAFILIADO']; ?>" 
                                                data-pk="<?php echo $data['idPaciente'] ?>" 
                                                data-url="<?php print_link("pacientes/editfield/" . urlencode($data['idPaciente'])); ?>" 
                                                data-name="NROAFILIADO" 
                                                data-title="Escribir  N° de Afiliado" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['NROAFILIADO']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-TELEFONO">
                                        <th class="title"> Telefono: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['TELEFONO']; ?>" 
                                                data-pk="<?php echo $data['idPaciente'] ?>" 
                                                data-url="<?php print_link("pacientes/editfield/" . urlencode($data['idPaciente'])); ?>" 
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
                                                data-pk="<?php echo $data['idPaciente'] ?>" 
                                                data-url="<?php print_link("pacientes/editfield/" . urlencode($data['idPaciente'])); ?>" 
                                                data-name="EMAIL" 
                                                data-title="Escribir  Correo Electronico" 
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
                                    <tr  class="td-DIAGNOSTICO">
                                        <th class="title"> Diagnostico: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-pk="<?php echo $data['idPaciente'] ?>" 
                                                data-url="<?php print_link("pacientes/editfield/" . urlencode($data['idPaciente'])); ?>" 
                                                data-name="DIAGNOSTICO" 
                                                data-title="Escribir  Diagnostico" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="textarea" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['DIAGNOSTICO']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-MEDICODERIV">
                                        <th class="title"> Medicoderiv: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['MEDICODERIV']; ?>" 
                                                data-pk="<?php echo $data['idPaciente'] ?>" 
                                                data-url="<?php print_link("pacientes/editfield/" . urlencode($data['idPaciente'])); ?>" 
                                                data-name="MEDICODERIV" 
                                                data-title="Escribir  Medico Derivante" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['MEDICODERIV']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-ESTADOPACIENTE">
                                        <th class="title"> Estadopaciente: </th>
                                        <td class="value"> <?php echo $data['ESTADOPACIENTE']; ?></td>
                                    </tr>
                                    <tr  class="td-cobertura_CODCOBERTURA">
                                        <th class="title"> Cobertura Codcobertura: </th>
                                        <td class="value"> <?php echo $data['cobertura_CODCOBERTURA']; ?></td>
                                    </tr>
                                    <tr  class="td-cobertura_TIPODOCUMENTO">
                                        <th class="title"> Cobertura Tipodocumento: </th>
                                        <td class="value"> <?php echo $data['cobertura_TIPODOCUMENTO']; ?></td>
                                    </tr>
                                    <tr  class="td-cobertura_NRODOCUMENTO">
                                        <th class="title"> Cobertura Nrodocumento: </th>
                                        <td class="value"> <?php echo $data['cobertura_NRODOCUMENTO']; ?></td>
                                    </tr>
                                    <tr  class="td-cobertura_NOMBCOBERTURA">
                                        <th class="title"> Cobertura Nombcobertura: </th>
                                        <td class="value"> <?php echo $data['cobertura_NOMBCOBERTURA']; ?></td>
                                    </tr>
                                    <tr  class="td-cobertura_CONTACTO">
                                        <th class="title"> Cobertura Contacto: </th>
                                        <td class="value"> <?php echo $data['cobertura_CONTACTO']; ?></td>
                                    </tr>
                                    <tr  class="td-cobertura_DOMICILIO">
                                        <th class="title"> Cobertura Domicilio: </th>
                                        <td class="value"> <?php echo $data['cobertura_DOMICILIO']; ?></td>
                                    </tr>
                                    <tr  class="td-cobertura_LOCALIDAD">
                                        <th class="title"> Cobertura Localidad: </th>
                                        <td class="value"> <?php echo $data['cobertura_LOCALIDAD']; ?></td>
                                    </tr>
                                    <tr  class="td-cobertura_CODPOSTAL">
                                        <th class="title"> Cobertura Codpostal: </th>
                                        <td class="value"> <?php echo $data['cobertura_CODPOSTAL']; ?></td>
                                    </tr>
                                    <tr  class="td-cobertura_PROVINCIA">
                                        <th class="title"> Cobertura Provincia: </th>
                                        <td class="value"> <?php echo $data['cobertura_PROVINCIA']; ?></td>
                                    </tr>
                                    <tr  class="td-cobertura_TELEFONO">
                                        <th class="title"> Cobertura Telefono: </th>
                                        <td class="value"> <?php echo $data['cobertura_TELEFONO']; ?></td>
                                    </tr>
                                    <tr  class="td-cobertura_EMAIL">
                                        <th class="title"> Cobertura Email: </th>
                                        <td class="value"> <?php echo $data['cobertura_EMAIL']; ?></td>
                                    </tr>
                                    <tr  class="td-cobertura_CONPLANILLA">
                                        <th class="title"> Cobertura Conplanilla: </th>
                                        <td class="value"> <?php echo $data['cobertura_CONPLANILLA']; ?></td>
                                    </tr>
                                    <tr  class="td-cobertura_OBSERVAC">
                                        <th class="title"> Cobertura Observac: </th>
                                        <td class="value"> <?php echo $data['cobertura_OBSERVAC']; ?></td>
                                    </tr>
                                    <tr  class="td-cobertura_CONTACTO2">
                                        <th class="title"> Cobertura Contacto2: </th>
                                        <td class="value"> <?php echo $data['cobertura_CONTACTO2']; ?></td>
                                    </tr>
                                    <tr  class="td-cobertura_CONTACTO3">
                                        <th class="title"> Cobertura Contacto3: </th>
                                        <td class="value"> <?php echo $data['cobertura_CONTACTO3']; ?></td>
                                    </tr>
                                    <tr  class="td-cobertura_TELEFONO2">
                                        <th class="title"> Cobertura Telefono2: </th>
                                        <td class="value"> <?php echo $data['cobertura_TELEFONO2']; ?></td>
                                    </tr>
                                    <tr  class="td-cobertura_TELEFONO3">
                                        <th class="title"> Cobertura Telefono3: </th>
                                        <td class="value"> <?php echo $data['cobertura_TELEFONO3']; ?></td>
                                    </tr>
                                    <tr  class="td-cobertura_TELEFONOEMERG">
                                        <th class="title"> Cobertura Telefonoemerg: </th>
                                        <td class="value"> <?php echo $data['cobertura_TELEFONOEMERG']; ?></td>
                                    </tr>
                                    <tr  class="td-cobertura_EMERGENCIA">
                                        <th class="title"> Cobertura Emergencia: </th>
                                        <td class="value"> <?php echo $data['cobertura_EMERGENCIA']; ?></td>
                                    </tr>
                                    <tr  class="td-date_deleted">
                                        <th class="title"> Date Deleted: </th>
                                        <td class="value"> <?php echo $data['date_deleted']; ?></td>
                                    </tr>
                                    <tr  class="td-is_deleted">
                                        <th class="title"> Is Deleted: </th>
                                        <td class="value"> <?php echo $data['is_deleted']; ?></td>
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
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("pacientes/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> Editar
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("pacientes/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="¿Seguro que quieres borrar este registro?" data-display-style="modal">
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
