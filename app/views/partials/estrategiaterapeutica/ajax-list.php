<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("estrategiaterapeutica/add");
$can_edit = ACL::is_allowed("estrategiaterapeutica/edit");
$can_view = ACL::is_allowed("estrategiaterapeutica/view");
$can_delete = ACL::is_allowed("estrategiaterapeutica/delete");
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
        <td class="td-descripcion">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['descripcion']; ?>" 
                data-pk="<?php echo $data['id'] ?>" 
                data-url="<?php print_link("estrategiaterapeutica/editfield/" . urlencode($data['id'])); ?>" 
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
        <td class="td-modalidad">
            <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu :: $modalidad); ?>' 
                data-value="<?php echo $data['modalidad']; ?>" 
                data-pk="<?php echo $data['id'] ?>" 
                data-url="<?php print_link("estrategiaterapeutica/editfield/" . urlencode($data['id'])); ?>" 
                data-name="modalidad" 
                data-title="Seleccione un valor" 
                data-placement="left" 
                data-toggle="click" 
                data-type="select" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['modalidad']; ?> 
            </span>
        </td>
        <td class="td-cantSemanas">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['cantSemanas']; ?>" 
                data-pk="<?php echo $data['id'] ?>" 
                data-url="<?php print_link("estrategiaterapeutica/editfield/" . urlencode($data['id'])); ?>" 
                data-name="cantSemanas" 
                data-title="Escribir  Cantsemanas" 
                data-placement="left" 
                data-toggle="click" 
                data-type="number" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['cantSemanas']; ?> 
            </span>
        </td>
        <td class="td-costo"> <?php echo $data['costo']; ?></td>
        <th class="td-btn">
            <?php if($can_view){ ?>
            <a class="btn btn-sm btn-success has-tooltip page-modal" title="Ver registro" href="<?php print_link("estrategiaterapeutica/view/$rec_id"); ?>">
                <i class="fa fa-eye"></i> Ver
            </a>
            <?php } ?>
            <?php if($can_edit){ ?>
            <a class="btn btn-sm btn-info has-tooltip" title="Editar este registro" href="<?php print_link("estrategiaterapeutica/edit/$rec_id"); ?>">
                <i class="fa fa-edit"></i> Editar
            </a>
            <?php } ?>
            <?php if($can_delete){ ?>
            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Eliminar este registro" href="<?php print_link("estrategiaterapeutica/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="¿Seguro que quieres borrar este registro?" data-display-style="modal">
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
    