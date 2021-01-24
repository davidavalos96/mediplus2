<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("evoluciones/add");
$can_edit = ACL::is_allowed("evoluciones/edit");
$can_view = ACL::is_allowed("evoluciones/view");
$can_delete = ACL::is_allowed("evoluciones/delete");
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
                        $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <!-- Datos del Paciente -->
                            <h3 style="text-align:center;"><?php echo $data['tipo_evolucion_descripcion'];?></h3>
                            <br>
                                <table style="border:hidden;">
                                    <tbody>
                                        <tr style="">
                                            <td style="width:45%;border:hidden;"><span><small>Paciente:</small><?php echo $data['pacientes_NOMBAPEPAC'];?></span></td>
                                            <td style="width:40%;border:hidden;"><span><small>Fecha de Nacimiento:</small><?php echo 
                                            date('d-m-Y',strtotime($data['pacientes_FECHANACPAC']));?></span></td>
                                            <td style="width:15%;border:hidden;"><span><small>Edad:<?php echo calculaEdad($data['pacientes_FECHANACPAC'])." AÑOS";?>
                                            </small></span></td>               
                                        </tr>
                                    </tbody>
                                </table>
                                <hr>
                                    <br>
                                        <!-- Datos de la Evolución -->
                                        <small>EVOLUCION</small>    <br>
                                            <span><?php echo $data['evolucion'];?></span>
                                            <!-- Datos de la Evolución -->
                                            <br>    <br>
                                                <small>DATOS GENERALES</small>
                                                <br>
                                                    <table style="border:hidden;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="border:hidden;"><small>Fecha: </small><span><?php echo date('d-m-Y',strtotime($data['fecha']))?></span></td>
                                                                <td style="border:hidden;"><small>Terapeuta: </small><span><?php echo $data['v_profesionales_tratamiento_NOMBAPEPRO']?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border:hidden;"><small>Via de Comunicacion: </small><span><?php echo $data['via_comunicacion_descripcion']?></span></td>
                                                                <td style="border:hidden;"><small>Otro, Especificar: </small><span><?php echo $data['otra_via']?></span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <hr>
                                                        <br><small>CONSULTA</small>    <br> <br>
                                                            <div class="checkboxes">
                                                                <?php
                                                                $control = new sharedController; 
                                                                $db = $control->GetModel(); 
                                                                $sqltext = "SELECT *  FROM v_items_consulta WHERE evolucion=".strval($data['id']);
                                                                $queryparams = null;
                                                                $val = $db->rawQuery($sqltext);
                                                                foreach($val as $registro){
                                                                if($registro['seleccionar']=="SI"){
                                                                $cadena= "<label><input type='checkbox' class='chkbox' id='".$registro['descripcion']."'";
                                                                    if($registro['activo']=="SI"){
                                                                    $cadena.="checked>";
                                                                    }
                                                                    else{
                                                                    $cadena.=">";
                                                                    }
                                                                    echo $cadena;
                                                                    }
                                                                    echo $registro['descripcion']." ".$registro['datos']."</label><br>";
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <table style="border:hidden;">
                                                                    <tr>
                                                                        <td style="text-align:right;border:hidden;"><img src="<?php echo $data['v_firma_foto'];?>" width="160"height="140"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="text-align:right;border:hidden;"><small>Firma del Profesional</small></td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                                <div class="p-3 d-flex">
                                                                    <?php if($can_edit){ ?>
                                                                    <a class=" td-btn btn btn-sm btn-info"  href="<?php print_link("evoluciones/edit/$rec_id"); ?>">
                                                                        <i class="fa fa-edit"></i> Edit
                                                                    </a>
                                                                    <?php } ?>
                                                                    <?php if($can_delete){ ?>
                                                                    <a class=" td-btn btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("evoluciones/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="¿Esta seguro que quiere eliminar este registro ?" data-display-style="modal">
                                                                        <i class="fa fa-times"></i> Delete
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
                                        </div>
                                    </section>
