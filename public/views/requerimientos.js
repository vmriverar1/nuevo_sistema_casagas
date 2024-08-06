function actualizarListaUsuarios(data) {
    initializeDataTable('html5-extension', 'requirements', columns, buttons, tabla_nombre);
}

const buttons = [
    {
        text: 'Crear almacen',
        className: 'btn create_requirements',
        action: function (e, dt, node, config) {
            resetModal('modal-requirements', 'requirements', actualizarListaUsuarios);
            $('#modal-requirements').modal('show');
        }
    }
];

const columns = [
    { data: 'name', title:'Nombre' },
    { data: 'type', title:'Tipo' },
];

const tabla_nombre = "requirements";

$(document).ready(function() {
    initializeDataTable('html5-extension', 'requirements', columns, buttons, actualizarListaUsuarios);
});

