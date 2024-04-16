$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = parseInt( $('#min').val(), 10 );
        var max = parseInt( $('#max').val(), 10 );
        var age = parseFloat( data[3] ) || 0; // use data for the age column

        if ( ( isNaN( min ) && isNaN( max ) ) ||
             ( isNaN( min ) && age <= max ) ||
             ( min <= age   && isNaN( max ) ) ||
             ( min <= age   && age <= max ) )
        {
            return true;
        }
        return false;
    }
);

$('#html5-extension').DataTable( {
    dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
    buttons: {
        buttons: [
            {
                text: 'Crear producto',
                className: 'btn crear_producto',
                action: function ( e, dt, node, config ) {
                    // Aquí puedes añadir tu lógica para "Crear producto"
                    $('#modal-productos').modal('show');
                }
            },
            {
                text: 'Crear kit',
                className: 'btn crear_kit',
                action: function ( e, dt, node, config ) {
                    // Aquí puedes añadir tu lógica para "Crear kit"
                    $('#modal-kit').modal('show');
                }
            },
            {
                text: 'Mercadería',
                className: 'btn crear_mercaderia',
                action: function ( e, dt, node, config ) {
                    // Aquí puedes añadir tu lógica para "Agregar mercadería"
                    $('#modal-mercaderia').modal('show');
                }
            },
            { extend: 'excel', className: 'btn' },
            { extend: 'print', className: 'btn' }
        ]
    },
    "oLanguage": {
        "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
        "sInfo": "Página actual _PAGE_ de _PAGES_",
        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        "sSearchPlaceholder": "Buscar...",
       "sLengthMenu": "Results :  _MENU_",
    },
    "stripeClasses": [],
    "lengthMenu": [7, 10, 20, 50],
    "pageLength": 17 ,
    responsive: true
} );
// Event listener to the two range filtering inputs to redraw on input
$('#min, #max').keyup( function() { table.draw(); } );

// ============================================
// PASOS WIZARD
// ============================================

// $("selector").steps({
//     cssClass: 'circle wizard'
// });

$("#circle-basic").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    autoFocus: true,
    cssClass: 'circle wizard'
});

$("#circle-basic-2").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    autoFocus: true,
    cssClass: 'circle wizard'
});

$("#circle-basic-3").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    autoFocus: true,
    cssClass: 'circle wizard'
});

// ============================================
// BOTONES MAS Y MENOS
// ============================================

// PRODUCTOS

$("#input_cantidad").TouchSpin({
    initval: 0
});

$("#input_costo").TouchSpin({
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

$("#input_precio").TouchSpin({
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

// KIT

$("#input_cantidad_kit").TouchSpin({
    initval: 0
});

$("#input_costo_kit").TouchSpin({
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

$("#input_precio_kit").TouchSpin({
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

// MERCADERIA

$("#input_costo_mercaderia").TouchSpin({
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


$("#select-almacen").select2({
    tags: true,
    dropdownParent: $("#modal-productos")
}).data('select2').$container.addClass('form-control-sm');

$("#select-marca").select2({
    tags: true,
    dropdownParent: $("#modal-productos")
}).data('select2').$container.addClass('form-control-sm');

$("#select-tienda").select2({
    tags: true,
    dropdownParent: $("#modal-mercaderia")
}).data('select2').$container.addClass('form-control-sm');

$("#select-producto-kit").select2({
    tags: true,
    dropdownParent: $("#modal-kit")
}).data('select2').$container.addClass('form-control-sm');

$("#select-producto-mercaderia").select2({
    tags: true,
    dropdownParent: $("#modal-mercaderia")
}).data('select2').$container.addClass('form-control-sm');

$("#select-producto-trasladar").select2({
    tags: true,
    dropdownParent: $("#modal-mercaderia")
}).data('select2').$container.addClass('form-control-sm');


$(".basic").select2({
    tags: true,
});

// var formSmall = $(".form-small").select2({ tags: true });
// formSmall.data('select2').$container.addClass('form-control-sm')

$(".nested").select2({
    tags: true
});
$(".tagging").select2({
    tags: true
});
$(".disabled-results").select2();
$(".placeholder").select2({
    placeholder: "Make a Selection",
    allowClear: true
});

function formatState (state) {
if (!state.id) {
    return state.text;
}
var baseClass = "flaticon-";
var $state = $(
    '<span><i class="' + baseClass + state.element.value.toLowerCase() + '" /> ' + state.text + '</i> </span>'
);
return $state;
};

$(".templating").select2({
    templateSelection: formatState
});


// ============================================
//  PREVISUALIZACIÓN DE IMAGENES
// ============================================

//First upload
var firstUpload = new FileUploadWithPreview('myFirstImage');
//Second upload
var secondUpload = new FileUploadWithPreview('mySecondImage');
