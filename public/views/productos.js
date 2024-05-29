function actualizarListaUsuarios(data) {

    $('.list_productos').children().remove();
    let tipo_producto = $(".select_tipo_producto ").val();
    if (tipo_producto === "producto") {
        $(".block_paquetes").hide();
        $(".block_productos").show();
    }else if (tipo_producto === "servicio") {
        $(".block_paquetes").hide();
        $(".block_productos").hide();
    }else if (tipo_producto === "paquete") {
        $(".block_productos").hide();
        $(".block_paquetes").show();
    }

    if (data['action'] != 'no_tabla') {
        initializeDataTable('html5-extension', 'products', columns, buttons, tabla_nombre);
    }

    // ====================================================================
    // Actualizar el select de marca y nombre con select2
    // ====================================================================

    let $selectMarca = $(".select_marca");
    $selectMarca.val(data['brand_id']).trigger('change');

    let $selectNombre = $(".select_nombre");
    $selectNombre.val(data['id']).trigger('change');

    // ====================================================================
    // Actualizar el select de categorías con select2
    // ====================================================================

    let $selectCategoria = $(".select_categoria");
    $selectCategoria.val(null).trigger('change');

    if (data['categories'] && Array.isArray(data['categories'])) {
        $selectCategoria.val(data['categories'].map(cat => cat.id)).trigger('change');
    }

    // ====================================================================
    // Actualizar el select de requerimientos con select2
    // ====================================================================

    let $selectRequerimientos = $(".select_requerimiento");
    $selectRequerimientos.val(null).trigger('change');

    if (data['requirements'] && Array.isArray(data['requirements'])) {
        $selectRequerimientos.val(data['requirements'].map(req => req.id)).trigger('change');
    }

    // ====================================================================
    // Agregar productos al paquete
    // ====================================================================
    let $listProductos = $('.list_productos');
    $listProductos.children().remove(); // Vaciar la lista de productos

    if (data['productsInPackage'] && Array.isArray(data['productsInPackage'])) {
        data['productsInPackage'].forEach(function(paquete) {
            let $newButton = $('<button>', {
                class: 'btn btn-warning mt-1 close_element',
                style: 'width: 100%;',
                text: paquete.pivot.quantity + ' ' + paquete.name
            }).attr('product_id', paquete.id).attr('quantity', paquete.pivot.quantity);

            $listProductos.append($('<div class="col-12">').append($newButton));
        });
    }

    updateProductosKit();
}

function updateProductosKit() {
    var productosKit = [];

    $('.list_productos button').each(function() {
        var $button = $(this);
        var productId = $button.attr('product_id');
        var quantity = $button.attr('quantity');

        productosKit.push({ id: productId, quantity: quantity });
    });

    $('#productos_kit').val(JSON.stringify(productosKit));
}

function updateProductosMove() {
    var productosKit = [];

    $('.list_productos_move button').each(function() {
        var $button = $(this);
        var productId = $button.attr('product_id');
        var quantity = $button.attr('quantity');

        productosKit.push({ id: productId, quantity: quantity });
    });

    $('#productos_move').val(JSON.stringify(productosKit));
}

const buttons = [
    {
        text: 'Crear Producto',
        className: 'btn create_products',
        action: function (e, dt, node, config) {
            resetModal('modal-products', 'products', actualizarListaUsuarios);
            $('#modal-products').modal('show');
            $('.list_productos').children().remove();
        }
    },
    {
        text: 'Trasladar mercaderia',
        className: 'btn move_products',
        action: function (e, dt, node, config) {
            resetModal('modal-move', 'move', actualizarListaUsuarios);
            $('#modal-move').modal('show');
            $('.list_productos_move').children().remove();
        }
    },
];

const columns = [
    { data: 'photo', title:'Foto' },
    { data: 'name', title:'Nompre' },
    { data: 'brand_id', title:'Marca' },
    { data: 'category_btns', title:'Categorias' },
    { data: 'barcode', title:'Código' },
    { data: 'stock', title:'Cantidad' },
    { data: 'sale_price', title:'Precio' },
    { data: 'type', title:'Tipo' },
    { data: 'status', title:'Estatus.' },
];

const tabla_nombre = "products";

$(document).ready(function() {
    initializeDataTable('html5-extension', 'products', columns, buttons, actualizarListaUsuarios);

    // Configurar el token CSRF para todas las solicitudes AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).on('select2:select', '.select_marca', function(e){
        var data = e.params.data;
        if (data.id === data.text) {
            console.log('Elemento nuevo creado:', data.text);
            // Iniciar el Axios
            axios.post('/brands', {
                name: data.text
            })
            .then(function(response) {
                console.log('Nueva categoría creada:', response.data);
            })
            .catch(function(error) {
                console.error('Error al crear la categoría:', error);
            });
        } else {
            console.log('Elemento existente seleccionado:', data.text);
        }
    });

    $(document).on('select2:select', '.select_categoria', function(e){
        var data = e.params.data;
        if (data.id === data.text) {
            console.log('Elemento nuevo creado:', data.text);
            // Iniciar el Axios
            axios.post('/categories', {
                name: data.text
            })
            .then(function(response) {
                console.log('Nueva categoría creada:', response.data);
            })
            .catch(function(error) {
                console.error('Error al crear la categoría:', error);
            });
        }
    });

    $(document).on("click", ".change_product", function(e){
        console.info("iniciando");
        var button = $(this);
        var productId = button.attr('data');
        var currentStatus = button.text().trim();

        console.log('Token CSRF:', $('meta[name="csrf-token"]').attr('content'));
        console.log('Datos enviados:', {
            product_id: productId,
            status: currentStatus
        });

        axios.post('/change-product-status', {
            product_id: productId,
            status: currentStatus,
            _token: $('meta[name="csrf-token"]').attr('content')
        })
        .then(function(response) {
            if (response.data.newBtn) {
                button.replaceWith(response.data.newBtn);
            }
        })
        .catch(function(error) {
            console.error('Error updating status:', error);
        });
    });

    $(document).on("click", ".select_tipo_producto", function(e){
        let tipo_producto = $(this).val();
        if (tipo_producto === "producto") {
            $(".block_paquetes").hide();
            $(".block_productos").show();
        }else if (tipo_producto === "servicio") {
            $(".block_paquetes").hide();
            $(".block_productos").hide();
        }else if (tipo_producto === "paquete") {
            $(".block_productos").hide();
            $(".block_paquetes").show();
        }
    });

    $(document).on('click', '.add_productos', function(e) {
        e.preventDefault();

        // Obtener el valor del select
        var $select = $('#select-producto-kit');
        var productId = $select.val();
        var productName = $select.find('option:selected').text();

        // Obtener la cantidad del input
        var quantity = $(this).closest('.form-row').find('input[name="txt"]').val();

        // Verificar si se ha seleccionado un producto y una cantidad
        if (productId && quantity) {
            // Verificar si el producto ya ha sido agregado
            var exists = false;
            $('.list_productos button').each(function() {
                if ($(this).attr('product_id') === productId) {
                    exists = true;
                    return false; // Salir del bucle each
                }
            });

            if (exists) {
                alert('El producto "' + productName + '" ya fue agregado.');
            } else {
                // Crear un nuevo botón con los atributos y contenido deseados
                var $newButton = $('<button>', {
                    class: 'btn btn-warning mt-1 close_element',
                    style: 'width: 100%;',
                    text: quantity + ' ' + productName
                }).attr('product_id', productId).attr('quantity', quantity);

                // Agregar el nuevo botón a la lista de productos
                $('.list_productos').append($('<div class="col-12">').append($newButton));

                // Actualizar el input hidden con los nuevos datos
                updateProductosKit();

                // Limpiar el select y el input
                $select.val(null).trigger('change');
                $(this).closest('.form-row').find('input[name="txt"]').val('');
            }
        } else {
            alert('Por favor, selecciona un producto y especifica una cantidad.');
        }
    });

    $(document).on('click', '.add_productos_move', function(e) {
        e.preventDefault();

        // Obtener el valor del select
        var $select = $('#select-producto-move');
        var productId = $select.val();
        var productName = $select.find('option:selected').text();
        var productStock = $select.find('option:selected').attr('stock');

        // Obtener la cantidad del input
        var quantity = $(this).closest('.form-row').find('input[name="txt"]').val();

        // Verificar si se ha seleccionado un producto y una cantidad
        console.log(productId && quantity);
        if (productId && quantity) {

            if (parseInt(quantity) > parseInt(productStock)) {
                alert('La cantidad ingresada excede el stock disponible para "' + productName + '".');
                return;
            }

            // Verificar si el producto ya ha sido agregado
            var exists = false;
            $('.list_productos_move button').each(function() {
                if ($(this).attr('product_id') === productId) {
                    exists = true;
                    return false; // Salir del bucle each
                }
            });

            console.log({exists});

            if (exists) {
                alert('El producto "' + productName + '" ya fue agregado.');
            } else {
                // Crear un nuevo botón con los atributos y contenido deseados
                var $newButton = $('<button>', {
                    class: 'btn btn-warning mt-1 close_element',
                    style: 'width: 100%;',
                    text: quantity + ' ' + productName
                }).attr('product_id', productId).attr('quantity', quantity);

                console.log($newButton);

                // Agregar el nuevo botón a la lista de productos
                $('.list_productos_move').append($('<div class="col-12">').append($newButton));

                // Actualizar el input hidden con los nuevos datos
                updateProductosMove();

                // Limpiar el select y el input
                $select.val(null).trigger('change');
                $(this).closest('.form-row').find('input[name="txt"]').val('');
            }
        } else {
            alert('Por favor, selecciona un producto y especifica una cantidad.');
        }
    });

    $(document).on('click', '.close_element', function(e) {
        if (confirm('¿Estás seguro de que deseas eliminar este elemento?')) {
            e.preventDefault();
            $(this).parent().remove();
            updateProductosKit();
        }
    });

    $(document).on("click", ".change_user", function(e){
    });

    $(document).on('select2:select', '.select_nombre', function(e){
        var data = e.params.data;
        console.log(data);
        if (data.id === data.text) {
            console.log('Elemento nuevo creado:', data.text);
        } else {
            console.log('Elemento existente seleccionado:', data.text);
            // Iniciar el Axios
            axios.get('/products/'+data.id)
            .then(function(response) {
                console.log('Nueva categoría creada:', response.data);
                const data = response.data;
                data["stock"] = 0;
                data['action'] = 'no_tabla';
                // Recorrer todos los inputs, selects y textareas dentro del modal
                $(".select_tipo_producto").val(data["type"]);
                actualizarListaUsuarios(data)
            })
            .catch(function(error) {
                console.error('Error al crear la categoría:', error);
            });
        }
    });

    // ==============================================
    // CATEGORY
    // ==============================================

    // Paso 1: Al hacer click en el botón de editar categoría
    $(document).on('click', '.edit_category', function() {
        var categoryId = $(this).attr('data');
        var categoryName = $(this).text().trim();

        // Paso 2: Abrir el modal
        $('#modal-categoria').modal('show');

        // Paso 3: Reiniciar el modal a su estado inicial
        $('#modal-categoria .modal-body .form-group').hide();
        $('#modal-categoria .modal-footer .btn-primary').hide();
        $('#modal-categoria input[name="name"]').val(categoryName);

        // Guardar el ID de la categoría en un atributo de datos del modal
        $('#modal-categoria').data('category-id', categoryId);

        // Mostrar las opciones de editar y eliminar
        $('#modal-categoria .modal-body .btn-warning').show();
        $('#modal-categoria .modal-body .btn-danger').show();
    });

    // Paso 4: Manejar el evento de click en el botón de eliminar
    $('#modal-categoria .btn-danger').on('click', function() {
        var categoryId = $('#modal-categoria').data('category-id');
        if (confirm('¿Estás seguro de que deseas eliminar esta categoría?')) {
            axios.delete('/categories/' + categoryId)
                .then(function(response) {
                    // Paso 5: Eliminar la categoría de la lista
                    initializeDataTable('html5-extension', 'products', columns, buttons, tabla_nombre);
                    $('#modal-categoria').modal('hide');
                })
                .catch(function(error) {
                    console.error(error);
                    alert('Ha ocurrido un error al eliminar la categoría.');
                });
        }
    });

    // Paso 6: Manejar el evento de click en el botón de editar
    $('#modal-categoria .btn-warning').on('click', function() {
        $('#modal-categoria .modal-body .form-group').show();
        $('#modal-categoria .modal-footer .btn-primary').show();
        $('#modal-categoria .btn-danger').hide();
        $(this).hide(); // Ocultar el botón de editar
    });

    // Paso 7: Manejar el evento de click en el botón de guardar
    $('#modal-categoria .btn-primary').on('click', function() {
        var categoryId = $('#modal-categoria').data('category-id');
        var categoryName = $('#modal-categoria input[name="name"]').val();

        axios.put('/categories/' + categoryId, { name: categoryName })
            .then(function(response) {
                // Actualizar el nombre de la categoría en la lista
                initializeDataTable('html5-extension', 'products', columns, buttons, tabla_nombre);
                $('#modal-categoria').modal('hide');
            })
            .catch(function(error) {
                console.error(error);
                alert('Ha ocurrido un error al actualizar la categoría.');
            });
    });

    // Paso 8: Cerrar el modal y restablecer su estado inicial
    $('#modal-categoria').on('hidden.bs.modal', function () {
        $('#modal-categoria .modal-body .form-group').hide();
        $('#modal-categoria .modal-footer .btn-primary').hide();
        $('#modal-categoria .btn-warning').show();
        $('#modal-categoria .btn-danger').show();
        $('#modal-categoria .btn-danger').show();
    });

    // ==============================================
    // BRANDS
    // ==============================================

    // Paso 1: Al hacer click en el botón de editar categoría
    $(document).on('click', '.edit_brand', function() {
        var brandId = $(this).attr('data');
        var brandName = $(this).text().trim();

        // Paso 2: Abrir el modal
        $('#modal-brand').modal('show');

        // Paso 3: Reiniciar el modal a su estado inicial
        $('#modal-brand .modal-body .form-group').hide();
        $('#modal-brand .modal-footer .btn-primary').hide();
        $('#modal-brand input[name="name"]').val(brandName);

        // Guardar el ID de la categoría en un atributo de datos del modal
        $('#modal-brand').data('brand-id', brandId);

        // Mostrar las opciones de editar y eliminar
        $('#modal-brand .modal-body .btn-warning').show();
        $('#modal-brand .modal-body .btn-danger').show();
    });

    // Paso 4: Manejar el evento de click en el botón de eliminar
    $('#modal-brand .btn-danger').on('click', function() {
        var brandId = $('#modal-brand').data('brand-id');
        if (confirm('¿Estás seguro de que deseas eliminar esta categoría?')) {
            axios.delete('/brands/' + brandId)
                .then(function(response) {
                    // Paso 5: Eliminar la categoría de la lista
                    initializeDataTable('html5-extension', 'products', columns, buttons, tabla_nombre);
                    $('#modal-brand').modal('hide');
                })
                .catch(function(error) {
                    console.error(error);
                    alert('Ha ocurrido un error al eliminar la categoría.');
                });
        }
    });

    // Paso 6: Manejar el evento de click en el botón de editar
    $('#modal-brand .btn-warning').on('click', function() {
        $('#modal-brand .modal-body .form-group').show();
        $('#modal-brand .modal-footer .btn-primary').show();
        $('#modal-brand .btn-danger').hide();
        $(this).hide(); // Ocultar el botón de editar
    });

    // Paso 7: Manejar el evento de click en el botón de guardar
    $('#modal-brand .btn-primary').on('click', function() {
        var brandId = $('#modal-brand').data('brand-id');
        var brandName = $('#modal-brand input[name="name"]').val();

        axios.put('/brands/' + brandId, { name: brandName })
            .then(function(response) {
                // Actualizar el nombre de la categoría en la lista
                initializeDataTable('html5-extension', 'products', columns, buttons, tabla_nombre);
                $('#modal-brand').modal('hide');
            })
            .catch(function(error) {
                console.error(error);
                alert('Ha ocurrido un error al actualizar la categoría.');
            });
    });

    // Paso 8: Cerrar el modal y restablecer su estado inicial
    $('#modal-brand').on('hidden.bs.modal', function () {
        $('#modal-brand .modal-body .form-group').hide();
        $('#modal-brand .modal-footer .btn-primary').hide();
        $('#modal-brand .btn-warning').show();
        $('#modal-brand .btn-danger').show();
        $('#modal-brand .btn-danger').show();
    });
});

// ============================================
//  SELECT 2
// ============================================

$.fn.modal.Constructor.prototype.enforceFocus = function() {
    $(document).on('focusin.modal', (e) => {
        if ($(e.target).hasClass('select2-input')) {
            return true;
        }

        if ($(e.target).closest('.select2-selection').length > 0) {
            return true;
        }

        if ($(e.target).closest('.select2-container').length > 0) {
            return true;
        }

        if ($(document).has(e.target).length) {
            return true;
        }
    });
};
