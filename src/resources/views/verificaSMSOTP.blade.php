@extends('bootstrap-italia::page')

@section('content')
<div class="container">

    <h4 style="text-align:center"> {{ __('Verifica numero di cellulare') }} </h4>
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <p>Per garantire la sicurezza e l'autenticità del tuo account, è necessario verificare il tuo numero di cellulare. Riceverai un SMS contenente un codice OTP di 6 cifre. Segui questi passaggi:
                <ul>
                    <li>Ricevi l'SMS con il codice OTP.</li>
                    <li>Inserisci il codice OTP: Riporta il codice OTP di 6 cifre nella pagina corrente.</li>
                    <li>Passa alla fase successiva: Una volta inserito correttamente il codice OTP, potrai passare alla fase successiva della registrazione.</li>
                </ul></p>
                <div class="card-body">
                    @if ($dataView['tentativiRimasti']!== null)
                        <div class="alert alert-warning">
                            Tentativi rimasti: {{ $dataView['tentativiRimasti'] }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('validateOTP') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="otp" class="col-md-4 col-form-label text-md-end">{{ __('Codice OTP') }}</label>

                            <div class="col-md-6">
                                <input id="inputOTP" type="text"
                                    class="form-control @error('inputOTP') is-invalid @enderror" name="inputOTP"
                                    value="{{ old('inputOTP') }}" required autocomplete="inputOTP" autofocus>

                                @error('inputOTP')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-send"></i>&nbsp;&nbsp;{{ __('Invia') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection