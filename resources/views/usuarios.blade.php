@extends('layouts.app')

@section('content')

<!--  BEGIN CONTENT AREA  -->

<div class="layout-px-spacing">

    <div class="page-header">
        <div class="page-title">
            <h3>Usuarios</h3>
        </div>
    </div>

    <div class="row layout-top-spacing" id="cancel-row">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="table-responsive mb-4">
                    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Rol</th>
                                <th>Imagen</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>
                                    <div class="d-flex">
                                        <div class="usr-img-frame mr-2 rounded-circle">
                                            <img alt="avatar" class="img-fluid rounded-circle"
                                                src="assets/img/90x90.jpg">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-dark btn-sm">Acciones</button>
                                        <button type="button"
                                            class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split"
                                            id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" data-reference="parent">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-chevron-down">
                                                <polyline points="6 9 12 15 18 9"></polyline>
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                                            <a class="dropdown-item" href="#">Editar</a>
                                            <a class="dropdown-item" href="#">Eliminar</a>
                                            <a class="dropdown-item" href="#">Traspasar</a>


                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Garrett Winters</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>63</td>
                                <td>
                                    <div class="d-flex">
                                        <div class="usr-img-frame mr-2 rounded-circle">
                                            <img alt="avatar" class="img-fluid rounded-circle"
                                                src="assets/img/90x90.jpg">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-dark btn-sm">Acciones</button>
                                        <button type="button"
                                            class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split"
                                            id="dropdownMenuReference2" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" data-reference="parent">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-chevron-down">
                                                <polyline points="6 9 12 15 18 9"></polyline>
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference2">
                                            <a class="dropdown-item" href="#">Editar</a>
                                            <a class="dropdown-item" href="#">Eliminar</a>
                                            <a class="dropdown-item" href="#">Traspasar</a>


                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Ashton Cox</td>
                                <td>Junior Technical Author</td>
                                <td>San Francisco</td>
                                <td>66</td>
                                <td>
                                    <div class="d-flex">
                                        <div class="usr-img-frame mr-2 rounded-circle">
                                            <img alt="avatar" class="img-fluid rounded-circle"
                                                src="assets/img/90x90.jpg">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-dark btn-sm">Acciones</button>
                                        <button type="button"
                                            class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split"
                                            id="dropdownMenuReference3" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" data-reference="parent">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-chevron-down">
                                                <polyline points="6 9 12 15 18 9"></polyline>
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference3">
                                            <a class="dropdown-item" href="#">Editar</a>
                                            <a class="dropdown-item" href="#">Eliminar</a>
                                            <a class="dropdown-item" href="#">Traspasar</a>


                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>


<div class="modal fade" id="modal-productos" class="modal-dom" tabindex="-1" role="dialog"
    aria-labelledby="modal-productos-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-productos-title">Crear usuario</h5>
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
                    <h3>Básico</h3>
                    <section>

                        <p class="mt-1">Selecciona tienda</p>
                        <select class="form-control form-small" id="select-tienda">
                            <option selected="selected">Tienda 1</option>
                            <option>Tienda 2</option>
                            <option>Tienda 3</option>
                        </select>

                        <div class="form-group">
                            <label for="t-text" class="sr-only">Usuario</label>
                            <input id="t-text" type="text" name="txt" placeholder="Nombre de usuario"
                                class="form-control" required>
                        </div>

                        <div class="form-group">
                            <input id="p-text" type="password" name="pass" placeholder="Contraseña" class="form-control" required="">
                        </div>

                        <div class="form-group">
                            <input id="p-text" type="password" name="pass" placeholder="Verificar Contraseña" class="form-control" required="">
                        </div>

                        <p class="mt-1">Selecciona rol</p>
                        <div class="mb-4">
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>

                    </section>
                    <h3>Detalles</h3>
                    <section>

                        <p class="mt-1">Email de usuario</p>
                        <div class="form-group">
                            <input id="e-text" type="email" name="email" placeholder="email@mail.com" class="form-control" required="">
                        </div>

                        <div class="form-group">
                            <input id="t-text" type="text" name="txt" placeholder="Nombre de usuario"
                                class="form-control" required>
                        </div>

                        <p class="mt-1">Apellidos de usuario</p>
                        <div class="form-group">
                            <input id="t-text" type="text" name="txt" placeholder="Nombre de usuario"
                                class="form-control" required>
                        </div>

                        <p class="mt-1">Tipo de documento</p>
                        <div class="mb-4">
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="t-text" class="sr-only">Documento</label>
                            <input id="t-text" type="number" name="txt" placeholder="Documento de usuario"
                                class="form-control" required>
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

            </div>
        </div>
    </div>
</div>

<!--  END CONTENT AREA  -->

@endsection
