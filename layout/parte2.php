<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2023 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


<!-- Bootstrap 4 -->
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>


<!-- DataTables  & Plugins -->
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
    $(document).ready(function() {
        // Cargar datos para el datalist
        function loadUnits() {
            $.ajax({
                url: '../app/controllers/unidades/buscar_unidades.php', // Asegúrate de que esta URL es correcta
                method: 'GET',
                success: function(data) {
                    const unidades = JSON.parse(data);
                    $('#datalistOptions').empty(); // Limpiar el datalist
                    unidades.forEach(function(unidad) {
                        $('#datalistOptions').append(`<option value="${unidad.nombre} (${unidad.simbolo})" data-id="${unidad.id}"></option>`);
                    });
                }
            });
        }

        loadUnits(); // Cargar las unidades al inicio

        // Manejar la selección de una unidad
        $('#unidad_medida').on('input', function() {
            const value = $(this).val();
            const options = $('#datalistOptions option');
            let found = false;
            options.each(function() {
                if (this.value === value) {
                    $('#id_unidad_base').val($(this).data('id')); // Guardar el ID de la unidad seleccionada
                    found = true;
                }
            });
            if (!found) {
                $('#id_unidad_base').val(''); // Limpiar el ID si no se encuentra
            }
        });

       
    });
</script>
</body>
</html>


