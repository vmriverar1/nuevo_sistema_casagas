@extends('layouts.app')

@section('content')

<script src="{{ asset("js/libs/jquery-3.1.1.min.js") }}"></script>

<div class="infobox-1">
    <div class="info-icon">
        <svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
        </svg>
    </div>
    <h5 class="info-heading">Ingresa la cantidad con la que inicias caja</h5>

    <form id="open-cash-form">
        <div class="mb-4">
            <input class="initial_cash" type="text" value="0" name="initial_cash">
        </div>

        <button type="button" id="open-cash-button" class="info-link">Abrir caja
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
        </button>
    </form>
</div>


<script>
    $(document).ready(function() {
        $(".initial_cash").TouchSpin({
            prefix: 'S/.',
            min: 0,
            max: 100000000000000000,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            buttondown_class: "btn btn-classic btn-primary",
            buttonup_class: "btn btn-classic btn-primary"
        });

        document.getElementById('open-cash-button').addEventListener('click', function (e) {
            e.preventDefault();

            const initialCashInput = document.querySelector('input[name="initial_cash"]');
            const initialCash = parseFloat(initialCashInput.value);

            // Mostrar alerta de confirmación
            const confirmUpdate = confirm(`Está a punto de actualizar la cantidad inicial a ${initialCash}. ¿Está seguro? No podrá cambiar esta cantidad luego.`);

            if (confirmUpdate) {
                axios.post('/petty-cash-initial', {
                    initial_cash: initialCash
                })
                .then(function (response) {
                    window.location.reload();
                })
                .catch(function (error) {
                    console.error(error);
                    alert('Hubo un error al abrir la caja. Intenta nuevamente.');
                });
            }
        });

    });
</script>

@endsection
