<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("grupofamiliar/add");
$can_edit = ACL::is_allowed("grupofamiliar/edit");
$can_view = ACL::is_allowed("grupofamiliar/view");
$can_delete = ACL::is_allowed("grupofamiliar/delete");
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
                    <h4 class="record-title">Grupofamiliar</h4>
                </div>
                <div class="col-sm-3 ">
                    <?php if($can_add){ ?>
                    <a  class="btn btn btn-primary my-1" href="<?php print_link("grupofamiliar/add") ?>">
                        <i class="fa fa-plus"></i>                              
                        Agregar nuevo 
                    </a>
                    <?php } ?>
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('grupofamiliar'); ?>" method="get">
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
                                        <a class="text-decoration-none" href="<?php print_link('grupofamiliar'); ?>">
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
                                        <a class="text-decoration-none" href="<?php print_link('grupofamiliar'); ?>">
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
                        <?php $this :: display_page_errors(); ?>
                        <div  class=" animated fadeIn page-content">
                            <div id="grupofamiliar-list-records">
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
                                                <th  class="td-CODGRUPOFAM"> Codgrupofam</th>
                                                <th  class="td-PACIENTE"> Paciente</th>
                                                <th  class="td-NOMBREMADRE"> Nombremadre</th>
                                                <th  class="td-DIRECCIONMADRE"> Direccionmadre</th>
                                                <th  class="td-LOCALIDADMADRE"> Localidadmadre</th>
                                                <th  class="td-EMAILMADRE"> Emailmadre</th>
                                                <th  class="td-NOMBREPADRE"> Nombrepadre</th>
                                                <th  class="td-DIRECCIONPADRE"> Direccionpadre</th>
                                                <th  class="td-LOCALIDADPADRE"> Localidadpadre</th>
                                                <th  class="td-CPPADRE"> Cppadre</th>
                                                <th  class="td-CPMADRE"> Cpmadre</th>
                                                <th  class="td-TELFIJOMADRE"> Telfijomadre</th>
                                                <th  class="td-TELFIJOPADRE"> Telfijopadre</th>
                                                <th  class="td-TELCELMADRE"> Telcelmadre</th>
                                                <th  class="td-TELCELPADRE"> Telcelpadre</th>
                                                <th  class="td-TELLABORALPADRE"> Tellaboralpadre</th>
                                                <th  class="td-TELLABORALMADRE"> Tellaboralmadre</th>
                                                <th  class="td-PROVINCIAMADRE"> Provinciamadre</th>
                                                <th  class="td-PROVINCIAPADRE"> Provinciapadre</th>
                                                <th  class="td-EMAILPADRE"> Emailpadre</th>
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
                                            $rec_id = (!empty($data['CODGRUPOFAM']) ? urlencode($data['CODGRUPOFAM']) : null);
                                            $counter++;
                                            ?>
                                            <tr>
                                                <?php if($can_delete){ ?>
                                                <th class=" td-checkbox">
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                        <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['CODGRUPOFAM'] ?>" type="checkbox" />
                                                            <span class="custom-control-label"></span>
                                                        </label>
                                                    </th>
                                                    <?php } ?>
                                                    <th class="td-sno"><?php echo $counter; ?></th>
                                                    <td class="td-CODGRUPOFAM"><a href="<?php print_link("grupofamiliar/view/$data[CODGRUPOFAM]") ?>"><?php echo $data['CODGRUPOFAM']; ?></a></td>
                                                    <td class="td-PACIENTE"> <?php echo $data['PACIENTE']; ?></td>
                                                    <td class="td-NOMBREMADRE">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['NOMBREMADRE']; ?>" 
                                                            data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                            data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                            data-name="NOMBREMADRE" 
                                                            data-title="Escribir  Apellido y Nombre de la Madre" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['NOMBREMADRE']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-DIRECCIONMADRE">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['DIRECCIONMADRE']; ?>" 
                                                            data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                            data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                            data-name="DIRECCIONMADRE" 
                                                            data-title="Escribir  Dirección" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['DIRECCIONMADRE']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-LOCALIDADMADRE">
                                                        <span <?php if($can_edit){ ?> data-source='<?php 
                                                            $dependent_field = (!empty($data['PROVINCIAMADRE']) ? urlencode($data['PROVINCIAMADRE']) : null);
                                                            print_link('api/json/grupofamiliar_LOCALIDADMADRE_option_list/'.$dependent_field); 
                                                            ?>' 
                                                            data-value="<?php echo $data['LOCALIDADMADRE']; ?>" 
                                                            data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                            data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                            data-name="LOCALIDADMADRE" 
                                                            data-title="Seleccione un valor" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="select" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['LOCALIDADMADRE']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-EMAILMADRE"><a href="<?php print_link("mailto:$data[EMAILMADRE]") ?>"><?php echo $data['EMAILMADRE']; ?></a></td>
                                                    <td class="td-NOMBREPADRE">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['NOMBREPADRE']; ?>" 
                                                            data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                            data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                            data-name="NOMBREPADRE" 
                                                            data-title="Escribir  Apellido y Nombre del Padre" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['NOMBREPADRE']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-DIRECCIONPADRE">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['DIRECCIONPADRE']; ?>" 
                                                            data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                            data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                            data-name="DIRECCIONPADRE" 
                                                            data-title="Escribir  Direccion" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['DIRECCIONPADRE']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-LOCALIDADPADRE">
                                                        <span <?php if($can_edit){ ?> data-source='<?php 
                                                            $dependent_field = (!empty($data['PROVINCIAPADRE']) ? urlencode($data['PROVINCIAPADRE']) : null);
                                                            print_link('api/json/grupofamiliar_LOCALIDADPADRE_option_list/'.$dependent_field); 
                                                            ?>' 
                                                            data-value="<?php echo $data['LOCALIDADPADRE']; ?>" 
                                                            data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                            data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                            data-name="LOCALIDADPADRE" 
                                                            data-title="Seleccione un valor" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="select" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['LOCALIDADPADRE']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-CPPADRE">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['CPPADRE']; ?>" 
                                                            data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                            data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                            data-name="CPPADRE" 
                                                            data-title="Escribir  Cod Postal" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['CPPADRE']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-CPMADRE">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['CPMADRE']; ?>" 
                                                            data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                            data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                            data-name="CPMADRE" 
                                                            data-title="Escribir  Cod. Postal" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['CPMADRE']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-TELFIJOMADRE">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['TELFIJOMADRE']; ?>" 
                                                            data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                            data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                            data-name="TELFIJOMADRE" 
                                                            data-title="Escribir  Telefono Particular Fijo" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['TELFIJOMADRE']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-TELFIJOPADRE">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['TELFIJOPADRE']; ?>" 
                                                            data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                            data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                            data-name="TELFIJOPADRE" 
                                                            data-title="Escribir  Telefono Particular Fijo" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['TELFIJOPADRE']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-TELCELMADRE">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['TELCELMADRE']; ?>" 
                                                            data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                            data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                            data-name="TELCELMADRE" 
                                                            data-title="Escribir  Telefono Celular" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['TELCELMADRE']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-TELCELPADRE">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['TELCELPADRE']; ?>" 
                                                            data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                            data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                            data-name="TELCELPADRE" 
                                                            data-title="Escribir  Telefono Celular" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['TELCELPADRE']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-TELLABORALPADRE">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['TELLABORALPADRE']; ?>" 
                                                            data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                            data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                            data-name="TELLABORALPADRE" 
                                                            data-title="Escribir  Telefono Laboral" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['TELLABORALPADRE']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-TELLABORALMADRE">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['TELLABORALMADRE']; ?>" 
                                                            data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                            data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                            data-name="TELLABORALMADRE" 
                                                            data-title="Escribir  Telefono Laboral" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['TELLABORALMADRE']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-PROVINCIAMADRE">
                                                        <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/grupofamiliar_PROVINCIAMADRE_option_list'); ?>' 
                                                            data-value="<?php echo $data['PROVINCIAMADRE']; ?>" 
                                                            data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                            data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                            data-name="PROVINCIAMADRE" 
                                                            data-title="Seleccione un valor" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="select" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['PROVINCIAMADRE']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-PROVINCIAPADRE">
                                                        <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/grupofamiliar_PROVINCIAPADRE_option_list'); ?>' 
                                                            data-value="<?php echo $data['PROVINCIAPADRE']; ?>" 
                                                            data-pk="<?php echo $data['CODGRUPOFAM'] ?>" 
                                                            data-url="<?php print_link("grupofamiliar/editfield/" . urlencode($data['CODGRUPOFAM'])); ?>" 
                                                            data-name="PROVINCIAPADRE" 
                                                            data-title="Seleccione un valor" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="select" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['PROVINCIAPADRE']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-EMAILPADRE"><a href="<?php print_link("mailto:$data[EMAILPADRE]") ?>"><?php echo $data['EMAILPADRE']; ?></a></td>
                                                    <th class="td-btn">
                                                        <?php if($can_view){ ?>
                                                        <a class="btn btn-sm btn-success has-tooltip" title="Ver registro" href="<?php print_link("grupofamiliar/view/$rec_id"); ?>">
                                                            <i class="fa fa-eye"></i> Ver
                                                        </a>
                                                        <?php } ?>
                                                        <?php if($can_edit){ ?>
                                                        <a class="btn btn-sm btn-info has-tooltip" title="Editar este registro" href="<?php print_link("grupofamiliar/edit/$rec_id"); ?>">
                                                            <i class="fa fa-edit"></i> Editar
                                                        </a>
                                                        <?php } ?>
                                                        <?php if($can_delete){ ?>
                                                        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Eliminar este registro" href="<?php print_link("grupofamiliar/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="¿Seguro que quieres borrar este registro?" data-display-style="modal">
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
                                                    <?php if($can_delete){ ?>
                                                    <button data-prompt-msg="¿Está seguro de que desea eliminar estos registros?" data-display-style="modal" data-url="<?php print_link("grupofamiliar/delete/{sel_ids}/?csrf_token=$csrf_token&redirect=$current_page"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                                                        <i class="fa fa-times"></i> Eliminar seleccionado
                                                    </button>
                                                    <?php } ?>
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
