@extends('layouts.app')

@section('content')

<script>
    const pagos_data_complete = @json($pagos);
    const descuentos_data_complete = @json($descuentos);
    const document_data_complete = @json($documentos);
</script>

<style>
    .caja-panel{
        width: 450px;
        padding: 20px 30px;
    }
    .card{
        max-height: 400px;
    }
    .card-img-top {
        height: 57% !important;
    }

    .layout-px-spacing>div, .layout-px-spacing .doc-container{
        height: 100% !important;
    }

</style>

<!--  BEGIN CONTENT AREA  -->

<div class="layout-px-spacing">

    <div class="row invoice layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="app-hamburger-container">
                <div class="hamburger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-menu chat-menu d-xl-none">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg></div>
            </div>
            <div class="doc-container">
                <div class="tab-title">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12 caja-panel">

                            <div class="input-group caja-panel-input">
                                <input type="text" class="form-control search_input search_sale" placeholder="Buscar" aria-label="dropdown">
                                <datalist id="suggestions"></datalist>
                                <div class="input-group-append">
                                    <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg> </button>
                                    <div class="dropdown-menu" style="will-change: transform;">
                                        <a class="dropdown-item ver_ventas" href="javascript:void(0);">Ventas</a>
                                        <a class="dropdown-item ver_compras" href="javascript:void(0);">Compras</a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item nueva_venta" href="javascript:void(0);">Nueva Venta</a>
                                        <a class="dropdown-item nueva_compra" href="javascript:void(0);">Nueva Compra</a>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-pills inv-list-container d-block inputs-ventas" id="pills-tab" role="tablist">
                                @foreach ( $ventas as $venta )
                                    <li class="nav-item abrir_venta" data="{{ $venta->id }}">
                                        <div class="nav-link list-actions" id="invoice-00001" data-invoice-id="00001">
                                            <div class="f-m-body">
                                                <div class="f-head">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-dollar-sign" style="background:
                                                        @if ($venta->status == "in_process")
                                                            #ffa190
                                                        @elseif ($venta->status == "charged")
                                                            #90ff90
                                                        @else
                                                            #fbff90
                                                        @endif
                                                        ">
                                                        <line x1="12" y1="1" x2="12" y2="23"></line>
                                                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div class="f-body">
                                                    <p class="invoice-number">Venta {{ $venta->accounting_document_code }}</p>
                                                    <p class="invoice-customer-name"><span>Cliente:</span> {{ $venta->customer->name ?? 'ANONIMO' }}</p>
                                                    <p class="invoice-generated-date">{{ $venta->created_at }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <ul class="nav nav-pills inv-list-container d-block inputs-compras" id="pills-tab" role="tablist" style="display:none !important;">
                                @foreach ( $compras as $compra )
                                    <li class="nav-item">
                                        <div class="nav-link list-actions" id="invoice-00001" data-invoice-id="00001">
                                            <div class="f-m-body">
                                                <div class="f-head">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-dollar-sign" style="background: #ffb1ab">
                                                        <line x1="12" y1="1" x2="12" y2="23"></line>
                                                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div class="f-body">
                                                    <p class="invoice-number">Gasto {{ $compra->accounting_document_code }}</p>
                                                    <p class="invoice-customer-name"><span>Proveedor:</span>{{ $compra->supplier->name }}</p>
                                                    <p class="invoice-generated-date">{{ $compra->created_at }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <ul class="nav nav-pills inv-list-container d-block inputs-clientes" id="pills-tab" role="tablist" style="display:none !important;">
                            </ul>

                            <ul class="nav nav-pills inv-list-container d-block inputs-nueva-venta" id="pills-tab" role="tablist" style="display:none !important;">

                            </ul>

                            <ul class="nav nav-pills inv-list-container d-block comanda" id="pills-tab" role="tablist" style="display:none !important;">
                            </ul>

                            <div class="input-group caja-panel-venta" style="display:none !important;">
                                <button class="btn btn-lg btn-primary btn-block caja-panel-cerrar-venta" style="border-radius: 0px 0px .3rem .3rem;" id="total-amount">Cobrar S/.0</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="invoice-container" style="background-image: url(../../img/bg.png);">
                    <div class="invoice-inbox" style="height: calc(-180px + 100vh);">

                        <div id="background-productos" class="inv-not-selected" style="display: none;">
                            {{-- <p>Open an invoice from the list.</p> --}}
                            <div class="lista-productos" style="display: none !important">
                                <ul class="nav nav-tabs  mb-3 mt-3" id="simpletab" role="tablist">
                                    <li class="nav-item btn-lista-productos">
                                        <a class="nav-link active" id="productos-tab" data-toggle="tab" href="#productos" role="tab" aria-controls="productos" aria-selected="true"><b>Productos</b></a>
                                    </li>
                                    <li class="nav-item btn-lista-servicios">
                                        <a class="nav-link" id="servicios-tab" data-toggle="tab" href="#servicios" role="tab" aria-controls="servicios" aria-selected="false"><b>Servicios</b></a>
                                    </li>
                                    <li class="nav-item btn-lista-kits">
                                        <a class="nav-link" id="kits-tab" data-toggle="tab" href="#kits" role="tab" aria-controls="kits" aria-selected="false"><b>Kits</b></a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="simpletabContent">
                                    <div class="tab-pane fade show active" id="productos" role="tabpanel" aria-labelledby="productos-tab">

                                        <div class="card-list-head">
                                            <div class="col-lg-12 col-md-12 col-sm-12 filtered-list-search mx-auto" style="margin-bottom: 10px;">
                                                <form class="form-inline my-2 my-lg-0 justify-content-center">
                                                    <div class="w-100">
                                                        <input type="text" class="w-100 form-control product-search br-30" id="input-search" placeholder="Buscar producto">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="card-list-body" id="product-list">
                                        </div>

                                        <div class="card-list-footer pagination-productos" id="pagination-container">
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="servicios" role="tabpanel" aria-labelledby="servicios-tab">
                                        <div class="card-list-head">
                                            <div class="col-lg-12 col-md-12 col-sm-12 filtered-list-search mx-auto" style="margin-bottom: 10px;">
                                                <form class="form-inline my-2 my-lg-0 justify-content-center">
                                                    <div class="w-100">
                                                        <input type="text" class="w-100 form-control service-search br-30" id="input-search" placeholder="Buscar servicio">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="card-list-body" id="service-list">
                                        </div>

                                        <div class="card-list-footer pagination-servicios" id="pagination-container">
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="kits" role="tabpanel" aria-labelledby="kits-tab">
                                        <div class="card-list-head">
                                            <div class="col-lg-12 col-md-12 col-sm-12 filtered-list-search mx-auto" style="margin-bottom: 10px;">
                                                <form class="form-inline my-2 my-lg-0 justify-content-center">
                                                    <div class="w-100">
                                                        <input type="text" class="w-100 form-control kit-search br-30" id="input-search" placeholder="Buscar kit">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="card-list-body" id="kit-list">
                                        </div>

                                        <div class="card-list-footer pagination-kits" id="pagination-container">
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>


                    </div>



                </div>

            </div>

        </div>
    </div>
</div>

<!-- Modal venta -->

<div class="modal fade" id="modal-cerrar-venta" class="modal-dom" tabindex="-1" role="dialog" aria-labelledby="modal-productos-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-productos-title">Cerrar venta</h5>
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

                        <h3>Cliente</h3>
                        <section>

                            <p class="mt-1">Forma de venta</p>
                            <div class="mb-4">
                                <select class="form-control" id="status_sale" name="status_sale" required>
                                    <option disabled selected>Seleccionar tipo de venta</option>
                                    <option value="in_parts">En Partes</option>
                                    <option value="in_process">Por cobrar</option>
                                    <option value="charged">Cobrar total</option>
                                </select>
                            </div>

                            <div class="mb-4" id="container_cliente_data" style="box-shadow: 0 0 5px 2px rgba(194, 213, 255, 0.619608); overflow: hidden; border-radius: 10px;">
                                <h3 class="in-heading" id="name_client">ANONIMO</h3>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="document_client" id="document_client" placeholder="Ingresa DNI o placa de cliente" aria-label="Recipient's username" style="border-radius: 0px 0px 10px 10px;">
                                </div>
                            </div>

                            <div id="div_car_registration">
                            </div>

                            @if ( $descuentos->count() > 0 )
                                <div class="mt-4 mb-4">
                                    <select class="form-control" name="discount_sale_select" id="discount_sale_select" required>
                                        <option value="ninguno" selected>Ningun descuento</option>
                                        @foreach ( $descuentos as $descuento )
                                            <option value="{{ $descuento->id }}">{{ $descuento->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <div id="dom_discount_type" style="display: none;">
                                <p class="mt-1">Descuento</p>
                                <div class="mb-4">
                                    <input class="input_precio" type="text" value="" name="discount_quantity">
                                </div>
                            </div>

                            @if ( $documentos->count() > 0 )
                                <div class="mt-4 mb-4">
                                    <select class="form-control" id="document_sale" name="document_sale" required>
                                        <option disabled selected>Seleccionar documento de pago</option>
                                        @foreach ( $documentos as $documento )
                                            <option value="{{ $documento->id }}">{{ $documento->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            @if ( $pagos->count() > 0 )
                                <div class="mt-4 mb-4">
                                    <select class="form-control" name="payment_sale" id="payment_sale">
                                        <option value="ninguno">Pago en efectivo</option>
                                        @foreach ( $pagos as $pago )
                                            <option value="{{ $pago->id }}">{{ $pago->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <div id="div_payment_type">
                            </div>

                        </section>

                        <h3>Detalle</h3>
                        <section>

                                <div class="widget-activity-three">

                                    <div class="timeline-line">

                                        <div class="item-timeline timeline-new">
                                            <div class="t-dot">
                                                <div class="t-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
                                            </div>
                                            <div class="t-content">
                                                <div class="t-uppercontent">
                                                    <h5>Cliente</h5>
                                                </div>
                                                <p id="modal_cliente"><span>Juan valder</span> (pago contado)</p>
                                                <div class="tags">
                                                    {{-- <div class="badge badge-primary">Matricula: AA-100</div>
                                                    <div class="badge badge-success">Nuevo</div> --}}
                                                    {{-- <div class="badge badge-warning" id="modal_vendedor">Atendido por: Juan</div> --}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="item-timeline timeline-new product_list_modal" id="product_list_modal">
                                            <div class="t-dot">
                                                <div class="t-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg></div>
                                            </div>
                                            <div class="t-content">
                                                <div class="t-uppercontent">
                                                    <h5>Productos</h5>
                                                </div>
                                                <div class="t-uppercontent">
                                                    <p>3 Motores</p>
                                                    <span class="">S/.100-00</span>
                                                </div>
                                                <div class="t-uppercontent">
                                                    <p>3 Motores</p>
                                                    <span class="">S/.100-00</span>
                                                </div>
                                                <div class="t-uppercontent">
                                                    <p>3 Motores</p>
                                                    <span class="">S/.100-00</span>
                                                </div>
                                                <div class="tags">
                                                    <div class="badge badge-primary">Admin</div>
                                                    <div class="badge badge-success">HR</div>
                                                    <div class="badge badge-warning">Mail</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="item-timeline timeline-new">
                                            <div class="t-dot">
                                                <div class="t-warning"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg></div>
                                            </div>
                                            <div class="t-content">
                                                <div class="t-uppercontent">
                                                    <h5>Subtotal</h5>
                                                </div>
                                                <p class="subtotal_modal">S/.0.00</p>
                                            </div>
                                        </div>

                                        @if ( $descuentos->count() > 0 )
                                            <div class="item-timeline timeline-new">
                                                <div class="t-dot">
                                                    <div class="t-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
                                                </div>
                                                <div class="t-content">
                                                    <div class="t-uppercontent">
                                                        <h5 class="descuento_titulo_modal">Descuento</h5>
                                                        {{-- <span class="">Monto fijo</span> --}}
                                                    </div>
                                                    <p class="descuento_modal">S/.0</p>
                                                </div>
                                            </div>
                                        @endif

                                        @if ( $documentos->count() > 0 )
                                            <div class="item-timeline timeline-new">
                                                <div class="t-dot">
                                                    <div class="t-warning"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                                                </div>
                                                <div class="t-content">
                                                    <div class="t-uppercontent">
                                                        <h5>Documentos</h5>
                                                        <span class="documento_tipo_modal">BOLETA</span>
                                                    </div>
                                                    <p class="documento_modal">S/.0.00</p>
                                                </div>
                                            </div>
                                        @endif

                                        @if ( $pagos->count() > 0 )
                                            <div class="item-timeline timeline-new">
                                                <div class="t-dot">
                                                    <div class="t-warning"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg></div>
                                                </div>
                                                <div class="t-content">
                                                    <div class="t-uppercontent">
                                                        <h5>Forma de pago</h5>
                                                        <span class="forma_pago_tipo_modal">Efectivo</span>
                                                    </div>
                                                    <p class="forma_pago_modal">Efectivo S/.0.00</p>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="item-timeline timeline-new">
                                            <div class="t-dot">
                                                <div class="t-dark"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6" y2="6"></line><line x1="6" y1="18" x2="6" y2="18"></line></svg></div>
                                            </div>
                                            <div class="t-content">
                                                <div class="t-uppercontent">
                                                    <h5>Total</h5>
                                                </div>
                                                <p class="total_modal">S/.1000</p>
                                            </div>
                                        </div>

                                        <div class="item-timeline timeline-new div_adelanto_modal">
                                            <div class="t-dot">
                                                <div class="t-success">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                                </div>
                                            </div>
                                            <div class="t-content">
                                                <div class="t-uppercontent">
                                                    <h5>Adelanto</h5>
                                                </div>
                                                <p class="adelanto_modal">S/.1000</p>
                                            </div>
                                        </div>

                                        <div class="item-timeline timeline-new div_adelanto_modal">
                                            <div class="t-dot">
                                                <div class="t-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                                                </div>
                                            </div>
                                            <div class="t-content">
                                                <div class="t-uppercontent">
                                                    <h5>Restante</h5>
                                                </div>
                                                <p class="restante_modal">S/.1000</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                        </section>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Modal anular venta -->

<div class="modal fade" id="modal-anular-venta" class="modal-dom modal-anular-venta" tabindex="-1" role="dialog"
    aria-labelledby="modal-productos-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-productos-title">Anular venta</h5>
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
                    @csrf
                    <div class="wizard_sale">

                        <h3>Venta</h3>
                        <section>

                            <p class="mt-1">Razon de anulación</p>
                            <div class="mb-4">
                                <textarea name="motivo_anulacion" id="motivo_anulacion" cols="30" rows="10" class="form-control" placeholder="Motivo de anulación"></textarea>
                            </div>

                        </section>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal editar venta -->

<div class="modal fade" id="modal-cobrar-venta" class="modal-dom" tabindex="-1" role="dialog"
    aria-labelledby="modal-productos-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-productos-title">Cerrar venta</h5>
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
                    @csrf
                    <div class="wizard_cobrar_venta">

                        <h3>Cliente</h3>
                        <section>

                            <p class="mt-1">Forma de venta</p>
                            <div class="mb-4">
                                <select class="form-control" id="status_sale_pay" name="status_sale" required>
                                    <option disabled selected>Seleccionar tipo de venta</option>
                                    <option value="in_parts">En Partes</option>
                                    <option value="charged">Cobrar total</option>
                                </select>
                            </div>

                            @if ( $descuentos->count() > 0 )
                                <div class="mt-4 mb-4">
                                    <select class="form-control" name="discount_sale_select" id="discount_sale_select_pay" required>
                                        <option value="ninguno" selected>Ningun descuento</option>
                                        @foreach ( $descuentos as $descuento )
                                            <option value="{{ $descuento->id }}">{{ $descuento->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            @if ( $pagos->count() > 0 )
                                <div class="mt-4 mb-4">
                                    <select class="form-control" name="payment_sale" id="payment_sale_pay">
                                        <option value="ninguno">Pago en efectivo</option>
                                        @foreach ( $pagos as $pago )
                                            <option value="{{ $pago->id }}">{{ $pago->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif


                            <div id="div_payment_type_sale">
                            </div>

                        </section>

                        <h3>Detalle</h3>
                        <section>

                                <div class="widget-activity-three">

                                    <div class="timeline-line">

                                        <div class="item-timeline timeline-new">
                                            <div class="t-dot">
                                                <div class="t-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
                                            </div>
                                            <div class="t-content">
                                                <div class="t-uppercontent">
                                                    <h5>Cliente</h5>
                                                </div>
                                                <p id="modal_cliente"><span>Juan valder</span> (pago contado)</p>
                                                <div class="tags">
                                                    {{-- <div class="badge badge-primary">Matricula: AA-100</div>
                                                    <div class="badge badge-success">Nuevo</div> --}}
                                                    {{-- <div class="badge badge-warning" id="modal_vendedor">Atendido por: Juan</div> --}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="item-timeline timeline-new product_list_modal" id="product_list_modal_pay">
                                            <div class="t-dot">
                                                <div class="t-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg></div>
                                            </div>
                                            <div class="t-content">
                                                <div class="t-uppercontent">
                                                    <h5>Productos</h5>
                                                </div>
                                                <div class="t-uppercontent">
                                                    <p>3 Motores</p>
                                                    <span class="">S/.100-00</span>
                                                </div>
                                                <div class="t-uppercontent">
                                                    <p>3 Motores</p>
                                                    <span class="">S/.100-00</span>
                                                </div>
                                                <div class="t-uppercontent">
                                                    <p>3 Motores</p>
                                                    <span class="">S/.100-00</span>
                                                </div>
                                                <div class="tags">
                                                    <div class="badge badge-primary">Admin</div>
                                                    <div class="badge badge-success">HR</div>
                                                    <div class="badge badge-warning">Mail</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="item-timeline timeline-new">
                                            <div class="t-dot">
                                                <div class="t-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg></div>
                                            </div>
                                            <div class="t-content">
                                                <div class="t-uppercontent">
                                                    <h5>Subtotal</h5>
                                                </div>
                                                <p class="subtotal_modal">S/.0.00</p>
                                            </div>
                                        </div>




                                        @if ( $documentos->count() > 0 )
                                            <div class="item-timeline timeline-new">
                                                <div class="t-dot">
                                                    <div class="t-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                                                </div>
                                                <div class="t-content">
                                                    <div class="t-uppercontent">
                                                        <h5>Documentos</h5>
                                                        <span class="documento_tipo_modal">BOLETA</span>
                                                    </div>
                                                    <p class="documento_modal">S/.0.00</p>
                                                </div>
                                            </div>
                                        @endif

                                        @if ( $descuentos->count() > 0 )
                                            <div class="item-timeline timeline-new">
                                                <div class="t-dot">
                                                    <div class="t-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
                                                </div>
                                                <div class="t-content">
                                                    <div class="t-uppercontent">
                                                        <h5 class="descuento_titulo_modal">Descuento</h5>
                                                        {{-- <span class="">Monto fijo</span> --}}
                                                    </div>
                                                    <p class="descuento_modal">S/.0</p>
                                                </div>
                                            </div>
                                        @endif



                                        <div class="item-timeline timeline-new">
                                            <div class="t-dot">
                                                <div class="t-dark"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6" y2="6"></line><line x1="6" y1="18" x2="6" y2="18"></line></svg></div>
                                            </div>
                                            <div class="t-content">
                                                <div class="t-uppercontent">
                                                    <h5>Total</h5>
                                                </div>
                                                <p class="total_modal">S/.1000</p>
                                            </div>
                                        </div>

                                        <div class="item-timeline timeline-new div_adelanto_modal">
                                            <div class="t-dot">
                                                <div class="t-warning">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                                </div>
                                            </div>
                                            <div class="t-content">
                                                <div class="t-uppercontent">
                                                    <h5>Adelanto</h5>
                                                </div>
                                                <p class="adelanto_modal">S/.1000</p>
                                            </div>
                                        </div>

                                        @if ( $pagos->count() > 0 )

                                            <div class="item-timeline timeline-new">
                                                <div class="t-dot">
                                                    <div class="t-warning"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg></div>
                                                </div>
                                                <div class="t-content">
                                                    <div class="t-uppercontent">
                                                        <h5>Forma de pago</h5>
                                                        <span class="forma_pago_tipo_modal">Efectivo</span>
                                                    </div>
                                                    <p class="forma_pago_modal">Efectivo S/.0.00</p>
                                                </div>
                                            </div>

                                        @endif



                                        <div class="item-timeline timeline-new div_adelanto_modal">

                                            <div class="t-dot">
                                                <div class="t-dark">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                                </div>
                                            </div>
                                            <div class="t-content">
                                                <div class="t-uppercontent">
                                                    <h5>Adelantos anteriores</h5>
                                                </div>
                                                <p class="adelanto_acumulado_modal">S/.1000</p>
                                            </div>
                                        </div>

                                        <div class="item-timeline timeline-new div_adelanto_modal">
                                            <div class="t-dot">
                                                <div class="t-dark">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                                                </div>
                                            </div>
                                            <div class="t-content">
                                                <div class="t-uppercontent">
                                                    <h5>Restante</h5>
                                                </div>
                                                <p class="restante_modal">S/.1000</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                        </section>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Modal ver productos -->
<div class="modal fade" id="modal-producto-venta" class="modal-dom" tabindex="-1" role="dialog"
    aria-labelledby="modal-productos-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-productos-title">Cerrar venta</h5>
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
                    <div class="wizard_producto_venta">

                        <h3>Cliente</h3>
                        <section>

                            <div class="block_agregar_producto">
                                <p class="mt-1">Produtos para agregar</p>
                                <div class="form-row">
                                    <div class="list_productos col-12 mb-4">
                                    </div>
                                    <div class="col-5">
                                        <select class="form-control form-small select2_modal" id="select-producto-agregar">
                                            <option selected="selected">Selecciona un producto</option>
                                        </select>
                                    </div>
                                    <div class="col-5">
                                        <input type="text" name="txt" placeholder="Cantidad" class="form-control" id="select-producto-cantidad">
                                    </div>
                                    <div class="col-2">
                                        <button class="btn btn-success mt-1 add_productos" style="width: 100%;">+</button>
                                    </div>

                                    <!-- Input hidden para almacenar los datos en formato JSON -->
                                    <input type="hidden" name="productos_kit" id="productos_kit" value="[]">

                                </div>
                            </div>

                        </section>

                        <h3>Detalle</h3>
                        <section>

                            <div class="widget-activity-three">

                                <div class="timeline-line">

                                    <div class="item-timeline timeline-new">
                                        <div class="t-dot">
                                            <div class="t-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
                                        </div>
                                        <div class="t-content">
                                            <div class="t-uppercontent">
                                                <h5>Cliente</h5>
                                            </div>
                                            <p id="modal_cliente"><span>Juan valder</span> (pago contado)</p>
                                            <div class="tags">
                                                {{-- <div class="badge badge-primary">Matricula: AA-100</div>
                                                <div class="badge badge-success">Nuevo</div> --}}
                                                {{-- <div class="badge badge-warning" id="modal_vendedor">Atendido por: Juan</div> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="item-timeline timeline-new product_list_modal" id="product_list_modal_pay">
                                        <div class="t-dot">
                                            <div class="t-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg></div>
                                        </div>
                                        <div class="t-content">
                                            <div class="t-uppercontent">
                                                <h5>Productos</h5>
                                            </div>
                                            <div class="t-uppercontent">
                                                <p>3 Motores</p>
                                                <span class="">S/.100-00</span>
                                            </div>
                                            <div class="t-uppercontent">
                                                <p>3 Motores</p>
                                                <span class="">S/.100-00</span>
                                            </div>
                                            <div class="t-uppercontent">
                                                <p>3 Motores</p>
                                                <span class="">S/.100-00</span>
                                            </div>
                                            <div class="tags">
                                                <div class="badge badge-primary">Admin</div>
                                                <div class="badge badge-success">HR</div>
                                                <div class="badge badge-warning">Mail</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="item-timeline timeline-new">
                                        <div class="t-dot">
                                            <div class="t-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg></div>
                                        </div>
                                        <div class="t-content">
                                            <div class="t-uppercontent">
                                                <h5>Subtotal</h5>
                                            </div>
                                            <p class="subtotal_modal">S/.0.00</p>
                                        </div>
                                    </div>

                                    @if ( $documentos->count() > 0 )
                                        <div class="item-timeline timeline-new">
                                            <div class="t-dot">
                                                <div class="t-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                                            </div>
                                            <div class="t-content">
                                                <div class="t-uppercontent">
                                                    <h5>Documentos</h5>
                                                    <span class="documento_tipo_modal">BOLETA</span>
                                                </div>
                                                <p class="documento_modal">S/.0.00</p>
                                            </div>
                                        </div>
                                    @endif

                                    @if ( $descuentos->count() > 0 )
                                        <div class="item-timeline timeline-new">
                                            <div class="t-dot">
                                                <div class="t-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
                                            </div>
                                            <div class="t-content">
                                                <div class="t-uppercontent">
                                                    <h5 class="descuento_titulo_modal">Descuento</h5>
                                                    {{-- <span class="">Monto fijo</span> --}}
                                                </div>
                                                <p class="descuento_modal">S/.0</p>
                                            </div>
                                        </div>
                                    @endif



                                    <div class="item-timeline timeline-new">
                                        <div class="t-dot">
                                            <div class="t-dark"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6" y2="6"></line><line x1="6" y1="18" x2="6" y2="18"></line></svg></div>
                                        </div>
                                        <div class="t-content">
                                            <div class="t-uppercontent">
                                                <h5>Total</h5>
                                            </div>
                                            <p class="total_modal">S/.1000</p>
                                        </div>
                                    </div>

                                    <div class="item-timeline timeline-new div_adelanto_modal">
                                        <div class="t-dot">
                                            <div class="t-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                            </div>
                                        </div>
                                        <div class="t-content">
                                            <div class="t-uppercontent">
                                                <h5>Adelanto</h5>
                                            </div>
                                            <p class="adelanto_modal">S/.1000</p>
                                        </div>
                                    </div>

                                    @if ( $pagos->count() > 0 )
                                        <div class="item-timeline timeline-new">
                                            <div class="t-dot">
                                                <div class="t-warning"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg></div>
                                            </div>
                                            <div class="t-content">
                                                <div class="t-uppercontent">
                                                    <h5>Forma de pago</h5>
                                                    <span class="forma_pago_tipo_modal">Efectivo</span>
                                                </div>
                                                <p class="forma_pago_modal">Efectivo S/.0.00</p>
                                            </div>
                                        </div>
                                    @endif



                                    <div class="item-timeline timeline-new div_adelanto_modal">

                                        <div class="t-dot">
                                            <div class="t-dark">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                            </div>
                                        </div>
                                        <div class="t-content">
                                            <div class="t-uppercontent">
                                                <h5>Adelantos anteriores</h5>
                                            </div>
                                            <p class="adelanto_acumulado_modal">S/.1000</p>
                                        </div>
                                    </div>

                                    <div class="item-timeline timeline-new div_adelanto_modal">
                                        <div class="t-dot">
                                            <div class="t-dark">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                                            </div>
                                        </div>
                                        <div class="t-content">
                                            <div class="t-uppercontent">
                                                <h5>Restante</h5>
                                            </div>
                                            <p class="restante_modal">S/.1000</p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </section>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Modal ver usuario -->
<div class="modal fade" id="modal-cliente-venta" class="modal-dom" tabindex="-1" role="dialog"
    aria-labelledby="modal-productos-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-productos-title">Cerrar venta</h5>
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

                        <div class="content clearfix">
                            <section style="padding:20px;">

                                    <div class="widget-activity-three">

                                        <div class="timeline-line">

                                            <div class="item-timeline timeline-new">
                                                <div class="t-dot">
                                                    <div class="t-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
                                                </div>
                                                <div class="t-content">
                                                    <div class="t-uppercontent">
                                                        <h5>Cliente</h5>
                                                    </div>
                                                    <p id="modal_cliente_sale_data"><span>Juan valder</span> (pago contado)</p>
                                                    <div class="tags">
                                                        <div class="badge badge-primary" id="modal_matricula_sale_data">Matricula: AA-100</div>
                                                        <div class="badge badge-warning" id="modal_vendedor_sale_data">Atendido por: Juan</div>
                                                        {{-- <div class="badge badge-success">Nuevo</div> --}}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="item-timeline timeline-new product_list_modal" id="product_list_modal_pay">
                                                <div class="t-dot">
                                                    <div class="t-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg></div>
                                                </div>
                                                <div class="t-content" id="modal_documentacion_sale_data">
                                                    <div class="t-uppercontent">
                                                        <h5>Productos (documentación)</h5>
                                                    </div>
                                                    <div class="t-uppercontent">
                                                        <p><a href="">3 Motores</a></p>
                                                    </div>
                                                    <div class="t-uppercontent">
                                                        <p><a href="">3 Motores</a></p>
                                                    </div>
                                                    <div class="t-uppercontent">
                                                        <p><a href="">3 Motores</a></p>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="item-timeline timeline-new product_list_modal" id="product_list_modal_pay">
                                                <div class="t-dot">
                                                    <div class="t-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg></div>
                                                </div>
                                                <div class="t-content" id="modal_cliente_adelanto_data">
                                                    <div class="t-uppercontent">
                                                        <h5>Adelantos</h5>
                                                    </div>
                                                    <div class="t-uppercontent">
                                                        <p>14/03/24</p>
                                                        <span class="">S/.100-00</span>
                                                    </div>
                                                    <div class="t-uppercontent">
                                                        <p>14/03/24</p>
                                                        <span class="">S/.100-00</span>
                                                    </div>
                                                    <div class="t-uppercontent">
                                                        <p>14/03/24</p>
                                                        <span class="">S/.100-00</span>
                                                    </div>
                                                    <div class="t-uppercontent">
                                                        <p>14/03/24</p>
                                                        <span class="">S/.100-00</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="item-timeline timeline-new">
                                                <div class="t-dot">
                                                    <div class="t-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                                                </div>
                                                <div class="t-content">
                                                    <div class="t-uppercontent">
                                                        <h5>Documentos</h5>
                                                        <span class="" id="modal_documento_sale_data">BOLETA</span>
                                                    </div>
                                                    <p class="" id="modal_codigo_sale_data">codigo</p>
                                                </div>
                                            </div>

                                            <div class="item-timeline timeline-new div_adelanto_modal">
                                                <div class="t-dot">
                                                    <div class="t-warning">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                                    </div>
                                                </div>
                                                <div class="t-content">
                                                    <div class="t-uppercontent">
                                                        <h5>Adelanto hasta el momento</h5>
                                                    </div>
                                                    <p class="adelanto_modal" id="modal_adelanto_final_sale_data">S/.1000</p>
                                                </div>
                                            </div>

                                            <div class="item-timeline timeline-new div_adelanto_modal">
                                                <div class="t-dot">
                                                    <div class="t-dark">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                                                    </div>
                                                </div>
                                                <div class="t-content">
                                                    <div class="t-uppercontent">
                                                        <h5>Restante</h5>
                                                    </div>
                                                    <p class="" id="modal_restante_sale_data">S/.1000</p>
                                                </div>
                                            </div>

                                            <div class="item-timeline timeline-new">
                                                <div class="t-dot">
                                                    <div class="t-dark"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6" y2="6"></line><line x1="6" y1="18" x2="6" y2="18"></line></svg></div>
                                                </div>
                                                <div class="t-content">
                                                    <div class="t-uppercontent">
                                                        <h5>Total</h5>
                                                    </div>
                                                    <p class="" id="modal_total_sale_data">S/.1000</p>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                            </section>
                        </div>


                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Modal agregar gasto -->

<div class="modal fade" id="modal-gastos" class="modal-dom modal-gastos" tabindex="-1" role="dialog"
    aria-labelledby="modal-productos-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-productos-title">Agregar gasto</h5>
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
                    @csrf
                    <div class="wizard_sale">

                        <h3>Gasto</h3>
                        <section>

                            <p class="mt-1">Precio para el cliente</p>
                            <div class="mb-4">
                                <input class="input_gasto" type="text" value="0" name="expense_input">
                            </div>

                            <p class="mt-1">Razon de anulación</p>
                            <div class="mb-4">
                                <textarea name="motivo_anulacion" id="motivo_anulacion" cols="30" rows="10" class="form-control" placeholder="Motivo de anulación"></textarea>
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
