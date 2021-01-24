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
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Agenda del Paciente</h4>
                </div>
                <div class="col-sm-3 ">
                </div>
                <div class="col-sm-4 ">
                </div>
                <div class="col-md-12 comp-grid">
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
                        <?php $this :: display_page_errors(); ?>
                        <div class="filter-tags mb-2">
                            <?php
                            if(!empty(get_value('turnos_IDPACIENTE'))){
                            ?>
                            <div class="filter-chip card bg-light">
                                <b>Turnos Idpaciente :</b> 
                                <?php 
                                if(get_value('turnos_IDPACIENTElabel')){
                                echo get_value('turnos_IDPACIENTElabel');
                                }
                                else{
                                echo get_value('turnos_IDPACIENTE');
                                }
                                $remove_link = unset_get_value('turnos_IDPACIENTE', $this->route->page_url);
                                ?>
                                <a href="<?php print_link($remove_link); ?>" class="close-btn">
                                    &times;
                                </a>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div  class=" animated fadeIn page-content " style="display:none;">
                            <div id="turnos-agendapaciente-records">
                                <div id="page-report-body" class="table-responsive">
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
                                                <th  class="td-IDCONSULTORIO"> Idconsultorio</th>
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
                                            $rec_id = (!empty($data['ID']) ? urlencode($data['ID']) : null);
                                            $counter++;
                                            ?>
                                            <tr>
                                                <?php if($can_delete){ ?>
                                                <th class=" td-checkbox">
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                        <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['ID'] ?>" type="checkbox" />
                                                            <span class="custom-control-label"></span>
                                                        </label>
                                                    </th>
                                                    <?php } ?>
                                                    <th class="td-sno"><?php echo $counter; ?></th>
                                                    <td class="td-IDCONSULTORIO">
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
                                                    <th class="td-btn">
                                                        <?php if($can_view){ ?>
                                                        <a class="btn btn-sm btn-success has-tooltip page-modal" title="Ver registro" href="<?php print_link("turnos/view/$rec_id"); ?>">
                                                            <i class="fa fa-eye"></i> View
                                                        </a>
                                                        <?php } ?>
                                                        <?php if($can_edit){ ?>
                                                        <a class="btn btn-sm btn-info has-tooltip page-modal" title="Editar este registro" href="<?php print_link("turnos/edit/$rec_id"); ?>">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>
                                                        <?php } ?>
                                                        <?php if($can_delete){ ?>
                                                        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Eliminar este registro" href="<?php print_link("turnos/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="¿Seguro que quieres borrar este registro?" data-display-style="modal">
                                                            <i class="fa fa-times"></i>
                                                            Delete
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
                                                    <button data-prompt-msg="¿Está seguro de que desea eliminar estos registros?" data-display-style="modal" data-url="<?php print_link("turnos/delete/{sel_ids}/?csrf_token=$csrf_token&redirect=$current_page"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                                                        <i class="fa fa-times"></i> Eliminar seleccionado
                                                    </button>
                                                    <?php } ?>
                                                    <div class="dropup export-btn-holder mx-1">
                                                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-save"></i> Export
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
                                                <div class="card mb-3">
                                                    <div class="card-header h4 h4">Paciente</div>
                                                    <div class="p-2">
                                                        <select   name="turnos_IDPACIENTE" class="form-control custom ">
                                                            <option value="12345678908765324563">Seleccione un Paciente</option>
                                                            <?php 
                                                            $turnos_IDPACIENTE_options = $comp_model -> turnos_turnosIDPACIENTE_option_list();
                                                            if(!empty($turnos_IDPACIENTE_options)){
                                                            foreach($turnos_IDPACIENTE_options as $option){
                                                            $value = (!empty($option['value']) ? $option['value'] : null);
                                                            $label = (!empty($option['label']) ? $option['label'] : $value);
                                                            $selected = $this->set_field_selected('turnos_IDPACIENTE',$value);
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
                                                    <button class="btn btn-primary" id="filtro">Mostrar Horarios</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-9 comp-grid">
                                            <div class=""><?php 
                                                $calendarName=random_str();
                                                $modal_id = "modal-" . random_str();
                                                ?>
                                                <script>
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
                                                    $('#main-page-modal').modal({show:true});
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
                                                        title: response[i].especialidades_DESCRIPCION,
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
