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
        <p class="mt-1 total_modal_calculadora" style="font-size: 23px; font-weight: 800; color: #00a90b;"> Total: S/.0.00<p/>
        <p class="mt-1" id="vuelto_modal" style="font-size: 23px; font-weight: 800; color: #a90017;"> Vuelto: S/.0.00<p/>
    </div>
</section>
`;

function createStepByTitle(newTitle, referenceTitle, before, content, number = 1000) {
    var steps = (caja.modal_tipe == 'create') ? $('.wizard').find('h3') : $('.wizard_cobrar_venta').find('h3');
    var referenceIndex = -1;

    // Buscar el índice del elemento de referencia
    steps.each(function(index, step) {
        if ($(step).text() === referenceTitle) {
            referenceIndex = index;
            return false;
        }
    });

    if (referenceIndex === -1) {
        console.error("Elemento de referencia no encontrado");
        return;
    }

    // Determinar el índice de inserción
    var insertIndex = before ? referenceIndex - 1 : referenceIndex;
    insertIndex = (number < 50) ? number : insertIndex;

    // Insertar el nuevo paso
    var $form_wizard = (caja.modal_tipe == 'create') ? $('.wizard') : $('.wizard_cobrar_venta');
    console.log({insertIndex})
    $form_wizard.steps('insert', insertIndex, {
        title: newTitle,
        content: content
    });
}

function removeStepByTitle(title) {
    var steps = (caja.modal_tipe == 'create') ? $('.wizard').find('h3') : $('.wizard_cobrar_venta').find('h3');
    var stepsToRemove = [];

    // Primero encontramos todos los índices de los pasos con el título especificado
    steps.each(function(index, step) {
        if ($(step).text() === title) {
            stepsToRemove.push(index);
        }
    });

    // Luego eliminamos los pasos desde el último hasta el primero para no alterar los índices
    for (var i = stepsToRemove.length - 1; i >= 0; i--) {
        var index = stepsToRemove[i];
        console.log({index});
        if(caja.modal_tipe == 'create'){
            $('.wizard').steps('remove', index-1);
        }else{
            $('.wizard_cobrar_venta').steps('remove', index);
        }
    }
}

// Inicializar la caja
let caja = new Caja();

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
    initval: 0,
    max: 10000000000000,
});

$("#input_descuento").TouchSpin({
    prefix: 'S/.',
    min: 0,
    max: 10000000000000,
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
    max: 10000000000000,
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

// -----------------------------------------------------------------
// MODAL
// -----------------------------------------------------------------
