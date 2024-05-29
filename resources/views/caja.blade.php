@extends('layouts.app')

@section('content')

<!--  BEGIN CONTENT AREA  -->

<div class="layout-px-spacing">

    <div class="page-header">
        <div class="page-title">
            <h3>Invoice</h3>
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
                                <input type="text" class="form-control" placeholder="Buscar" aria-label="dropdown">
                                <div class="input-group-append">
                                    <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg> </button>
                                    <div class="dropdown-menu" style="will-change: transform;">
                                        <a class="dropdown-item ver_ventas" href="javascript:void(0);">Ventas</a>
                                        <a class="dropdown-item ver_compras" href="javascript:void(0);">Compras</a>
                                        <a class="dropdown-item ver_clientes" href="javascript:void(0);">Clientes</a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item nueva_venta" href="javascript:void(0);">Nueva Venta</a>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-pills inv-list-container d-block inputs-ventas" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00001" data-invoice-id="00001">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Vemta #00001</p>
                                                <p class="invoice-customer-name"><span>To:</span> Jesse Cory</p>
                                                <p class="invoice-generated-date">Date: 12 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00002" data-invoice-id="00002">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Vemta #00002</p>
                                                <p class="invoice-customer-name"><span>To:</span> Linda Nelson
                                                </p>
                                                <p class="invoice-generated-date">Date: 13 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00003" data-invoice-id="00003">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Vemta #00003</p>
                                                <p class="invoice-customer-name"><span>To:</span> Andy King</p>
                                                <p class="invoice-generated-date">Date: 13 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00004" data-invoice-id="00004">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Vemta #00004</p>
                                                <p class="invoice-customer-name"><span>To:</span> Luke Ivory</p>
                                                <p class="invoice-generated-date">Date: 13 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00005" data-invoice-id="00005">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Vemta #00005</p>
                                                <p class="invoice-customer-name"><span>To:</span> Susan Phillips
                                                </p>
                                                <p class="invoice-generated-date">Date: 14 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00006" data-invoice-id="00006">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Vemta #00006</p>
                                                <p class="invoice-customer-name"><span>To:</span> Thomas Granger
                                                </p>
                                                <p class="invoice-generated-date">Date: 15 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00007" data-invoice-id="00007">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Vemta #00007</p>
                                                <p class="invoice-customer-name"><span>To:</span> Donna Rogers
                                                </p>
                                                <p class="invoice-generated-date">Date: 16 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00008" data-invoice-id="00008">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Vemta #00008</p>
                                                <p class="invoice-customer-name"><span>To:</span> Angie Lamb</p>
                                                <p class="invoice-generated-date">Date: 17 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00009" data-invoice-id="00009">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Vemta #00009</p>
                                                <p class="invoice-customer-name"><span>To:</span> Mary Mcdonald
                                                </p>
                                                <p class="invoice-generated-date">Date: 17 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00010" data-invoice-id="00010">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Vemta #00010</p>
                                                <p class="invoice-customer-name"><span>To:</span> Thomas Granger
                                                </p>
                                                <p class="invoice-generated-date">Date: 18 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00011" data-invoice-id="00011">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Vemta #00011</p>
                                                <p class="invoice-customer-name"><span>To:</span> Sonia Shaw</p>
                                                <p class="invoice-generated-date">Date: 19 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00012" data-invoice-id="00012">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Vemta #00012</p>
                                                <p class="invoice-customer-name"><span>To:</span> Laurie Fox</p>
                                                <p class="invoice-generated-date">Date: 19 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00013" data-invoice-id="00013">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Vemta #00013</p>
                                                <p class="invoice-customer-name"><span>To:</span> Ryan McKillop
                                                </p>
                                                <p class="invoice-generated-date">Date: 19 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00014" data-invoice-id="00014">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Vemta #00014</p>
                                                <p class="invoice-customer-name"><span>To:</span> Jimmy Turner
                                                </p>
                                                <p class="invoice-generated-date">Date: 20 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00015" data-invoice-id="00015">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Vemta #00015</p>
                                                <p class="invoice-customer-name"><span>To:</span> Roxanne</p>
                                                <p class="invoice-generated-date">Date: 20 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <ul class="nav nav-pills inv-list-container d-block inputs-compras" id="pills-tab" role="tablist" style="display:none !important;">
                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00001" data-invoice-id="00001">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Gasto #00001</p>
                                                <p class="invoice-customer-name"><span>To:</span> Jesse Cory</p>
                                                <p class="invoice-generated-date">Date: 12 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00002" data-invoice-id="00002">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Gasto #00002</p>
                                                <p class="invoice-customer-name"><span>To:</span> Linda Nelson
                                                </p>
                                                <p class="invoice-generated-date">Date: 13 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00003" data-invoice-id="00003">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Gasto #00003</p>
                                                <p class="invoice-customer-name"><span>To:</span> Andy King</p>
                                                <p class="invoice-generated-date">Date: 13 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00004" data-invoice-id="00004">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Gasto #00004</p>
                                                <p class="invoice-customer-name"><span>To:</span> Luke Ivory</p>
                                                <p class="invoice-generated-date">Date: 13 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00005" data-invoice-id="00005">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Gasto #00005</p>
                                                <p class="invoice-customer-name"><span>To:</span> Susan Phillips
                                                </p>
                                                <p class="invoice-generated-date">Date: 14 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00006" data-invoice-id="00006">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Gasto #00006</p>
                                                <p class="invoice-customer-name"><span>To:</span> Thomas Granger
                                                </p>
                                                <p class="invoice-generated-date">Date: 15 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00007" data-invoice-id="00007">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Gasto #00007</p>
                                                <p class="invoice-customer-name"><span>To:</span> Donna Rogers
                                                </p>
                                                <p class="invoice-generated-date">Date: 16 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00008" data-invoice-id="00008">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Gasto #00008</p>
                                                <p class="invoice-customer-name"><span>To:</span> Angie Lamb</p>
                                                <p class="invoice-generated-date">Date: 17 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00009" data-invoice-id="00009">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Gasto #00009</p>
                                                <p class="invoice-customer-name"><span>To:</span> Mary Mcdonald
                                                </p>
                                                <p class="invoice-generated-date">Date: 17 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00010" data-invoice-id="00010">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Gasto #00010</p>
                                                <p class="invoice-customer-name"><span>To:</span> Thomas Granger
                                                </p>
                                                <p class="invoice-generated-date">Date: 18 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00011" data-invoice-id="00011">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Gasto #00011</p>
                                                <p class="invoice-customer-name"><span>To:</span> Sonia Shaw</p>
                                                <p class="invoice-generated-date">Date: 19 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00012" data-invoice-id="00012">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Gasto #00012</p>
                                                <p class="invoice-customer-name"><span>To:</span> Laurie Fox</p>
                                                <p class="invoice-generated-date">Date: 19 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00013" data-invoice-id="00013">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Gasto #00013</p>
                                                <p class="invoice-customer-name"><span>To:</span> Ryan McKillop
                                                </p>
                                                <p class="invoice-generated-date">Date: 19 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00014" data-invoice-id="00014">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Gasto #00014</p>
                                                <p class="invoice-customer-name"><span>To:</span> Jimmy Turner
                                                </p>
                                                <p class="invoice-generated-date">Date: 20 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00015" data-invoice-id="00015">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Gasto #00015</p>
                                                <p class="invoice-customer-name"><span>To:</span> Roxanne</p>
                                                <p class="invoice-generated-date">Date: 20 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <ul class="nav nav-pills inv-list-container d-block inputs-clientes" id="pills-tab" role="tablist" style="display:none !important;">
                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00001" data-invoice-id="00001">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Boleta #00001</p>
                                                <p class="invoice-customer-name"><span>To:</span> Jesse Cory</p>
                                                <p class="invoice-generated-date">Date: 12 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00002" data-invoice-id="00002">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Boleta #00002</p>
                                                <p class="invoice-customer-name"><span>Atendido por:</span> Linda Nelson
                                                </p>
                                                <p class="invoice-generated-date">Date: 13 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00003" data-invoice-id="00003">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Boleta #00003</p>
                                                <p class="invoice-customer-name"><span>Atendido por:</span> Andy King</p>
                                                <p class="invoice-generated-date">Date: 13 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00004" data-invoice-id="00004">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Boleta #00004</p>
                                                <p class="invoice-customer-name"><span>Atendido por:</span> Luke Ivory</p>
                                                <p class="invoice-generated-date">Date: 13 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00005" data-invoice-id="00005">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Boleta #00005</p>
                                                <p class="invoice-customer-name"><span>Atendido por:</span> Susan Phillips
                                                </p>
                                                <p class="invoice-generated-date">Date: 14 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00006" data-invoice-id="00006">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Boleta #00006</p>
                                                <p class="invoice-customer-name"><span>Atendido por:</span> Thomas Granger
                                                </p>
                                                <p class="invoice-generated-date">Date: 15 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00007" data-invoice-id="00007">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Boleta #00007</p>
                                                <p class="invoice-customer-name"><span>Atendido por:</span> Donna Rogers
                                                </p>
                                                <p class="invoice-generated-date">Date: 16 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00008" data-invoice-id="00008">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Boleta #00008</p>
                                                <p class="invoice-customer-name"><span>Atendido por:</span> Angie Lamb</p>
                                                <p class="invoice-generated-date">Date: 17 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00009" data-invoice-id="00009">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Boleta #00009</p>
                                                <p class="invoice-customer-name"><span>Atendido por:</span> Mary Mcdonald
                                                </p>
                                                <p class="invoice-generated-date">Date: 17 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00010" data-invoice-id="00010">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Boleta #00010</p>
                                                <p class="invoice-customer-name"><span>Atendido por:</span> Thomas Granger
                                                </p>
                                                <p class="invoice-generated-date">Date: 18 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00011" data-invoice-id="00011">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Boleta #00011</p>
                                                <p class="invoice-customer-name"><span>Atendido por:</span> Sonia Shaw</p>
                                                <p class="invoice-generated-date">Date: 19 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00012" data-invoice-id="00012">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Boleta #00012</p>
                                                <p class="invoice-customer-name"><span>Atendido por:</span> Laurie Fox</p>
                                                <p class="invoice-generated-date">Date: 19 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00013" data-invoice-id="00013">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Boleta #00013</p>
                                                <p class="invoice-customer-name"><span>Atendido por:</span> Ryan McKillop
                                                </p>
                                                <p class="invoice-generated-date">Date: 19 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00014" data-invoice-id="00014">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Boleta #00014</p>
                                                <p class="invoice-customer-name"><span>Atendido por:</span> Jimmy Turner
                                                </p>
                                                <p class="invoice-generated-date">Date: 20 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-00015" data-invoice-id="00015">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <p class="invoice-number">Boleta #00015</p>
                                                <p class="invoice-customer-name"><span>Atendido por:</span> Roxanne</p>
                                                <p class="invoice-generated-date">Date: 20 Apr 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <ul class="nav nav-pills inv-list-container d-block inputs-nueva-venta" id="pills-tab" role="tablist" style="display:none !important;">
                                <li class="nav-item">
                                    <div class="nav-link list-actions producto-output">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <p class="invoice-number mt-1">Producto 1</p>
                                            </div>
                                            <div class="f-body">
                                                <div class="mb-1 btn-group">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>

                                                    <input class="input_cantidad" type="text" value="">
                                                </div>
                                                <p class="invoice-customer-name"><span>Total:</span> S/.100</p>
                                                <p class="invoice-generated-date">Precio uitario: 100</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <div class="nav-link list-actions producto-output">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <p class="invoice-number mt-1">Producto 1</p>
                                            </div>
                                            <div class="f-body">
                                                <div class="mb-1 btn-group">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>

                                                    <input class="input_cantidad" type="text" value="">
                                                </div>
                                                <p class="invoice-customer-name"><span>Total:</span> S/.100</p>
                                                <p class="invoice-generated-date">Precio uitario: 100</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <div class="nav-link list-actions producto-output">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <p class="invoice-number mt-1">Producto 1</p>
                                            </div>
                                            <div class="f-body">
                                                <div class="mb-1 btn-group">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>

                                                    <input class="input_cantidad" type="text" value="">
                                                </div>
                                                <p class="invoice-customer-name"><span>Total:</span> S/.100</p>
                                                <p class="invoice-generated-date">Precio uitario: 100</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <div class="nav-link list-actions producto-output">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <p class="invoice-number mt-1">Producto 1</p>
                                            </div>
                                            <div class="f-body">
                                                <div class="mb-1 btn-group">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>

                                                    <input class="input_cantidad" type="text" value="">
                                                </div>
                                                <p class="invoice-customer-name"><span>Total:</span> S/.100</p>
                                                <p class="invoice-generated-date">Precio uitario: 100</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <div class="nav-link list-actions producto-output">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <p class="invoice-number mt-1">Producto 1</p>
                                            </div>
                                            <div class="f-body">
                                                <div class="mb-1 btn-group">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>

                                                    <input class="input_cantidad" type="text" value="">
                                                </div>
                                                <p class="invoice-customer-name"><span>Total:</span> S/.100</p>
                                                <p class="invoice-generated-date">Precio uitario: 100</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <div class="nav-link list-actions producto-output">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <p class="invoice-number mt-1">Producto 1</p>
                                            </div>
                                            <div class="f-body">
                                                <div class="mb-1 btn-group">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>

                                                    <input class="input_cantidad" type="text" value="">
                                                </div>
                                                <p class="invoice-customer-name"><span>Total:</span> S/.100</p>
                                                <p class="invoice-generated-date">Precio uitario: 100</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <div class="nav-link list-actions producto-output">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <p class="invoice-number mt-1">Producto 1</p>
                                            </div>
                                            <div class="f-body">
                                                <div class="mb-1 btn-group">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>

                                                    <input class="input_cantidad" type="text" value="">
                                                </div>
                                                <p class="invoice-customer-name"><span>Total:</span> S/.100</p>
                                                <p class="invoice-generated-date">Precio uitario: 100</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <div class="nav-link list-actions producto-output">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <p class="invoice-number mt-1">Producto 1</p>
                                            </div>
                                            <div class="f-body">
                                                <div class="mb-1 btn-group">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>

                                                    <input class="input_cantidad" type="text" value="">
                                                </div>
                                                <p class="invoice-customer-name"><span>Total:</span> S/.100</p>
                                                <p class="invoice-generated-date">Precio uitario: 100</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                            <ul class="nav nav-pills inv-list-container d-block comanda" id="pills-tab" role="tablist" style="display:none !important;">
                            </ul>
                            <div class="input-group caja-panel-venta" style="display:none !important;">
                                <button class="btn btn-lg btn-primary btn-block caja-panel-cerrar-venta" style="border-radius: 0px 0px .3rem .3rem;">Cobrar S/.1440</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="invoice-container">
                    <div class="invoice-inbox" style="height: calc(-180px + 100vh);">

                        <div class="inv-not-selected">
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
                                        <a class="nav-link" id="kits" role="tab" aria-controls="kits" aria-selected="false"><b>Kits</b></a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="simpletabContent">
                                    <div class="tab-pane fade show active" id="productos" role="tabpanel" aria-labelledby="productos-tab">

                                        <div class="card-list-head">
                                            <div class="col-lg-12 col-md-12 col-sm-12 filtered-list-search mx-auto" style="margin-bottom: 10px;">
                                                <form class="form-inline my-2 my-lg-0 justify-content-center">
                                                    <div class="w-100">
                                                        <input type="text" class="w-100 form-control product-search br-30" id="input-search" placeholder="Buscar producto">
                                                        <button class="btn btn-primary" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="card-list-body">
                                            <div class="card component-card_2 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <img src="{{ asset('img/400x300.jpg') }}" class="card-img-top" alt="widget-card-2">
                                                <div class="card-body">
                                                    <h5 class="card-title">Producto 1</h5>
                                                    <a href="#" class="btn btn-primary">Agregar</a>
                                                </div>
                                            </div>

                                            <div class="card component-card_2 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <img src="{{ asset('img/400x300.jpg') }}" class="card-img-top" alt="widget-card-2">
                                                <div class="card-body">
                                                    <h5 class="card-title">Producto 2</h5>
                                                    <a href="#" class="btn btn-primary">Agregar</a>
                                                </div>
                                            </div>

                                            <div class="card component-card_2 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <img src="{{ asset('img/400x300.jpg') }}" class="card-img-top" alt="widget-card-2">
                                                <div class="card-body">
                                                    <h5 class="card-title">Producto 3</h5>
                                                    <a href="#" class="btn btn-primary">Agregar</a>
                                                </div>
                                            </div>

                                            <div class="card component-card_2 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <img src="{{ asset('img/400x300.jpg') }}" class="card-img-top" alt="widget-card-2">
                                                <div class="card-body">
                                                    <h5 class="card-title">Producto 4</h5>
                                                    <a href="#" class="btn btn-primary">Agregar</a>
                                                </div>
                                            </div>

                                            <div class="card component-card_2 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <img src="{{ asset('img/400x300.jpg') }}" class="card-img-top" alt="widget-card-2">
                                                <div class="card-body">
                                                    <h5 class="card-title">Producto 4</h5>
                                                    <a href="#" class="btn btn-primary">Agregar</a>
                                                </div>
                                            </div>

                                            <div class="card component-card_2 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <img src="{{ asset('img/400x300.jpg') }}" class="card-img-top" alt="widget-card-2">
                                                <div class="card-body">
                                                    <h5 class="card-title">Producto 4</h5>
                                                    <a href="#" class="btn btn-primary">Agregar</a>
                                                </div>
                                            </div>

                                            <div class="card component-card_2 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <img src="{{ asset('img/400x300.jpg') }}" class="card-img-top" alt="widget-card-2">
                                                <div class="card-body">
                                                    <h5 class="card-title">Producto 4</h5>
                                                    <a href="#" class="btn btn-primary">Agregar</a>
                                                </div>
                                            </div>

                                            <div class="card component-card_2 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <img src="{{ asset('img/400x300.jpg') }}" class="card-img-top" alt="widget-card-2">
                                                <div class="card-body">
                                                    <h5 class="card-title">Producto 4</h5>
                                                    <a href="#" class="btn btn-primary">Agregar</a>
                                                </div>
                                            </div>

                                            <div class="card component-card_2 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <img src="{{ asset('img/400x300.jpg') }}" class="card-img-top" alt="widget-card-2">
                                                <div class="card-body">
                                                    <h5 class="card-title">Producto 4</h5>
                                                    <a href="#" class="btn btn-primary">Agregar</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-list-footer">
                                            <div class="pagination-no_spacing">
                                                <ul class="pagination">
                                                    <li><a href="javascript:void(0);" class="prev"><svg> ... </svg></a></li>
                                                    <li><a href="javascript:void(0);">1</a></li>
                                                    <li><a href="javascript:void(0);" class="active">2</a></li>
                                                    <li><a href="javascript:void(0);">3</a></li>
                                                    <li><a href="javascript:void(0);" class="next"><svg> ... </svg></a></li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="servicios" role="tabpanel" aria-labelledby="servicios-tab">
                                        <p class="">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </div>
                                    <div class="tab-pane fade" id="kits" role="tabpanel" aria-labelledby="kits-tab">
                                        <p class="">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="invoice-header-section">
                            <h4 class="inv-number"></h4>
                            <div class="invoice-action">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-printer action-print"
                                    data-toggle="tooltip" data-placement="top" data-original-title="Reply">
                                    <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                    <path
                                        d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2">
                                    </path>
                                    <rect x="6" y="14" width="12" height="8"></rect>
                                </svg>
                            </div>
                        </div>

                        <div id="ct" class="">

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

                            <div class="invoice-00002">
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
                                            <p class="inv-customer-name">Linda Nelson</p>
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

                            <div class="invoice-00003">
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
                                            <p class="inv-customer-name">Andy King</p>
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

                            <div class="invoice-00004">
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
                                            <p class="inv-customer-name">Luke Ivory</p>
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

                            <div class="invoice-00005">
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
                                            <p class="inv-customer-name">Susan Phillips</p>
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

                            <div class="invoice-00006">
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
                                            <p class="inv-customer-name">Thomas Granger</p>
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

                            <div class="invoice-00007">
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
                                            <p class="inv-customer-name">Donna Rogers</p>
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

                            <div class="invoice-00008">
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
                                            <p class="inv-customer-name">Angie Lamb</p>
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

                            <div class="invoice-00009">
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
                                            <p class="inv-customer-name">Mary Mcdonald</p>
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

                            <div class="invoice-00010">
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
                                            <p class="inv-customer-name">Thomas Granger</p>
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

                            <div class="invoice-00011">
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
                                            <p class="inv-customer-name">Sonia Shaw</p>
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

                            <div class="invoice-00012">
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
                                            <p class="inv-customer-name">Laurie Fox</p>
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

                            <div class="invoice-00013">
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
                                            <p class="inv-customer-name">Ryan McKillop</p>
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

                            <div class="invoice-00014">
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
                                            <p class="inv-customer-name">Jimmy Turner</p>
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

                            <div class="invoice-00015">
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
                                            <p class="inv-customer-name">Roxanne</p>
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
                        </div>


                    </div>



                </div>

            </div>

        </div>
    </div>
</div>



<div class="modal fade" id="modal-cerar-venta" class="modal-dom" tabindex="-1" role="dialog"
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

                <div id="circle-basic" class="">
                    <h3>Cliente</h3>
                    <section>

                        <p class="mt-1">Buscar cliente</p>
                        <div class="input-group mb-4">
                            <input type="text" class="form-control" placeholder="Ingresa DNI de cliente" aria-label="Recipient's username">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-zoom-in">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <h3 class="in-heading" style="text-align: center;">JUAN MANUEL LOPES SUAREZ</h3>

                        <p class="mt-5">Tipo de venta</p>
                        <div class="mb-4">
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>Seleccionar pago</option>
                                <option>En Partes</option>
                                <option>Por cobrar</option>
                                <option>Cobrado</option>
                            </select>
                        </div>

                    </section>
                    <h3>Pago</h3>
                    <section>

                        <p class="mt-1">Descuento</p>
                        <div class="mb-4">
                            <input id="input_descuento" type="text" value="0" name="demo1">
                        </div>

                        <p class="mt-1">Pago inicial</p>
                        <div class="mb-4">
                            <input id="input_pago_inicial" type="text" value="0" name="demo1">
                        </div>



                    </section>
                    <h3>Productos</h3>
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

                    <h3>Detalle</h3>
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
