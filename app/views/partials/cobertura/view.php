<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("cobertura/add");
$can_edit = ACL::is_allowed("cobertura/edit");
$can_view = ACL::is_allowed("cobertura/view");
$can_delete = ACL::is_allowed("cobertura/delete");
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
                    <h4 class="record-title">Editar Cobertura</h4>
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
                    <div class="card ">
                        <div class="card-header p-0 pt-2 px-2">
                            <ul class="nav  nav-tabs   ">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#TabPage-2-Page1" role="tab" aria-selected="true">
                                        <i class="fa fa-book "></i> DATOS DE LA COBERTURA
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#TabPage-2-Page2" role="tab" aria-selected="true">
                                        <i class="fa fa-list "></i> PLANILLA DE ASISTENCIA
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active fade" id="TabPage-2-Page1" role="tabpanel">
                                    <div class=" reset-grids">
                                        <?php  
                                        $this->render_page("cobertura/edit/$page_id"); 
                                        ?>
                                    </div>
                                </div>
                                <div class="tab-pane  fade" id="TabPage-2-Page2" role="tabpanel">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
