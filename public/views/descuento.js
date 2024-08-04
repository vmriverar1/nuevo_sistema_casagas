function actualizarListaUsuarios(data) {
    initializeDataTable('html5-extension', 'discounts', columns, buttons, tabla_nombre);
}

const buttons = [
    {
        text: 'Crear descuento',
        className: 'btn create_discounts',
        action: function (e, dt, node, config) {
            resetModal('modal-discounts', 'discounts', actualizarListaUsuarios);
            $('#modal-discounts').modal('show');
        }
    }
];

const columns = [
    { data: 'name', title:'Nombre' },
    { data: 'type', title:'Tipo' },
    { data: 'markdown', title:'Descuento' },
    { data: 'status', title:'Estado' },
];

const tabla_nombre = "discounts";

$(document).ready(function() {
    initializeDataTable('html5-extension', 'discounts', columns, buttons, actualizarListaUsuarios);
});

