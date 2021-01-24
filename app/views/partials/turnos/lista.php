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
$calendarName=random_str();
?>
<section class="page ajax-page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">AGENDA DEL PROFESIONAL</h4>
                </div>
                <div class="col-sm-3 ">
                    <?php if($can_add){ ?>
                    <?php $modal_id = "modal-" . random_str(); ?>
                    
                    <div data-backdrop="true" id="<?php  echo $modal_id ?>" class="modal fade"  role="dialog" aria-labelledby="<?php  echo $modal_id ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-body p-0 ">
                                </div>
                                <div style="top: 5px; right:5px; z-index: 999;" class="position-absolute">
                                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">&times;</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="col-sm-4 ">
                    
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
                    <div class="col-md-3 comp-grid">
                        <form method="get" action="<?php print_link($current_page) ?>" class="form filter-form">
                           
                            <div class="card mb-3 sel_profesional">
                                <div class="card-header h4 h4">Profesional</div>
                                <div class="p-2">
                                    <select   name="turnos_IDPROFESIONAL" class="form-control custom ">
                                        <option value="2321323124142123667787669022">Seleccione un Profesional</option>
                                        <?php 
                                        $turnos_IDPROFESIONAL_options = $comp_model -> turnos_turnosIDPROFESIONAL_option_list();
                                        if(!empty($turnos_IDPROFESIONAL_options)){
                                        foreach($turnos_IDPROFESIONAL_options as $option){
                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                        $selected = $this->set_field_selected('turnos_IDPROFESIONAL',$value);
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
                            <div class="card mb-3 oculto">
                                <div class="card-header h4 h4">Filter by Turnos Fechaturno</div>
                                <div class="p-2">
                                    <input class="form-control datepicker"  value="<?php echo $this->set_field_value('turnos_FECHATURNO') ?>" type="datetime"  name="turnos_FECHATURNO" placeholder="" data-enable-time="" data-date-format="Y-m-d" data-alt-format="M j, Y" data-inline="false" data-no-calendar="false" data-mode="range" />
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group text-center">
                                    <button class="btn btn-primary" id="filtro">Mostrar Horarios</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-9 comp-grid">
                            <div class=""><script>
                                var modalid='<?php echo $modal_id;?>';
                                var urledit='<?php print_link("turnos/edit/") ?>';
                                $(document).ready(function(){
                                var idPaciente='';
                                var idProfesional='';
                                $('#Calendar<?=$calendarName;?><?=$calendarName;?>').fullCalendar({
                                
                                header:{
                                left:   'day,prev,next',
                                center: 'title',
                                right:  'agendaWeek'
                                },
                                minTime: "7:00",
                                maxTime: "19:00",
                                contentHeight: 'auto',
                                defaultView: 'agendaWeek',
                                customButtons:{
                                AgregarTurno:{
                                text:'Registrar Turno',
                                click:function(){
                                alert("funcion que da de alta un turno");
                                }
                                }
                                },
                                selectable:true,
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
                                
                                eventClassNames: [ 'open-page-modal' ],
                                eventClick: function(calEvent, jsEvent, view) {
                                //example: http://www.mikesmithdev.com/blog/fullcalendar-event-details-with-bootstrap-modal/
                                $('.modal-body').load(urledit+calEvent.id,function(result){
                                $('#'+modalid).modal({show:true});
                                });
                                //$(this).fullCalendar("rerenderEvents");
                                //THIS DOES NOT WORK.  When click, right scroll bar disappears
                                //$('#calendarmodalForm').modal();
                                //THIS DOES NOT WORK.  When click, right scroll bar disappears, but if click again scroll bar comes back.
                                $('#calendarmodalForm').modal("toggle");
                                //THIS WORKS - SHOWS ALERT
                                //alert('Event id: ' + calEvent.id);
                                },
                                events:function( start, end, timezone, callback ) { 
                                var fecini=moment(start).format('YYYY-MM-DD');
                                var fecfin= moment(end).format('YYYY-MM-DD');
                                var url='<?php echo SITE_ADDR;?>turnos/lista?turnos_FECHATURNO=';     
                                url=url + fecini.toString() + '-to-'+fecfin.toString();
                                $('.sel_paciente').attr('id', 'paciente');
                                var idPaciente = $( 'select[name ="turnos_IDPACIENTE"] option:selected' ).val();
                                $('.sel_profesional').attr('id', 'profesional');
                                var idProfesional = $( 'select[name ="turnos_IDPROFESIONAL"] option:selected').val();
                                if(typeof(idPaciente) !='undefined' && idPaciente.length >0 ){
                                url = url +'&turnos_IDPACIENTE='+idPaciente;
                                }
                                if(typeof(idProfesional) !='undefined'&& idProfesional.length >0){
                                url = url+'&turnos_IDPROFESIONAL='+idProfesional;
                                }
                                url=url+'&format=json'; 
                                $.ajax({
                                url: url,
                                type: 'GET',
                                success: function(response){
                                var eventos =[];
                                for(i=0;i<response.length;i++){
                                var horaSalida=response[i].HSSALIDA;
                                var descripcionEvento ='Profesional:'+  response[i].profesionales_NOMBAPEPRO+'<br>'+'Consultorio:'+response[i].CONSULTORIO+'<br>'+'Terapia:'+response[i].especialidades_DESCRIPCION+'<br>Hora de Ingreso'+response[i].HSTURNO+' Hora de Salida:'+horaSalida;
                                    eventos.push({
                                    id:response[i].ID,
                                    title: response[i].pacientes_NOMBAPEPAC,
                                    description:descripcionEvento,
                                    start:response[i].FECHATURNO+'T'+response[i].HSTURNO ,
                                    end: response[i].FECHATURNO+'T'+horaSalida,
                                    color:response[i].estadoturno_COLOR,
                                    allDay:false
                                    })
                                    }
                                    console.log(url);
                                    console.log(eventos);
                                    callback(eventos)
                                    }
                                    });
                                    }
                                    }); 
                                    $('#filtro').click(function(){
                                        $("#Calendar<?=$calendarName;?><?=$calendarName;?>").fullCalendar("refetchEvents");
                                    });

                                    $(".modal").on("hidden.bs.modal", function () {
                                          // put your default event here
                                          $("#Calendar<?=$calendarName;?><?=$calendarName;?>").fullCalendar("refetchEvents");
                                    });

                                    $('.fc-button-prev span').click(function(){
                                        alert('prev is clicked, do something');
                                    });

                                    $('.fc-button-next span').click(function(){
                                        alert('nextis clicked, do something');
                                    });

                                    });
                                </script>
                            <div id="Calendar<?=$calendarName;?><?=$calendarName;?>"></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
