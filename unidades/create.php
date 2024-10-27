<!-- modal_crear_unidad.php -->
<div class="modal fade" id="crearUnidadModal" tabindex="-1" role="dialog" aria-labelledby="modalCrearUnidadLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCrearUnidadLabel">Crear Nueva Unidad de Medida</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCrearUnidad" action="../app/controllers/unidades/crear_unidad.php" method="POST" >
                <input type="hidden" name="redirect_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">    
                <div class="form-group">
                        <label for="nombre_unidad">Nombre de la unidad:</label>
                        <input type="text" class="form-control" name="nombre_unidad" required>
                    </div>
                    <div class="form-group">
                        <label for="simbolo_unidad">Símbolo de la unidad:</label>
                        <input type="text" class="form-control" name="simbolo_unidad" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar unidad</button>
                </form>
            </div>
        </div>
    </div>
</div>