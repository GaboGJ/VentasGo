<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel">Detalles del Rol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                if (isset($_GET['id'])) {
                    include ('../app/config.php');
                    
                    $id_rol = $_GET['id'];
                    
                    include ('../app/controllers/permisos/listado_permisos.php'); 
                    include ('../app/controllers/roles/obtener_permisos.php');
                    
                    if (!empty($modulos_operaciones_datos)) {
                        echo '<h6>Permisos del Rol</h6>';
                        echo '<div id="permisosRol" class="list-group">';
                        
                        foreach ($modulos_operaciones_datos as $permiso) {
                            $checked = in_array($permiso['id_operacion'], $permisos_asignados) ? 'checked' : '';

                            echo '<div class="form-check form-switch">';
                            echo '<input class="form-check-input switch-permiso" type="checkbox" id="permiso_' . htmlspecialchars($permiso['id_operacion']) . '" value="' . htmlspecialchars($permiso['id_operacion']) . '" ' . $checked . ' data-id-rol="' . htmlspecialchars($id_rol) . '">';
                            echo '<label class="form-check-label" for="permiso_' . htmlspecialchars($permiso['id_operacion']) . '">';
                            echo htmlspecialchars($permiso['nombre_operacion']) . ' (' . htmlspecialchars($permiso['nombre_modulo']) . ')';
                            echo '</label>';
                            echo '</div>';
                        }
                        echo '</div>';
                    } else {
                        echo '<p>No se encontraron permisos para este rol.</p>';
                    }
                } else {
                    echo '<p>No se proporcionó un ID válido.</p>';
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.switch-permiso').forEach(function(switchElem) {
    switchElem.addEventListener('change', function() {
        var idOperacion = this.value;
        var idRol = this.getAttribute('data-id-rol');
        var isChecked = this.checked;

        // Preparar la solicitud AJAX para actualizar el permiso
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../app/controllers/roles/actualizar_permisos.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Definir lo que sucede al recibir respuesta del servidor
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log(xhr.responseText); // Mostrar respuesta del servidor
            } else {
                console.error('Error en la actualización de permisos.');
            }
        };

        // Enviar los datos: si está chequeado, añadir, si no, eliminar
        if (isChecked) {
            xhr.send('accion=agregar&id_rol=' + idRol + '&id_operacion=' + idOperacion);
        } else {
            xhr.send('accion=eliminar&id_rol=' + idRol + '&id_operacion=' + idOperacion);
        }
    });
});
</script>
