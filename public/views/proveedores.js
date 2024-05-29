function actualizarListaUsuarios(data) {
    initializeDataTable('html5-extension', 'suppliers', columns, buttons, tabla_nombre);
}

const buttons = [
    {
        text: 'Crear proveedor',
        className: 'btn create_suppliers',
        action: function (e, dt, node, config) {
            resetModal('modal-suppliers', 'suppliers', actualizarListaUsuarios);
            $('#modal-suppliers').modal('show');
        }
    }
];

const columns = [
    { data: 'photo', title:'Foto' },
    { data: 'name', title:'Nombres' },
    { data: 'email', title:'Email' },
    { data: 'document_type', title:'Tipo' },
    { data: 'document', title:'Doumento' },
    { data: 'phone', title:'Celular' },
    { data: 'address', title:'Dirección.' },
    { data: 'birthday', title:'Cumpleaños' },
];

const tabla_nombre = "suppliers";

$(document).ready(function() {
    initializeDataTable('html5-extension', 'suppliers', columns, buttons, actualizarListaUsuarios);
});


