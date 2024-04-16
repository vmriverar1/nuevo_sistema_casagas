@extends('layouts.app')

@section('content')

<!--  BEGIN CONTENT AREA  -->

<div class="layout-px-spacing">

    <div class="page-header">
        <div class="page-title">
            <h3>Almacenes</h3>
        </div>
    </div>

    <div class="row layout-top-spacing" id="cancel-row">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="table-responsive mb-4">
                    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Tienda</th>
                                <th>Nonbre</th>
                                <th>Descripción</th>
                                <th>Último ingreso</th>
                                <th>Logo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>T-1</td>
                                <td>Tienda 1</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>12-12-24</td>
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
                                            <a class="dropdown-item" href="#">Reportar</a>

                                            <a class="dropdown-item" href="#">Reoprte</a>


                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>T-2</td>
                                <td>Tienda 2</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>12-12-24</td>
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
                                            <a class="dropdown-item" href="#">Reportar</a>

                                            <a class="dropdown-item" href="#">Reoprte</a>


                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>T-2</td>
                                <td>Tienda 2</td>
                                <td>Junior Technical Author</td>
                                <td>San Francisco</td>
                                <td>12-12-24</td>
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
                                            <a class="dropdown-item" href="#">Reportar</a>

                                            <a class="dropdown-item" href="#">Reoprte</a>


                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>T-3</td>
                                <td>Tienda 3</td>
                                <td>Senior Javascript Developer</td>
                                <td>Edinburgh</td>
                                <td>12-12-24</td>
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
                                            id="dropdownMenuReference4" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" data-reference="parent">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-chevron-down">
                                                <polyline points="6 9 12 15 18 9"></polyline>
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference4">
                                            <a class="dropdown-item" href="#">Editar</a>
                                            <a class="dropdown-item" href="#">Eliminar</a>
                                            <a class="dropdown-item" href="#">Traspasar</a>
                                            <a class="dropdown-item" href="#">Reportar</a>

                                            <a class="dropdown-item" href="#">Reoprte</a>
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
                <h5 class="modal-title" id="modal-productos-title">Crear almacén</h5>
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
                        <div class="form-group">
                            <label for="t-text" class="sr-only">Nombre de almacén</label>
                            <input id="t-text" type="text" name="txt" placeholder="Nombre de almacén"
                                class="form-control" required>
                        </div>

                        <p class="mt-1">Descripción de almacen</label>
                        <div class="mb-4">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>

                        <p class="mt-1">Selecciona la tienda</p>
                        <select class="form-control form-small" id="select-tienda">
                            <option selected="selected">Tienda 1</option>
                            <option>Tienda 2</option>
                            <option>Tienda 3</option>
                        </select>

                    </section>
                    <h3>Detalles</h3>
                    <section>

                        <p class="mt-1">Responsable de almamcén</p>
                        <select class="form-control form-small" id="select-responsable">
                            <option selected="selected">Responsable 1</option>
                            <option>Responsable 2</option>
                            <option>Responsable 3</option>
                        </select>

                        <p class="mt-1">Alerta de stock</p>
                        <div class="mb-4">
                            <input id="input_alerta" type="text" value="0" name="demo1">
                        </div>

                        <p class="mt-1">Rotación de productos</p>
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

<div class="modal fade" id="modal-kit" class="modal-dom" tabindex="-1" role="dialog"
    aria-labelledby="modal-productos-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-productos-title">Traspasar mercaderia</h5>
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

                <div id="circle-basic-2" class="">
                    <h3>Básico</h3>
                    <section>

                        <p class="mt-1">Selecciona almacen de origen</p>
                        <select class="form-control form-small" id="select-tienda">
                            <option selected="selected">Tienda 1</option>
                            <option>Tienda 2</option>
                            <option>Tienda 3</option>
                        </select>


                        <p class="mt-1">Agregar produtos</p>
                        <div class="form-row">
                            <div class="col-5">
                                <select class="form-control form-small" id="select-producto-mercaderia">
                                    <option selected="selected">Producto 1</option>
                                    <option>Producto 2</option>
                                    <option>Producto 3</option>
                                </select>
                            </div>
                            <div class="col-5">
                                <input id="t-text" type="text" name="txt" placeholder="Cantidad" class="form-control"
                                    required>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-success mt-1" style="width: 100%;">+</button>
                            </div>
                        </div>

                    </section>
                    <h3>Detalles</h3>
                    <section>

                        <p class="mt-1">Selecciona almacen de destino</p>
                        <select class="form-control form-small" id="select-tienda">
                            <option selected="selected">Tienda 1</option>
                            <option>Tienda 2</option>
                            <option>Tienda 3</option>
                        </select>

                        <p class="mt-1">Justifica el traspaso</label>
                        <div class="mb-4">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>

                    </section>
                </div>

            </div>
        </div>
    </div>
</div>

<!--  END CONTENT AREA  -->

@endsection
