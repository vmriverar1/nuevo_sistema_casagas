function actualizarListaUsuarios(data) {
    initializeDataTable('html5-extension', 'branches', columns, buttons, tabla_nombre);
}

const buttons = [
    {
        text: 'Crear Tienda',
        className: 'btn crear_tienda',
        action: function (e, dt, node, config) {
            resetModal('modal-branches', 'branches', actualizarListaUsuarios);
            $('#modal-branches').modal('show');
        }
    }
];

const columns = [
    { data: 'photo', title: 'Logo' },
    { data: 'company_name', title: 'Tienda' },
    { data: 'email', title: 'Email' },
    { data: 'ruc', title: 'RUC' },
    { data: 'branch_type', title: 'Tipo' },
    { data: 'status', title: 'Estado' },
    { data: 'main_address', title: 'Dirección' },
    { data: 'main_phone', title: 'Telf.' },
    { data: 'secondary_address', title: 'Dirección Sec' },
    { data: 'secondary_phone', title: 'Telf. Sec' },
    { data: 'notes', title: 'Adicional' }
];

const tabla_nombre = "branches";

$(document).ready(function() {
    initializeDataTable('html5-extension', 'branches', columns, buttons, actualizarListaUsuarios);
});

