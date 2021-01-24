<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("deta_evolucion/add");
$can_edit = ACL::is_allowed("deta_evolucion/edit");
$can_view = ACL::is_allowed("deta_evolucion/view");
$can_delete = ACL::is_allowed("deta_evolucion/delete");
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
    <th class="td-sno"><?php echo $counter; ?></th>
    <td class="td-activo"> <?php echo $data['activo']; ?></td>
    <td class="td-item_evolucion_descripcion"> <?php echo $data['item_evolucion_descripcion']; ?></td>
    <td class="td-datos"> <?php echo $data['datos']; ?></td>
    <th class="td-btn">
        <?php if($can_edit){ ?>
        <a class="btn btn-sm btn-info has-tooltip page-modal" title="Editar este registro" href="<?php print_link("deta_evolucion/edit/$rec_id"); ?>">
            <i class="fa fa-edit"></i> Editar
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
