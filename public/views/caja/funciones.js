$(document).ready(function() {
    cargarProductos();
    cargarServicios();
    cargarPaquetes();
});

// ============================================
// PRODUCTOS
// ============================================

function buscarProductos(query, page = 1) {
    axios.get('/buscar-productos', { params: { search: query, page: page } })
        .then(function(response) {
            actualizarListaProductos(response.data.products);
            actualizarPaginacion(response.data.pagination);
        })
        .catch(function(error) {
            console.error('Error al buscar productos:', error);
        });
}

function cargarProductos(page = 1, query = '') {
    axios.get('/buscar-productos', { params: { page: page, search: query } })
        .then(function(response) {
            actualizarListaProductos(response.data.products);
            actualizarPaginacion(response.data.pagination);
        })
        .catch(function(error) {
            cargarProductos();
            console.error('Error al cargar productos:', error);
        });
}

function actualizarListaProductos(productos) {
    var $lista = $('#product-list');
    $lista.empty();

    productos.forEach(function(producto) {
        var imagen = (producto.photo == 'default.jpg') ? 'storage/product/default.jpg' : producto.photo;
        var item = `
            <div class="card component-card_2 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <img src="${imagen}" class="card-img-top" alt="widget-card-2">
                <div class="card-body">
                    <h5 class="card-title">${producto.name} (${producto.stock} Unidades)</h5>
                    <a href="#" class="btn btn-primary agregar-producto" data-id="${producto.id}">Agregar</a>
                </div>
            </div>
        `;
        $lista.append(item);
    });
}

function cargarServicios(page = 1, query = '') {
    axios.get('/buscar-servicios', { params: { page: page, search: query } })
        .then(function(response) {
            actualizarListaServicios(response.data.products);
            actualizarPaginacion(response.data.pagination, 'pagination-servicios');
        })
        .catch(function(error) {
            cargarServicios();
            console.error('Error al cargar productos:', error);
        });
}

function actualizarListaServicios(productos) {
    var $lista = $('#service-list');
    $lista.empty();

    productos.forEach(function(producto) {
        var imagen = (producto.photo == 'default.jpg') ? 'storage/product/default.jpg' : producto.photo;
        var item = `
            <div class="card component-card_2 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <img src="${imagen}" class="card-img-top" alt="widget-card-2">
                <div class="card-body">
                    <h5 class="card-title">${producto.name}</h5>
                    <a href="#" class="btn btn-primary agregar-producto" data-id="${producto.id}">Agregar</a>
                </div>
            </div>
        `;
        $lista.append(item);
    });
}

function cargarPaquetes(page = 1, query = '') {
    axios.get('/buscar-paquetes', { params: { page: page, search: query } })
        .then(function(response) {
            actualizarListaPaquetes(response.data.products);
            actualizarPaginacion(response.data.pagination, 'pagination-kits');
        })
        .catch(function(error) {
            cargarPaquetes();
            console.error('Error al cargar productos:', error);
        });
}

function actualizarListaPaquetes(productos) {
    var $lista = $('#kit-list');
    $lista.empty();

    productos.forEach(function(producto) {
        var imagen = (producto.photo == 'default.jpg') ? 'storage/product/default.jpg' : producto.photo;
        var item = `
            <div class="card component-card_2 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <img src="${imagen}" class="card-img-top" alt="widget-card-2">
                <div class="card-body">
                    <h5 class="card-title">${producto.name} (${producto.stock} Unidades)</h5>
                    <a href="#" class="btn btn-primary agregar-producto" data-id="${producto.id}">Agregar</a>
                </div>
            </div>
        `;
        $lista.append(item);
    });
}

function actualizarPaginacion(pagination, clase_paginacion = 'pagination-productos') {
    var $paginationContainer = $(`.${clase_paginacion}`);
    var currentPage = pagination.current_page;
    var lastPage = pagination.last_page;

    localStorage.setItem("current_product", currentPage);
    localStorage.setItem("last_product", lastPage);


    if (lastPage <= 1) {
        $paginationContainer.empty();
        return;
    }

    var paginationHTML = '<div class="pagination-no_spacing"><ul class="pagination pag_productos" page="'+currentPage+'">';

    if (currentPage > 1) {
        paginationHTML += '<li><a href="javascript:void(0);" class="prev_product"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg></a></li>';
    }else{
        paginationHTML += '<li><a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left" style="color: #b2b2b2;"><polyline points="15 18 9 12 15 6"></polyline></svg></a></li>';
    }

    for (var i = 1; i <= lastPage; i++) {
        if (i === currentPage) {
            paginationHTML += '<li><a href="javascript:void(0);" class="active btn_pag_prod">' + i + '</a></li>';
        } else {
            paginationHTML += '<li><a href="javascript:void(0);" class="btn_pag_prod">' + i + '</a></li>';
        }
    }

    if (currentPage < lastPage) {
        paginationHTML += '<li><a href="javascript:void(0);" class="next_product"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></a></li>';
    }else{
        paginationHTML += '<li><a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right" style="color: #b2b2b2;"><polyline points="9 18 15 12 9 6"></polyline></svg></a></li>';
    }

    paginationHTML += '</ul></div>';
    $paginationContainer.html(paginationHTML);
}

// ============================================
// VENTAS
// ============================================

function traerVentas(){
    axios.get('/traer-ventas')
        .then(function(response) {
            actualizarListaVentas(response.data.sales);
        })
        .catch(function(error) {
            console.error('Error al cargar ventas:', error);
        });
}

function renderVenta(data) {
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

    let btn_editar_venta = '';
    let btn_adelanto_venta = '';
    let btn_agregar_productos = '';
    let titulo_documento = (data.accounting_document) ? (data.accounting_document.name.toUpperCase() + ' DE VENTA') : 'SIN DOCUMENTO DE VENTA';
    let data_in_parts = '';
    let titulo_total = 'Total :';

    if (data.status == 'in_process' || data.status == 'in_parts') {
        btn_editar_venta = `<svg onclick="editSale('/editar_venta/${data.id}')" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>`;

        btn_agregar_productos = `<svg onclick="addProductModal('/agregar_productos/${data.id}')" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>`;

        titulo_documento = 'EN PROCESO';
        titulo_total = 'Por pagar :';

        if (data.status == 'in_parts') {
            titulo_documento = 'EN PARTES';
            btn_adelanto_venta = `<svg onclick="paySale('/editar_venta/${data.id}')" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>`;

            let advances = 0;
            data.advances.forEach((advance) => {
                let adelanto = parseFloat(advance.advance_amount);
                advances += adelanto;
            });
            let deuda_final = data.amount - advances;
            advances = advances.toFixed(2);
            deuda_final = deuda_final.toFixed(2);

            data_in_parts = `
                <div class="col-sm-8 col-7 grand-total-title" style="padding-bottom: 5px;">
                    <h4 class="">Total pagado : </h4>
                </div>
                <div class="col-sm-4 col-5 grand-total-amount" style="padding-bottom: 5px;">
                    <h4 class="">S/.${advances}</h4>
                </div>
                <div class="col-sm-8 col-7 grand-total-title" style="border-top: 1px solid; padding-top: 5px;">
                    <h4 class="">Total por pagar: </h4>
                </div>
                <div class="col-sm-4 col-5 grand-total-amount" style="border-top: 1px solid; padding-top: 5px;">
                    <h4 class="">S/.${deuda_final}</h4>
                </div>`;
        }
    }

    $(".invoice-inbox").append(`
        <div id="background-facturas-head" class="invoice-header-section" style="display:flex; background: white;">
            <h4 class="inv-number"></h4>
            <div class="invoice-action">
                ${btn_editar_venta}
                <svg onclick="addClientModal()" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                <svg onclick="deleteDataSale('sales/${data.id}')" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                    <polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y1="17"></line><line x1="14" y1="11" x2="14" y1="17"></line>
                </svg>
                ${btn_adelanto_venta}
                ${btn_agregar_productos}
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
                            <h3 class="in-heading">${titulo_documento}</h3>
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
                            <p class="inv-customer-name">${(data.customer) ? data.customer.name : 'Anónimo'}</p>
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
                                        <p class="">S/.${data.amount}</p>
                                    </div>
                                    <div class="col-sm-8 col-7">
                                        <p class="">Impuestos: </p>
                                    </div>
                                    <div class="col-sm-4 col-5">
                                        <p class="">S/.${data.tax ? data.tax : '0.00'}</p>
                                    </div>
                                    <div class="col-sm-8 col-7">
                                        <p class=" discount-rate">Descuentos : <span
                                                class="discount-percentage">${(data.discounts.length == 0) ? '0%' : '5%'}</span> </p>
                                    </div>
                                    <div class="col-sm-4 col-5">
                                        <p class="">S/.${(data.discounts.length == 0) ? data.discount : '0.00'}</p>
                                    </div>
                                    <div class="col-sm-8 col-7 grand-total-title">
                                        <h4 class="">${titulo_total}</h4>
                                    </div>
                                    <div class="col-sm-4 col-5 grand-total-amount">
                                        <h4 class="">S/.${data.amount}</h4>
                                    </div>
                                    ${data_in_parts}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    `);
}

function actualizarListaVentas(ventas) {
    var $lista = $('#sale-list');
    $lista.empty();
}

function submitFormPay(formSelector) {
    const $form = $(formSelector);
    const formData = new FormData();

    console.log("submitFormPay");

    // Recoger los datos del formulario
    $form.find('input, select, textarea').each(function() {
        const input = $(this);

        if (input.attr('type') === 'file') {
            if (input[0].files.length > 0) {
                const fileName = input.attr('name').startsWith('requerimiento') ? input.attr('name') : 'photo';
                formData.append(fileName, input[0].files[0]);
            }
        } else if (input.attr('type') === 'checkbox') {
            formData.append(input.attr('name'), input.prop('checked'));
        } else if (input.is('select[multiple]')) {
            const values = input.val();
            if (values) {
                values.forEach(value => {
                    formData.append(input.attr('name') + '[]', value);
                });
            }
        } else {
            formData.append(input.attr('name'), input.val());
        }
    });

    if (caja) {
        formData.append('caja', JSON.stringify(caja));
    }

    // Enviar los datos utilizando Axios
    axios.post('/hacer_venta', formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
    .then(response => {

        console.log(response.data);
        // desacticamos el boton de terminar venta
        $("#modal-cerrar-venta").find('.wizard').find('.actions ul').find('.btn-next').prop('disabled', false);
        // Cerrar el modal si está dentro de uno
        $("#modal-cerrar-venta").modal('hide');
        // Limpiar caja
        if (caja && typeof caja.resetCash === 'function') {
            caja.resetCash();
        }

        cargarProductos();
        cargarServicios();
        cargarPaquetes();
    })
    .catch(error => {
        $("#modal-cerrar-venta").find('.wizard').find('.actions ul').find('.btn-next').prop('disabled', false);
        console.error(error);
        // Manejar los errores aquí, por ejemplo, mostrar mensajes de error en el modal
        alert('Ha ocurrido un error. Por favor, inténtelo de nuevo.');
    });
}

function updateFormPay(formSelector,route) {

    const $form = $(formSelector);
    const formData = new FormData();

    // Recoger los datos del formulario
    $form.find('input, select, textarea').each(function() {
        const input = $(this);

        if (input.attr('type') === 'file') {
            if (input[0].files.length > 0) {
                const fileName = input.attr('name').startsWith('requerimiento') ? input.attr('name') : 'photo';
                formData.append(fileName, input[0].files[0]);
            }
        } else if (input.attr('type') === 'checkbox') {
            formData.append(input.attr('name'), input.prop('checked'));
        } else if (input.is('select[multiple]')) {
            const values = input.val();
            if (values) {
                values.forEach(value => {
                    formData.append(input.attr('name') + '[]', value);
                });
            }
        } else {
            formData.append(input.attr('name'), input.val());
        }
    });

    if (caja) {
        formData.append('caja', JSON.stringify(caja));
    }

    // Añadir el método PUT al formulario
    formData.append('_method', 'POST');

    // Enviar los datos utilizando Axios
    axios.post(route, formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
    .then(response => {
        console.log(response.data);
        // desacticamos el boton de terminar venta
        $("#modal-cobrar-venta").find('.wizard').find('.actions ul').find('.btn-next').prop('disabled', false);
        // Cerrar el modal si está dentro de uno
        $("#modal-cobrar-venta").modal('hide');
        // Limpiar caja
        if (caja && typeof caja.resetCash === 'function') {
            caja.resetCash();
        }

        $(".ver_ventas").click();

        const venta_id = response.data.id;

        axios.get('/traer-venta/' + venta_id)
            .then(response => {
                const data = response.data;
                renderVenta(data);
            })
            .catch(error => {
                console.error('Error al obtener la venta:', error);
                alert(`Error al obtener la venta: ${error.response?.data?.error || error.message}`);
            });
    })
    .catch(error => {
        console.error(error);
        // Manejar los errores aquí, por ejemplo, mostrar mensajes de error en el modal
        alert('Ha ocurrido un error. Por favor, inténtelo de nuevo.');
    });
}


function updateFormProduct(formSelector,route) {

    const $form = $(formSelector);
    const formData = new FormData();

    // Recoger los datos del formulario
    $form.find('input, select, textarea').each(function() {
        const input = $(this);

        if (input.attr('type') === 'file') {
            if (input[0].files.length > 0) {
                const fileName = input.attr('name').startsWith('requerimiento') ? input.attr('name') : 'photo';
                formData.append(fileName, input[0].files[0]);
            }
        } else if (input.attr('type') === 'checkbox') {
            formData.append(input.attr('name'), input.prop('checked'));
        } else if (input.is('select[multiple]')) {
            const values = input.val();
            if (values) {
                values.forEach(value => {
                    formData.append(input.attr('name') + '[]', value);
                });
            }
        } else {
            formData.append(input.attr('name'), input.val());
        }
    });

    if (caja) {
        formData.append('caja', JSON.stringify(caja));
    }

    // Añadir el método PUT al formulario
    formData.append('_method', 'POST');

    // Enviar los datos utilizando Axios
    axios.post(route, formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
    .then(response => {
        console.log(response.data);
        // desacticamos el boton de terminar venta
        $("#modal-producto-venta").find('.wizard').find('.actions ul').find('.btn-next').prop('disabled', false);
        // Cerrar el modal si está dentro de uno
        $("#modal-producto-venta").modal('hide');
        // Limpiar caja
        if (caja && typeof caja.resetCash === 'function') {
            caja.resetCash();
        }

        $(".ver_ventas").click();

        const venta_id = response.data.id;
        axios.get('/traer-venta/' + venta_id)
            .then(response => {
                const data = response.data;
                renderVenta(data);
            })
            .catch(error => {
                console.error('Error al obtener la venta:', error);
                alert(`Error al obtener la venta: ${error.response?.data?.error || error.message}`);
            });

    })
    .catch(error => {
        console.error(error);
        // Manejar los errores aquí, por ejemplo, mostrar mensajes de error en el modal
        alert('Ha ocurrido un error. Por favor, inténtelo de nuevo.');
    });
}

function deleteDataSale(route) {
    var $modal = $('#modal-anular-venta');
    var $wizard = $modal.find('.wizard_sale');
    var $form = $modal.find('form');

    // Mostrar el modal
    $modal.modal('show');

    if ($wizard.length > 0) {
        var formValidator = $form.validate({
            ignore: ":disabled,:hidden",
            rules: {
                motivo_anulacion: {
                    required: true
                }
            },
            messages: {
                motivo_anulacion: {
                    required: "El motivo de anulación es requerido"
                }
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            }
        });

        $form[0].reset();
        formValidator.resetForm();
        $form.find('.form-control').removeClass('is-invalid');
        $form.find('.error').removeClass('error');

        $wizard.each(function() {
            console.log("Inicializando wizard para:", this);
            $(this).steps({
                headerTag: "h3",
                bodyTag: "section",
                transitionEffect: "slideLeft",
                autoFocus: true,
                cssClass: 'circle wizard',
                onStepChanging: function (event, currentIndex, newIndex) {
                    $form.validate().settings.ignore = ":disabled,:hidden";
                    return $form.valid();
                },
                onFinishing: function (event, currentIndex) {
                    $form.validate().settings.ignore = ":disabled";
                    return $form.valid();
                },
                onFinished: function (event, currentIndex) {
                    deleteDataForm(route, $form);
                }
            });
        });
    }

    $modal.modal('show');
}

function deleteDataForm(route, $form) {
    if (confirm('¿Estás seguro de que deseas eliminar este elemento?')) {
        var formData = $form.serializeArray();
        formData.push({ name: '_method', value: 'DELETE' });
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        formData.push({ name: '_token', value: csrfToken });

        $.ajax({
            url: route,
            type: 'POST',
            data: $.param(formData),
            success: function(response) {
                // Maneja la respuesta del servidor aquí
                console.log("Venta anulada exitosamente:", response);
                $('#modal-anular-venta').modal('hide');
                $(".ver_ventas").click();
            },
            error: function(xhr) {
                // Maneja el error del servidor aquí
                console.error("Error al anular la venta:", xhr);
            }
        });
    }
}

async function paySale(route) {
    await paySaleDest();
    await paySaleInit(route);
}

async function paySaleDest(){

    return new Promise((resolve) => {
        // Destruir wizard
        var $modal = $('#modal-cobrar-venta');
        var $wizard = $modal.find('.wizard_cobrar_venta');

        if ($wizard.length > 0) {
            $wizard.each(function() {
                var wizardInstance = $(this);
                if (wizardInstance.data('steps')) {
                    wizardInstance.steps('destroy');
                }
            });
        }

        // Destruir file-upload
        $modal.find('.custom-file-container').each(function() {
            var uploadId = $(this).data('upload-id');
            if (uploadId) {
                new FileUploadWithPreview(uploadId).clearPreviewPanel();
            }
        });

        // Destruir select2
        $modal.find(".select2_modal").each(function() {
            var $this = $(this);

            if ($this.hasClass("select2-hidden-accessible")) {
                $this.select2('destroy');
                $(".select2-container").remove();
            } else {
            }
        });

        // destruir botones de Touchsan
        $modal.find(".input-group-prepend").remove();
        $modal.find(".input-group-append").remove();

        resolve();
    });
}

async function paySaleInit(route){
    return new Promise((resolve) => {
        var $modal = $('#modal-cobrar-venta');
        var $wizard = $modal.find('.wizard_cobrar_venta');
        var $form = $modal.find('form');
        if ($wizard.length > 0) {
            var formValidator = $form.validate({
                ignore: ":disabled,:hidden",
                rules: {
                    password: {
                        required: true,
                        minlength: 8
                    },
                    "verify-password": {
                        required: true,
                        minlength: 8,
                        equalTo: "input[name='password']"
                    },
                    role: {
                        required: true
                    },
                    document_type: {
                        required: true
                    },
                    "categories[]": {
                        select2Required: true
                    },
                    "requirements[]": {
                        select2Required: true
                    }
                },
                messages: {
                    password: {
                        required: "Este dato es requerido",
                        minlength: "La contraseña debe tener al menos 8 caracteres"
                    },
                    "verify-password": {
                        required: "Este dato es requerido",
                        minlength: "La contraseña debe tener al menos 8 caracteres",
                        equalTo: "Las contraseñas no coinciden"
                    },
                    role: {
                        required: "El rol de usuario es requerido"
                    },
                    document_type: {
                        required: "Este dato es requerido"
                    },
                    "categories[]": {
                        select2Required: "Por favor, selecciona al menos una categoría"
                    },
                    "requirements[]": {
                        select2Required: "Por favor, selecciona al menos un requerimiento"
                    }
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element);
                }
            });

            $form[0].reset();
            formValidator.resetForm();
            $form.find('.form-control').removeClass('is-invalid');
            $form.find('.error').removeClass('error');

            $wizard.each(function() {
                console.log("Inicializando wizard para:", this);
                $(this).steps({
                    headerTag: "h3",
                    bodyTag: "section",
                    transitionEffect: "slideLeft",
                    autoFocus: true,
                    cssClass: 'circle wizard',
                    onStepChanging: function (event, currentIndex, newIndex)
                    {
                        $form.validate().settings.ignore = ":disabled,:hidden";
                        return $form.valid();
                    },
                    onFinishing: function (event, currentIndex)
                    {
                        $form.validate().settings.ignore = ":disabled";
                        return $form.valid();
                    },
                    onFinished: function (event, currentIndex)
                    {
                        updateFormPay($("#modal-cobrar-venta form"),route);
                    }
                });
            });

            // Inicializar file-upload
            $modal.find('.custom-file-container').each(function() {
                var uploadId = $(this).data('upload-id');
                if (uploadId) {
                    console.log("Inicializando file-upload para:", this);
                    new FileUploadWithPreview(uploadId);
                }
            });

            // Inicializar select2
            $modal.find(".select2_modal").each(function() {
                console.log("Select2 testeo.");
                var $this = $(this);
                if ($this.length > 0) {
                    $this.select2({
                        tags: true,
                        dropdownParent: $modal // Asegurarse de que el dropdown parent sea el modal actual
                    });

                    var select2Instance = $this.data('select2');
                    if (select2Instance) {
                        select2Instance.$container.addClass('form-control-sm');
                    } else {
                        console.error("No se pudo inicializar select2 para:", this);
                    }
                }
            });

            // iniciar botones de Touchspin
            $modal.find(".input_cantidad").TouchSpin({
                initval: 0
            });

            // input precio
            $modal.find(".input_precio").TouchSpin({
                prefix: 'S/.',
                min: 0,
                max: 100,
                step: 0.1,
                decimals: 2,
                boostat: 5,
                maxboostedstep: 10,
                buttondown_class: "btn btn-classic btn-primary",
                buttonup_class: "btn btn-classic btn-primary"
            });
        }
        caja.actualizarProductosModal();

        $modal.modal('show');
        resolve();
    });
}

async function addProductModal(route) {
    await productSaleDest();
    await productSaleInit(route);
}

async function productSaleDest(){

    return new Promise((resolve) => {
        // Destruir wizard
        var $modal = $('#modal-producto-venta');
        var $wizard = $modal.find('.wizard_producto_venta');

        if ($wizard.length > 0) {
            $wizard.each(function() {
                var wizardInstance = $(this);
                if (wizardInstance.data('steps')) {
                    wizardInstance.steps('destroy');
                }
            });
        }

        // Destruir file-upload
        $modal.find('.custom-file-container').each(function() {
            var uploadId = $(this).data('upload-id');
            if (uploadId) {
                new FileUploadWithPreview(uploadId).clearPreviewPanel();
            }
        });

        // Destruir select2
        $modal.find(".select2_modal").each(function() {
            var $this = $(this);

            if ($this.hasClass("select2-hidden-accessible")) {
                $this.select2('destroy');
                $(".select2-container").remove();
            } else {
            }
        });

        // destruir botones de Touchsan
        $modal.find(".input-group-prepend").remove();
        $modal.find(".input-group-append").remove();

        resolve();
    });
}

async function productSaleInit(route){
    return new Promise((resolve) => {
        var $modal = $('#modal-producto-venta');
        var $wizard = $modal.find('.wizard_producto_venta');
        var $form = $modal.find('form');
        if ($wizard.length > 0) {
            var formValidator = $form.validate({
                ignore: ":disabled,:hidden",
                rules: {
                    password: {
                        required: true,
                        minlength: 8
                    },
                    "verify-password": {
                        required: true,
                        minlength: 8,
                        equalTo: "input[name='password']"
                    },
                    role: {
                        required: true
                    },
                    document_type: {
                        required: true
                    },
                    "categories[]": {
                        select2Required: true
                    },
                    "requirements[]": {
                        select2Required: true
                    }
                },
                messages: {
                    password: {
                        required: "Este dato es requerido",
                        minlength: "La contraseña debe tener al menos 8 caracteres"
                    },
                    "verify-password": {
                        required: "Este dato es requerido",
                        minlength: "La contraseña debe tener al menos 8 caracteres",
                        equalTo: "Las contraseñas no coinciden"
                    },
                    role: {
                        required: "El rol de usuario es requerido"
                    },
                    document_type: {
                        required: "Este dato es requerido"
                    },
                    "categories[]": {
                        select2Required: "Por favor, selecciona al menos una categoría"
                    },
                    "requirements[]": {
                        select2Required: "Por favor, selecciona al menos un requerimiento"
                    }
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element);
                }
            });

            $form[0].reset();
            formValidator.resetForm();
            $form.find('.form-control').removeClass('is-invalid');
            $form.find('.error').removeClass('error');

            $wizard.each(function() {
                console.log("Inicializando wizard para:", this);
                $(this).steps({
                    headerTag: "h3",
                    bodyTag: "section",
                    transitionEffect: "slideLeft",
                    autoFocus: true,
                    cssClass: 'circle wizard',
                    onStepChanging: function (event, currentIndex, newIndex)
                    {
                        $form.validate().settings.ignore = ":disabled,:hidden";
                        return $form.valid();
                    },
                    onFinishing: function (event, currentIndex)
                    {
                        $form.validate().settings.ignore = ":disabled";
                        return $form.valid();
                    },
                    onFinished: function (event, currentIndex)
                    {
                        updateFormProduct($("#modal-cobrar-venta form"),route);
                    }
                });
            });

            // Inicializar file-upload
            $modal.find('.custom-file-container').each(function() {
                var uploadId = $(this).data('upload-id');
                if (uploadId) {
                    console.log("Inicializando file-upload para:", this);
                    new FileUploadWithPreview(uploadId);
                }
            });

            // Inicializar select2
            $('#select-producto-agregar').select2({
                placeholder: "Selecciona un producto",
                ajax: {
                    url: '/buscar-productos-select',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term // término de búsqueda
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                };
                            })
                        };
                    },
                    cache: true
                },
                dropdownParent: $('#modal-producto-venta') // Asegúrate de usar el ID correcto de tu modal
            });

            // iniciar botones de Touchspin
            $modal.find(".input_cantidad").TouchSpin({
                initval: 0
            });

            // input precio
            $modal.find(".input_precio").TouchSpin({
                prefix: 'S/.',
                min: 0,
                max: 100,
                step: 0.1,
                decimals: 2,
                boostat: 5,
                maxboostedstep: 10,
                buttondown_class: "btn btn-classic btn-primary",
                buttonup_class: "btn btn-classic btn-primary"
            });
        }

        $(".list_productos").children().remove();
        caja.actualizarProductosModal();

        $modal.modal('show');
        resolve();
    });
}

async function addClientModal() {
    $("#modal_cliente_sale_data").html(caja.customer_name);
    $("#modal_matricula_sale_data").html(caja.plate);
    $("#modal_vendedor_sale_data").html(caja.seller_name);

    var documentacion = '<div class="t-uppercontent"><h5>Productos (documentación)</h5></div>';

    caja.products.forEach(function(product) {
        const requerimientos = product.requirements || [];
        console.log(requerimientos);

        if(requerimientos.length > 0){
            requerimientos.forEach(function(req){
                documentacion += `
                    <div class="t-uppercontent" id="${product.id}">
                        <p><a href="">${product.quantity} ${product.name}</a></p>
                    </div>
                `;
            });
        } else {
            documentacion += `
                <div class="t-uppercontent" id="${product.id}">
                    <p>${product.quantity} ${product.name} (no requiere)</p>
                </div>
            `;
        }
        console.log(documentacion);
    });

    $("#modal_documentacion_sale_data").html(documentacion);

    // trabajamos los adelantos

    var adelantos = '<div class="t-uppercontent"><h5>Adelantos</h5></div>';
    var adelanto_final = 0;
    caja.advances.forEach(function(advance) {
        var monto = advance.advance_amount || 0;
        adelanto_final += caja.formatNumber(monto);
        monto = caja.formatPrice(monto);

        var fecha = advance.created_at || '';
        // damos dormato a la fecha
        var date = new Date(fecha);
        // creamos la nueva fecha con el formato deseado con hora y fecha
        var newDate = date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear() + ' ' + date.getHours() + ':' + date.getMinutes() + ' horas';

        adelantos += `
            <div class="t-uppercontent">
                <p>${newDate}</p>
                <span class="">S/.${monto}</span>
            </div>
            `;
    });

    $("#modal_cliente_adelanto_data").html(adelantos);
    $("#modal_documento_sale_data").html(caja.accounting_document_name);
    $("#modal_codigo_sale_data").html(caja.accounting_document_code);
    $("#modal_adelanto_final_sale_data").html(`S/.${caja.formatPrice(adelanto_final)}`);
    $("#modal_restante_sale_data").html(`S/.${caja.formatPrice( caja.formatNumber(caja.total) - adelanto_final)}`);
    $("#modal_total_sale_data").html(`S/.${caja.formatPrice(caja.total)}`);
    var $modal = $('#modal-cliente-venta');
    $modal.modal('show');
}

function editSale(route) {

    // caja.accion = 'venta';
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

    // agregamos los productos a la caja
    caja.products.forEach(function(product) {
        var data = product;
        var uniqueId = `input-cantidad-${data.id}`;
        var item = `
            <li class="nav-item" data-product-id="${data.id}">
                <div class="nav-link list-actions producto-output">
                    <div class="f-m-body">
                        <div class="f-head">
                            <p class="invoice-number mt-1">${data.name}</p>
                        </div>
                        <div class="f-body">
                            <div class="mb-1 btn-group">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x delete_product" data="${data.id}"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                <input id="${uniqueId}" class="input_cantidad" precio="${data.sale_price}" data="${data.id}" type="text" value="${data.quantity}" max="${data.stock}">
                            </div>
                            <p class="invoice-customer-name amount_product"><span>Total:</span> S/.${data.sale_price}</p>
                            <p class="invoice-generated-date">Precio unitario: ${data.sale_price}</p>
                        </div>
                    </div>
                </div>
            </li>
        `;
        $('.inputs-nueva-venta').append(item);
        $(`#${uniqueId}`).TouchSpin({
            initval: 1,
            min: 0,
            max: (caja.accion == 'venta') ? data.stock : 1000000,
        });

        $(`#${uniqueId}`).on('change', (e) => {
            var quantity = parseFloat($(e.currentTarget).val());
            if (quantity > data.stock) {

                // en caso de venta
                // =======================
                if(caja.accion == 'venta' || caja.accion == 'editar_venta'){
                    $(e.currentTarget).val(data.stock);
                    quantity = data.stock;
                }

            } else if (quantity <= 0) {
                caja.eliminarProducto(data.id, $(e.currentTarget).closest('li'));
                return;
            }
            caja.actualizarCantidadProducto(data.id, quantity);
        });
    });

    // actualizamos el select de tipo de venta
    caja.actualizarStepsWizard();
    caja.accion = 'editar_venta';
}

// ============================================
// TRER VENTAS O COMPRAS
// ============================================

function searchAndUpdate(url, query, containerClass) {

    if (query.length >= 6 || query.length === 0 || query === "vacio") {
        if (query.length === 0) {
            query = "vacio";
        }

        console.log("Buscando:", query);

        axios.get(`${url}/${query}`)
            .then(response => {
                const data = response.data;
                console.log(data);
                const $container = $(containerClass);
                $container.empty();

                data.forEach(item => {
                    console.log(item);
                    const currentColor = getCurrentColor(item);
                    const selectorClass = getSelectorClass(item);
                    const customerOrSupplier = getCustomerOrSupplier(item);
                    const formattedDate = formatDate(item.created_at);

                    const listItem = `
                        <li class="nav-item ${selectorClass}" data="${item.id}">
                            <div class="nav-link list-actions" id="invoice-${item.id}" data-invoice-id="${item.id}">
                                <div class="f-m-body">
                                    <div class="f-head">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign" style="background: ${currentColor}">
                                            <line x1="12" y1="1" x2="12" y2="23"></line>
                                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                        </svg>
                                    </div>
                                    <div class="f-body">
                                        <p class="invoice-number">${item.type} ${item.accounting_document_code}</p>
                                        <p class="invoice-customer-name"><span>${customerOrSupplier.label}:</span> ${customerOrSupplier.name}</p>
                                        <p class="invoice-generated-date">${formattedDate}</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    `;

                    $container.append(listItem);
                });
            })
            .catch(error => {
                const $container = $(containerClass);
                $container.empty();
                console.error('Error al buscar cliente:', error);
            });
    }
}

function getCurrentColor(item) {

    if (item.status === 'in_parts') {
        return '#fbff90';
    }

    if (item.status === 'in_process') {
        return '#ffa190';
    }

    if (item.status === 'charged') {
        return '#90ff90';
    }
}

function getSelectorClass(item) {
    return item.type === 'venta' ? 'abrir_venta' : 'abrir_compra';
}

function getCustomerOrSupplier(item) {
    if (item.type === 'venta') {
        return {
            label: 'Cliente',
            name: item.customer ? item.customer.name : 'Anónimo'
        };
    } else {
        return {
            label: 'Proveedor',
            name: item.supplier ? item.supplier.name : 'Anónimo'
        };
    }
}

function formatDate(dateString) {
    const options = { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit', second: '2-digit' };
    const date = new Date(dateString);
    return date.toLocaleDateString('en-GB', options).replace(',', '');
}
