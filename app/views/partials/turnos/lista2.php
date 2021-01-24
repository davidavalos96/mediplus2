<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("turnos/add");
$can_edit = ACL::is_allowed("turnos/edit");
$can_view = ACL::is_allowed("turnos/view");
$can_delete = ACL::is_allowed("turnos/delete");
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
                    <h4 class="record-title">Turnos</h4>
                </div>
                <div class="col-sm-3 ">
                    <?php if($can_add){ ?>
                    <a  class="btn btn btn-primary my-1" href="<?php print_link("turnos/add") ?>">
                        <i class="fa fa-plus"></i>                              
                        Agregar nuevo 
                    </a>
                    <?php } ?>
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('turnos/'); ?>" method="get">
                        <div class="input-group">
                            <input value="<?php echo get_value('search'); ?>" class="form-control" type="text" name="search"  placeholder="Buscar" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 comp-grid">
                        <div class="">
                            <!-- Page bread crumbs components-->
                            <?php
                            if(!empty($field_name) || !empty($_GET['search'])){
                            ?>
                            <hr class="sm d-block d-sm-none" />
                            <nav class="page-header-breadcrumbs mt-2" aria-label="breadcrumb">
                                <ul class="breadcrumb m-0 p-1">
                                    <?php
                                    if(!empty($field_name)){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('turnos'); ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <?php echo (get_value("tag") ? get_value("tag")  :  make_readable($field_name)); ?>
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold">
                                        <?php echo (get_value("label") ? get_value("label")  :  make_readable(urldecode($field_value))); ?>
                                    </li>
                                    <?php 
                                    }   
                                    ?>
                                    <?php
                                    if(get_value("search")){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('turnos'); ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-capitalize">
                                        Buscar
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold"><?php echo get_value("search"); ?></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </nav>
                            <!--End of Page bread crumbs components-->
                            <?php
                            }
                            ?>
                        </div>
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
                        <div class=""><?php $counter = 0;
                            foreach($records as $data){
                            $rec_id = (!empty($data['ID']) ? urlencode($data['ID']) : null);
                            $counter++;
                            $suma = strtotime($data['HSTURNO']) + strtotime($data['DURACION']); 
                            $horaFin= date("H:i:s", $suma) ;
                            ?>
                            <script>
                                if(typeof(eventos)=='undefined'){
                                var eventos = new Array(); 
                                }
                                eventos.push({
                                title: '<?php echo $data['pacientes_NOMBAPEPAC']?> ',
                                description:'<?php echo "Profesional:".$data['profesionales_NOMBAPEPRO'].'<br>'.'Consultorio:';?>',
                                    start: '<?php echo $data['FECHATURNO'].'T'.$data['HSTURNO'];?>',
                                    end: '<?php echo $data['FECHATURNO'].'T'.$horaFin;?>',
                                    allDay:false
                                    })
                                </script>   
                                <?php } ?>
                                <div id="Calendar"></div>
                                <script>
                                    $(document).ready(function(){
                                    $('#Calendar').fullCalendar({
                                    header:{
                                    left:   'day,prev,next,AgregarTurno',
                                    center: 'title',
                                    right:  'agendaDay,agendaWeek,month'
                                    },
                                    customButtons:{
                                    AgregarTurno:{
                                    text:'Registrar Turno',
                                    click:function(){
                                    alert("funcion que da de alta un turno");
                                    }
                                    }
                                    },
                                    eventRender: function(eventObj, $el) {
                                    $el.popover({
                                    title: eventObj.title,
                                    content: eventObj.description,
                                    trigger: 'hover',
                                    placement: 'top',
                                    html: true, /* activamos el uso de codigo html */
                                    container: 'body'
                                    });
                                    },
                                    events:eventos}); 
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
