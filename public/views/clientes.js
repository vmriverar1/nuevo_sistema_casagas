function actualizarListaUsuarios(data) {
    initializeDataTable('html5-extension', 'clients', columns, buttons, tabla_nombre);
}

const buttons = [
    {
        text: 'Crear cliente',
        className: 'btn create_clients',
        action: function (e, dt, node, config) {
            resetModal('modal-clients', 'clients', actualizarListaUsuarios);
            $('#modal-clients').modal('show');
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

const tabla_nombre = "clients";

$(document).ready(function() {
    initializeDataTable('html5-extension', 'clients', columns, buttons, actualizarListaUsuarios);
});


