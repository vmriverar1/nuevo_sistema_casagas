$(document).ready(function() {
    cargarProductos();
    cargarServicios();
    cargarPaquetes();
});

function searchAndUpdate(url, query, containerClass) {
    if (query.length >= 8 || query.length === 0 || query === "vacio") {
        if (query.length === 0) {
            query = "vacio";
        }
        axios.get(`${url}/${query}`)
            .then(function (response) {
                var data = response.data;
                var $container = $(containerClass);
                $container.empty();

                data.forEach(function (item) {
                    var current_color = '';
                    if (item.type === 'venta') {
                        current_color = item.status === 'in_process' ? '#90ff90' : '#90acff';
                        selector_obj = 'abrir_venta';
                    } else {
                        current_color = item.status === 'in_process' ? '#90ff90' : '#ffb1ab';
                        selector_obj = 'abrir_compra';
                    }
                    var listItem = `
                        <li class="nav-item ${selector_obj}" data="${item.id}">
                            <div class="nav-link list-actions" id="invoice-${item.id}" data-invoice-id="${item.id}">
                                <div class="f-m-body">
                                    <div class="f-head">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign" style="background: ${item.type === 'venta' ? '#90ff90' : '#ffb1ab'}">
                                            <line x1="12" y1="1" x2="12" y2="23"></line>
                                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                        </svg>
                                    </div>
                                    <div class="f-body">
                                        <p class="invoice-number">${item.type} ${item.accounting_document_code}</p>
                                        <p class="invoice-customer-name"><span>${item.type === 'venta' ? 'Cliente' : 'Proveedor'}:</span> ${item.type === 'venta' ? item.customer.name : item.supplier.name}</p>
                                        <p class="invoice-generated-date">${item.created_at}</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    `;

                    $container.append(listItem);
                });
            })
            .catch(function (error) {
                console.error('Error al buscar cliente:', error);
            });
    }
}

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
        var item = `
            <div class="card component-card_2 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <img src="storage/product/${producto.photo}" class="card-img-top" alt="widget-card-2">
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
        var item = `
            <div class="card component-card_2 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <img src="storage/product/${producto.photo}" class="card-img-top" alt="widget-card-2">
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
        var item = `
            <div class="card component-card_2 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <img src="storage/product/${producto.photo}" class="card-img-top" alt="widget-card-2">
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

function submitForm(formSelector) {
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

    console.log(caja);

    if (caja) {
        formData.append('caja', JSON.stringify(caja));
    }

    console.log(formData);

    // Enviar los datos utilizando Axios
    axios.post('/hacer_venta', formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
    .then(response => {
        $("#modal-cerrar-venta").find('.wizard').find('.actions ul').find('.btn-next').prop('disabled', false);
        // Cerrar el modal si está dentro de uno
        const $modal = $form.closest('.modal');
        if ($modal.length) {
            $modal.modal('hide');
        }
        // Limpiar el modal
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

