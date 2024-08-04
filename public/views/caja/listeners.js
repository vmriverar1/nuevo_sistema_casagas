$(document).on('input', '.search_sale', function () {
    var query = $(this).val();
    console.log(query);
    searchAndUpdate('/buscar-venta', query, '.inputs-ventas');
});


$(document).on('input', '.search_product', function () {
    const $searchInput = $(this);
    const query = $searchInput.val();
    const $suggestions = $('#suggestions');

    if (query.length >= 2) {  // Limitar las consultas demasiado cortas
        axios.get('/buscar-productos-todos', {
            params: { q: query }
        })
        .then(function (response) {
            const productos = response.data;
            $suggestions.empty();  // Limpiar las sugerencias anteriores

            productos.forEach(function (producto) {
                const option = `<option data-id="${producto.id}" value="${producto.name}"></option>`;
                $suggestions.append(option);
            });
        })
        .catch(function (error) {
            console.error('Error al buscar productos:', error);
        });
    }
});

$(document).on('change', '.search_product', function () {
    const $searchInput = $(this);
    const value = $searchInput.val();
    const $suggestions = $('#suggestions');
    const $option = $suggestions.find(`option[value="${value}"]`);
    const productId = $option.data('id');

    if (productId) {
        caja.obtenerProducto(productId);
        $(this).val('');
        $("#suggestions").html("");
    }
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
    caja.resetCash();
    actualizarUI($(this));

    $(".inputs-compras").attr("style", "display: none !important");
    $(".inputs-clientes").attr("style", "display: none !important");
    $(".inputs-nueva-venta").attr("style", "display: none !important");
    $(".caja-panel-venta").attr("style", "display: none !important");
    $(".lista-productos").attr("style", "display: none !important");
    $(".inputs-ventas").attr("style", "display: block !important");
    $('.inputs-compras').children().remove();
    $("#background-productos").attr("style", "display: none !important");
    $("#background-facturas-head").remove();
    $("#background-facturas-body").remove();

    searchAndUpdate('/buscar-venta', 'vacio', '.inputs-ventas');
    actualizarInput("sale");
});

// BOTON COMPRAS
$(document).on('click', '.ver_compras', function () {
    caja.resetCash();
    actualizarUI($(this));

    $(".inputs-ventas").attr("style", "display: none !important");
    $(".inputs-clientes").attr("style", "display: none !important");
    $(".inputs-nueva-venta").attr("style", "display: none !important");
    $(".caja-panel-venta").attr("style", "display: none !important");
    $(".lista-productos").attr("style", "display: none !important");
    $(".inputs-compras").attr("style", "display: block !important");
    $('.inputs-compras').children().remove();
    $("#background-productos").attr("style", "display: none !important");

    $("#background-facturas-head").remove();
    $("#background-facturas-body").remove();
    searchAndUpdate('/buscar-compra', 'vacio', '.inputs-compras');
    actualizarInput("purchase");
});

// BOTON HACER VENTA
$(document).on('click', '.nueva_venta', function () {
    caja.resetCash();
    caja.accion = 'venta';
    actualizarUI($(this));

    $(".inputs-ventas").attr("style", "display: none !important");
    $(".inputs-compras").attr("style", "display: none !important");
    $(".inputs-clientes").attr("style", "display: none !important");
    $(".inputs-nueva-venta").attr("style", "display: block !important; padding-bottom: 100px;");
    $(".lista-productos").attr("style", "display: block !important");
    $(".caja-panel-venta").attr("style", "display: flex !important");
    $("#background-productos").attr("style", "display: flex !important");
    // aparecemos botones de servicios y paquetes
    $(".btn-lista-servicios").attr("style", "display: block !important");
    $(".btn-lista-kits").attr("style", "display: block !important");
    // click en el boton de lista de productos
    $(".btn-lista-productos").click();

    $("#background-facturas-head").remove();
    $("#background-facturas-body").remove();
    actualizarInput("product");
});


// Función para actualizar el input de búsqueda
function actualizarInput(tipo) {
    const $searchInput = $(".search_input");
    const tipos = ["sale", "purchase", "client", "product"];
    tipos.forEach(t => $searchInput.removeClass(`search_${t}`));

    if (tipo === "product") {
        $searchInput.attr("list", "suggestions");
    } else {
        $searchInput.removeAttr("list");
    }

    $("#suggestions").html("");
    $(".search_input").val("");
    $searchInput.addClass(`search_${tipo}`);
}

// -----------------------------------------------------------------
// TABLA VENTAS
// -----------------------------------------------------------------

$(document).on('click', '.abrir_venta', function () {

    const venta_id = $(this).attr("data");

    axios.get('/traer-venta/' + venta_id)
        .then((response) => {

            const data = response.data;
            data.accion = 'ver_venta';
            data.modal_tipe = 'cobrar';
            caja.resetCash();
            console.log(data);

            caja.setCash(data);
            caja.id_venta = data.id;

            $("#background-facturas-head").remove();
            $("#background-facturas-body").remove();

            renderVenta(data);
        })
        .catch((error) => {
            console.error('Error al obtener la venta:', error);
        });
});

// -----------------------------------------------------------------
// TABLA XOMPRA
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

                <div id="background-facturas-body" id="ct" class="" style="display:block; background: white; height: 100%;">

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

// Evento click en el botón "+"
$(document).on('click', '.add_productos', function(e) {
    e.preventDefault();

    var productoId = $('#select-producto-agregar').val();
    var cantidad = $('#select-producto-cantidad').val();

    if (productoId && cantidad) {

        var existingProduct = caja.products.find(p => p.id === parseInt(productoId));
        if (existingProduct) {
            existingProduct.quantity = parseInt(existingProduct.quantity) + parseInt(cantidad);
            // Agregar HTML a la lista de productos
            $('.list_productos').append(
                `<div class="col-12">
                    <button class="btn btn-warning mt-1 close_product" style="width: 100%;" product_id="${existingProduct.id}" quantity="${cantidad}">
                        ${cantidad} ${existingProduct.name}
                    </button>
                </div>`
            );
        }else{
            axios.get('/producto/' + productoId)
                .then(function(response) {
                    var data = response.data;
                    data.quantity = cantidad;
                    // Agregar producto a la caja
                    caja.agregarProducto(data);

                    // Agregar HTML a la lista de productos
                    $('.list_productos').append(
                        `<div class="col-12">
                            <button class="btn btn-warning mt-1 close_product" style="width: 100%;" product_id="${data.id}" quantity="${cantidad}">
                                ${cantidad} ${data.name}
                            </button>
                        </div>`
                    );


                })
                .catch(function(error) {
                    console.error('Error al obtener el producto:', error);
                });
        }

        caja.calcularMonto();

    } else {
        alert('Selecciona un producto y una cantidad.');
    }

    // Limpiar el select y el input
    $('#select-producto-agregar').val(null).trigger('change');
    $('input[name="txt"]').val('');

    caja.actualizarStepsWizard();
    // esperar 1 segunso para actualizar los productos
    setTimeout(() => {
        caja.actualizarProductosModal();
    }, 1000);
});

// Evento click en el botón de cerrar producto
$(document).on('click', '.close_product', function(e) {
    e.preventDefault();
    var productId = $(this).attr('product_id');
    var element = $(this).closest('.col-12');

    // Eliminar producto de la caja
    caja.eliminarProducto(productId, element);
});

// -----------------------------------------------------------------
// VALIDAR VUELTOS
// -----------------------------------------------------------------

$(document).on('input', '#document_client', function(e) {
    this.value = this.value.replace(/\D/g, '');
});

