$(document).on('input', '.search_client', function () {
    var query = $(this).val();
    searchAndUpdate('/buscar-cliente', query, '.inputs-clientes');
});

$(document).on('input', '.search_sale', function () {
    var query = $(this).val();
    searchAndUpdate('/buscar-venta', query, '.inputs-ventas');
});

$(document).on('input', '.search_purchase', function () {
    var query = $(this).val();
    searchAndUpdate('/buscar-compra', query, '.inputs-compras');
});

// -----------------------------------------------------------------
// FUNCIÓN BOTOBES NAVEGACION CAFA
// -----------------------------------------------------------------

// BOTON VENTAS
$(document).on('click', '.ver_ventas', function () {
    actualizarUI($(this));
    $(".inputs-compras").attr("style", "display: none !important");
    $(".inputs-clientes").attr("style", "display: none !important");
    $(".inputs-nueva-venta").attr("style", "display: none !important");
    $(".caja-panel-venta").attr("style", "display: none !important");
    $(".lista-productos").attr("style", "display: none !important");
    $(".inputs-ventas").attr("style", "display: block !important");
    $(".search_input").addClass("search_sale").removeClass("search_purchase search_client");
    $('.inputs-compras').children().remove();
    $("#background-productos").attr("style", "display: none !important");

    $("#background-facturas-head").remove();
    $("#background-facturas-body").remove();
    searchAndUpdate('/buscar-venta', 'vacio', '.inputs-ventas');
});

// BOTON COMPRAS
$(document).on('click', '.ver_compras', function () {
    actualizarUI($(this));
    $(".inputs-ventas").attr("style", "display: none !important");
    $(".inputs-clientes").attr("style", "display: none !important");
    $(".inputs-nueva-venta").attr("style", "display: none !important");
    $(".caja-panel-venta").attr("style", "display: none !important");
    $(".lista-productos").attr("style", "display: none !important");
    $(".inputs-compras").attr("style", "display: block !important");
    $('.inputs-compras').children().remove();
    $(".search_input").addClass("search_purchase").removeClass("search_sale search_client");
    $("#background-productos").attr("style", "display: none !important");

    $("#background-facturas-head").remove();
    $("#background-facturas-body").remove();
    searchAndUpdate('/buscar-compra', 'vacio', '.inputs-compras');
});

// BOTON CLIENTE
$(document).on('click', '.ver_clientes', function () {
    actualizarUI($(this));
    $(".inputs-ventas").attr("style", "display: none !important");
    $(".inputs-compras").attr("style", "display: none !important");
    $(".inputs-nueva-venta").attr("style", "display: none !important");
    $(".caja-panel-venta").attr("style", "display: none !important");
    $(".lista-productos").attr("style", "display: none !important");
    $(".inputs-clientes").attr("style", "display: block !important");
    $('.inputs-compras').children().remove();
    $(".search_input").addClass("search_client").removeClass("search_sale search_purchase");
    $("#background-productos").attr("style", "display: none !important");

    $("#background-facturas-head").remove();
    $("#background-facturas-body").remove();
});

// BOTON HACER VENTA
$(document).on('click', '.nueva_venta', function () {
    actualizarUI($(this));
    $(".inputs-ventas").attr("style", "display: none !important");
    $(".inputs-compras").attr("style", "display: none !important");
    $(".inputs-clientes").attr("style", "display: none !important");
    $(".inputs-nueva-venta").attr("style", "display: block !important; padding-bottom: 100px;");
    $(".lista-productos").attr("style", "display: block !important");
    $(".caja-panel-venta").attr("style", "display: flex !important");
    $("#background-productos").attr("style", "display: flex !important");

    $("#background-facturas-head").remove();
    $("#background-facturas-body").remove();
});

// -----------------------------------------------------------------
// TABLA VENTAS
// -----------------------------------------------------------------

$(document).on('click', '.abrir_venta', function () {

    const venta_id = $(this).attr("data");

    axios.get('/traer-venta/' + venta_id)
        .then((response) => {
            const data = response.data;
            console.log(data);
            $("#background-facturas-head").remove();
            $("#background-facturas-body").remove();

            let itemsHtml = '';
            data.products.forEach((item, index) => {
                const precio = item.sale_price;
                const subtotal = item.pivot.quantity * item.sale_price;
                itemsHtml += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.name}</td>
                        <td class="text-right">${item.pivot.quantity}</td>
                        <td class="text-right">S/.${caja.formatPrice(precio)}</td>
                        <td class="text-right">S/.${caja.formatPrice(subtotal)}</td>
                    </tr>
                `;
            });

            $(".invoice-inbox").append(
                `
                <div id="background-facturas-head" class="invoice-header-section" style="display:flex; background: white;">
                    <h4 class="inv-number"></h4>
                    <div class="invoice-action">

                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>

                        <svg onclick="deleteData('sales/${data.id}')" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                            <polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line>
                        </svg>

                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>

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

                <div id="background-facturas-body" id="ct" class="" style="display:block; background: white;">

                    <div>
                        <div class="content-section  animated animatedFadeInUp fadeInUp">

                            <div class="row inv--head-section">

                                <div class="col-sm-6 col-12">
                                    <h3 class="in-heading">${(data.accounting_document.name).toUpperCase()} DE VENTA</h3>
                                </div>
                                <div class="col-sm-6 col-12 align-self-center text-sm-right">
                                    <div class="company-info">
                                        <img src="http://casagas.test/img/logo-blanco-bloque.png" class="navbar-logo" alt="logo" style="height: 45px;">
                                    </div>
                                </div>

                            </div>

                            <div class="row inv--detail-section">

                                <div class="col-sm-7 align-self-center">
                                    <p class="inv-to" style="margin-bottom: 0px;">Emitida para:</p>
                                    <p class="inv-customer-name">${data.customer.name}</p>
                                </div>

                                <div class="col-sm-5 align-self-center  text-sm-right order-2">
                                    <p class="inv-list-number"><span class="inv-title">Número :
                                        </span> <span class="inv-number">${data.accounting_document_code}</span>
                                    </p>
                                    <p class="inv-created-date"><span class="inv-title">Fecha :
                                        </span> <span class="inv-date">${new Date(data.created_at).toLocaleDateString()}</span>
                                    </p>
                                </div>
                            </div>

                            <div class="row inv--product-table-section">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="">
                                                <tr>
                                                    <th scope="col">N</th>
                                                    <th scope="col">Nombre</th>
                                                    <th class="text-right" scope="col">Qty</th>
                                                    <th class="text-right" scope="col">Precio</th>
                                                    <th class="text-right" scope="col">Monto</th>
                                                </tr>
                                            </thead>
                                            <tbody>${itemsHtml}</tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-sm-5 col-12 order-sm-0 order-1">
                                    <div class="inv--payment-info">
                                        <div class="row">
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
                                                <p class="">S/.${data.total}</p>
                                            </div>
                                            <div class="col-sm-8 col-7">
                                                <p class="">Impuestos: </p>
                                            </div>
                                            <div class="col-sm-4 col-5">
                                                <p class="">S/.${data.tax}</p>
                                            </div>
                                            <div class="col-sm-8 col-7">
                                                <p class=" discount-rate">Descuentos : <span
                                                        class="discount-percentage">5%</span> </p>
                                            </div>
                                            <div class="col-sm-4 col-5">
                                                <p class="">S/.${data.discount}</p>
                                            </div>
                                            <div class="col-sm-8 col-7 grand-total-title">
                                                <h4 class="">Total : </h4>
                                            </div>
                                            <div class="col-sm-4 col-5 grand-total-amount">
                                                <h4 class="">S/.${data.total}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                `
            );
        })
        .catch((error) => {

        });
});

// -----------------------------------------------------------------
// TABLA VENTAS
// -----------------------------------------------------------------

$(document).on('click', '.abrir_compra', function () {

    const compra_id = $(this).attr("data");

    axios.get('/traer-compra/' + compra_id)
        .then((response) => {
            const data = response.data;

            $("#background-facturas-head").remove();
            $("#background-facturas-body").remove();

            let itemsHtml = '';
            data.products.forEach((item, index) => {
                const precio = item.sale_price;
                const subtotal = item.pivot.quantity * item.sale_price;
                itemsHtml += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.name}</td>
                        <td class="text-right">${item.pivot.quantity}</td>
                        <td class="text-right">S/.${this.formatPrice(precio)}</td>
                        <td class="text-right">S/.${this.formatPrice(subtotal)}</td>
                    </tr>
                `;
            });

            $(".invoice-inbox").append(
                `
                <div id="background-facturas-head" class="invoice-header-section" style="display:flex; background: white;">
                    <h4 class="inv-number"></h4>
                    <div class="invoice-action">

                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>

                        <svg onclick="deleteData('purchases/${data.id}')" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                            <polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line>
                        </svg>

                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>

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

                <div id="background-facturas-body" id="ct" class="" style="display:block; background: white;">

                    <div>
                        <div class="content-section  animated animatedFadeInUp fadeInUp">

                            <div class="row inv--head-section">

                                <div class="col-sm-6 col-12">
                                    <h3 class="in-heading">${(data.accounting_document.name).toUpperCase()} DE COMPRA</h3>
                                </div>
                                <div class="col-sm-6 col-12 align-self-center text-sm-right">
                                    <div class="company-info">
                                        <img src="http://casagas.test/img/logo-blanco-bloque.png" class="navbar-logo" alt="logo" style="height: 45px;">
                                    </div>
                                </div>

                            </div>

                            <div class="row inv--detail-section">

                                <div class="col-sm-7 align-self-center">
                                    <p class="inv-to" style="margin-bottom: 0px;">Emitida para:</p>
                                    <p class="inv-customer-name">${data.supplier.name}</p>
                                </div>

                                <div class="col-sm-5 align-self-center  text-sm-right order-2">
                                    <p class="inv-list-number"><span class="inv-title">Número :
                                        </span> <span class="inv-number">${data.accounting_document_code}</span>
                                    </p>
                                    <p class="inv-created-date"><span class="inv-title">Fecha :
                                        </span> <span class="inv-date">${new Date(data.created_at).toLocaleDateString()}</span>
                                    </p>
                                </div>
                            </div>

                            <div class="row inv--product-table-section">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="">
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Nombre</th>
                                                    <th class="text-right" scope="col">Qty</th>
                                                    <th class="text-right" scope="col">Precio</th>
                                                    <th class="text-right" scope="col">Monto</th>
                                                </tr>
                                            </thead>
                                            <tbody>${itemsHtml}</tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-sm-5 col-12 order-sm-0 order-1">
                                    <div class="inv--payment-info">
                                        <div class="row">
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
                                                <p class="">S/.${this.formatPrice(data.total)}</p>
                                            </div>
                                            <div class="col-sm-8 col-7">
                                                <p class="">Impuestos: </p>
                                            </div>
                                            <div class="col-sm-4 col-5">
                                                <p class="">S/.${this.formatPrice(data.tax)}</p>
                                            </div>
                                            <div class="col-sm-8 col-7">
                                                <p class=" discount-rate">Descuentos : <span
                                                        class="discount-percentage">5%</span> </p>
                                            </div>
                                            <div class="col-sm-4 col-5">
                                                <p class="">S/.${this.formatPrice(data.discount)}</p>
                                            </div>
                                            <div class="col-sm-8 col-7 grand-total-title">
                                                <h4 class="">Total : </h4>
                                            </div>
                                            <div class="col-sm-4 col-5 grand-total-amount">
                                                <h4 class="">S/.${this.formatPrice(data.total)}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                `
            );
        })
        .catch((error) => {

        });
});

// -----------------------------------------------------------------
// TABLA PRODUCTOS
// -----------------------------------------------------------------

$('.product-search').on('input', function() {
    var query = $(this).val();
    buscarProductos(query, 1);
});


$(document).on('click', '.btn_pag_prod', function(e) {
    e.preventDefault();
    var page = $(this).text();
    var query = $('#input-search').val();
    cargarProductos(page, query);
});

$(document).on('click', '.prev_product', function(e) {
    e.preventDefault();
    var currentPage = parseInt(localStorage.getItem("current_product"));
    if (currentPage > 1) {
        var query = $('#input-search').val();
        cargarProductos(currentPage - 1, query);
    }
});

$(document).on('click', '.next_product', function(e) {
    e.preventDefault();
    var currentPage = parseInt(localStorage.getItem("current_product"));
    var lastPage = parseInt(localStorage.getItem("last_product"));
    if (currentPage < lastPage) {
        var query = $('#input-search').val();
        cargarProductos(currentPage + 1, query);
    }
});

// -----------------------------------------------------------------
// VALIDAR VUELTOS
// -----------------------------------------------------------------

$(document).on('input', '#document_client', function(e) {
    this.value = this.value.replace(/\D/g, '');
});

