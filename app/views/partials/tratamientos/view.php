<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("tratamientos/add");
$can_edit = ACL::is_allowed("tratamientos/edit");
$can_view = ACL::is_allowed("tratamientos/view");
$can_delete = ACL::is_allowed("tratamientos/delete");
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
                        $rec_id = (!empty($data['codTratamiento']) ? urlencode($data['codTratamiento']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-codTratamiento">
                                        <th class="title"> Codtratamiento: </th>
                                        <td class="value"> <?php echo $data['codTratamiento']; ?></td>
                                    </tr>
                                    <tr  class="td-fecha_finalizacion">
                                        <th class="title"> Fecha Finalizacion: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['fecha_finalizacion']; ?>" 
                                                data-pk="<?php echo $data['codTratamiento'] ?>" 
                                                data-url="<?php print_link("tratamientos/editfield/" . urlencode($data['codTratamiento'])); ?>" 
                                                data-name="fecha_finalizacion" 
                                                data-title="Escribir  Fecha de Finalizacion" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['fecha_finalizacion']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-fecha_inicio">
                                        <th class="title"> Fecha Inicio: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['fecha_inicio']; ?>" 
                                                data-pk="<?php echo $data['codTratamiento'] ?>" 
                                                data-url="<?php print_link("tratamientos/editfield/" . urlencode($data['codTratamiento'])); ?>" 
                                                data-name="fecha_inicio" 
                                                data-title="Escribir  Fecha de Inicio" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['fecha_inicio']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-estrategiaTerapeutica">
                                        <th class="title"> Estrategiaterapeutica: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/tratamientos_estrategiaTerapeutica_option_list'); ?>' 
                                                data-value="<?php echo $data['estrategiaTerapeutica']; ?>" 
                                                data-pk="<?php echo $data['codTratamiento'] ?>" 
                                                data-url="<?php print_link("tratamientos/editfield/" . urlencode($data['codTratamiento'])); ?>" 
                                                data-name="estrategiaTerapeutica" 
                                                data-title="Seleccione un valor" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['estrategiaTerapeutica']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-paciente">
                                        <th class="title"> Paciente: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/tratamientos_paciente_option_list'); ?>' 
                                                data-value="<?php echo $data['paciente']; ?>" 
                                                data-pk="<?php echo $data['codTratamiento'] ?>" 
                                                data-url="<?php print_link("tratamientos/editfield/" . urlencode($data['codTratamiento'])); ?>" 
                                                data-name="paciente" 
                                                data-title="Seleccione un valor" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['paciente']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-pacientes_idPaciente">
                                        <th class="title"> Pacientes Idpaciente: </th>
                                        <td class="value"> <?php echo $data['pacientes_idPaciente']; ?></td>
                                    </tr>
                                    <tr  class="td-pacientes_NUMDOCPAC">
                                        <th class="title"> Pacientes Numdocpac: </th>
                                        <td class="value"> <?php echo $data['pacientes_NUMDOCPAC']; ?></td>
                                    </tr>
                                    <tr  class="td-pacientes_FECHANACPAC">
                                        <th class="title"> Pacientes Fechanacpac: </th>
                                        <td class="value"> <?php echo $data['pacientes_FECHANACPAC']; ?></td>
                                    </tr>
                                    <tr  class="td-pacientes_FECHACERTVTO">
                                        <th class="title"> Pacientes Fechacertvto: </th>
                                        <td class="value"> <?php echo $data['pacientes_FECHACERTVTO']; ?></td>
                                    </tr>
                                    <tr  class="td-pacientes_NOMBAPEPAC">
                                        <th class="title"> Pacientes Nombapepac: </th>
                                        <td class="value"> <?php echo $data['pacientes_NOMBAPEPAC']; ?></td>
                                    </tr>
                                    <tr  class="td-pacientes_COORDINADOR">
                                        <th class="title"> Pacientes Coordinador: </th>
                                        <td class="value"> <?php echo $data['pacientes_COORDINADOR']; ?></td>
                                    </tr>
                                    <tr  class="td-pacientes_COBERTURA">
                                        <th class="title"> Pacientes Cobertura: </th>
                                        <td class="value"> <?php echo $data['pacientes_COBERTURA']; ?></td>
                                    </tr>
                                    <tr  class="td-pacientes_PLANOBRASOC">
                                        <th class="title"> Pacientes Planobrasoc: </th>
                                        <td class="value"> <?php echo $data['pacientes_PLANOBRASOC']; ?></td>
                                    </tr>
                                    <tr  class="td-pacientes_NROAFILIADO">
                                        <th class="title"> Pacientes Nroafiliado: </th>
                                        <td class="value"> <?php echo $data['pacientes_NROAFILIADO']; ?></td>
                                    </tr>
                                    <tr  class="td-pacientes_DOMICILIO">
                                        <th class="title"> Pacientes Domicilio: </th>
                                        <td class="value"> <?php echo $data['pacientes_DOMICILIO']; ?></td>
                                    </tr>
                                    <tr  class="td-pacientes_barrio">
                                        <th class="title"> Pacientes Barrio: </th>
                                        <td class="value"> <?php echo $data['pacientes_barrio']; ?></td>
                                    </tr>
                                    <tr  class="td-pacientes_LOCALIDAD">
                                        <th class="title"> Pacientes Localidad: </th>
                                        <td class="value"> <?php echo $data['pacientes_LOCALIDAD']; ?></td>
                                    </tr>
                                    <tr  class="td-pacientes_TELEFONO">
                                        <th class="title"> Pacientes Telefono: </th>
                                        <td class="value"> <?php echo $data['pacientes_TELEFONO']; ?></td>
                                    </tr>
                                    <tr  class="td-pacientes_EMAIL">
                                        <th class="title"> Pacientes Email: </th>
                                        <td class="value"> <?php echo $data['pacientes_EMAIL']; ?></td>
                                    </tr>
                                    <tr  class="td-pacientes_DIAGNOSTICO">
                                        <th class="title"> Pacientes Diagnostico: </th>
                                        <td class="value"> <?php echo $data['pacientes_DIAGNOSTICO']; ?></td>
                                    </tr>
                                    <tr  class="td-pacientes_MEDICODERIV">
                                        <th class="title"> Pacientes Medicoderiv: </th>
                                        <td class="value"> <?php echo $data['pacientes_MEDICODERIV']; ?></td>
                                    </tr>
                                    <tr  class="td-pacientes_ESTADOPACIENTE">
                                        <th class="title"> Pacientes Estadopaciente: </th>
                                        <td class="value"> <?php echo $data['pacientes_ESTADOPACIENTE']; ?></td>
                                    </tr>
                                    <tr  class="td-estrategiaterapeutica_id">
                                        <th class="title"> Estrategiaterapeutica Id: </th>
                                        <td class="value"> <?php echo $data['estrategiaterapeutica_id']; ?></td>
                                    </tr>
                                    <tr  class="td-estrategiaterapeutica_descripcion">
                                        <th class="title"> Estrategiaterapeutica Descripcion: </th>
                                        <td class="value"> <?php echo $data['estrategiaterapeutica_descripcion']; ?></td>
                                    </tr>
                                    <tr  class="td-estrategiaterapeutica_modalidad">
                                        <th class="title"> Estrategiaterapeutica Modalidad: </th>
                                        <td class="value"> <?php echo $data['estrategiaterapeutica_modalidad']; ?></td>
                                    </tr>
                                    <tr  class="td-estrategiaterapeutica_cantSemanas">
                                        <th class="title"> Estrategiaterapeutica Cantsemanas: </th>
                                        <td class="value"> <?php echo $data['estrategiaterapeutica_cantSemanas']; ?></td>
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
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("tratamientos/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> Editar
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("tratamientos/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="¿Seguro que quieres borrar este registro?" data-display-style="modal">
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
