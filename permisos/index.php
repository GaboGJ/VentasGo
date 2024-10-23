<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');


include ('../app/controllers/permisos/listado_permisos.php');
include ('../app/controllers/modulos/listado_modulos.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Permisos
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
                            <i class="fa fa-plus"></i> Agregar Nuevo
                        </button>
                    </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Permisos registrados</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: block;">
                            <table id="example1" class="table table-bordered table-striped table-sm">
                                <thead>
                                <tr>
                                    <th><center>Nro</center></th>
                                    <th><center>Nombre del permiso</center></th>
                                    <th><center>Modulo</center></th>
                                    <th><center>Acciones</center></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $contador = 0;
                                foreach ($modulos_operaciones_datos as $permisos_dato){
                                    $id_permiso = $permisos_dato['id_operacion'];
                                    $nombre_permiso = $permisos_dato['nombre_operacion']; ?>
                                    <tr>
                                        <td><center><?php echo $contador = $contador + 1;?></center></td>
                                        <td><?php echo $nombre_permiso;?></td>
                                        <td><?php echo $permisos_dato['nombre_modulo'];?></td>
                                        <td>
                                             
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#modal-delete<?php echo $id_permiso;?>">
                                                <i class="fa fa-trash"></i> Borrar
                                            </button>
                                            <!-- modal para borrar permiso -->
                                            <div class="modal fade" id="modal-delete<?php echo $id_permiso;?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header" style="background-color: #ca0a0b;color: white">
                                                            <h4 class="modal-title">¿Está seguro de eliminar el permiso?</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Nombre del Permiso <b>*</b></label>
                                                                        <input type="text" id="nombre_permiso<?php echo $id_permiso;?>" value="<?php echo $nombre_permiso."  ".$permisos_dato['nombre_modulo'];?>" class="form-control" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                          
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                            <button type="button" class="btn btn-danger" id="btn_delete<?php echo $id_permiso;?>">Eliminar</button>
                                                        </div>
                                                        <div id="respuesta_delete<?php echo $id_permiso;?>"></div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
                                            <script>
                                                $('#btn_delete<?php echo $id_permiso;?>').click(function () {
                                                    var id_permiso = '<?php echo $id_permiso;?>';
                                                    var url2 = "../app/controllers/permisos/delete.php"; // Cambia la ruta al controlador adecuado
                                                    $.get(url2, {id_permiso: id_permiso}, function (datos) {
                                                        $('#respuesta_delete<?php echo $id_permiso;?>').html(datos);
                                                        // Opcional: cerrar el modal después de la eliminación
                                                        $('#modal-delete<?php echo $id_permiso;?>').modal('hide');
                                                    });
                                                });
                                            </script>
                                        </div>


                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include ('../layout/mensajes.php'); ?>
<?php include ('../layout/parte2.php'); ?>


<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Proveedores",
                "infoEmpty": "Mostrando 0 a 0 de 0 Proveedores",
                "infoFiltered": "(Filtrado de _MAX_ total Proveedores)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Proveedores",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true, "lengthChange": true, "autoWidth": false,
            buttons: [{
                extend: 'collection',
                text: 'Reportes',
                orientation: 'landscape',
                buttons: [{
                    text: 'Copiar',
                    extend: 'copy',
                }, {
                    extend: 'pdf'
                },{
                    extend: 'csv'
                },{
                    extend: 'excel'
                },{
                    text: 'Imprimir',
                    extend: 'print'
                }
                ]
            },
                {
                    extend: 'colvis',
                    text: 'Visor de columnas',
                    collectionLayout: 'fixed three-column'
                }
            ],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>





<!-- Modal para registrar nuevo permiso -->
<div class="modal fade" id="modal-create">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #1d36b6;color: white">
                <h4 class="modal-title">Creación de un nuevo permiso</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="modulo">Seleccionar Módulo <b>*</b></label>
                            <select id="modulo" name="modulo_id" class="form-control">
                                <!-- Lista de módulos obtenida del controlador -->
                                <option value="">Seleccionar Módulo</option>
                                <?php 
                                    
                                    foreach ($modulos_datos as $modulo) {
                                        echo '<option value="'.$modulo['id_modulo'].'">'.$modulo['nombre_modulo'].'</option>';
                                    }
                                ?>
                            </select>
                            <small style="color: red; display: none" id="lbl_modulo">* Este campo es requerido</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="operaciones">Seleccionar Operaciones <b>*</b></label><br>
                            <div class="form-check">
                                <input type="checkbox" id="ver" class="form-check-input">
                                <label class="form-check-label" for="ver">Ver</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" id="crear" class="form-check-input">
                                <label class="form-check-label" for="crear">Crear</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" id="editar" class="form-check-input">
                                <label class="form-check-label" for="editar">Editar</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" id="eliminar" class="form-check-input">
                                <label class="form-check-label" for="eliminar">Eliminar</label>
                            </div>
                            <small style="color: red; display: none" id="lbl_operaciones">* Selecciona al menos una operación</small>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn_create">Guardar permiso</button>
            </div>
            <div id="respuesta"></div>
        </div>
    </div>
</div>

<script>
    $('#btn_create').click(function () {
        var modulo = $('#modulo').val();
        var ver = $('#ver').is(':checked') ? 1 : 0; // Permiso Ver
        var crear = $('#crear').is(':checked') ? 1 : 0; // Permiso Crear
        var editar = $('#editar').is(':checked') ? 1 : 0; // Permiso Editar
        var eliminar = $('#eliminar').is(':checked') ? 1 : 0; // Permiso Eliminar

        // Validaciones
        $('#lbl_modulo').css('display', 'none'); // Esconde el mensaje de error de módulo
        $('#lbl_operaciones').css('display', 'none'); // Esconde el mensaje de error de operaciones

        if (modulo == "") {
            $('#modulo').focus();
            $('#lbl_modulo').css('display', 'block');
        } else if (!ver && !crear && !editar && !eliminar) {
            $('#lbl_operaciones').css('display', 'block');
        } else {
            // Enviar los datos al controlador para guardar el permiso
            var url = "../app/controllers/permisos/create.php";
            $.post(url, {
                modulo_id: modulo,
                ver: ver,
                crear: crear,
                editar: editar,
                eliminar: eliminar
            }, function (datos) {
                $('#respuesta').html(datos);
            });
        }
    });
</script>
