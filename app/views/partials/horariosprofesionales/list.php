<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("horariosprofesionales/add");
$can_edit = ACL::is_allowed("horariosprofesionales/edit");
$can_view = ACL::is_allowed("horariosprofesionales/view");
$can_delete = ACL::is_allowed("horariosprofesionales/delete");
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
                    <h4 class="record-title">Lista de Horarios</h4>
                </div>
                <div class="col-sm-3 ">
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
                        <div id="horariosprofesionales-list-records">
                            <div id="page-report-body" class="table-responsive">
                                <table class="table  table-striped table-sm text-left">
                                    <thead class="table-header bg-light">
                                        <tr>
                                            <th class="td-sno">#</th>
                                            <th  class="td-dias_nombre"> Dias Nombre</th>
                                            <th  class="td-DESDE"> Desde</th>
                                            <th  class="td-HASTA"> Hasta</th>
                                            <th  class="td-duracion"> Duracion(Minutos)</th>
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
                                        $rec_id = (!empty($data['IDHORARIO']) ? urlencode($data['IDHORARIO']) : null);
                                        $counter++;
                                        ?>
                                        <tr>
                                            <th class="td-sno"><?php echo $counter; ?></th>
                                            <td class="td-dias_nombre">
                                                <span <?php if($can_edit){ ?> data-value="<?php echo $data['dias_nombre']; ?>" 
                                                    data-pk="<?php echo $data['IDHORARIO'] ?>" 
                                                    data-url="<?php print_link("dias/editfield/" . urlencode($data['codDia'])); ?>" 
                                                    data-name="nombre" 
                                                    data-title="Escribir  Nombre" 
                                                    data-placement="left" 
                                                    data-toggle="click" 
                                                    data-type="text" 
                                                    data-mode="popover" 
                                                    data-showbuttons="left" 
                                                    class="is-editable" <?php } ?>>
                                                    <?php echo $data['dias_nombre']; ?> 
                                                </span>
                                            </td>
                                            <td class="td-DESDE">
                                                <span <?php if($can_edit){ ?> data-value="<?php echo $data['DESDE']; ?>" 
                                                    data-pk="<?php echo $data['IDHORARIO'] ?>" 
                                                    data-url="<?php print_link("horariosprofesionales/editfield/" . urlencode($data['IDHORARIO'])); ?>" 
                                                    data-name="DESDE" 
                                                    data-title="Escribir  Desde" 
                                                    data-placement="left" 
                                                    data-toggle="click" 
                                                    data-type="time" 
                                                    data-mode="popover" 
                                                    data-showbuttons="left" 
                                                    class="is-editable" <?php } ?>>
                                                    <?php echo $data['DESDE']; ?> 
                                                </span>
                                            </td>
                                            <td class="td-HASTA">
                                                <span <?php if($can_edit){ ?> data-value="<?php echo $data['HASTA']; ?>" 
                                                    data-pk="<?php echo $data['IDHORARIO'] ?>" 
                                                    data-url="<?php print_link("horariosprofesionales/editfield/" . urlencode($data['IDHORARIO'])); ?>" 
                                                    data-name="HASTA" 
                                                    data-title="Escribir  Hasta" 
                                                    data-placement="left" 
                                                    data-toggle="click" 
                                                    data-type="time" 
                                                    data-mode="popover" 
                                                    data-showbuttons="left" 
                                                    class="is-editable" <?php } ?>>
                                                    <?php echo $data['HASTA']; ?> 
                                                </span>
                                            </td>
                                            <td class="td-duracion">
                                                <span <?php if($can_edit){ ?> data-value="<?php echo $data['duracion']; ?>" 
                                                    data-pk="<?php echo $data['IDHORARIO'] ?>" 
                                                    data-url="<?php print_link("horariosprofesionales/editfield/" . urlencode($data['IDHORARIO'])); ?>" 
                                                    data-name="duracion" 
                                                    data-title="Escribir  Duracion" 
                                                    data-placement="left" 
                                                    data-toggle="click" 
                                                    data-type="number" 
                                                    data-mode="popover" 
                                                    data-showbuttons="left" 
                                                    class="is-editable" <?php } ?>>
                                                    <?php echo $data['duracion']; ?> 
                                                </span>
                                            </td>
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