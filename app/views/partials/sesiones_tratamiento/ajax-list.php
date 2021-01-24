<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("sesiones_tratamiento/add");
$can_edit = ACL::is_allowed("sesiones_tratamiento/edit");
$can_view = ACL::is_allowed("sesiones_tratamiento/view");
$can_delete = ACL::is_allowed("sesiones_tratamiento/delete");
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
$rec_id = (!empty($data['codSesion']) ? urlencode($data['codSesion']) : null);
$counter++;
?>
<tr>
    <?php if($can_delete){ ?>
    <th class=" td-checkbox">
        <label class="custom-control custom-checkbox custom-control-inline">
            <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['codSesion'] ?>" type="checkbox" />
                <span class="custom-control-label"></span>
            </label>
        </th>
        <?php } ?>
        <th class="td-sno"><?php echo $counter; ?></th>
        <td class="td-dias_nombre"> <?php echo $data['dias_nombre']; ?></td>
        <td class="td-desde">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['desde']; ?>" 
                data-pk="<?php echo $data['codSesion'] ?>" 
                data-url="<?php print_link("sesiones_tratamiento/editfield/" . urlencode($data['codSesion'])); ?>" 
                data-name="desde" 
                data-title="Escribir  Desde" 
                data-placement="left" 
                data-toggle="click" 
                data-type="time" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['desde']; ?> 
            </span>
        </td>
        <td class="td-hasta">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['hasta']; ?>" 
                data-pk="<?php echo $data['codSesion'] ?>" 
                data-url="<?php print_link("sesiones_tratamiento/editfield/" . urlencode($data['codSesion'])); ?>" 
                data-name="hasta" 
                data-title="Escribir  Hasta" 
                data-placement="left" 
                data-toggle="click" 
                data-type="time" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['hasta']; ?> 
            </span>
        </td>
        <td class="td-cantSesiones">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['cantSesiones']; ?>" 
                data-pk="<?php echo $data['codSesion'] ?>" 
                data-url="<?php print_link("sesiones_tratamiento/editfield/" . urlencode($data['codSesion'])); ?>" 
                data-name="cantSesiones" 
                data-title="Escribir  Cantsesiones" 
                data-placement="left" 
                data-toggle="click" 
                data-type="number" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['cantSesiones']; ?> 
            </span>
        </td>
        <td class="td-consultorio">
            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/sesiones_tratamiento_consultorio_option_list'); ?>' 
                data-value="<?php echo $data['consultorio']; ?>" 
                data-pk="<?php echo $data['codSesion'] ?>" 
                data-url="<?php print_link("sesiones_tratamiento/editfield/" . urlencode($data['codSesion'])); ?>" 
                data-name="consultorio" 
                data-title="Seleccione un valor" 
                data-placement="left" 
                data-toggle="click" 
                data-type="select" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['consultorio']; ?> 
            </span>
        </td>
        <th class="td-btn">
            <?php if($can_view){ ?>
            <a class="btn btn-sm btn-success has-tooltip page-modal" title="Ver registro" href="<?php print_link("sesiones_tratamiento/view/$rec_id"); ?>">
                <i class="fa fa-eye"></i> Ver
            </a>
            <?php } ?>
            <?php if($can_edit){ ?>
            <a class="btn btn-sm btn-info has-tooltip page-modal" title="Editar este registro" href="<?php print_link("sesiones_tratamiento/edit/$rec_id"); ?>">
                <i class="fa fa-edit"></i> Editar
            </a>
            <?php } ?>
            <?php if($can_delete){ ?>
            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Eliminar este registro" href="<?php print_link("sesiones_tratamiento/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="¿Seguro que quieres borrar este registro?" data-display-style="modal">
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
    