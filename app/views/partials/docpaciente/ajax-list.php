<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("docpaciente/add");
$can_edit = ACL::is_allowed("docpaciente/edit");
$can_view = ACL::is_allowed("docpaciente/view");
$can_delete = ACL::is_allowed("docpaciente/delete");
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
$rec_id = (!empty($data['CODDOCUMENTO']) ? urlencode($data['CODDOCUMENTO']) : null);
$counter++;
?>
<tr>
    <th class=" td-checkbox">
        <label class="custom-control custom-checkbox custom-control-inline">
            <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['CODDOCUMENTO'] ?>" type="checkbox" />
                <span class="custom-control-label"></span>
            </label>
        </th>
        <th class="td-sno"><?php echo $counter; ?></th>
        <td class="td-TIPODOCUMENTO">
            <span  data-source='<?php print_link('api/json/docpaciente_TIPODOCUMENTO_option_list'); ?>' 
                data-value="<?php echo $data['TIPODOCUMENTO']; ?>" 
                data-pk="<?php echo $data['CODDOCUMENTO'] ?>" 
                data-url="<?php print_link("docpaciente/editfield/" . urlencode($data['CODDOCUMENTO'])); ?>" 
                data-name="TIPODOCUMENTO" 
                data-title="Seleccione un valor" 
                data-placement="left" 
                data-toggle="click" 
                data-type="select" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" >
                <?php echo $data['tipo_doc_paciente_descripcion']; ?> 
            </span>
        </td>
        <td class="td-ARCHIVO">
            <a  class="btn btn-sm btn-info" href="<?php echo $data['ARCHIVO']; ?>"><i class="fa fa-file"></i> &nbsp;Descargar Archivo </a> 
        </span>
    </td>
    <th class="td-btn">
        <a class="btn btn-sm btn-info has-tooltip page-modal" title="Editar este registro" href="<?php print_link("docpaciente/edit/$rec_id"); ?>">
            <i class="fa fa-edit"></i> Editar
        </a>
        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Eliminar este registro" href="<?php print_link("docpaciente/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="¿Seguro que quieres borrar este registro?" data-display-style="modal">
            <i class="fa fa-times"></i>
            Borrar
        </a>
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
