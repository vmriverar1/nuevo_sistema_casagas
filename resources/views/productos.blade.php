@extends('layouts.app')

@section('content')

<!--  BEGIN CONTENT AREA  -->

<div class="layout-px-spacing">

    <div class="page-header">
        <div class="page-title">
            <h3>Productos</h3>
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
                                <th>Nompre</th>
                                <th>Marca</th>
                                <th>Categorias</th>
                                <th>Código</th>
                                <th>Stock</th>
                                <th>Precio</th>
                                <th>Tipo</th>
                                <th>Estatus</th>
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


<div class="modal fade" id="modal-products" class="modal-dom" tabindex="-1" role="dialog"
    aria-labelledby="modal-products-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-products-title">Modal productos</h5>
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
                                    <select class="form-control form-small select2_modal select_nombre" name="name" required>
                                        <option selected="selected" disabled>Nombre de producto</option>
                                        @foreach ($dataProductos as $producto)
                                            <option value="{{ $producto->id }}">{{ $producto->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <select class="form-control form-small mt-1 select_tipo_producto" name="type" required>
                                        <option selected="selected" disabled>Tipo de producto</option>
                                        <option value="producto">Producto</option>
                                        <option value="servicio">Servicio</option>
                                        <option value="paquete">Paquete</option>
                                    </select>
                                </div>

                                <div class="form-group" style="display: flex; flex-direction: column;">
                                    <select class="form-control form-small select2_modal select_marca" name="brand_id" required>
                                        <option selected="selected" disabled>Seleccionar marca</option>
                                        @foreach ($marcas as $marca)
                                            <option value="{{ $marca->id }}">{{ $marca->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group" style="display: flex; flex-direction: column;">
                                    <p class="mt-1">Selecciona categorias</p>
                                    <select class="form-control select2_modal tagging mt-1 select_categoria" multiple="multiple" name="categories" required>
                                        @foreach ($categorias as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group" style="display: flex; flex-direction: column;">
                                    <p class="mt-1">Selecciona los requerimientos</p>
                                    <div class="form-row">
                                        <select class="form-control form-small select2_modal select_requerimiento" multiple="multiple" name="requirements" required>
                                            @foreach ($requerimientos as $requerimiento)
                                                <option value="{{ $requerimiento->id }}">{{ $requerimiento->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                            </section>
                            <h3>Detalles</h3>
                            <section>

                                {{-- CUANDO EL TIPO ES PRODUCTO --}}

                                <div class="block_productos">


                                    <div class="stock">
                                        <p class="mt-1">Stock</p>
                                        <div class="mb-4">
                                            <input class="input_cantidad" type="text" value="" name="stock" required>
                                        </div>
                                    </div>

                                    <p class="mt-1">Stock mínimo (para alarma)</p>
                                    <div class="mb-4">
                                        <input class="input_cantidad" type="text" value="" name="minimum" required>
                                    </div>

                                    <p class="mt-1">Precio del proveedor</p>
                                    <div class="mb-4">
                                        <input class="input_precio" type="text" value="0" name="purchase_price" required>
                                    </div>

                                </div>

                                {{-- CUANDO EL TIPO ES PAQUETES --}}

                                <div class="block_paquetes">
                                    <p class="mt-1">Produtos del kit</p>
                                    <div class="form-row">
                                        <div class="list_productos col-12 mb-4">
                                        </div>
                                        <div class="col-5">
                                            <select class="form-control form-small select2_modal" id="select-producto-kit">
                                                <option selected="selected">Selecciona un producto</option>
                                                @foreach ($productos as $producto)
                                                    <option value="{{ $producto->id }}">{{ $producto->name }}</option>
                                                @endforeach
                                                @foreach ($servicios as $servicio)
                                                    <option value="{{ $servicio->id }}">{{ $servicio->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-5">
                                            <input type="text" name="txt" placeholder="Cantidad" class="form-control">
                                        </div>
                                        <div class="col-2">
                                            <button class="btn btn-success mt-1 add_productos" style="width: 100%;">+</button>
                                        </div>

                                        <!-- Input hidden para almacenar los datos en formato JSON -->
                                        <input type="hidden" name="productos_kit" id="productos_kit" value="[]">

                                    </div>
                                </div>

                                <p class="mt-1">Precio para el cliente</p>
                                <div class="mb-4">
                                    <input class="input_precio" type="text" value="0" name="sale_price">
                                </div>

                                {{-- CUANDO EL TIPO ES SERVICIO --}}

                                <div class="block_servicio">

                                </div>

                                <div class="block_productos">

                                    <p class="mt-1">Ingresa codigo de productos</p>
                                    <div class="input-group mb-4">
                                        <span class="input-group-text" id="basic-addon1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-code">
                                                <polyline points="16 18 22 12 16 6"></polyline>
                                                <polyline points="8 6 2 12 8 18"></polyline>
                                            </svg>
                                        </span>
                                        <input type="text" class="form-control" placeholdfer="Barcode" aria-label="Barcode" name="barcode">
                                    </div>

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
</div>

<div class="modal fade" id="modal-categoria" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal Categorias</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" style="min-height: 130px; margin: auto !important; display: flex; justify-content: center;">

                    <div class="col-lg-6 row" style="justify-content: center; align-items: center;">
                        <button class="btn btn-warning mb-2 mr-2 btn-rounded">Editar
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 ml-4"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                        </button>
                    </div>

                    <div class="col-lg-6 row" style="justify-content: center; align-items: center;">
                        <button class="btn btn-danger mb-2 mr-2 btn-rounded">Eliminar
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 ml-4"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                        </button>
                    </div>

                    <div class="form-group mb-4 col-12" style="display: none;">
                        <input type="text" name="name" placeholder="Nombre de categoria" class="form-control" required>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" style="display: none;">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-brand" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal Marca</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" style="min-height: 130px; margin: auto !important; display: flex; justify-content: center;">

                    <div class="col-lg-6 row" style="justify-content: center; align-items: center;">
                        <button class="btn btn-warning mb-2 mr-2 btn-rounded">Editar
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 ml-4"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                        </button>
                    </div>

                    <div class="col-lg-6 row" style="justify-content: center; align-items: center;">
                        <button class="btn btn-danger mb-2 mr-2 btn-rounded">Eliminar
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 ml-4"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                        </button>
                    </div>

                    <div class="form-group mb-4 col-12" style="display: none;">
                        <input type="text" name="name" placeholder="Nombre de categoria" class="form-control" required>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" style="display: none;">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-move" class="modal-dom" tabindex="-1" role="dialog"
    aria-labelledby="modal-move-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-move-title">Administrar mercaderia</h5>
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

                <div id="circle-basic-3" class="">
                    <form action="#">
                        <div class="wizard">
                            <h3>Agregar</h3>
                            <section>

                                <div class="">
                                    <p class="mt-1">Produtos del kit</p>
                                    <div class="form-row">
                                        <div class="list_productos_move col-12 mb-4">
                                        </div>
                                        <div class="col-5">
                                            <select class="form-control form-small select2_modal" id="select-producto-move">
                                                <option selected="selected">Selecciona un producto</option>
                                                @foreach ($productos as $producto)
                                                    <option stock="{{ $producto->stock }}" value="{{ $producto->id }}">{{ $producto->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-5">
                                            <input type="text" name="txt" placeholder="Cantidad" class="form-control">
                                        </div>
                                        <div class="col-2">
                                            <button class="btn btn-success mt-1 add_productos_move" style="width: 100%;">+</button>
                                        </div>

                                        <!-- Input hidden para almacenar los datos en formato JSON -->
                                        <input type="hidden" name="productos_move" id="productos_move" value="[]">

                                    </div>
                                </div>

                            </section>
                            <h3>Trasladar</h3>
                            <section>

                                <div class="form-group mb-4">
                                    <select class="form-control form-small mt-1 select_tienda" name="branch_id" required>
                                        <option selected="selected" disabled>Seleiona la tienda</option>
                                        @foreach ($tiendas as $tienda)
                                            <option value="{{ $tienda->id }}">{{ $tienda->company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </section>
                            {{-- <h3>Justifica</h3>
                            <section>
                                <div class="custom-file-container" data-upload-id="myFirstImage">

                                    <div class="form-group mb-4">
                                        <label for="exampleFormControlTextarea1">Justifica tu acción</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                </div>
                            </section> --}}
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>


<!--  END CONTENT AREA  -->

@endsection
