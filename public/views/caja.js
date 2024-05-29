// -----------------------------------------------------------------
// FUNCIÓN BOTOBES NAVEGACION CAFA
// -----------------------------------------------------------------

// BOTON VENTAS
var $btn_ver_ventas = $(".ver_ventas").click(function () {
    actualizarUI($(this));
    $(".inputs-compras").attr("style", "display: none !important");
    $(".inputs-clientes").attr("style", "display: none !important");
    $(".inputs-nueva-venta").attr("style", "display: none !important");
    $(".caja-panel-venta").attr("style", "display: none !important");
    $(".lista-productos").attr("style", "display: none !important");
    $(".inputs-ventas").attr("style", "display: block !important");
});

// BOTON COMPRAS
var $btn_ver_compras = $(".ver_compras").click(function () {
    actualizarUI($(this));
    $(".inputs-ventas").attr("style", "display: none !important");
    $(".inputs-clientes").attr("style", "display: none !important");
    $(".inputs-nueva-venta").attr("style", "display: none !important");
    $(".caja-panel-venta").attr("style", "display: none !important");
    $(".lista-productos").attr("style", "display: none !important");
    $(".inputs-compras").attr("style", "display: block !important");
});

// BOTON CLIENTE
var $btn_ver_clientes = $(".ver_clientes").click(function () {
    actualizarUI($(this));
    $(".inputs-ventas").attr("style", "display: none !important");
    $(".inputs-compras").attr("style", "display: none !important");
    $(".inputs-nueva-venta").attr("style", "display: none !important");
    $(".caja-panel-venta").attr("style", "display: none !important");
    $(".lista-productos").attr("style", "display: none !important");
    $(".inputs-clientes").attr("style", "display: block !important");
});

// BOTON HACER VENTA
var $btn_nueva_venta = $(".nueva_venta").click(function () {
    actualizarUI($(this));
    $(".inputs-ventas").attr("style", "display: none !important");
    $(".inputs-compras").attr("style", "display: none !important");
    $(".inputs-clientes").attr("style", "display: none !important");
    $(".inputs-nueva-venta").attr("style", "display: block !important; padding-bottom: 100px;");
    $(".lista-productos").attr("style", "display: block !important");
    $(".caja-panel-venta").attr("style", "display: flex !important");
});

// BOTOBES VER FACTURA
var $btns_facturas_ventas = $(".list-actions").click(function () {
    var getDataInvoiceAttr = $(this).attr("data-invoice-id");
    var getParentDiv = $(this).parents(".doc-container");

    var $el = $("." + this.id).show();
    $("#ct > div").not($el).hide();
    var setInvoiceNumber = getParentDiv
        .find(".invoice-inbox .inv-number")
        .text("#" + getDataInvoiceAttr);
    var showInvHeaderSection = getParentDiv
        .find(".invoice-inbox .invoice-header-section")
        .css("display", "flex");
    var showInvContentSection = getParentDiv
        .find(".invoice-inbox #ct")
        .css("display", "block");
    var showInvContentSection = getParentDiv
        .find(".invoice-inbox")
        .css("height", "calc(100vh - 232px)");
    var hideInvEmptyContent = getParentDiv
        .find(".invoice-inbox .inv-not-selected")
        .css("display", "none");
    var hideInvEmptyContent = getParentDiv
        .find(".invoice-container .inv--thankYou")
        .css("display", "block");
    if ($(this).parents(".tab-title").hasClass("open-inv-sidebar")) {
        $(this).parents(".tab-title").removeClass("open-inv-sidebar");
    }
    $btns_facturas_ventas.removeClass("active");
    $(this).addClass("active");

    var myDiv = document.getElementsByClassName("invoice-inbox")[0];
    myDiv.scrollTop = 0;
});

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

$(".caja-panel-cerrar-venta").on("click", function (event) {
    $('#modal-cerar-venta').modal('show');
});

$("#circle-basic").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    autoFocus: true,
    cssClass: 'circle wizard'
});
