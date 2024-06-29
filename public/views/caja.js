const paso_agregar_cliente = `
<section>
    <div class="form-group">
        <input type="text" name="name" placeholder="Nombre completo" class="form-control" required>
    </div>
    <div class="form-group">
        <input type="text" name="phone" placeholder="Teléfono de usuario" class="form-control">
    </div>
    <div class="form-group">
        <input type="email" name="email" placeholder="email@mail.com" class="form-control">
    </div>
</section>
`;

const paso_agregar_botones = `
<section>
    <div class="">
        <input type="number" name="input_recibido_modal" id="input_recibido_modal" placeholder="Recibo del cliente" style="height: 70px;width: 100%;font-size: 30px;text-align: center; margin: 0px 0px 30px 0px; color: black;" disabled>

        <div id="pin">
            <div class="numbers">
                <div class="number">1</div>
                <div class="number">2</div>
                <div class="number">3</div>
                <div class="number">4</div>
                <div class="number">5</div>
                <div class="number">6</div>
                <div class="number">7</div>
                <div class="number">8</div>
                <div class="number">9</div>

                <div class="number">.</div>
                <div class="number">0</div>
                <div class="number">C</div>
            </div>
        </div>
    </div>
    <div style="flex-direction: row; display: flex; justify-content: space-around;">
        <p class="mt-1 total_modal" style="font-size: 23px; font-weight: 800; color: #00a90b;"> Total: S/.0.00<p/>
        <p class="mt-1" id="vuelto_modal" style="font-size: 23px; font-weight: 800; color: #a90017;"> Vuelto: S/.0.00<p/>
    </div>
</section>
`;

function removeStepByTitle(title) {
    var steps = $('.wizard').find('h3');
    steps.each(function(index, step) {
        if ($(step).text() === title) {
            $('.wizard').steps('remove', index-1);
            return false;
        }
    });
}





// Inicializar la caja
let caja = new Caja();


// -----------------------------------------------------------------
// ACCESORIOS
// -----------------------------------------------------------------

// BOTOBES VER FACTURA
// $(document).on('click', '.list-actions', function () {
//     var getDataInvoiceAttr = $(this).attr("data-invoice-id");
//     var getParentDiv = $(this).parents(".doc-container");

//     var $el = $("." + this.id).show();
//     $("#ct > div").not($el).hide();
//     var setInvoiceNumber = getParentDiv
//         .find(".invoice-inbox .inv-number")
//         .text("#" + getDataInvoiceAttr);
//     var showInvHeaderSection = getParentDiv
//         .find(".invoice-inbox .invoice-header-section")
//         .css("display", "flex");
//     var showInvContentSection = getParentDiv
//         .find(".invoice-inbox #ct")
//         .css("display", "block");
//     var showInvContentSection = getParentDiv
//         .find(".invoice-inbox")
//         .css("height", "calc(100vh - 232px)");
//     var hideInvEmptyContent = getParentDiv
//         .find(".invoice-inbox .inv-not-selected")
//         .css("display", "none");
//     var hideInvEmptyContent = getParentDiv
//         .find(".invoice-container .inv--thankYou")
//         .css("display", "block");
//     if ($(this).parents(".tab-title").hasClass("open-inv-sidebar")) {
//         $(this).parents(".tab-title").removeClass("open-inv-sidebar");
//     }
//     $btns_facturas_ventas.removeClass("active");
//     $(this).addClass("active");

//     var myDiv = document.getElementsByClassName("invoice-inbox")[0];
//     myDiv.scrollTop = 0;
// });


// -----------------------------------------------------------------
// ACCESORIOS
// -----------------------------------------------------------------

$(".action-print").on("click", function (event) {
    event.preventDefault();
    /* Act on the event */
    window.print();
});

const ps = new PerfectScrollbar(".inv-list-container", {
    suppressScrollX: true,
});

// const inv_container = new PerfectScrollbar(".invoice-inbox", {
//     suppressScrollX: true,
// });

if (window.innerWidth >= 768) {
    // const inv_container = new PerfectScrollbar(".invoice-inbox", {
    //     suppressScrollX: true,
    // });
} else if (window.innerWidth < 768) {
    inv_container.destroy();
}

$(".hamburger, .inv-not-selected p").on("click", function (event) {
    $(".doc-container").find(".tab-title").toggleClass("open-inv-sidebar");
});


// -----------------------------------------------------------------
// MÉTODOS ACCESORIOS
// -----------------------------------------------------------------

function actualizarUI(elemento, mostrarNumeroFactura = "") {
    var getParentDiv = elemento.parents(".doc-container");
    var setInvoiceNumber = getParentDiv
        .find(".invoice-inbox .inv-number")
        .text(mostrarNumeroFactura);

    getParentDiv.find(".invoice-inbox .invoice-header-section").css("display", "none");
    getParentDiv.find(".invoice-inbox #ct").css("display", "none");
    getParentDiv.find(".invoice-inbox").css("height", "calc(100vh - 232px)");
    getParentDiv.find(".invoice-inbox .inv-not-selected").css("display", "flex");
    getParentDiv.find(".invoice-container .inv--thankYou").css("display", "none");

    var myDiv = document.getElementsByClassName("invoice-inbox")[0];
    myDiv.scrollTop = 0;
}


// ============================================
// BOTONES MAS Y MENOS
// ============================================

$(".input_cantidad").TouchSpin({
    initval: 0
});

$("#input_descuento").TouchSpin({
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

$("#input_pago_inicial").TouchSpin({
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

// ============================================
// PERFECT SCROLL
// ============================================

new PerfectScrollbar(".inputs-ventas", {
    suppressScrollX: true,
});

new PerfectScrollbar(".inputs-compras", {
    suppressScrollX: true,
});

new PerfectScrollbar(".inputs-clientes", {
    suppressScrollX: true,
});

new PerfectScrollbar(".inputs-nueva-venta", {
    suppressScrollX: true,
});

// new PerfectScrollbar("#productos", {
//     suppressScrollX: true,
// });

// new PerfectScrollbar("#servicios", {
//     suppressScrollX: true,
// });

// new PerfectScrollbar("#kits", {
//     suppressScrollX: true,
// });

// -----------------------------------------------------------------
// MODAL
// -----------------------------------------------------------------
