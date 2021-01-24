<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("sesiones_tratamiento/add");
$can_edit = ACL::is_allowed("sesiones_tratamiento/edit");
$can_view = ACL::is_allowed("sesiones_tratamiento/view");
$can_delete = ACL::is_allowed("sesiones_tratamiento/delete");
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
    <div  class="">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class=" animated fadeIn page-content">
                        <div id="sesiones_tratamiento-lista-records">
                            <div id="page-report-body" class="table-responsive">
                                <table class="table  table-striped table-sm text-left">
                                    <thead class="table-header bg-light">
                                        <tr>
                                            <th class="td-sno">#</th>
                                            <th  class="td-dias_nombre"> Dias</th>
                                            <th  class="td-desde"> Desde</th>
                                            <th  class="td-hasta"> Hasta</th>
                                            <th  class="td-cantSesiones"> Cantsesiones</th>
                                            <th  class="td-consultorio"> Consultorio</th>
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
                                        $rec_id = (!empty($data['codSesion']) ? urlencode($data['codSesion']) : null);
                                        $counter++;
                                        ?>
                                        <tr>
                                            <th class="td-sno"><?php echo $counter; ?></th>
                                            <td class="td-dias_nombre">
                                                <span <?php if($can_edit){ ?> data-value="<?php echo $data['dias_nombre']; ?>" 
                                                    data-pk="<?php echo $data['codSesion'] ?>" 
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
                                            <td class="td-desde">
                                                <span <?php if($can_edit){ ?> data-value="<?php echo $data['desde']; ?>" 
                                                    data-pk="<?php echo $data['codSesion'] ?>" 
                                                    data-url="<?php print_link("sesiones_tratamiento/editfield/" . urlencode($data['codSesion'])); ?>" 
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
                                            <td class="td-hasta">
                                                <span <?php if($can_edit){ ?> data-value="<?php echo $data['hasta']; ?>" 
                                                    data-pk="<?php echo $data['codSesion'] ?>" 
                                                    data-url="<?php print_link("sesiones_tratamiento/editfield/" . urlencode($data['codSesion'])); ?>" 
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
                                            <td class="td-cantSesiones">
                                                <span <?php if($can_edit){ ?> data-value="<?php echo $data['cantSesiones']; ?>" 
                                                    data-pk="<?php echo $data['codSesion'] ?>" 
                                                    data-url="<?php print_link("sesiones_tratamiento/editfield/" . urlencode($data['codSesion'])); ?>" 
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
                                            <td class="td-consultorio">
                                                <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/sesiones_tratamiento_consultorio_option_list'); ?>' 
                                                    data-value="<?php echo $data['consultorio']; ?>" 
                                                    data-pk="<?php echo $data['codSesion'] ?>" 
                                                    data-url="<?php print_link("sesiones_tratamiento/editfield/" . urlencode($data['codSesion'])); ?>" 
                                                    data-name="consultorio" 
                                                    data-title="Seleccione un valor" 
                                                    data-placement="left" 
                                                    data-toggle="click" 
                                                    data-type="select" 
                                                    data-mode="popover" 
                                                    data-showbuttons="left" 
                                                    class="is-editable" <?php } ?>>
                                                    <?php echo $data['consultorio']; ?> 
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
