@extends('layouts.app')

@section('content')

<!--  BEGIN CONTENT AREA  -->

<div class="layout-px-spacing">

    <div class="page-header">
        <div class="page-title">
            <h3>Tiendas</h3>
        </div>
    </div>

    <div class="row layout-top-spacing" id="cancel-row">
        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="table-responsive mb-4">
                    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Logo</th>
                                <th>Tienda</th>
                                <th>Email</th>
                                <th>RUC</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>Dirección</th>
                                <th>Telf.</th>
                                <th>Dirección Sec</th>
                                <th>Telf. Sec</th>
                                <th>Descripción</th>
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


<div class="modal fade" id="modal-branches" class="modal-dom" tabindex="-1" role="dialog"
    aria-labelledby="modal-branches-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-branches-title">Modal tienda</h5>
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
                <form action="#">
                    <div class="wizard">
                        <h3>Básico</h3>
                        <section>

                            <p class="mt-1">Administrador</p>
                            <div class="mb-4">
                                <select class="form-control select2_modal" name="admin_branch" required>
                                    <option selected disabled>Selecciona un adminstrador</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="t-text" class="sr-only">Nombre de tienda</label>
                                <input type="text" name="company_name" placeholder="Nombre de tienda" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="t-text" class="sr-only">RUC de tienda</label>
                                <input type="text" name="ruc" placeholder="RUC de tienda" class="form-control" required>
                            </div>

                        </section>

                        <h3>Tienda</h3>
                        <section>

                            <div class="mb-4">
                                <select class="form-control" name="branch_type" required>
                                    <option selected disabled>Selecciona tipode tienda</option>
                                    <option value="central">Central</option>
                                    <option value="sucursal">Suirsal</option>
                                    <option value="otro">Otro</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <select class="form-control" name="status" required>
                                    <option value="activa">Activo</option>
                                    <option value="inactiva">Inactivo</option>
                                    <option value="mantenimiento">Mantenimiento</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="t-text" class="sr-only">Dirección de tienda</label>
                                <input type="text" name="main_address" placeholder="Dirección de tienda" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="t-text" class="sr-only">Teléfono de tienda</label>
                                <input type="text" name="main_phone" placeholder="Teléfono de tienda" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="t-text" class="sr-only">Email de tienda</label>
                                <input id="e-text" type="email" name="email" placeholder="email@mail.com" class="form-control" required="">
                            </div>
                        </section>

                        <h3>Adicional</h3>
                        <section>

                            <p class="mt-1">Descripción de tienda</label>
                            <div class="mb-4">
                                <textarea class="form-control" rows="3" name="notes"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="t-text" class="sr-only">Dirección secundaria</label>
                                <input type="text" name="secondary_address" placeholder="Dirección secundaria" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="t-text" class="sr-only">Teléfono secundario</label>
                                <input type="text" name="secondary_phone" placeholder="Teléfono secundario" class="form-control">
                            </div>

                        </section>

                        <h3>Logo</h3>
                        <section>
                            <div class="custom-file-container" data-upload-id="myFirstImage">

                                <label>Subir archivo <a href="javascript:void(0)" class="custom-file-container__image-clear"
                                        title="Clear Image">x</a></label>
                                <label class="custom-file-container__custom-file">
                                    <input type="file" class="custom-file-container__custom-file__custom-file-input"
                                        accept="image/*">
                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                </label>
                                <div class="custom-file-container__image-preview"></div>
                            </div>
                        </section>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--  END CONTENT AREA  -->

@endsection
