@extends('layouts.app')

@section('content')

<!--  BEGIN CONTENT AREA  -->

<div class="layout-px-spacing">

    <div class="page-header">
        <div class="page-title">
            <h3>Clientes</h3>
        </div>
    </div>

    <div class="row layout-top-spacing" id="cancel-row">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="table-responsive mb-4">
                    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nombres</th>
                                <th>Email</th>
                                <th>Tipo Doc.</th>
                                <th>Doumento</th>
                                <th>Celular</th>
                                <th>Dirección</th>
                                <th>Cumpleaños</th>
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


<div class="modal fade" id="modal-clients" class="modal-dom" tabindex="-1" role="dialog"
    aria-labelledby="modal-clients-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-clients-title">Modal usuario</h5>
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

                            <div class="form-group">
                                <input type="text" name="name" placeholder="Nombre completo" class="form-control" required>
                            </div>

                            <div class="mb-4">
                                <select class="form-control" name="document_type" required>
                                    <option selected disabled>Documento de usuario</option>
                                    <option value="dni">DNI</option>
                                    <option value="pasaporte">Pasaporte</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="number" name="document" placeholder="Número de documento" class="form-control" required>
                            </div>

                        </section>

                        <h3>Adicionales</h3>
                        <section>

                            <label for="t-text">Cumpleaños</label>
                            <div class="form-group">
                                <input type="date" name="birthday" class="form-control">
                            </div>

                            <div class="form-group">
                                <input type="text" name="phone" placeholder="Teléfono de usuario" class="form-control">
                            </div>

                            <div class="form-group">
                                <input type="text" name="address" placeholder="Dirección de usuario" class="form-control">
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" placeholder="email@mail.com" class="form-control">
                            </div>

                        </section>

                        <h3>Imagen</h3>
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
