function actualizarListaUsuarios(data) {
    initializeDataTable('html5-extension', 'warehouses', columns, buttons, tabla_nombre);
}

const buttons = [
    {
        text: 'Crear almacen',
        className: 'btn create_warehouses',
        action: function (e, dt, node, config) {
            resetModal('modal-warehouses', 'warehouses', actualizarListaUsuarios);
            $('#modal-warehouses').modal('show');
        }
    }
];

const columns = [
    { data: 'photo', title:'Foto' },
    { data: 'name', title:'Nombres' },
    { data: 'username', title:'Usuario' },
    { data: 'email', title:'Email' },
    { data: 'document_type', title:'Tipo' },
    { data: 'document', title:'Doumento' },
    { data: 'phone', title:'Celular' },
    { data: 'address', title:'Dirección.' },
    { data: 'birthday', title:'Cumpleaños' },
    { data: 'status', title:'Estatus.' },
];

const tabla_nombre = "warehouses";

$(document).ready(function() {
    initializeDataTable('html5-extension', 'warehouses', columns, buttons, actualizarListaUsuarios);
});

// ============================================
// BOTONES MAS Y MENOS
// ============================================

$("#input_alerta").TouchSpin({
    initval: 0
});

