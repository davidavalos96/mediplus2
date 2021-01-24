<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("profesionales/add");
$can_edit = ACL::is_allowed("profesionales/edit");
$can_view = ACL::is_allowed("profesionales/view");
$can_delete = ACL::is_allowed("profesionales/delete");
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
                                    <tr  class="td-FECHAALTA">
                                        <th class="title"> Fechaalta: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['FECHAALTA']; ?>" 
                                                data-pk="<?php echo $data['ID'] ?>" 
                                                data-url="<?php print_link("profesionales/editfield/" . urlencode($data['ID'])); ?>" 
                                                data-name="FECHAALTA" 
                                                data-title="Escribir  Fecha de Alta" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['FECHAALTA']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-FECHABAJA">
                                        <th class="title"> Fechabaja: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-flatpickr="{ enableTime: false, minDate: '', maxDate: '<?php echo date_now(); ?>'}" 
                                                data-value="<?php echo $data['FECHABAJA']; ?>" 
                                                data-pk="<?php echo $data['ID'] ?>" 
                                                data-url="<?php print_link("profesionales/editfield/" . urlencode($data['ID'])); ?>" 
                                                data-name="FECHABAJA" 
                                                data-title="Escribir  Fecha de Baja" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['FECHABAJA']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-TIPODOCPRO">
                                        <th class="title"> Tipodocpro: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu :: $TIPODOCPRO); ?>' 
                                                data-value="<?php echo $data['TIPODOCPRO']; ?>" 
                                                data-pk="<?php echo $data['ID'] ?>" 
                                                data-url="<?php print_link("profesionales/editfield/" . urlencode($data['ID'])); ?>" 
                                                data-name="TIPODOCPRO" 
                                                data-title="Seleccione un valor" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['TIPODOCPRO']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-NRODOCPRO">
                                        <th class="title"> Nrodocpro: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['NRODOCPRO']; ?>" 
                                                data-pk="<?php echo $data['ID'] ?>" 
                                                data-url="<?php print_link("profesionales/editfield/" . urlencode($data['ID'])); ?>" 
                                                data-name="NRODOCPRO" 
                                                data-title="Escribir  N° de Documento" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['NRODOCPRO']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-FECHANACPRO">
                                        <th class="title"> Fechanacpro: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-flatpickr="{ enableTime: false, minDate: '', maxDate: '<?php echo date('d-m-Y', strtotime('-18year')); ?>'}" 
                                                data-value="<?php echo $data['FECHANACPRO']; ?>" 
                                                data-pk="<?php echo $data['ID'] ?>" 
                                                data-url="<?php print_link("profesionales/editfield/" . urlencode($data['ID'])); ?>" 
                                                data-name="FECHANACPRO" 
                                                data-title="Escribir  Fecha de Nacimiento" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['FECHANACPRO']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-NOMBAPEPRO">
                                        <th class="title"> Nombapepro: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['NOMBAPEPRO']; ?>" 
                                                data-pk="<?php echo $data['ID'] ?>" 
                                                data-url="<?php print_link("profesionales/editfield/" . urlencode($data['ID'])); ?>" 
                                                data-name="NOMBAPEPRO" 
                                                data-title="Escribir  Apellido y Nombre" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['NOMBAPEPRO']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-DOMICILIO">
                                        <th class="title"> Domicilio: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['DOMICILIO']; ?>" 
                                                data-pk="<?php echo $data['ID'] ?>" 
                                                data-url="<?php print_link("profesionales/editfield/" . urlencode($data['ID'])); ?>" 
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
                                    <tr  class="td-BARRIO">
                                        <th class="title"> Barrio: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php 
                                                $dependent_field = (!empty($data['LOCALIDAD']) ? urlencode($data['LOCALIDAD']) : null);
                                                print_link('api/json/profesionales_BARRIO_option_list/'.$dependent_field); 
                                                ?>' 
                                                data-value="<?php echo $data['BARRIO']; ?>" 
                                                data-pk="<?php echo $data['ID'] ?>" 
                                                data-url="<?php print_link("profesionales/editfield/" . urlencode($data['ID'])); ?>" 
                                                data-name="BARRIO" 
                                                data-title="Seleccione un valor" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['BARRIO']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-LOCALIDAD">
                                        <th class="title"> Localidad: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/profesionales_LOCALIDAD_option_list'); ?>' 
                                                data-value="<?php echo $data['LOCALIDAD']; ?>" 
                                                data-pk="<?php echo $data['ID'] ?>" 
                                                data-url="<?php print_link("profesionales/editfield/" . urlencode($data['ID'])); ?>" 
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
                                    <tr  class="td-TELPARTPRO">
                                        <th class="title"> Telpartpro: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['TELPARTPRO']; ?>" 
                                                data-pk="<?php echo $data['ID'] ?>" 
                                                data-url="<?php print_link("profesionales/editfield/" . urlencode($data['ID'])); ?>" 
                                                data-name="TELPARTPRO" 
                                                data-title="Escribir  Telefono Fijo Particular" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['TELPARTPRO']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-TELCELPRO">
                                        <th class="title"> Telcelpro: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['TELCELPRO']; ?>" 
                                                data-pk="<?php echo $data['ID'] ?>" 
                                                data-url="<?php print_link("profesionales/editfield/" . urlencode($data['ID'])); ?>" 
                                                data-name="TELCELPRO" 
                                                data-title="Escribir  Telefono Celular" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['TELCELPRO']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-EMAIL">
                                        <th class="title"> Email: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['EMAIL']; ?>" 
                                                data-pk="<?php echo $data['ID'] ?>" 
                                                data-url="<?php print_link("profesionales/editfield/" . urlencode($data['ID'])); ?>" 
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
                                    <tr  class="td-NROMATRICULA">
                                        <th class="title"> Nromatricula: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['NROMATRICULA']; ?>" 
                                                data-pk="<?php echo $data['ID'] ?>" 
                                                data-url="<?php print_link("profesionales/editfield/" . urlencode($data['ID'])); ?>" 
                                                data-name="NROMATRICULA" 
                                                data-title="Escribir  N° de Matricula" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['NROMATRICULA']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-FECHAVTOMAT">
                                        <th class="title"> Fechavtomat: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['FECHAVTOMAT']; ?>" 
                                                data-pk="<?php echo $data['ID'] ?>" 
                                                data-url="<?php print_link("profesionales/editfield/" . urlencode($data['ID'])); ?>" 
                                                data-name="FECHAVTOMAT" 
                                                data-title="Escribir  Fecha de Venc. Matricula" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['FECHAVTOMAT']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-NRORNP">
                                        <th class="title"> Nrornp: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['NRORNP']; ?>" 
                                                data-pk="<?php echo $data['ID'] ?>" 
                                                data-url="<?php print_link("profesionales/editfield/" . urlencode($data['ID'])); ?>" 
                                                data-name="NRORNP" 
                                                data-title="Escribir  N° de NRP" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['NRORNP']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-FECHAVTORNP">
                                        <th class="title"> Fechavtornp: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['FECHAVTORNP']; ?>" 
                                                data-pk="<?php echo $data['ID'] ?>" 
                                                data-url="<?php print_link("profesionales/editfield/" . urlencode($data['ID'])); ?>" 
                                                data-name="FECHAVTORNP" 
                                                data-title="Escribir  Fecha Venc. NRP" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['FECHAVTORNP']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-EXEINGRESOSBRUTOS">
                                        <th class="title"> Exeingresosbrutos: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['EXEINGRESOSBRUTOS']; ?>" 
                                                data-pk="<?php echo $data['ID'] ?>" 
                                                data-url="<?php print_link("profesionales/editfield/" . urlencode($data['ID'])); ?>" 
                                                data-name="EXEINGRESOSBRUTOS" 
                                                data-title="Escribir  Ext. Ingresos Brutos" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['EXEINGRESOSBRUTOS']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-POLIZA">
                                        <th class="title"> Poliza: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['POLIZA']; ?>" 
                                                data-pk="<?php echo $data['ID'] ?>" 
                                                data-url="<?php print_link("profesionales/editfield/" . urlencode($data['ID'])); ?>" 
                                                data-name="POLIZA" 
                                                data-title="Escribir  Poliza N°" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['POLIZA']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-HORALUN">
                                        <th class="title"> Horalun: </th>
                                        <td class="value"> <?php echo $data['HORALUN']; ?></td>
                                    </tr>
                                    <tr  class="td-HORAMAR">
                                        <th class="title"> Horamar: </th>
                                        <td class="value"> <?php echo $data['HORAMAR']; ?></td>
                                    </tr>
                                    <tr  class="td-HORAMIE">
                                        <th class="title"> Horamie: </th>
                                        <td class="value"> <?php echo $data['HORAMIE']; ?></td>
                                    </tr>
                                    <tr  class="td-HORAJUE">
                                        <th class="title"> Horajue: </th>
                                        <td class="value"> <?php echo $data['HORAJUE']; ?></td>
                                    </tr>
                                    <tr  class="td-HORAVIE">
                                        <th class="title"> Horavie: </th>
                                        <td class="value"> <?php echo $data['HORAVIE']; ?></td>
                                    </tr>
                                    <tr  class="td-HORASAB">
                                        <th class="title"> Horasab: </th>
                                        <td class="value"> <?php echo $data['HORASAB']; ?></td>
                                    </tr>
                                    <tr  class="td-CONVENIOS">
                                        <th class="title"> Convenios: </th>
                                        <td class="value"> <?php echo $data['CONVENIOS']; ?></td>
                                    </tr>
                                    <tr  class="td-ESPECIALIDAD1">
                                        <th class="title"> Especialidad1: </th>
                                        <td class="value"> <?php echo $data['ESPECIALIDAD1']; ?></td>
                                    </tr>
                                    <tr  class="td-ESPECIALIDAD2">
                                        <th class="title"> Especialidad2: </th>
                                        <td class="value"> <?php echo $data['ESPECIALIDAD2']; ?></td>
                                    </tr>
                                    <tr  class="td-ESPECIALIDAD3">
                                        <th class="title"> Especialidad3: </th>
                                        <td class="value"> <?php echo $data['ESPECIALIDAD3']; ?></td>
                                    </tr>
                                    <tr  class="td-localidades_id">
                                        <th class="title"> Localidades Id: </th>
                                        <td class="value"> <?php echo $data['localidades_id']; ?></td>
                                    </tr>
                                    <tr  class="td-localidades_provincia">
                                        <th class="title"> Localidades Provincia: </th>
                                        <td class="value"> <?php echo $data['localidades_provincia']; ?></td>
                                    </tr>
                                    <tr  class="td-localidades_localidad">
                                        <th class="title"> Localidades Localidad: </th>
                                        <td class="value"> <?php echo $data['localidades_localidad']; ?></td>
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
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("profesionales/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> Editar
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("profesionales/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="¿Seguro que quieres borrar este registro?" data-display-style="modal">
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
