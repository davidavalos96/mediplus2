<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("evoluciones/add");
$can_edit = ACL::is_allowed("evoluciones/edit");
$can_view = ACL::is_allowed("evoluciones/view");
$can_delete = ACL::is_allowed("evoluciones/delete");
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
<section class="page ajax-page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Evoluciones</h4>
                </div>
                <div class="col-sm-3 ">
                    <div class="">
                        <?php 
                        if(USER_ROLE != "Terapeuta" || USER_ROLE != "Medico")
                        {
                        ?>
                        <a  class="btn btn btn-primary my-1" href="<?php print_link("evoluciones/add"); ?>">
                        <i class="fa fa-plus"></i>Agregar Nuevo </a>
                        <?php
                        }
                        else{
                        ?>
                        <a  class="btn btn btn-primary my-1" href="<?php print_link("evoluciones/agregar_evolucion_terapeuta"); ?>">
                        <i class="fa fa-plus"></i>Agregar Nuevo </a>
                        <?php                    
                        }
                    ?></div>
                </div>
                <div class="col-sm-4 ">
                    <input autocomplete="off" data-page-id="<?php echo $page_element_id ?>" data-page="<?php print_link($current_page); ?>" value="<?php echo get_value('search'); ?>" class="form-control ajax-page-search" type="text" name="search"  placeholder="Buscar" />
                        <div class=""><div></div>
                        </div>
                    </div>
                    <div class="col-md-12 comp-grid">
                        <div class=""><?php 
                            if($field_name=="evoluciones.paciente"){
                            $_SESSION['idPaciente']=$field_value;
                            }
                        ?></div>
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
                    <div class="col-md-3 comp-grid">
                        <form method="get" action="<?php print_link($current_page) ?>" class="form filter-form">
                            <div class="card mb-3">
                                <div class="card-header h4 h4">Filtrar por fecha</div>
                                <div class="p-2">
                                    <input class="form-control datepicker"  value="<?php echo $this->set_field_value('evoluciones_fecha') ?>" type="datetime"  name="evoluciones_fecha" placeholder="" data-enable-time="" data-date-format="Y-m-d" data-alt-format="M j, Y" data-inline="false" data-no-calendar="false" data-mode="range" />
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header h4 h4">Tipo de Evolucion</div>
                                    <div class="p-2">
                                        <select   name="evoluciones_tipo_evolucion" class="form-control custom ">
                                            <option value="">Seleccione un valor</option>
                                            <?php 
                                            $evoluciones_tipo_evolucion_options = $comp_model -> evoluciones_evolucionestipo_evolucion_option_list();
                                            if(!empty($evoluciones_tipo_evolucion_options)){
                                            foreach($evoluciones_tipo_evolucion_options as $option){
                                            $value = (!empty($option['value']) ? $option['value'] : null);
                                            $label = (!empty($option['label']) ? $option['label'] : $value);
                                            $selected = $this->set_field_selected('evoluciones_tipo_evolucion',$value);
                                            ?>
                                            <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                <?php echo $label; ?>
                                            </option>
                                            <?php
                                            }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group text-center">
                                    <button class="btn btn-primary">Filtrar</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-9 comp-grid">
                            <?php $this :: display_page_errors(); ?>
                            <div class="filter-tags mb-2">
                                <?php
                                if(!empty($_GET['evoluciones_fecha'])){
                                ?>
                                <div class="filter-chip card bg-light">
                                    <b>Rango de fecha :</b> 
                                    <?php
                                    $date_val = get_value('evoluciones_fecha');
                                    $formated_date = "";
                                    if(str_contains('-to-', $date_val)){
                                    //if value is a range date
                                    $vals = explode('-to-' , str_replace(' ' , '' , $date_val));
                                    $startdate = $vals[0];
                                    $enddate = $vals[1];
                                    $formated_date = format_date($startdate, 'jS F, Y') . ' <span class="text-muted">&#10148;</span> ' . format_date($enddate, 'jS F, Y');
                                    }
                                    elseif(str_contains(',', $date_val)){
                                    //multi date values
                                    $vals = explode(',' , str_replace(' ' , '' , $date_val));
                                    $formated_arrs = array_map(function($date){return format_date($date, 'jS F, Y');}, $vals);
                                    $formated_date = implode(' <span class="text-info">&#11161;</span> ', $formated_arrs);
                                    }
                                    else{
                                    $formated_date = format_date($date_val, 'jS F, Y');
                                    }
                                    echo  $formated_date;
                                    $remove_link = unset_get_value('evoluciones_fecha', $this->route->page_url);
                                    ?>
                                    <a href="<?php print_link($remove_link); ?>" class="close-btn">
                                        &times;
                                    </a>
                                </div>
                                <?php
                                }
                                ?>
                                <?php
                                if(!empty(get_value('evoluciones_tipo_evolucion'))){
                                ?>
                                <div class="filter-chip card bg-light">
                                    <b>Tipo de Evolucion :</b> 
                                    <?php 
                                    if(get_value('evoluciones_tipo_evolucionlabel')){
                                    echo get_value('evoluciones_tipo_evolucionlabel');
                                    }
                                    else{
                                    echo get_value('evoluciones_tipo_evolucion');
                                    }
                                    $remove_link = unset_get_value('evoluciones_tipo_evolucion', $this->route->page_url);
                                    ?>
                                    <a href="<?php print_link($remove_link); ?>" class="close-btn">
                                        &times;
                                    </a>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div  class=" animated fadeIn page-content">
                                <div id="evoluciones-list-records">
                                    <div id="page-report-body" class="table-responsive">
                                        <?php Html::ajaxpage_spinner(); ?>
                                        <table class="table  table-striped table-sm text-left">
                                            <thead class="table-header bg-light">
                                                <tr>
                                                    <?php if($can_delete){ ?>
                                                    <th class="td-checkbox">
                                                        <label class="custom-control custom-checkbox custom-control-inline">
                                                            <input class="toggle-check-all custom-control-input" type="checkbox" />
                                                            <span class="custom-control-label"></span>
                                                        </label>
                                                    </th>
                                                    <?php } ?>
                                                    <th class="td-sno">#</th>
                                                    <th  class="td-fecha"> Fecha</th>
                                                    <th  class="td-tipo_evolucion_descripcion"> Tipo de Evolucion</th>
                                                    <th  class="td-v_profesionales_tratamiento_NOMBAPEPRO"> Profesional</th>
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
                                                $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                                                $counter++;
                                                ?>
                                                <tr>
                                                    <?php if($can_delete){ ?>
                                                    <th class=" td-checkbox">
                                                        <label class="custom-control custom-checkbox custom-control-inline">
                                                            <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['id'] ?>" type="checkbox" />
                                                                <span class="custom-control-label"></span>
                                                            </label>
                                                        </th>
                                                        <?php } ?>
                                                        <th class="td-sno"><?php echo $counter; ?></th>
                                                        <td class="td-fecha"> <?php echo $data['fecha']; ?></td>
                                                        <td class="td-tipo_evolucion_descripcion"> <?php echo $data['tipo_evolucion_descripcion']; ?></td>
                                                        <td class="td-v_profesionales_tratamiento_NOMBAPEPRO"> <?php echo $data['v_profesionales_NOMBAPEPRO']; ?></td>
                                                        <th class="td-btn">
                                                            <?php if($can_view){ ?>
                                                            <a class="btn btn-sm btn-success has-tooltip" title="Ver registro" href="<?php print_link("evoluciones/reporte/$rec_id?format=pdf"); ?>">
                                                                <i class="fa fa-print"></i> Imprimir
                                                            </a>
                                                            <?php } ?>
                                                            <?php if($can_edit){ ?>
                                                            <a class="btn btn-sm btn-info has-tooltip" title="Editar este registro" href="<?php print_link("evoluciones/edit/$rec_id"); ?>">
                                                                <i class="fa fa-edit"></i> Editar
                                                            </a>
                                                            <?php } ?>
                                                            <?php if($can_delete){ ?>
                                                            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Eliminar este registro" href="<?php print_link("evoluciones/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="¿Esta seguro que quiere eliminar este registro ?" data-display-style="modal">
                                                                <i class="fa fa-times"></i>
                                                                Borrar
                                                            </a>
                                                            <?php } ?>
                                                        </th>
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
                                                <i class="fa fa-ban"></i> No existen registros
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
                                                        <?php if($can_delete){ ?>
                                                        <button data-prompt-msg="¿Está seguro de que desea eliminar estos registros?" data-display-style="modal" data-url="<?php print_link("evoluciones/delete/{sel_ids}/?csrf_token=$csrf_token&redirect=$current_page"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                                                            <i class="fa fa-times"></i> Eliminar seleccionado
                                                        </button>
                                                        <?php } ?>
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
                                                    $pager->ajax_page = true;
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
