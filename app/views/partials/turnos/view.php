<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("turnos/add");
$can_edit = ACL::is_allowed("turnos/edit");
$can_view = ACL::is_allowed("turnos/view");
$can_delete = ACL::is_allowed("turnos/delete");
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
                        $rec_id = (!empty($data['ID']) ? urlencode($data['ID']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-ID">
                                        <th class="title"> Id: </th>
                                        <td class="value"> <?php echo $data['ID']; ?></td>
                                    </tr>
                                    <tr  class="td-IDPROFESIONAL">
                                        <th class="title"> Idprofesional: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-IDPACIENTE">
                                        <th class="title"> Idpaciente: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-IDESPECIALIDAD">
                                        <th class="title"> Idespecialidad: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-FECHATURNO">
                                        <th class="title"> Fechaturno: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-HSTURNO">
                                        <th class="title"> Hsturno: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-ESTADOTURNO">
                                        <th class="title"> Estadoturno: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-TIPOTURNO">
                                        <th class="title"> Tipoturno: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-OBSERVACION">
                                        <th class="title"> Observacion: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-IDCONSULTORIO">
                                        <th class="title"> Idconsultorio: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-DURACION">
                                        <th class="title"> Duracion: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-auxiliar">
                                        <th class="title"> Auxiliar: </th>
                                        <td class="value"> <?php echo $data['auxiliar']; ?></td>
                                    </tr>
                                    <tr  class="td-CANTSESIONES">
                                        <th class="title"> Cantsesiones: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-especialidades_CODIGO">
                                        <th class="title"> Especialidades Codigo: </th>
                                        <td class="value"> <?php echo $data['especialidades_CODIGO']; ?></td>
                                    </tr>
                                    <tr  class="td-especialidades_DESCRIPCION">
                                        <th class="title"> Especialidades Descripcion: </th>
                                        <td class="value"> <?php echo $data['especialidades_DESCRIPCION']; ?></td>
                                    </tr>
                                    <tr  class="td-especialidades_ABREVIACION">
                                        <th class="title"> Especialidades Abreviacion: </th>
                                        <td class="value"> <?php echo $data['especialidades_ABREVIACION']; ?></td>
                                    </tr>
                                    <tr  class="td-estadoturno_idEstadoTurno">
                                        <th class="title"> Estadoturno Idestadoturno: </th>
                                        <td class="value"> <?php echo $data['estadoturno_idEstadoTurno']; ?></td>
                                    </tr>
                                    <tr  class="td-estadoturno_descripcion">
                                        <th class="title"> Estadoturno Descripcion: </th>
                                        <td class="value"> <?php echo $data['estadoturno_descripcion']; ?></td>
                                    </tr>
                                    <tr  class="td-estadoturno_cantSesiones">
                                        <th class="title"> Estadoturno Cantsesiones: </th>
                                        <td class="value"> <?php echo $data['estadoturno_cantSesiones']; ?></td>
                                    </tr>
                                    <tr  class="td-estadoturno_COLOR">
                                        <th class="title"> Estadoturno Color: </th>
                                        <td class="value"> <?php echo $data['estadoturno_COLOR']; ?></td>
                                    </tr>
                                    <tr  class="td-v_profesionales_ID">
                                        <th class="title"> V Profesionales Id: </th>
                                        <td class="value"> <?php echo $data['v_profesionales_ID']; ?></td>
                                    </tr>
                                    <tr  class="td-v_profesionales_NRODOCPRO">
                                        <th class="title"> V Profesionales Nrodocpro: </th>
                                        <td class="value"> <?php echo $data['v_profesionales_NRODOCPRO']; ?></td>
                                    </tr>
                                    <tr  class="td-v_profesionales_NOMBAPEPRO">
                                        <th class="title"> V Profesionales Nombapepro: </th>
                                        <td class="value"> <?php echo $data['v_profesionales_NOMBAPEPRO']; ?></td>
                                    </tr>
                                    <tr  class="td-v_paciente_idPaciente">
                                        <th class="title"> V Paciente Idpaciente: </th>
                                        <td class="value"> <?php echo $data['v_paciente_idPaciente']; ?></td>
                                    </tr>
                                    <tr  class="td-v_paciente_NUMDOCPAC">
                                        <th class="title"> V Paciente Numdocpac: </th>
                                        <td class="value"> <?php echo $data['v_paciente_NUMDOCPAC']; ?></td>
                                    </tr>
                                    <tr  class="td-v_paciente_NOMBAPEPAC">
                                        <th class="title"> V Paciente Nombapepac: </th>
                                        <td class="value"> <?php echo $data['v_paciente_NOMBAPEPAC']; ?></td>
                                    </tr>
                                    <tr  class="td-estadoturno_idEstadoTurno">
                                        <th class="title"> Estadoturno Idestadoturno: </th>
                                        <td class="value"> <?php echo $data['estadoturno_idEstadoTurno']; ?></td>
                                    </tr>
                                    <tr  class="td-estadoturno_descripcion">
                                        <th class="title"> Estadoturno Descripcion: </th>
                                        <td class="value"> <?php echo $data['estadoturno_descripcion']; ?></td>
                                    </tr>
                                    <tr  class="td-estadoturno_cantSesiones">
                                        <th class="title"> Estadoturno Cantsesiones: </th>
                                        <td class="value"> <?php echo $data['estadoturno_cantSesiones']; ?></td>
                                    </tr>
                                    <tr  class="td-estadoturno_COLOR">
                                        <th class="title"> Estadoturno Color: </th>
                                        <td class="value"> <?php echo $data['estadoturno_COLOR']; ?></td>
                                    </tr>
                                    <tr  class="td-estadoturno_date_deleted">
                                        <th class="title"> Estadoturno Date Deleted: </th>
                                        <td class="value"> <?php echo $data['estadoturno_date_deleted']; ?></td>
                                    </tr>
                                    <tr  class="td-estadoturno_is_deleted">
                                        <th class="title"> Estadoturno Is Deleted: </th>
                                        <td class="value"> <?php echo $data['estadoturno_is_deleted']; ?></td>
                                    </tr>
                                    <tr  class="td-consultorio_CODIGO">
                                        <th class="title"> Consultorio Codigo: </th>
                                        <td class="value"> <?php echo $data['consultorio_CODIGO']; ?></td>
                                    </tr>
                                    <tr  class="td-consultorio_DESCRIPCION">
                                        <th class="title"> Consultorio Descripcion: </th>
                                        <td class="value"> <?php echo $data['consultorio_DESCRIPCION']; ?></td>
                                    </tr>
                                    <tr  class="td-consultorio_date_deleted">
                                        <th class="title"> Consultorio Date Deleted: </th>
                                        <td class="value"> <?php echo $data['consultorio_date_deleted']; ?></td>
                                    </tr>
                                    <tr  class="td-consultorio_is_deleted">
                                        <th class="title"> Consultorio Is Deleted: </th>
                                        <td class="value"> <?php echo $data['consultorio_is_deleted']; ?></td>
                                    </tr>
                                    <tr  class="td-especialidades_CODIGO">
                                        <th class="title"> Especialidades Codigo: </th>
                                        <td class="value"> <?php echo $data['especialidades_CODIGO']; ?></td>
                                    </tr>
                                    <tr  class="td-especialidades_DESCRIPCION">
                                        <th class="title"> Especialidades Descripcion: </th>
                                        <td class="value"> <?php echo $data['especialidades_DESCRIPCION']; ?></td>
                                    </tr>
                                    <tr  class="td-especialidades_ABREVIACION">
                                        <th class="title"> Especialidades Abreviacion: </th>
                                        <td class="value"> <?php echo $data['especialidades_ABREVIACION']; ?></td>
                                    </tr>
                                    <tr  class="td-especialidades_date_deleted">
                                        <th class="title"> Especialidades Date Deleted: </th>
                                        <td class="value"> <?php echo $data['especialidades_date_deleted']; ?></td>
                                    </tr>
                                    <tr  class="td-especialidades_is_deleted">
                                        <th class="title"> Especialidades Is Deleted: </th>
                                        <td class="value"> <?php echo $data['especialidades_is_deleted']; ?></td>
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
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("turnos/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> Editar
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("turnos/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="¿Seguro que quieres borrar este registro?" data-display-style="modal">
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
