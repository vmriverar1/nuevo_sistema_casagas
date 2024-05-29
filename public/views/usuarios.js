function actualizarListaUsuarios(data) {
    initializeDataTable('html5-extension', 'users', columns, buttons, tabla_nombre);
}

const buttons = [
    {
        text: 'Crear Usuario',
        className: 'btn create_users',
        action: function (e, dt, node, config) {

            $('#modal-users').find('.password').show();
            $('#modal-users').find('.verify-password').show();
            $('#modal-users').find('.password').attr('required', 'required').attr('name', 'password');
            $('#modal-users').find('.verify-password').attr('required', 'required').attr('name', 'verify-password');
            resetModal('modal-users', 'users', actualizarListaUsuarios);
            $('#modal-users').modal('show');
        }
    }
];

const columns = [
    { data: 'photo', title:'Foto' },
    { data: 'role', title:'Rol' },
    { data: 'name', title:'Nombres' },
    { data: 'email', title:'Email' },
    { data: 'document_type', title:'Tipo' },
    { data: 'document', title:'Doumento' },
    { data: 'phone', title:'Celular' },
    { data: 'address', title:'Dirección.' },
    { data: 'status', title:'Estatus.' },
];

const tabla_nombre = "users";

$(document).ready(function() {
    initializeDataTable('html5-extension', 'users', columns, buttons, actualizarListaUsuarios);

    $('#modal-users').on('change', 'input[name="email"]', function() {

        var email = $(this).val();
        if (!email || !validateEmail(email)) {
            return;
        }

        axios.post('/check-email', {
            email: email
        })
        .then(function(response) {
            // Manejar la respuesta del servidor
            if (response.data.exists) {
                console.log('El email existe en la base de datos. Datos recibidos:', response.data.user);
                // Aquí puedes manejar la data recibida, por ejemplo, llenar el formulario con los datos del usuario
                fillUserData(response.data.user);
            } else {
                console.log('El email no existe en la base de datos.');
                // Aquí puedes limpiar los campos del formulario si es necesario
                clearUserData();
            }
        })
        .catch(function(error) {
            console.error('Ocurrió un error al verificar el email:', error);
        });
    });

    $(document).on("click", ".change_user", function(e){
        console.info("iniciando");
        var button = $(this);
        var userId = button.attr('data');
        var currentStatus = button.text().trim();

        console.log('Token CSRF:', $('meta[name="csrf-token"]').attr('content'));
        console.log('Datos enviados:', {
            user_id: userId,
            status: currentStatus
        });

        axios.post('/change-user-status', {
            user_id: userId,
            status: currentStatus,
            _token: $('meta[name="csrf-token"]').attr('content')
        })
        .then(function(response) {
            if (response.data.newBtn) {
                button.replaceWith(response.data.newBtn);
            }
        })
        .catch(function(error) {
            console.error('Error updating status:', error);
        });
    });

    function validateEmail(email) {
        var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    function fillUserData(user) {
        $('#modal-users').find('input[name="password"]').hide();
        $('#modal-users').find('input[name="verify-password"]').hide();
        // Llenar los campos del formulario con los datos del usuario
        $('#modal-users').find('input[name="password"]').val("password");
        $('#modal-users').find('input[name="verify-password"]').val("password");
        $('#modal-users').find('input[name="name"]').val(user.name);
        $('#modal-users').find('select[name="document_type"]').val(user.document_type);
        $('#modal-users').find('input[name="document"]').val(user.document);
        $('#modal-users').find('input[name="birthday"]').val(formatDate(user.birthday));
        $('#modal-users').find('input[name="phone"]').val(user.phone);
        $('#modal-users').find('input[name="address"]').val(user.address);
    }

    function clearUserData() {
        $('#modal-users').find('input[name="password"]').show();
        $('#modal-users').find('input[name="verify-password"]').show();
        // Limpiar los campos del formulario
        $('#modal-users').find('input[name="password"]').val("");
        $('#modal-users').find('input[name="verify-password"]').val("");
        $('#modal-users').find('input[name="name"]').val("");
        $('#modal-users').find('select[name="document_type"]').val("");
        $('#modal-users').find('input[name="document"]').val("");
        $('#modal-users').find('input[name="birthday"]').val("");
        $('#modal-users').find('input[name="phone"]').val("");
        $('#modal-users').find('input[name="address"]').val("");
    }

    function formatDate(dateString) {
        var date = new Date(dateString);
        var year = date.getFullYear();
        var month = ("0" + (date.getMonth() + 1)).slice(-2);
        var day = ("0" + date.getDate()).slice(-2);
        return `${year}-${month}-${day}`;
    }
});


