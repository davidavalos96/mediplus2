<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("tipo_indicacion/add");
$can_edit = ACL::is_allowed("tipo_indicacion/edit");
$can_view = ACL::is_allowed("tipo_indicacion/view");
$can_delete = ACL::is_allowed("tipo_indicacion/delete");
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
        <td class="td-id"><a href="<?php print_link("tipo_indicacion/view/$data[id]") ?>"><?php echo $data['id']; ?></a></td>
        <td class="td-descripcion">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['descripcion']; ?>" 
                data-pk="<?php echo $data['id'] ?>" 
                data-url="<?php print_link("tipo_indicacion/editfield/" . urlencode($data['id'])); ?>" 
                data-name="descripcion" 
                data-title="Escribir  Descripcion" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['descripcion']; ?> 
            </span>
        </td>
        <th class="td-btn">
            <?php if($can_edit){ ?>
            <a class="btn btn-sm btn-info has-tooltip page-modal" title="Editar este registro" href="<?php print_link("tipo_indicacion/edit/$rec_id"); ?>">
                <i class="fa fa-edit"></i> Editar
            </a>
            <?php } ?>
            <?php if($can_delete){ ?>
            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Eliminar este registro" href="<?php print_link("tipo_indicacion/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="¿Esta seguro que quiere eliminar este registro ?" data-display-style="modal">
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
    