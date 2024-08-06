@extends('layouts.app')

@section('content')

<!--  BEGIN CONTENT AREA  -->

<div class="layout-px-spacing">

    <div class="page-header">
        <div class="page-title">
            <h3>Descuentos</h3>
        </div>
    </div>

    <div class="row layout-top-spacing" id="cancel-row">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="table-responsive mb-4">
                    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Porcentaje</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>


<div class="modal fade" id="modal-discounts" class="modal-dom" tabindex="-1" role="dialog"
    aria-labelledby="modal-requirements-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-requirements-title">Modal Descuentos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="col-lg-12 layout-spacing">

                <div id="circle-basic" class="">
                    <form action="#">
                        <div class="wizard">
                            <h3>Básico</h3>
                            <section>
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Nombre de descuento"
                                        class="form-control" required>
                                </div>

                                <select class="form-control form-small" name="type">
                                    <option selected="selected" disabled>Tipo de descuento</option>
                                    <option value="porcentaje">Pocentaje</option>
                                    <option value="fijo">Fijo</option>
                                </select>

                                <div class="stock">
                                    <p class="mt-1">Cantidad</p>
                                    <div class="mb-4">
                                        <input class="input_cantidad" type="text" value="" name="markdown" required>
                                    </div>
                                </div>

                            </section>
                            <h3>Detalles</h3>
                            <section>

                                <select class="form-control form-small" name="status">
                                    <option selected="selected" disabled>Status del descuento</option>
                                    <option value="Activado">Activado</option>
                                    <option value="Desactivado">Desactivado</option>
                                </select>

                            </section>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<!--  END CONTENT AREA  -->

@endsection
