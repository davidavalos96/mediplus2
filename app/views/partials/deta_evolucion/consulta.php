<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("deta_evolucion/add");
$can_edit = ACL::is_allowed("deta_evolucion/edit");
$can_view = ACL::is_allowed("deta_evolucion/view");
$can_delete = ACL::is_allowed("deta_evolucion/delete");
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
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="grid" data-page-url="<?php print_link($current_page); ?>">
    <div  class="">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class=" animated fadeIn page-content">
                        <div id="deta_evolucion-consulta-records">
                            <?php
                            if(!empty($records)){
                            ?>
                            <!--record-->
                            <?php
                            $counter = 0;
                            foreach($records as $data){
                            $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                            $counter++;
                            ?>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <h6>
                                            <input type="checkbox" disabled <?php echo $data['activo']?'checked':''; ?>/>
                                                <?php echo $data['item_evolucion_descripcion'];?>  <br> 
                                                </h6></div>
                                            </div>
                                        </div>
                                        <?php 
                                        }
                                        ?>
                                        <!--endrecord-->
                                        <?php }?>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
