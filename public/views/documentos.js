function actualizarListaUsuarios(data) {
    initializeDataTable('html5-extension', 'accounting-documents', columns, buttons, tabla_nombre);
}

const buttons = [
    {
        text: 'Crear documento',
        className: 'btn create_accounting-documents',
        action: function (e, dt, node, config) {
            resetModal('modal-accounting-documents', 'accounting-documents', actualizarListaUsuarios);
            $('#modal-accounting-documents').modal('show');
        }
    }
];

const columns = [
    { data: 'name', title:'Nombre' },
    { data: 'electronic_billing', title:'Facturación Electrónica' },
    { data: 'tax_type', title:'Incluido en el precio' },
    { data: 'sale_percentage', title:'Porcentaje' },
    { data: 'print_document', title:'Impresión Automática' },
    { data: 'prefix_numbering', title:'Prefijo' },
    { data: 'start_numbering', title:'Numero actual' },
    { data: 'mail_shipping', title:'Enviar correo' }
];

const tabla_nombre = "accounting-documents";

$(document).ready(function() {
    initializeDataTable('html5-extension', 'accounting-documents', columns, buttons, actualizarListaUsuarios);
});

