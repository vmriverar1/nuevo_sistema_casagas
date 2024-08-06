// -----------------------------------------------------------------
// CAJA
// -----------------------------------------------------------------

class Caja {
    constructor() {
        this.initCaja();
        this.initListeners();
        this.productPromises = {}
    }

    // -----------------------------------------------------------------
    // INICIALIZAR
    // -----------------------------------------------------------------

    initCaja() {
        this.modal = (this.modal_tipe == 'create') ? $('#modal-cerrar-venta') : $('#modal-cobrar-venta');
        this.document_required = false;
        this.accion = 'venta';
        this.status = '';
        this.customer_id = '';
        this.customer_name = 'Anónimo';
        this.placa = '';
        this.seller_id = '';
        this.seller_name = '';
        this.products = [];
        this.amount = 0;
        this.sale_discount = [];
        this.accounting_document_id = '';
        this.content_requirements = '';
        this.money_advance = 0;
        this.change = 0;
        this.advances = [];
        this.total = 0;
        this.modal_tipe = 'create';
        // documento
        this.tax = 0;
        this.tax_id = 0;
        this.tax_type = '';
        this.tax_name = '';
        this.tax_quantity = 0;
        this.document_data = document_data_complete;
        // descuento
        this.discount = 0;
        this.discounts = [];
        this.discount_id = 0;
        this.discount_type = 'ninguno';
        this.discount_name = '';
        this.discount_quantity = 0;
        this.discount_data = descuentos_data_complete;
        // métodos de pago
        this.payment_method = 0;
        this.payment_method_id = 0;
        this.payment_method_type = "ninguno";
        this.payment_method_name = "";
        this.payment_method_quantity = 0;
        this.payment_method_data = pagos_data_complete;
    }

    setCash(cashData) {
        this.modal = $('#modal-cerrar-venta');
        // this.modal = (this.modal_tipe == 'create') ? $('#modal-cerrar-venta') : $('#modal-cobrar-venta');
        // ESTADO
        this.status = cashData.status;
        // CLIENTE
        this.customer_id = cashData.customer_id;
        this.customer_name = cashData.customer ? cashData.customer.name : 'Anónimo';
        this.plate = cashData.plate ? cashData.plate.plate_number : '';
        // VENDEDOR
        this.seller_id = cashData.seller_id;
        this.seller_name = cashData.seller.name;
        // PRODUCTOS
        this.products = cashData.products.map(product => ({
            id: product.id,
            name: product.name,
            sale_price: product.sale_price,
            quantity: product.pivot.quantity,
            car_registration: product.car_registration,
            requirements: product.requirements || []
        }));
        this.advances = cashData.advances;
        this.amount = cashData.amount;
        this.sale_discount = cashData.discounts;
        this.money_advance = 0;
        this.change = 0;
        // IMPUESTOS
        this.accounting_document_id = cashData.accounting_document_id;
        this.accounting_document_code = cashData.accounting_document_code;
        this.accounting_document_name = cashData.accounting_document ? cashData.accounting_document.name : '';
        this.total = cashData.total;
        this.tax = cashData.tax;
        this.tax_id = cashData.accounting_document ? cashData.accounting_document.id : '';
        this.tax_type = cashData.accounting_document ? cashData.accounting_document.tax_type : '';
        this.tax_name = cashData.accounting_document ? cashData.accounting_document.name : '';
        this.tax_quantity = cashData.accounting_document ? cashData.accounting_document.sale_percentage : 0;
        this.discount = cashData.discount;
        this.discounts = cashData.discounts;
        this.discount_id = cashData.discounts.length > 0 ? cashData.discounts[0].id : 0;
        this.discount_type = cashData.discounts.length > 0 ? cashData.discounts[0].type : 'ninguno';
        this.discount_name = cashData.discounts.length > 0 ? cashData.discounts[0].name : '';
        this.discount_quantity = 0;
        this.payment_method = 0;
        this.payment_method_id = 0;
        this.payment_method_type = "ninguno";
        this.payment_method_name = "";
        this.payment_method_quantity = 0;
        this.modal_tipe = cashData.modal_tipe;
    }

    // -----------------------------------------------------------------
    // OBLIGAR A USAR DOCUMENTOS DEL CLIENTE
    // -----------------------------------------------------------------

    documentRequired() {
        // car registration esta activo
        let car_registration = this.products.some(product => product.car_registration && product.car_registration === 'activo');
        // hay requerimientos en los productos
        let requirement_in_products = this.products.some(product => product.requirements && product.requirements.length > 0);
        // la venta es en partes o por totalidad
        let payment = (this.status === 'in_parts' || this.status === 'in_process') ? true : false;

        if (car_registration || requirement_in_products || payment) {
            $('#document_client').prop('required', true);
        } else {
            $('#document_client').prop('required', false);
        }
    }

    verificarRequirements() {

        removeStepByTitle(this.modal, "Productos");

        let html_generado = '<section>';
        this.products.forEach(product => {
            if (product.requirements && product.requirements.length > 0) {
                html_generado += `<label style="color: black; font-weight: 800;">${product.name}</label>`;
                product.requirements.forEach(requirement => {
                    if (requirement.type === 'imagen') {
                        html_generado += `
                            <div class="mb-2">
                                <label>Subir ${requirement.name} <a href="javascript:void(0)" title="Clear Image">x</a></label>
                                <input type="file" accept="image/*" name="requerimiento_${requirement.name}">
                            </div>
                        `;
                    } else if (requirement.type === 'documentos') {
                        html_generado += `
                            <div class="mb-2">
                                <label>Subir ${requirement.name} <a href="javascript:void(0)" title="Clear Document">x</a></label>
                                <input type="file" accept="application/msword, application/pdf" name="requerimiento_${requirement.name}">
                            </div>
                        `;
                    } else if (requirement.type === 'texto') {
                        html_generado += `
                            <div class="mb-2">
                                <p class="mt-1">${requirement.name}</p>
                                <div class="mb-4">
                                    <input class="input_cantidad form-control" type="text" value="" name="requerimiento_${requirement.name}" required>
                                </div>
                            </div>
                        `;
                    }
                });
            }
        });
        html_generado += '</section>';

        this.content_requirements = html_generado;
        this.documentRequired();
    }

    // -----------------------------------------------------------------
    // CLIENTE
    // -----------------------------------------------------------------

    buscarCliente() {
        const documentValue = $('#document_client').val();
        var $form_wizard = (this.modal_tipe == 'create') ? $('.wizard') : $('.wizard_cobrar_venta');

        axios.get('/cliente-data/' + documentValue)
            .then((response) => {
                const data = response.data;
                // AGREGAMOS LOS DATOS AL OBJETO
                this.customer_id = data.id;
                this.customer_name = data.name;
                this.customer_document = data.document;
                this.customer_plates = data.plates;
                // reiniciamos el select2 del objeto con el id car_registration
                $("#car_registration").val(null).trigger('change');
                // agregamos como opción todas las placas de auto del cliente
                data.plates.forEach(plate => {
                    var newOption = new Option(plate["plate_number"], plate["id"], true, true);
                    $("#car_registration").append(newOption).trigger('change');
                });
                // CAMBIAMOS EL DOM
                $("#name_client").html(data.name);
                $('.modal_cliente').html(`<span>${data.name}</span>`);
                $("#div_car_registration").show();
                $("#document_client").val(data.document);
                $("#document_client").prop('disabled', true);
                removeStepByTitle(this.modal, "Agregar cliente");
            })
            .catch((error) => {
                // AGREGAMOS LOS DATOS AL OBJETO
                this.customer_id = '';
                this.customer_name = '';
                // AGREGAMOS LOS DATOS AL OBJETO
                this.customer_id = $("#document_client").val();
                $('.modal_cliente').html(`<span></span>`);

                removeStepByTitle(this.modal, "Agregar cliente");

                if (error.response.status === 404) {
                    // CAMBIAMOS EL DOM
                    $("#div_car_registration").show();
                    // INSERTAR PASO
                    var step = {
                        title: "Agregar cliente",
                        content: paso_agregar_cliente
                    };
                    $form_wizard.steps('insert', 1, step);

                } else {
                    // CAMBIAMOS EL DOM
                    $("#document_client").val("");
                    $("#div_car_registration").hide();
                    $('.modal_cliente').html(`<span></span>`);
                    // ALERTA DE ERROR
                    alert("Ocurrió un error en la consulta de documentos, vuelve a intentarlo");
                }
            });
    }

    actualizarPagoCliente(value) {
        let currentValue = $('#input_recibido_modal') ? $('#input_recibido_modal').val() : 0;
        // si currentValue termina en .00 borramos el 00 despues del punto
        if (currentValue.endsWith('.00')) {
            currentValue = currentValue.slice(0, -2);
        }
        if (value === 'C') {
            currentValue = '';
        } else if(value === '.') {
            currentValue += value;
            $('#input_recibido_modal').val(currentValue+'00');
            return;
        } else {
            currentValue += value;
        }

        $('#input_recibido_modal').val(currentValue);

        let pagoCliente = parseFloat(currentValue);
        var total_calcular = (this.status === 'in_parts' || this.money_advance > 0) ? (this.formatNumber(this.money_advance) + this.formatNumber(this.payment_method)) : (this.formatNumber(this.total) + this.formatNumber(this.payment_method));

        if (!isNaN(pagoCliente) && pagoCliente >= total_calcular) {
            let vuelto = pagoCliente - total_calcular;
            $('#vuelto_modal').html(`Vuelto: S/.${this.formatPrice(vuelto)}`);
            this.change = this.formatPrice(this.change);
            this.formatPrice(this.change);
        } else {
            $('#vuelto_modal').html('');
            this.change = 0;
        }
    }

    verificarCarRegistrations() {
        let hasCarRegistration = this.products.some(product => product.car_registration && product.car_registration === 'activo');
        if (hasCarRegistration) {
            $('#div_car_registration').html(`
                <p class="mt-1">Placa de auto</p>
                <div class="mb-4">
                    <select class="form-control select2_modal tagging" name="car_registration" id="car_registration" required></select>
                </div>
            `);
            $("#car_registration").select2({
                tags: true,
                dropdownParent: $("#modal-cerrar-venta")
            });
        } else {
            $('#div_car_registration').empty();
        }
        this.documentRequired();
    }

    // -----------------------------------------------------------------
    // PRODUCTOS
    // -----------------------------------------------------------------

    agregarProducto(product) {
        let existingProduct = this.products.find(p => p.id === product.id);
        if (existingProduct) {
            existingProduct.quantity++;
        } else {
            product.quantity = (product.quantity && product.quantity > 0) ? product.quantity : 1;
            this.products.push(product);
        }
        this.calcularMonto();
    }

    obtenerProducto(id) {
        if (this.productPromises[id]) {
            // Si ya hay una promesa en curso para este producto, esperar a que se complete
            return this.productPromises[id].then((existingProduct) => {
                console.log(existingProduct);
                existingProduct.quantity++;
                this.actualizarCantidadProducto(id, existingProduct.quantity);
                $(`input[data=${id}]`).val(existingProduct.quantity).trigger('change');
            });
        }

        let existingProduct = this.products.find(p => p.id === id);
        if (existingProduct) {
            console.log(existingProduct);
            existingProduct.quantity++;
            this.actualizarCantidadProducto(id, existingProduct.quantity);
            $(`input[data=${id}]`).val(existingProduct.quantity).trigger('change');
            return Promise.resolve();
        }

        // Si no existe el producto en local, hacer la solicitud y guardar la promesa
        this.productPromises[id] = axios.get('/producto/' + id)
            .then((response) => {
                var data = response.data;
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
                                        <input id="${uniqueId}" class="input_cantidad" precio="${data.sale_price}" data="${data.id}" type="text" value="1" max="${data.stock}">
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
                    max: (caja.accion == 'venta' || caja.accion == 'editar_venta') ? data.stock : 1000000,
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
                        this.eliminarProducto(data.id, $(e.currentTarget).closest('li'));
                        return;
                    }
                    this.actualizarCantidadProducto(data.id, quantity);
                });

                this.agregarProducto(data);

                return data; // Devolver el producto para cualquier suscriptor de la promesa
            })
            .catch((error) => {
                console.error('Error al obtener producto:', error);
                throw error; // Propagar el error a cualquier suscriptor de la promesa
            })
            .finally(() => {
                // Borrar la promesa cacheada después de que se complete
                delete this.productPromises[id];
            });

        return this.productPromises[id];
    }

    eliminarProducto(id, element) {
        this.products = this.products.filter(p => p.id !== parseInt(id));
        element.remove();
        this.calcularMonto();
    }

    actualizarCantidadProducto(id, quantity) {
        let product = this.products.find(p => p.id === id);
        if (product) {
            product.quantity = quantity;
            this.calcularMonto();
        }
    }

    calcularMonto() {
        this.amount = this.products.reduce((total, product) => total + (product.sale_price * product.quantity), 0);
        this.products.forEach(product => {
            $(`li[data-product-id="${product.id}"] .amount_product`).html(`<span>Total:</span> S/.${this.formatPrice(parseFloat(product.sale_price) * parseFloat(product.quantity))}`);
        });
        this.actualizarStepsWizard();
    }

    // -----------------------------------------------------------------
    // FORMATO
    // -----------------------------------------------------------------

    formatPrice(price) {
        if (typeof price === 'string') {
            price = parseFloat(price);
        }
        if (isNaN(price)) {
            return '0.00';
        }

        price = parseFloat(price);
        return price.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    }

    formatNumber(number) {
        // verificamos si es un string
        if (typeof number === 'string') {
            return parseFloat((number).replace(',', ''));
        }
        // pero si es un número
        return parseFloat(number);
    }

    // -----------------------------------------------------------------
    // FUNCIONES DE MODAL
    // -----------------------------------------------------------------

    async abrirModal() {
        $("#div_car_registration").hide();
        await this.resetModal();
        this.verificarCarRegistrations();
        this.verificarRequirements();
        if(this.modal_tipe == 'create'){
            $('#modal-cerrar-venta').modal('show');
        }else{
            $('#modal-cobrar-venta').modal('show');
        }
        this.actualizarProductosModal();
    }

    async resetModal(){
        var $modal = '';

        if(this.modal_tipe == 'create'){
            var $modal = $('#modal-cerrar-venta');
        }else{
            var $modal = $('#modal-cobrar-venta');

            // creamos el select de tipos de pago
            // ==================================
            let option_in_process = (caja.status == "in_process") ? `<option value="in_process">Por cobrar</option>` : ``;
            let option_edfault =    `<option disabled="" selected="">Seleccionar tipo de venta</option>
                                    ${option_in_process}
                                    <option value="in_parts">En Partes</option>
                                    <option value="charged">Cobrar total</option>`;
            $("#status_sale_pay").html(option_edfault);
        }


        // Limpiar todos los inputs
        $modal.find('input').val('');
        $modal.find('select').val(null).trigger('change');

        $modal.find('input, select, textarea').each(function() {
            const input = $(this);
            if (input.attr('type') === 'checkbox') {
                input.prop('checked', false);
            } else if (input.attr('type') === 'file') {
                input.val(null);
            } else if (input.is('select[multiple]')) {
                input.val(null).trigger('change');
            } else {
                input.val('');
            }
        });

        // CAMBIAMOS EL DOM
        $("#document_client").val("");
        $("#name_client").html("Anónimo");
        $("#document_client").prop('disabled', false);
        $("#div_car_registration").hide();
        $('.modal_cliente').html(`<span></span>`);

        await this.destroyComponents($modal);
        await this.initializeComponents($modal);
    }

    async destroyComponents($modal){
        return new Promise((resolve) => {
            // Destruir wizard
            var $wizard = (this.modal_tipe == 'create') ? $modal.find('.wizard') : $modal.find('.wizard_cobrar_venta');
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

            // adicionales
            $('#money_advance').remove();

            resolve();
        });
    }

    async initializeComponents($modal) {


        return new Promise((resolve) => {

            // Inicializar wizard
            var $wizard = (this.modal_tipe == 'create') ? $modal.find('.wizard') : $modal.find('.wizard_cobrar_venta');
            var $form = $modal.find('form');
            if ($wizard.length > 0) {

                var formValidator = $form.validate({
                    ignore: ":disabled,:hidden",
                    rules: {
                        document_client: {
                            required: function(element) {
                                return $('#document_client').prop('required');
                            },
                            minlength: 8,
                            digits: true
                        },
                        input_recibido_modal: {
                            required: true,
                            min: function() {
                                if (this.status === 'in_parts' || this.money_advance > 0) {
                                    return parseFloat($('.total_modal').text().replace('Adelanto: S/.', ''));
                                }else{
                                    return parseFloat($('.total_modal').text().replace('Total: S/.', ''));
                                }
                            }
                        },
                        document_sale: {
                            required: true,
                        }
                    },
                    messages: {
                        document_client: {
                            required: "Ciertos productos requieren registrar el documento del cliente. Por favor, ingréselo.",
                            minlength: "El documento debe tener al menos 8 dígitos.",
                            digits: "El documento solo debe contener números."
                        },
                        input_recibido_modal: {
                            required: "Este dato es requerido",
                            min: "Debes ingresar un dato mayor o igual al total."
                        },
                        document_sale: {
                            required: "Este dato es requerido"
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
                            // bloqueamos el boton que inicia el evento
                            // if(caja.modal_tipe == 'create'){
                            //     $modal.find('.wizard').find('.actions ul').find('.btn-next').prop('disabled', true);
                            // }else{
                            //     $modal.find('.wizard_cobrar_venta').find('.actions ul').find('.btn-next').prop('disabled', true);
                            // }

                            if(caja.accion == 'venta'){
                                console.log("venta");
                                submitFormPay($("#modal-cerrar-venta form"));
                                return;
                            }

                            if(caja.accion == 'editar_venta'){
                                console.log("editar venta");
                                updateFormPay($("#modal-cerrar-venta form"), "/editar_venta/" + caja.id_venta);
                                return;
                            }
                        }
                    });
                });
            }

            // Inicializar file-upload
            $modal.find('.custom-file-container').each(function() {
                var uploadId = $(this).data('upload-id');
                if (uploadId) {
                    new FileUploadWithPreview(uploadId);
                }
            });

            // Inicializar select2
            $modal.find(".select2_modal").each(function() {
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

            resolve();
        });
    }

    // -----------------------------------------------------------------
    // GUARDAR, ACTUALIZAR Y ELIMINAR
    // -----------------------------------------------------------------


    // -----------------------------------------------------------------
    // ACTUALIZAR DATA
    // -----------------------------------------------------------------

    actualizarStepsWizard() {

        if(this.advances.length > 0 || this.status == "in_parts"){
            $('.div_adelanto_modal').show();
        }else{
            $('.div_adelanto_modal').hide();
        }

        // detectamos si hay adelantos
        var adelantos_acumulados = 0;

        // calculamos adelantos
        this.advances.forEach(advance => {
            adelantos_acumulados = adelantos_acumulados + this.formatNumber(advance.advance_amount);
        });

        // convertimos el string de this.amount de texto a Number
        const amount = this.formatNumber(this.amount);
        const discount = this.formatNumber(this.discount);
        const tax = this.formatNumber(this.tax);
        const money_advance = this.formatNumber(this.money_advance);
        const total_payment = (this.status == "in_parts") ? money_advance : (amount - adelantos_acumulados);

        // descuento y porcentaje
        this.discount = (this.discount_type == 'porcentaje') ? (amount * this.discount_quantity / 100) : this.discount_quantity;
        this.discount = this.formatPrice(this.discount);

        // metodo de pago y su porcentaje
        this.payment_method = (this.payment_method_type == "porcentaje") ? (total_payment * this.payment_method_quantity / 100) : this.payment_method_quantity;
        this.payment_method = this.formatPrice(parseFloat(this.payment_method));

        // impuestos y porcentaje
        this.tax = this.formatPrice(amount * this.formatNumber(this.tax_quantity) / 100);
        this.tax = (this.tax_type == "out_price") ? this.tax : this.formatPrice(0);

        // calculamos el total
        this.total = amount - discount + tax - adelantos_acumulados;
        this.total = this.formatPrice(this.total);

        // ACTUALIZAMOS CLIENTES
        $(".modal_cliente").html(`<span>${this.customer_name}</span>`);

        // ACTUALIZAMOS EL DOM
        $('#total-amount').text("Cobrar: S/." + this.formatPrice(amount));
        $('#total-tax').text(this.formatPrice(tax));
        $('#total-discount').text(this.formatPrice(discount));
        $('#total-amount-final').text(this.total);

        // SUBTOTAL
        $('.subtotal_modal').text(`S/.${this.formatPrice(amount)}`);

        // PAGO
        var adicional = (this.payment_method_type == 'porcentaje') ? ` (+${this.payment_method_quantity}%)` : ` (+S/.${this.payment_method_quantity})`;
        $('.forma_pago_tipo_modal').text(this.payment_method_name + adicional);
        $('.forma_pago_modal').text(`S/.${total_payment} + S/.${this.payment_method}`);

        // DESCUENTO
        var adicional = (this.discount_type == 'porcentaje') ? `(-${this.discount_quantity}%)` : `(-S/.${this.discount_quantity})`;
        $('.descuento_titulo_modal').text(`Descuento: - ${this.discount_name} ${adicional}`);
        $('.descuento_modal').text(`S/.${this.discount}`);

        // TAX
        var adicional = (this.tax_type == 'out_price') ? ` (+${this.tax_quantity}%)` : ``;
        $('.documento_tipo_modal').text(this.tax_name + adicional);
        $('.documento_modal').text(`S/.${this.tax}`);

        // ADELANTOS ACUMULADOS
        $('.adelanto_acumulado_modal').text(`S/.${this.formatPrice(adelantos_acumulados)}`);
        $('.adelanto_modal').html("S/." + this.money_advance);
        $('.restante_modal').html("S/." + (this.formatNumber(this.total) - this.formatNumber(this.money_advance)));

        // TOTAL
        $('.total_modal').text(`Total: S/.${this.formatPrice(amount - discount + tax)}`);
        $('.total_modal_calculadora').text(`Total: S/.${this.formatNumber(total_payment) + this.formatNumber(this.payment_method)}`);

    }

    actualizarProductosReq(){
        var html_producto_generado = '';

        this.products.forEach(product => {
            if (product.requirements && product.requirements.length > 0) {
                html_producto_generado += `<label style="color: black; font-weight: 800;">${product.name}</label>`;
                product.requirements.forEach(requirement => {
                    if (requirement.type === 'imagen') {
                        html_producto_generado += `
                            <div class="mb-2">
                                <label>Subir ${requirement.name} <a href="javascript:void(0)" title="Clear Image">x</a></label>
                                <input type="file" accept="image/*" name="requerimiento_${requirement.name}">
                            </div>
                        `;
                    } else if (requirement.type === 'documentos') {
                        html_producto_generado += `
                            <div class="mb-2">
                                <label>Subir ${requirement.name} <a href="javascript:void(0)" title="Clear Document">x</a></label>
                                <input type="file" accept="application/msword, application/pdf" name="requerimiento_${requirement.name}">
                            </div>
                        `;
                    } else if (requirement.type === 'texto') {
                        html_producto_generado += `
                            <div class="mb-2">
                                <p class="mt-1">${requirement.name}</p>
                                <div class="mb-4">
                                    <input class="input_cantidad form-control" type="text" value="" name="requerimiento_${requirement.name}" required>
                                </div>
                            </div>
                        `;
                    }
                });
            }
        });

        if(html_producto_generado == ''){
            removeStepByTitle(this.modal, "Productos");
            return;
        }

        createStepByTitle(this.modal,"Productos", "Detalle", true, html_producto_generado);
    }

    actualizarPagoReq(){
        var html_pago_generado = '';
        var payment_data = [];
        payment_data.requirements = [];

        this.payment_method_data.forEach(payment => {
            // aqui queremos determinar traer elelemento de payment_method_data que tenga el mismo id que payment_method
            if (payment.id == this.payment_method) {
                payment_data = payment;
            }
        });


        if(this.payment_method == "ninguno" || payment_data.requirements.length == 0){
            removeStepByTitle(this.modal, "Finalizar");
            return;
        }

        for (var i = 0; i < this.payment_method_data.length; i++) {
            if (this.payment_method_data[i].id == this.payment_method) {

                var html_pago_generado = '<label style="color: black; font-weight: 800;">Requeremiento para hacer el pago</label>';

                this.payment_method_data[i].requirements.forEach(requirement => {

                    if (requirement.type === 'imagen') {
                        html_pago_generado += `
                            <div class="mb-2">
                                <label>Subir ${requirement.name} <a href="javascript:void(0)" title="Clear Image">x</a></label>
                                <input type="file" accept="image/*" name="${requirement.name}">
                            </div>
                        `;
                    } else if (requirement.type === 'documento') {
                        html_pago_generado += `
                            <div class="mb-2">
                                <label>Subir ${requirement.name} <a href="javascript:void(0)" title="Clear Document">x</a></label>
                                <input type="file" accept="application/msword, application/pdf" name="${requirement.name}">
                            </div>
                        `;
                    } else if (requirement.type === 'texto') {
                        html_pago_generado += `
                            <div class="mb-2">
                                <p class="mt-1">${requirement.name}</p>
                                <div class="mb-4">
                                    <input class="input_cantidad form-control" type="text" value="" name="${requirement.name}" required>
                                </div>
                            </div>
                        `;
                    }

                });
            }
        }

        createStepByTitle(this.modal,"Finalizar", "Pago", false, html_pago_generado);
    }

    actualizarProductosModal() {
        let productListHtml = `
            <div class="t-dot">
                <div class="t-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </div>
            </div>
            <div class="t-content">
                <div class="t-uppercontent">
                    <h5>Productos</h5>
                </div>
        `;
        this.products.forEach(product => {
            productListHtml += `
                    <div class="t-uppercontent">
                        <p>${product.quantity} ${product.name}</p>
                        <span class="">S/.${this.formatPrice(parseFloat(product.sale_price) * parseFloat(product.quantity))}</span>
                    </div>`;
        });

        productListHtml += `</div>`;
        $('.product_list_modal').html(productListHtml);
    }

    // -----------------------------------------------------------------
    // RESET
    // -----------------------------------------------------------------

    resetCash(){
        this.initCaja();
        // CAMBIAMOS EL DOM
        $("#document_client").val("");
        $("#document_client").prop('disabled', false);
        $("#div_car_registration").hide();
        $('.modal_cliente').html(`<span></span>`);
        $('.inputs-nueva-venta').children('.nav-item').remove();
        $('#total-amount').text("Cobrar: S/.0.00");
        $('#total-tax').text(this.formatPrice(0));
        $('#total-discount').text(this.formatPrice(0));
        $('#total-amount-final').text(this.formatPrice(0));
        this.actualizarStepsWizard();
    }

    // -----------------------------------------------------------------
    // LISTENERS
    // -----------------------------------------------------------------

    initListeners() {

        // -----------------------------------------------------------------
        // PRODUCTOS
        // -----------------------------------------------------------------

        $(document).on('click', '.agregar-producto', (e) => {
            e.preventDefault();
            var productId = $(e.currentTarget).data('id');
            this.obtenerProducto(productId);
        });

        $(document).on('click', '.delete_product', (e) => {
            e.preventDefault();
            var productId = $(e.currentTarget).attr('data');
            this.eliminarProducto(productId, $(e.currentTarget).closest('li'));
        });

        // -----------------------------------------------------------------
        // CLINTE
        // -----------------------------------------------------------------

        $(document).on('input', '#document_client', (e) => {
            const documentValue = $(e.currentTarget).val();
            if (documentValue.length == 8) {
                this.buscarCliente();
            }else{
                removeStepByTitle(this.modal, "Agregar cliente");
                $("#div_car_registration").hide();
                $('.modal_cliente').html(`<span></span>`);
            }
        });

        // -----------------------------------------------------------------
        // VENTA
        // -----------------------------------------------------------------

        $(document).on('change', '#status_sale', (e) => {
            this.status = $(e.currentTarget).val();
            console.log(this.status);
            // REINICIAR STEPS
            removeStepByTitle(this.modal, "Productos");
            removeStepByTitle(this.modal, "Pago");
            removeStepByTitle(this.modal, "Finalizar");
            $('#money_advance').remove();
            $('.div_adelanto_modal').hide();

            if(this.status == 'in_parts'){

                createStepByTitle(this.modal,"Pago", "Detalle", false, paso_agregar_botones);
                this.actualizarProductosReq();
                this.actualizarPagoReq();

                $('#div_payment_type').append(`
                    <input type="number" class="form-control" name="money_advance" id="money_advance" placeholder="Ingresa el adelanto que dará el cliente" required="">
                    `);
                $('.div_adelanto_modal').show();

            }else if(this.status == 'charged'){

                createStepByTitle(this.modal,"Pago", "Detalle", false, paso_agregar_botones);
                this.actualizarProductosReq();
                this.actualizarPagoReq();
                $('.div_adelanto_modal').hide();

            }

            this.actualizarStepsWizard();
            this.documentRequired();
        });

        $(document).on('change', '#status_sale_pay', (e) => {

            this.status = $(e.currentTarget).val();
            removeStepByTitle(this.modal, "Productos");
            removeStepByTitle(this.modal, "Pago");
            removeStepByTitle(this.modal, "Finalizar");
            $('#money_advance').remove();
            $('.div_adelanto_modal').hide();

            if(this.status == 'in_parts'){

                createStepByTitle(this.modal,"Pago", "Detalle", false, paso_agregar_botones, 2);
                this.actualizarProductosReq();
                this.actualizarPagoReq();
                $('#div_payment_type_sale').append(`
                    <input type="number" class="form-control" name="money_advance" id="money_advance" placeholder="Ingresa el adelanto que dará el cliente" required="">
                    `);
                $('.div_adelanto_modal').show();

            }else if(this.status == 'charged'){

                createStepByTitle(this.modal,"Pago", "Detalle", false, paso_agregar_botones, 2);
                this.actualizarProductosReq();
                this.actualizarPagoReq();

                if(this.advances.length > 0){
                    $('.div_adelanto_modal').show();
                }else{
                    $('.div_adelanto_modal').hide();
                }
            }

            this.actualizarStepsWizard();
        });

        $(document).on('change', '#discount_sale_select', (e) => {
            this.discount_id = $(e.currentTarget).val();

            if(this.discount_id == "ninguno"){
                this.discount = 0;
                this.discount_id = 0;
                this.discount_type = 'ninguno';
                this.discount_name = '';
                this.discount_quantity = 0;
                return;
            }

            this.discount_data.forEach((discount) => {
                if(discount.id == this.discount_id){
                    const descuento = discount.markdown;
                    this.discount_id = discount.id;
                    this.discount_type = discount.type;
                    this.discount_name = discount.name;
                    this.discount_quantity = discount.markdown;
                }
            });

            this.actualizarStepsWizard();
        });

        $(document).on('change', '#discount_sale_select_pay', (e) => {
            this.discount_id = $(e.currentTarget).val();

            if(this.discount_id == "ninguno"){
                this.discount = 0;
                this.discount_id = 0;
                this.discount_type = 'ninguno';
                this.discount_name = '';
                this.discount_quantity = 0;
                return;
            }

            this.discount_data.forEach((discount) => {
                if(discount.id == this.discount_id){
                    const descuento = discount.markdown;
                    this.discount_id = discount.id;
                    this.discount_type = discount.type;
                    this.discount_name = discount.name;
                    this.discount_quantity = discount.markdown;
                }
            });

            this.actualizarStepsWizard();
        });

        $(document).on('change', '#document_sale', (e) => {
            this.accounting_document_id = $(e.currentTarget).val();

            if(this.accounting_document_id == "ninguno" || this.accounting_document_id == "" || this.accounting_document_id == null){
                this.tax = 0;
                this.tax_id = 0;
                this.tax_quantity = 0;
                this.tax_type = '';
                this.tax_name = '';
                return;
            }

            this.document_data.forEach((document) => {
                if(document.id == this.accounting_document_id){
                    this.tax_id = document.id;
                    this.tax_type = document.tax_type;
                    this.tax_name = document.name;
                    this.tax_quantity = document.sale_percentage;
                }
            });

            this.actualizarStepsWizard();
        });

        $(document).on('change', '#payment_sale', (e) => {
            this.payment_method = $(e.currentTarget).val();

            if(this.payment_method == "ninguno" || this.payment_method == "" || this.payment_method == null){
                this.payment_method = 0;
                this.payment_method_id = 0;
                this.payment_method_type = '';
                this.payment_method_name = '';
                this.payment_method_quantity = 0;
                return;
            }

            this.payment_method_data.forEach((payment) => {
                if(payment.id == this.payment_method){
                    this.payment_method_id = payment.id;
                    this.payment_method_name = payment.name;
                    this.payment_method_type = payment.type;
                    this.payment_method_quantity = payment.commission;
                }
            });

            this.actualizarStepsWizard();
        });

        $(document).on('change', '#payment_sale_pay', (e) => {
            this.payment_method = $(e.currentTarget).val();

            if(this.payment_method == "ninguno" || this.payment_method == "" || this.payment_method == null){
                this.payment_method = 0;
                this.payment_method_id = 0;
                this.payment_method_type = '';
                this.payment_method_name = '';
                this.payment_method_quantity = 0;
                return;
            }

            this.payment_method_data.forEach((payment) => {
                if(payment.id == this.payment_method){
                    this.payment_method_id = payment.id;
                    this.payment_method_name = payment.name;
                    this.payment_method_type = payment.type;
                    this.payment_method_quantity = payment.commission;
                }
            });

            this.actualizarStepsWizard();
        });

        $(document).on('input', '#money_advance', (e) => {

            this.money_advance = $(e.currentTarget).val();
            console.log(this.money_advance);
            const total = this.formatNumber(this.total);

            if(this.money_advance > total){
                alert("El adelanto no puede ser mayor al total de la venta");
                $('#div_adelanto_modal').show();
                this.money_advance = this.total;
                $('#money_advance').val(this.total);
            }else if(this.money_advance == ""){
                $('#div_adelanto_modal').hide();
                this.money_advance = 0;
                $('#money_advance').val("");
            }

            this.actualizarStepsWizard();
        });

        $(document).on('click', '.caja-panel-cerrar-venta', (e) => {

            // verificar que el total no sea menor que los adelantos
            // =====================================================
            const amount = this.formatNumber(this.amount);
            const discount = this.formatNumber(this.discount);
            const tax = this.formatNumber(this.tax);

            console.log(caja.advances.length + ">" + 0, caja.advances.length > 0)
            if(caja.advances.length > 0){
                let advances = caja.money_advance;
                caja.advances.forEach((advance) => {
                    let adelanto = parseFloat(advance.advance_amount);
                    advances += adelanto;
                });
                let deuda_final = (amount - discount + tax) - advances;

                console.log(deuda_final + '<' + 0, deuda_final < 0);

                if(deuda_final < 0){
                    alert('Los delantos son mayores al total de la venta. Agregue productos para poder realizar la venta');
                    return;
                }
            }

            // ejecuramos el modal
            // ===================
            this.modal_tipe = (caja.accion == 'venta') ? 'create' : 'edit';

            if (this.products.length > 0) {
                this.abrirModal();
            }
        });

        $(document).on('click', '.number', (e) => {
            var value = $(e.currentTarget).text();
            this.actualizarPagoCliente(value);
        });
    }
}
