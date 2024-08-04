
<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset("js/libs/jquery-3.1.1.min.js") }}"></script>
<script src="{{ asset("bootstrap/js/popper.min.js") }}"></script>
<script src="{{ asset("bootstrap/js/bootstrap.min.js") }}"></script>

<!-- END GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset("js/authentication/form-1.js") }}"></script>
<script src="{{ asset("plugins/perfect-scrollbar/perfect-scrollbar.min.js") }}"></script>

<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset("js/app-theme.js") }}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>

<!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
<script src="{{ asset("plugins/apex/apexcharts.min.js") }}"></script>
<script src="{{ asset("plugins/table/datatable/datatables.js") }}"></script>
<script src="{{ asset("plugins/table/datatable/dataTables.responsive.min.js") }}"></script>
<script src="{{ asset("plugins/table/datatable/button-ext/dataTables.buttons.min.js") }}"></script>
<script src="{{ asset("plugins/table/datatable/button-ext/jszip.min.js") }}"></script>
<script src="{{ asset("plugins/table/datatable/button-ext/buttons.html5.min.js") }}"></script>
<script src="{{ asset("plugins/table/datatable/button-ext/buttons.print.min.js") }}"></script>

<script src="{{ asset("plugins/highlight/highlight.pack.js") }}"></script>
<script src="{{ asset("js/scrollspyNav.js") }}"></script>
<script src="{{ asset("plugins/jquery-step/jquery.steps.min.js") }}"></script>
<script src="{{ asset("plugins/select2/select2.min.js") }}"></script>
<script src="{{ asset("plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js") }}"></script>
{{-- <script src="{{ asset("plugins/bootstrap-touchspin/custom-bootstrap-touchspin.js") }}"></script> --}}

<script src="{{ asset("js/custom.js") }}"></script>
<script src="{{ asset("plugins/file-upload/file-upload-with-preview.min.js") }}"></script>



<!-- END PAGE LEVEL SCRIPTS -->
@if(request()->routeIs('welcome'))
    <script src="{{ asset("js/dashboard/dash_1.js") }}"></script>
@elseif(request()->routeIs('productos'))
    <script src="{{ asset("views/productos.js") }}"></script>

@elseif (request()->routeIs('tiendas'))
    <script src="{{ asset("views/tiendas.js") }}"></script>

@elseif (request()->routeIs('requerimientos'))
    <script src="{{ asset("views/requerimientos.js") }}"></script>
@elseif (request()->routeIs('descuentos'))
    <script src="{{ asset("views/descuento.js") }}"></script>
@elseif (request()->routeIs('documentos'))
    <script src="{{ asset("views/documentos.js") }}"></script>
@elseif (request()->routeIs('codigos'))
    <script src="{{ asset("views/codigos.js") }}"></script>

@elseif (request()->routeIs('usuarios'))
    <script src="{{ asset("views/usuarios.js") }}"></script>

@elseif (request()->routeIs('proveedores'))
    <script src="{{ asset("views/proveedores.js") }}"></script>

@elseif (request()->routeIs('clientes'))
    <script src="{{ asset("views/clientes.js") }}"></script>

@elseif (request()->routeIs('caja'))
    <script src="{{ asset("views/caja/funciones.js") }}"></script>
    <script src="{{ asset("views/caja/objeto.js") }}"></script>
    <script src="{{ asset("views/caja/listeners.js") }}"></script>
    <script src="{{ asset("views/caja.js") }}"></script>
    <script src="{{ asset("js/apps/invoice.js") }}"></script>

@elseif (request()->routeIs('reportes'))
    <script src="{{ asset("views/reportes.js") }}"></script>

@elseif (request()->routeIs('configuraciones'))
    <script src="{{ asset("views/configuraciones.js") }}"></script>
@endif

<script src="{{ mix('js/app.js') }}" defer></script>

<script>
    $(document).ready(function() {
        App.init();
    });
</script>
