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
    <?php if($can_delete){ ?>
    <th class=" td-checkbox">
        <label class="custom-control custom-checkbox custom-control-inline">
            <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['ID'] ?>" type="checkbox" />
                <span class="custom-control-label"></span>
            </label>
        </th>
        <?php } ?>
        <th class="td-sno"><?php echo $counter; ?></th>
        <td class="td-ID"><a href="<?php print_link("turnos/view/$data[ID]") ?>"><?php echo $data['ID']; ?></a></td>
        <td class="td-FECHATURNO">
            <span <?php if($can_edit){ ?> data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                data-value="<?php echo $data['FECHATURNO']; ?>" 
                data-pk="<?php echo $data['ID'] ?>" 
                data-url="<?php print_link("turnos/editfield/" . urlencode($data['ID'])); ?>" 
                data-name="FECHATURNO" 
                data-title="Escribir  Fecha" 
                data-placement="left" 
                data-toggle="click" 
                data-type="flatdatetimepicker" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['FECHATURNO']; ?> 
            </span>
        </td>
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
        <td class="td-HSSALIDA"> <?php echo $data['HSSALIDA']; ?></td>
        <td class="td-CONSULTORIO"> <?php echo $data['CONSULTORIO']; ?></td>
        <td class="td-CANTSESIONES">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['CANTSESIONES']; ?>" 
                data-pk="<?php echo $data['ID'] ?>" 
                data-url="<?php print_link("turnos/editfield/" . urlencode($data['ID'])); ?>" 
                data-name="CANTSESIONES" 
                data-title="Escribir  Cantsesiones" 
                data-placement="left" 
                data-toggle="click" 
                data-type="number" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['CANTSESIONES']; ?> 
            </span>
        </td>
        <td class="td-pacientes_idPaciente"> <?php echo $data['pacientes_idPaciente']; ?></td>
        <td class="td-pacientes_NOMBAPEPAC">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['pacientes_NOMBAPEPAC']; ?>" 
                data-pk="<?php echo $data['ID'] ?>" 
                data-url="<?php print_link("pacientes/editfield/" . urlencode($data['idPaciente'])); ?>" 
                data-name="NOMBAPEPAC" 
                data-title="Escribir  Apellido y Nombre" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['pacientes_NOMBAPEPAC']; ?> 
            </span>
        </td>
        <td class="td-profesionales_NOMBAPEPRO">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['profesionales_NOMBAPEPRO']; ?>" 
                data-pk="<?php echo $data['ID'] ?>" 
                data-url="<?php print_link("profesionales/editfield/" . urlencode($data['ID'])); ?>" 
                data-name="NOMBAPEPRO" 
                data-title="Escribir  Apellido y Nombre" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['profesionales_NOMBAPEPRO']; ?> 
            </span>
        </td>
        <td class="td-especialidades_DESCRIPCION">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['especialidades_DESCRIPCION']; ?>" 
                data-pk="<?php echo $data['ID'] ?>" 
                data-url="<?php print_link("especialidades/editfield/" . urlencode($data['CODIGO'])); ?>" 
                data-name="DESCRIPCION" 
                data-title="Escribir  Descripcion" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['especialidades_DESCRIPCION']; ?> 
            </span>
        </td>
        <td class="td-especialidades_ABREVIACION">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['especialidades_ABREVIACION']; ?>" 
                data-pk="<?php echo $data['ID'] ?>" 
                data-url="<?php print_link("especialidades/editfield/" . urlencode($data['CODIGO'])); ?>" 
                data-name="ABREVIACION" 
                data-title="Escribir  Abreviacion" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['especialidades_ABREVIACION']; ?> 
            </span>
        </td>
        <td class="td-estadoturno_descripcion">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['estadoturno_descripcion']; ?>" 
                data-pk="<?php echo $data['ID'] ?>" 
                data-url="<?php print_link("estadoturno/editfield/" . urlencode($data['idEstadoTurno'])); ?>" 
                data-name="descripcion" 
                data-title="Escribir  Descripcion" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['estadoturno_descripcion']; ?> 
            </span>
        </td>
        <td class="td-estadoturno_cantSesiones">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['estadoturno_cantSesiones']; ?>" 
                data-pk="<?php echo $data['ID'] ?>" 
                data-url="<?php print_link("estadoturno/editfield/" . urlencode($data['idEstadoTurno'])); ?>" 
                data-name="cantSesiones" 
                data-title="Escribir  Cantsesiones" 
                data-placement="left" 
                data-toggle="click" 
                data-type="number" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['estadoturno_cantSesiones']; ?> 
            </span>
        </td>
        <td class="td-estadoturno_COLOR">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['estadoturno_COLOR']; ?>" 
                data-pk="<?php echo $data['ID'] ?>" 
                data-url="<?php print_link("estadoturno/editfield/" . urlencode($data['idEstadoTurno'])); ?>" 
                data-name="COLOR" 
                data-title="Escribir  Color" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['estadoturno_COLOR']; ?> 
            </span>
        </td>
        <th class="td-btn">
            <?php if($can_view){ ?>
            <a class="btn btn-sm btn-success has-tooltip page-modal" title="Ver registro" href="<?php print_link("turnos/view/$rec_id"); ?>">
                <i class="fa fa-eye"></i> Ver
            </a>
            <?php } ?>
            <?php if($can_edit){ ?>
            <a class="btn btn-sm btn-info has-tooltip page-modal" title="Editar este registro" href="<?php print_link("turnos/edit/$rec_id"); ?>">
                <i class="fa fa-edit"></i> Editar
            </a>
            <?php } ?>
            <?php if($can_delete){ ?>
            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Eliminar este registro" href="<?php print_link("turnos/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="¿Seguro que quieres borrar este registro?" data-display-style="modal">
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
    