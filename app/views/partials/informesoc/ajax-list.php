<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("informesoc/add");
$can_edit = ACL::is_allowed("informesoc/edit");
$can_view = ACL::is_allowed("informesoc/view");
$can_delete = ACL::is_allowed("informesoc/delete");
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
        <td class="td-periodo"> <?php echo $data['periodo']; ?></td>
        <td class="td-tipo_informesoc_tipo_informe"> <?php echo $data['tipo_informesoc_tipo_informe']; ?></td>
        <td class="td-archivo"> <a href="<?php echo $data['archivo']; ?>" class="btn-sm btn btn-primary"><i class="fa fa-file"></i>Descargar Archivo</a></td>
        <th class="td-btn">
            <?php if($can_edit){ ?>
            <a class="btn btn-sm btn-info has-tooltip" title="Editar este registro" href="<?php print_link("informesoc/edit/$rec_id"); ?>">
                <i class="fa fa-edit"></i> Editar
            </a>
            <?php } ?>
            <?php if($can_delete){ ?>
            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Eliminar este registro" href="<?php print_link("informesoc/delete/$rec_id/?csrf_token=$csrf_token"); ?>" data-prompt-msg="¿Esta seguro que quiere eliminar este registro ?" data-display-style="modal">
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
    