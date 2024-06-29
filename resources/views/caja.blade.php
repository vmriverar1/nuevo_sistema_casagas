@extends('layouts.app')

@section('content')

<script>
    const pagos_data_complete = @json($pagos);
    const descuentos_data_complete = @json($descuentos);
    const document_data_complete = @json($documentos);
</script>

<!--  BEGIN CONTENT AREA  -->

<div class="layout-px-spacing">

    <div class="page-header">
        <div class="page-title">
            <h3>Caja</h3>
        </div>
    </div>

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
                                <div class="input-group-append">
                                    <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg> </button>
                                    <div class="dropdown-menu" style="will-change: transform;">
                                        <a class="dropdown-item ver_ventas" href="javascript:void(0);">Ventas</a>
                                        <a class="dropdown-item ver_compras" href="javascript:void(0);">Compras</a>
                                        <a class="dropdown-item ver_clientes" href="javascript:void(0);">Clientes</a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item nueva_venta" href="javascript:void(0);">Nueva Venta</a>
                                        <a class="dropdown-item nueva_venta" href="javascript:void(0);">Nueva Compra</a>
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
                                                            #90acff
                                                        @else
                                                            #90ff90
                                                        @endif
                                                        ">
                                                        <line x1="12" y1="1" x2="12" y2="23"></line>
                                                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div class="f-body">
                                                    <p class="invoice-number">Venta {{ $venta->accounting_document_code }}</p>
                                                    <p class="invoice-customer-name"><span>Cliente:</span> {{ $venta->customer->name }}</p>
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
                                    <li class="nav-item">
                                        <a class="nav-link active" id="productos-tab" data-toggle="tab" href="#productos" role="tab" aria-controls="productos" aria-selected="true"><b>Productos</b></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="servicios-tab" data-toggle="tab" href="#servicios" role="tab" aria-controls="servicios" aria-selected="false"><b>Servicios</b></a>
                                    </li>
                                    <li class="nav-item">
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



                        {{-- <div id="background-facturas-body" id="ct" class="">

                            <div class="invoice-00001">
                                <div class="content-section  animated animatedFadeInUp fadeInUp">

                                    <div class="row inv--head-section">

                                        <div class="col-sm-6 col-12">
                                            <h3 class="in-heading">INVOICE</h3>
                                        </div>
                                        <div class="col-sm-6 col-12 align-self-center text-sm-right">
                                            <div class="company-info">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-hexagon">
                                                    <path
                                                        d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                                                    </path>
                                                </svg>
                                                <h5 class="inv-brand-name">CORK</h5>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row inv--detail-section">

                                        <div class="col-sm-7 align-self-center">
                                            <p class="inv-to">Invoice To</p>
                                        </div>
                                        <div class="col-sm-5 align-self-center  text-sm-right order-sm-0 order-1">
                                            <p class="inv-detail-title">From : XYZ Company</p>
                                        </div>

                                        <div class="col-sm-7 align-self-center">
                                            <p class="inv-customer-name">Jesse Cory</p>
                                            <p class="inv-street-addr">405 Mulberry Rd. Mc Grady, NC, 28649</p>
                                            <p class="inv-email-address">redq@company.com</p>
                                        </div>
                                        <div class="col-sm-5 align-self-center  text-sm-right order-2">
                                            <p class="inv-list-number"><span class="inv-title">Invoice Number :
                                                </span> <span class="inv-number">[invoice number]</span></p>
                                            <p class="inv-created-date"><span class="inv-title">Invoice Date :
                                                </span> <span class="inv-date">20 Aug 2019</span></p>
                                            <p class="inv-due-date"><span class="inv-title">Due Date : </span>
                                                <span class="inv-date">26 Aug 2019</span>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row inv--product-table-section">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead class="">
                                                        <tr>
                                                            <th scope="col">S.No</th>
                                                            <th scope="col">Items</th>
                                                            <th class="text-right" scope="col">Qty</th>
                                                            <th class="text-right" scope="col">Unit Price</th>
                                                            <th class="text-right" scope="col">Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Electric Shaver</td>
                                                            <td class="text-right">20</td>
                                                            <td class="text-right">$300</td>
                                                            <td class="text-right">$2800</td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>Earphones</td>
                                                            <td class="text-right">49</td>
                                                            <td class="text-right">$500</td>
                                                            <td class="text-right">$7000</td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td>Wireless Router</td>
                                                            <td class="text-right">30</td>
                                                            <td class="text-right">$500</td>
                                                            <td class="text-right">$3500</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-sm-5 col-12 order-sm-0 order-1">
                                            <div class="inv--payment-info">
                                                <div class="row">
                                                    <div class="col-sm-12 col-12">
                                                        <h6 class=" inv-title">Payment Info:</h6>
                                                    </div>
                                                    <div class="col-sm-4 col-12">
                                                        <p class=" inv-subtitle">Bank Name: </p>
                                                    </div>
                                                    <div class="col-sm-8 col-12">
                                                        <p class="">Bank of America</p>
                                                    </div>
                                                    <div class="col-sm-4 col-12">
                                                        <p class=" inv-subtitle">Account Number : </p>
                                                    </div>
                                                    <div class="col-sm-8 col-12">
                                                        <p class="">1234567890</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-7 col-12 order-sm-1 order-0">
                                            <div class="inv--total-amounts text-sm-right">
                                                <div class="row">
                                                    <div class="col-sm-8 col-7">
                                                        <p class="">Sub Total: </p>
                                                    </div>
                                                    <div class="col-sm-4 col-5">
                                                        <p class="">$13300</p>
                                                    </div>
                                                    <div class="col-sm-8 col-7">
                                                        <p class="">Tax Amount: </p>
                                                    </div>
                                                    <div class="col-sm-4 col-5">
                                                        <p class="">$700</p>
                                                    </div>
                                                    <div class="col-sm-8 col-7">
                                                        <p class=" discount-rate">Discount : <span
                                                                class="discount-percentage">5%</span> </p>
                                                    </div>
                                                    <div class="col-sm-4 col-5">
                                                        <p class="">$700</p>
                                                    </div>
                                                    <div class="col-sm-8 col-7 grand-total-title">
                                                        <h4 class="">Grand Total : </h4>
                                                    </div>
                                                    <div class="col-sm-4 col-5 grand-total-amount">
                                                        <h4 class="">$14000</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div> --}}

                    </div>



                </div>

            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal-cerrar-venta" class="modal-dom" tabindex="-1" role="dialog"
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


                            <div class="mt-4 mb-4">
                                <select class="form-control" name="discount_sale_select" id="discount_sale_select" required>
                                    <option value="ninguno" selected>Ningun descuento</option>
                                    @foreach ( $descuentos as $descuento )
                                        <option value="{{ $descuento->id }}">{{ $descuento->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div id="dom_discount_type" style="display: none;">
                                <p class="mt-1">Descuento</p>
                                <div class="mb-4">
                                    <input class="input_precio" type="text" value="" name="discount_quantity">
                                </div>
                            </div>

                            <div class="mt-4 mb-4">
                                <select class="form-control" id="document_sale" name="document_sale" required>
                                    <option disabled selected>Seleccionar documento de pago</option>
                                    @foreach ( $documentos as $documento )
                                        <option value="{{ $documento->id }}">{{ $documento->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-4 mb-4">
                                <select class="form-control" name="payment_sale" id="payment_sale">
                                    <option value="ninguno">Pago en efectivo</option>
                                    @foreach ( $pagos as $pago )
                                        <option value="{{ $pago->id }}">{{ $pago->name }}</option>
                                    @endforeach
                                </select>
                            </div>

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

                                        <div class="item-timeline timeline-new" id="product_list_modal">
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

<!--  END CONTENT AREA  -->

@endsection
