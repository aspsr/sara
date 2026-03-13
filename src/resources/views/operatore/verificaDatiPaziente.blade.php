@extends('bootstrap-italia::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align:center">
                    <legend>{{ __('Verifica dati paziente') }}</legend>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-warning">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="GET" action="{{ route('operatore.visualizzaPaziente') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="surname" class="col-md-4 col-form-label text-md-end">{{ __('Cognome') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror"
                                    name="surname" value="{{ $dataView["surname"] }}" readonly autocomplete="name" autofocus>

                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ $dataView["name"] }}" readonly autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $dataView["email"] }}" readonly autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tax_id"
                                class="col-md-4 col-form-label text-md-end">{{ __('Codice Fiscale') }}</label>


                            <div class="col-md-6">
                                <input id="tax_id" type="text"
                                    pattern="^[a-zA-Z]{6}[0-9]{2}[a-zA-Z][0-9]{2}[a-zA-Z][0-9]{3}[a-zA-Z]$"
                                    class="form-control @error('tax_id') is-invalid @enderror" name="tax_id"
                                    value="{{ $dataView["tax_id"] }}" readonly autocomplete="tax_id">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Cellulare') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ $dataView["phone"] }}" readonly autocomplete="phone" autofocus>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="birth_date"
                                class="col-md-4 col-form-label text-md-end">{{ __('Data di nascita') }}</label>

                            <div class="col-md-6">
                                <input id="birth_date" type="date"
                                    class="form-control @error('birth_date') is-invalid @enderror" name="birth_date"
                                    value="{{ $dataView["birth_date"] }}" readonly autocomplete="birth_date">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Modifica dati paziente') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    @if (isset($dataView['prenotazioni']) && count($dataView['prenotazioni']) > 0)
                        <div class="col my-3 mt-4">
                            <div class="cardPrenotazioni border-hover-primary hover-scale">
                                <div class="card-bodyPrenotazioni">
                                    <div class="text-primary mb-5">

                                        <div class="col-md-12 offset-md-5">
                                            <h5>Prenotazione</h5>
                                        </div>

                                        <div class="col-md-12 ">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align:center">Data</th>
                                                        <th style="text-align:center">Centro vaccinale</th>
                                                        <th style="text-align:center"></th>
                                                        <th style="text-align:center"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($dataView['prenotazioni'] as $prenotazione)
                                                    <tr>
                                                        <td style="text-align:center">
                                                            {{ Carbon\Carbon::parse($prenotazione->data_vaccino)->format("d/m/Y") }}
                                                        </td>
                                                        <td style="text-align:center">
                                                            {{ App\Models\CentroVaccinale::where("id", $prenotazione->centro_vaccinale_id)->first()->descrizione }}
                                                        </td>
                                                        <td style="text-align:center">
                                                            <form method="post" action="{{ route('operatore.modificaPrenotazione')}}">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $dataView["id"]}}">
                                                                <input type="hidden" name="nominativo" value="{{ $dataView["surname"] . " " . $dataView["name"]}}">
                                                                <input type="submit" class="btn btn-success " value="modifica">
                                                            </form>
                                                        </td>
                                                        <td style="text-align:center">
                                                            <form method="post" action="{{ route('operatore.cancellaPrenotazione')}}">
                                                                @csrf
                                                                <input type="hidden" name="prenotazioneID" value="{{ $prenotazione->id }}">
                                                                <input type="hidden" name="id" value="{{ $dataView["id"]}}">
                                                                <input type="hidden" name="nominativo" value="{{ $dataView["surname"] . " " . $dataView["name"]}}">
                                                                <input type="submit" class="btn btn-danger " value="Cancella">
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .cardPrenotazioni {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, .125);
        border-radius: .4rem;
        box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
    }

    .card-bodyPrenotazioni {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1.25rem;
    }
</style>

@endsection