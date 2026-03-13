@extends('bootstrap-italia::page')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card border-dark mb-3">
                <div class="card-header border-dark mb-3 mx-auto">
                    <legend>{{ __('Prenotazione vaccino ' . Auth::user()->name) }}</legend>
                </div>

                <div class="card-body">
                    <div class="row">
                        Disponibilità
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection