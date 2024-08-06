@extends('layouts.app-out')

@section('content-void')

<div class="lista-tiendas">
    @foreach ($branches as $branch)
        <div class="infobox-3">
            <div class="info-icon">
                <img src="storage/branch/{{ $branch->photo }}" style="width: 70px;" alt="">
            </div>
            <h5 class="info-heading">{{ $branch->company_name }}</h5>
            <p class="info-text">{{ $branch->notes }}</p>
            <a class="info-link" href="{{ route('choose_business', $branch->cun) }}">
                Entrar <svg> ... </svg>
            </a>
        </div>
    @endforeach
</div>

@endsection
