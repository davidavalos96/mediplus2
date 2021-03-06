<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("cobertura/add");
$can_edit = ACL::is_allowed("cobertura/edit");
$can_view = ACL::is_allowed("cobertura/view");
$can_delete = ACL::is_allowed("cobertura/delete");
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
$rec_id = (!empty($data['CODCOBERTURA']) ? urlencode($data['CODCOBERTURA']) : null);
$counter++;
?>
<tr>
    <?php if($can_delete){ ?>
    <th class=" td-checkbox">
        <label class="custom-control custom-checkbox custom-control-inline">
            <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['CODCOBERTURA'] ?>" type="checkbox" />
                <span class="custom-control-label"></span>
            </label>
        </th>
        <?php } ?>
        <th class="td-sno"><?php echo $counter; ?></th>
        <td class="td-TIPODOCUMENTO"> <?php echo $data['TIPODOCUMENTO']; ?></td>
        <td class="td-NRODOCUMENTO"> <?php echo $data['NRODOCUMENTO']; ?></td>
        <td class="td-NOMBCOBERTURA"> <?php echo $data['NOMBCOBERTURA']; ?></td>
        <td class="td-DOMICILIO"> <?php echo $data['DOMICILIO']; ?></td>
        <td class="td-TELEFONO"> <?php echo $data['TELEFONO']; ?></td>
        <th class="td-btn">
            <?php if($can_view){ ?>
            <a class="btn btn-sm btn-success has-tooltip" title="Ver registro" href="<?php print_link("cobertura/view/$rec_id"); ?>">
                <i class="fa fa-eye"></i> Editar
            </a>
            <?php } ?>
            <?php if($can_delete){ ?>
            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Eliminar este registro" href="<?php print_link("cobertura/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="¿Seguro que quieres borrar este registro?" data-display-style="modal">
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
    