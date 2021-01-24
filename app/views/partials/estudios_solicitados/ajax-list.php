<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("estudios_solicitados/add");
$can_edit = ACL::is_allowed("estudios_solicitados/edit");
$can_view = ACL::is_allowed("estudios_solicitados/view");
$can_delete = ACL::is_allowed("estudios_solicitados/delete");
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
        <td class="td-fecha">
            <span <?php if($can_edit){ ?> data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                data-value="<?php echo $data['fecha']; ?>" 
                data-pk="<?php echo $data['id'] ?>" 
                data-url="<?php print_link("estudios_solicitados/editfield/" . urlencode($data['id'])); ?>" 
                data-name="fecha" 
                data-title="Escribir  Fecha" 
                data-placement="left" 
                data-toggle="click" 
                data-type="flatdatetimepicker" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['fecha']; ?> 
            </span>
        </td>
        <td class="td-tipo_estudio_descripcion">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['tipo_estudio_descripcion']; ?>" 
                data-pk="<?php echo $data['id'] ?>" 
                data-url="<?php print_link("tipo_estudio/editfield/" . urlencode($data['id'])); ?>" 
                data-name="descripcion" 
                data-title="Escribir  Descripcion" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['tipo_estudio_descripcion']; ?> 
            </span>
        </td>
    <td class="td-archivo"> <a href="<?php echo $data['archivo']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-file"></i>Descargar Archivo</a></span></td>
    <th class="td-btn">
        <?php if($can_edit){ ?>
        <a class="btn btn-sm btn-info has-tooltip page-modal" title="Editar este registro" href="<?php print_link("estudios_solicitados/edit/$rec_id"); ?>">
            <i class="fa fa-edit"></i> Edit
        </a>
        <?php } ?>
        <?php if($can_delete){ ?>
        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Eliminar este registro" href="<?php print_link("estudios_solicitados/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="¿Esta seguro que quiere eliminar este registro ?" data-display-style="modal">
            <i class="fa fa-times"></i>
            Delete
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
