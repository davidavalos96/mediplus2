<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("pacientes/add");
$can_edit = ACL::is_allowed("pacientes/edit");
$can_view = ACL::is_allowed("pacientes/view");
$can_delete = ACL::is_allowed("pacientes/delete");
?>
<?php
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
if (!empty($records)) {
?>
<!--record-->
<?php
$counter = 0;
foreach($records as $data){
$rec_id = (!empty($data['idPaciente']) ? urlencode($data['idPaciente']) : null);
$counter++;
?>
<tr>
    <?php if($can_delete){ ?>
    <th class=" td-checkbox">
        <label class="custom-control custom-checkbox custom-control-inline">
            <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['idPaciente'] ?>" type="checkbox" />
                <span class="custom-control-label"></span>
            </label>
        </th>
        <?php } ?>
        <th class="td-sno"><?php echo $counter; ?></th>
        <td class="td-NOMBAPEPAC"> <?php echo $data['NOMBAPEPAC']; ?></td>
        <td class="td-NUMDOCPAC"> <?php echo $data['NUMDOCPAC']; ?></td>
        <td class="td-cobertura_NOMBCOBERTURA"> <?php echo $data['cobertura_NOMBCOBERTURA']; ?></td>
        <td class="td-PLANOBRASOC"> <?php echo $data['PLANOBRASOC']; ?></td>
        <td class="td-NROAFILIADO"> <?php echo $data['NROAFILIADO']; ?></td>
        <th class="td-btn">
            <?php if($can_view){ ?>
            <a class="btn btn-sm btn-success has-tooltip page-modal" title="Ver registro" href="<?php print_link("pacientes/view/$rec_id"); ?>">
                <i class="fa fa-eye"></i> Ver
            </a>
            <?php } ?>
            <?php if($can_edit){ ?>
            <a class="btn btn-sm btn-info has-tooltip" title="Editar este registro" href="<?php print_link("pacientes/edit/$rec_id"); ?>">
                <i class="fa fa-edit"></i> Editar
            </a>
            <?php } ?>
            <?php if($can_delete){ ?>
            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Eliminar este registro" href="<?php print_link("pacientes/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="¿Seguro que quieres borrar este registro?" data-display-style="modal">
                <i class="fa fa-times"></i>
                Borrar
            </a>
            <?php } ?>
        </th>
    </tr>
    <?php 
    }
    ?>
    <?php
    } else {
    ?>
    <td class="no-record-found col-12" colspan="100">
        <h4 class="text-muted text-center ">
            ningún record fue encontrado
        </h4>
    </td>
    <?php
    }
    ?>
    