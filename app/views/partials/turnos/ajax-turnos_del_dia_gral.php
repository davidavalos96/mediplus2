<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("turnos/add");
$can_edit = ACL::is_allowed("turnos/edit");
$can_view = ACL::is_allowed("turnos/view");
$can_delete = ACL::is_allowed("turnos/delete");
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
$rec_id = (!empty($data['ID']) ? urlencode($data['ID']) : null);
$counter++;
?>
<tr>
    <th class="td-sno"><?php echo $counter; ?></th>
    <td class="td-HSTURNO">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['HSTURNO']; ?>" 
            data-pk="<?php echo $data['ID'] ?>" 
            data-url="<?php print_link("turnos/editfield/" . urlencode($data['ID'])); ?>" 
            data-name="HSTURNO" 
            data-title="Escribir  Hora" 
            data-placement="left" 
            data-toggle="click" 
            data-type="time" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" <?php } ?>>
            <?php echo $data['HSTURNO']; ?> 
        </span>
    </td>
    <td class="td-v_paciente_NOMBAPEPAC"> <?php echo $data['v_paciente_NOMBAPEPAC']; ?></td>
    <td class="td-v_profesionales_NOMBAPEPRO"> <?php echo $data['v_profesionales_NOMBAPEPRO']; ?></td>
    <td class="td-CANTSESIONES"> <?php echo $data['CANTSESIONES']; ?></td>
    <td class="td-ESTADOTURNO">
        <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/turnos_ESTADOTURNO_option_list'); ?>' 
            data-value="<?php echo $data['ESTADOTURNO']; ?>" 
            data-pk="<?php echo $data['ID'] ?>" 
            data-url="<?php print_link("turnos/editfield/" . urlencode($data['ID'])); ?>" 
            data-name="ESTADOTURNO" 
            data-title="Seleccione un valor" 
            data-placement="left" 
            data-toggle="click" 
            data-type="select" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" <?php } ?>>
            <?php echo $data['estadoturno_descripcion']; ?> 
        </span>
    </td>
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
            <?php echo $data['consultorio_DESCRIPCION']; ?> 
        </span>
    </td>
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
