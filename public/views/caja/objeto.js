// -----------------------------------------------------------------
// CAJA
// -----------------------------------------------------------------

class Caja {
    constructor() {
        this.initCaja();
        this.initListeners();
    }

    initCaja() {
        this.status = '';
        this.customer_id = '';
        this.customer_name = '';
        this.products = [];
        this.amount = 0;
        this.sale_discount = [];
        this.accounting_document_id = '';
        this.content_requirements = '';
        this.money_advance = 0;
        this.change = 0;
        this.total = 0;
        // documento
        this.tax = 0;
        this.tax_id = 0;
        this.tax_type = '';
        this.tax_name = '';
        this.tax_quantity = 0;
        this.document_data = document_data_complete;
        // descuento
        this.discount = 0;
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

    initListeners() {
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

        $(document).on('input', '#document_client', (e) => {
            const documentValue = $(e.currentTarget).val();
            if (documentValue.length == 8) {
                this.buscarCliente();
            }else{
                removeStepByTitle("Agregar cliente");
                $("#div_car_registration").hide();
                $('#modal_cliente').html(`<span></span>`);
            }
        });

        $(document).on('change', '#status_sale', (e) => {
            this.status = $(e.currentTarget).val();
            if(this.status == 'in_parts'){
                $('#div_payment_type').append(`
                    <input type="number" class="form-control" name="money_advance" id="money_advance" placeholder="Ingresa el adelanto que dará el cliente" required="">
                    `);
                $('.div_adelanto_modal').show();
            }else{
                $('#money_advance').remove();
                $('.div_adelanto_modal').hide();
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
                    this.discount = (this.discount_type == 'porcentaje') ? parseFloat(this.amount) * descuento / 100 : descuento;
                    this.discount = this.formatPrice(this.discount);
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
                    this.tax = this.formatPrice(parseFloat(this.amount) * document.sale_percentage / 100);
                    this.tax = (this.tax_type == "out_price") ? this.tax : this.formatPrice(0);
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
                    this.payment_method = (this.payment_method_type == "porcentaje") ? (parseFloat(this.amount) * payment.commission / 100) : payment.commission;
                    this.payment_method = this.formatPrice(parseFloat(this.payment_method));
                }
            });

            this.actualizarStepsWizard();
        });

        $(document).on('input', '#money_advance', (e) => {
            this.money_advance = $(e.currentTarget).val();
            $('.adelanto_modal').html("S/." + this.money_advance);
            $('.restante_modal').html("S/." + (parseFloat(this.total) - parseFloat(this.money_advance)));
            if(this.money_advance > this.total){
                alert("El adelanto no puede ser mayor al total de la venta");
                $('#div_adelanto_modal').show();
                this.money_advance = this.total;
                $('#money_advance').val(this.total);
            }else if(this.money_advance == "" || this.money_advance == 0){
                $('#div_adelanto_modal').hide();
                this.money_advance = 0;
                $('#money_advance').val("");
            }

            if (this.status === 'in_parts' || this.money_advance > 0) {
                $('.total_modal').text(`Adelanto S/.${this.money_advance}`);
            }else{
                $('.total_modal').text(`Total: S/.${this.total}`);
            }
        });

        $(document).on('click', '.caja-panel-cerrar-venta', (e) => {

            if (this.products.length > 0) {
                this.abrirModal();
            }
        });

        $(document).on('click', '.number', (e) => {
            var value = $(e.currentTarget).text();
            this.actualizarPagoCliente(value);
        });
    }

    obtenerProducto(id) {
        let existingProduct = this.products.find(p => p.id === id);
        if (existingProduct) {
            existingProduct.quantity++;
            this.actualizarCantidadProducto(id, existingProduct.quantity);
            $(`input[data=${id}]`).val(existingProduct.quantity).trigger('change');
            return;
        }

        axios.get('/producto/' + id)
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
                    max: data.stock
                });

                $(`#${uniqueId}`).on('change', (e) => {
                    var quantity = parseFloat($(e.currentTarget).val());
                    if (quantity > data.stock) {
                        $(e.currentTarget).val(data.stock);
                        quantity = data.stock;
                    } else if (quantity <= 0) {
                        this.eliminarProducto(data.id, $(e.currentTarget).closest('li'));
                        return;
                    }
                    this.actualizarCantidadProducto(data.id, quantity);
                });

                this.agregarProducto(data);
            })
            .catch((error) => {
                console.error('Error al obtener producto:', error);
            });
    }

    agregarProducto(product) {
        let existingProduct = this.products.find(p => p.id === product.id);
        if (existingProduct) {
            existingProduct.quantity++;
        } else {
            product.quantity = 1;
            this.products.push(product);
        }
        this.calcularMonto();
    }

    actualizarCantidadProducto(id, quantity) {
        let product = this.products.find(p => p.id === id);
        if (product) {
            product.quantity = quantity;
            this.calcularMonto();
        }
    }

    eliminarProducto(id, element) {
        this.products = this.products.filter(p => p.id !== parseInt(id));
        element.remove();
        this.calcularMonto();
    }

    calcularMonto() {
        this.amount = this.products.reduce((total, product) => total + (product.sale_price * product.quantity), 0);
        this.products.forEach(product => {
            $(`li[data-product-id="${product.id}"] .amount_product`).html(`<span>Total:</span> S/.${this.formatPrice(parseFloat(product.sale_price) * parseFloat(product.quantity))}`);
        });
        this.actualizarTotal();
    }

    actualizarTotal() {
        this.total = this.amount + this.discount + this.tax;
        this.total = this.formatPrice(this.total);
        this.mostrarTotales();
    }

    mostrarTotales() {
        $('#total-amount').text("Cobrar: S/." + this.formatPrice(this.amount));
        $('#total-tax').text(this.formatPrice(this.tax));
        $('#total-discount').text(this.formatPrice(this.discount));
        $('#total-amount-final').text(this.formatPrice(this.total));
    }

    buscarCliente() {
        const documentValue = $('#document_client').val();

        axios.get('/cliente-data/' + documentValue)
            .then((response) => {
                const data = response.data;
                console.log({data});
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
                $('#modal_cliente').html(`<span>${data.name}</span>`);
                $("#div_car_registration").show();
                $("#document_client").val(data.document);
                $("#document_client").prop('disabled', true);
                removeStepByTitle("Agregar cliente");
            })
            .catch((error) => {
                // AGREGAMOS LOS DATOS AL OBJETO
                this.customer_id = '';
                this.customer_name = '';
                // AGREGAMOS LOS DATOS AL OBJETO
                this.customer_id = $("#document_client").val();
                $('#modal_cliente').html(`<span></span>`);

                removeStepByTitle("Agregar cliente");

                if (error.response.status === 404) {
                    // CAMBIAMOS EL DOM
                    $("#div_car_registration").show();
                    // INSERTAR PASO
                    var step = {
                        title: "Agregar cliente",
                        content: paso_agregar_cliente
                    };
                    $('.wizard').steps('insert', 1, step);
                } else {
                    // CAMBIAMOS EL DOM
                    $("#document_client").val("");
                    $("#div_car_registration").hide();
                    $('#modal_cliente').html(`<span></span>`);
                    // ALERTA DE ERROR
                    alert("Ocurrió un error en la consulta de documentos, vuelve a intentarlo");
                }
            });
    }

    async abrirModal() {
        $("#div_car_registration").hide();
        await this.resetModal();
        this.verificarCarRegistrations();
        this.verificarRequirements();
        $('#modal-cerrar-venta').modal('show');
        this.actualizarModal();
    }

    resetCash(){
        this.initCaja();
        // CAMBIAMOS EL DOM
        $("#document_client").val("");
        $("#document_client").prop('disabled', false);
        $("#div_car_registration").hide();
        $('#modal_cliente').html(`<span></span>`);
        $('.inputs-nueva-venta').children('.nav-item').remove();
        $('#total-amount').text("Cobrar: S/.0.00");
        $('#total-tax').text(this.formatPrice(0));
        $('#total-discount').text(this.formatPrice(0));
        $('#total-amount-final').text(this.formatPrice(0));
        this.actualizarStepsWizard();
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
            $('#document_client').prop('required', true);
        } else {
            $('#div_car_registration').empty();
            $('#document_client').prop('required', false);
        }
        this.actualizarRequisitosDocumento();
    }

    verificarRequirements() {
        removeStepByTitle("Productos");

        let html_generado = '<section>';
        let hasRequirements = false;
        this.products.forEach(product => {
            if (product.requirements && product.requirements.length > 0) {
                hasRequirements = true;
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
        if (hasRequirements) {
            $('#document_client').prop('required', true);
        } else {
            $('#document_client').prop('required', false);
        }
        this.actualizarRequisitosDocumento();
    }

    actualizarRequisitosDocumento() {
        let carReg = this.products.some(product => product.car_registration && product.car_registration === 'activo');
        let req = this.products.some(product => product.requirements && product.requirements.length > 0);
        if (carReg || req) {
            $('#document_client').prop('required', true);
        } else {
            $('#document_client').prop('required', false);
        }
    }

    actualizarModal() {
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

        $('#product_list_modal').html(productListHtml);
        if (this.status === 'in_parts' || this.money_advance > 0) {
            $('.total_modal').html(`Adelanto S/.${this.money_advance}`);
        }else{
            $('.total_modal').html(`Total: S/.${this.total}`);
        }
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
        var total_calcular = (this.status === 'in_parts' || this.money_advance > 0) ? this.money_advance : this.total;

        if (!isNaN(pagoCliente) && pagoCliente >= total_calcular) {
            let vuelto = pagoCliente - total_calcular;
            $('#vuelto_modal').html(`Vuelto: S/.${this.formatPrice(vuelto)}`);
            this.change = this.formatPrice(product.vuelto);
            this.formatPrice(product.vuelto);
        } else {
            $('#vuelto_modal').html('');
            this.change = 0;
        }
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

    // -----------------------------------------------------------------
    // FUNCIONES DE MODAL
    // -----------------------------------------------------------------

    async resetModal(type='save'){
        const $modal = $('#modal-cerrar-venta');

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
        $("#document_client").prop('disabled', false);
        $("#div_car_registration").hide();
        $('#modal_cliente').html(`<span></span>`);

        await this.destroyComponents($modal);
        await this.initializeComponents($modal, type);
    }

    async destroyComponents($modal){
        return new Promise((resolve) => {
            // Destruir wizard
            var $wizard = $modal.find('.wizard');
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

    async initializeComponents($modal, type) {
        return new Promise((resolve) => {
            // Inicializar wizard
            var $wizard = $modal.find('.wizard');
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
                            $("#modal-cerrar-venta").find('.wizard').find('.actions ul').find('.btn-next').prop('disabled', true);
                            if (type == "save") {
                                submitForm($("#modal-cerrar-venta form"));
                            } else if (type == "update") {
                                updateForm(modalId, route, callback);
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
    // ACTUALIZAR DOM
    // -----------------------------------------------------------------

    actualizarStepsWizard() {
        var paso_final =2;
        removeStepByTitle("Productos");
        removeStepByTitle("Pago");
        if(this.status === 'in_parts' || this.status === 'charged'){
            var stepProducts = {
                title: "Productos",
                content: this.content_requirements
            };
            $('.wizard').steps('insert', 1, stepProducts);

            var stepPago = {
                title: "Pago",
                content: paso_agregar_botones
            };
            $('.wizard').steps('insert', 3, stepPago);

            paso_final = 4;
        }

        for (var i = 0; i < this.payment_method_data.length; i++) {
            if (this.payment_method_data[i].id == this.payment_method || this.payment_method == "ninguno") {
                removeStepByTitle("Finalizar");

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

                if(this.payment_method != "ninguno"){
                    var stepPago = {
                        title: "Finalizar",
                        content: html_pago_generado
                    };

                    $('.wizard').steps('insert', paso_final, stepPago);
                }

            }
        }

        // convertimos el string de this.amount de texto a Number
        this.amount = (this.amount);

        this.total = parseFloat(this.amount) - parseFloat(this.discount) + parseFloat(this.tax) + parseFloat(this.payment_method);
        this.total = this.formatPrice(this.total);

        // SUBTOTAL
        $('.subtotal_modal').text(`S/.${this.formatPrice(this.amount)}`);

        // PAGO
        var adicional = (this.payment_method_type == 'porcentaje') ? ` (+${this.payment_method_quantity}%)` : ` (+S/.${this.payment_method_quantity})`;
        $('.forma_pago_tipo_modal').text(this.payment_method_name + adicional);
        $('.forma_pago_modal').text(`S/.${this.payment_method}`);

        // DESCUENTO
        var adicional = (this.discount_type == 'porcentaje') ? `(-${this.discount_quantity}%)` : `(-S/.${this.discount_quantity})`;
        $('.descuento_titulo_modal').text(`Descuento: - ${this.discount_name} ${adicional}`);
        $('.descuento_modal').text(`S/.${this.discount}`);

        // TAX
        var adicional = (this.tax_type == 'out_price') ? ` (+${this.tax_quantity}%)` : ``;
        $('.documento_tipo_modal').text(this.tax_name + adicional);
        $('.documento_modal').text(`S/.${this.tax}`);

        // TOTAL
        if (this.status === 'in_parts' || this.money_advance > 0) {
            $('.total_modal').text(`Adelanto S/.${this.money_advance}`);
        }else{
            $('.total_modal').text(`Total: S/.${this.total}`);
        }
    }

}
