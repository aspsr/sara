@extends('bootstrap-italia::page')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card border-dark mb-3">
                <div class="card-header border-dark mb-3 mx-auto">
                    <legend>{{ __('Prenotazione vaccino') }}</legend>
                    <legend>{{ $dataView['nomePaziente'] }}</legend>
                </div>

                <div class="card-body">
                    <div class="row">
                        Seleziona una data oppure un centro vaccinale in cui prenotare il successivo vaccino
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <form action="{{ route("operatore.listaDisponibilita") }}" method="post">
                                @csrf
                                <input type="hidden" name="idPaziente" value="{{ $dataView['idPaziente'] }}">
                                <input type="hidden" name="nomePaziente" value="{{ $dataView['nomePaziente'] }}">
                                <label for="dataDisponibilita" class="form-label">Data</label>
                                <input type="date" name="dataDisponibilita" class="form-control" required min="{{ date('Y-m-d') }}">
                                <input type="submit" value="Cerca" class="btn btn-success">
                            </form>
                        </div>
                        <div class="col-3">&nbsp;</div>
                        <div class="col-3">
                            <form action="{{ route("operatore.listaDisponibilita") }}" method="post">
                                @csrf
                                <input type="hidden" name="idPaziente" value="{{ $dataView['idPaziente'] }}">
                                <input type="hidden" name="nomePaziente" value="{{ $dataView['nomePaziente'] }}">
                                <label for="centroVaccinale" class="form-label">Centro vaccinale </label>
                                <select name="centroVaccinale" class="form-control" required>
                                @foreach(App\Models\CentroVaccinale::all() as $centroVaccinale)
                                    <option value="{{ $centroVaccinale->id }}">{{ $centroVaccinale->descrizione }}</option>
                                @endforeach
                                </select>
                                <input type="submit" value="Cerca" class="btn btn-success">
                            </form>
                        </div>
                        <div class="col-3">&nbsp;</div>
                    </div>

                
                    @if (isset($dataView['result']))
                        <div class="row">&nbsp;</div>
                        <div class="row">
                            <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Centro vaccinale</th>
                                    <th scope="col">Appuntamenti disponibili</th>
                                    <th scope="col">Data</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($dataView['result'] as $result)
                                <tr>
                                    <td>{{ \App\Models\CentroVaccinale::where("id", $result['centro_vaccinale_id'])->first()->descrizione }}</td>
                                    <td>{{ $result['slot_disponibili'] - $result['numero_prenotazioni'] }}</td>
                                    <td>{{ date("d/m/Y", strtotime($result['data'])) }}</td>
                                    <td>
                                        <form method="post" action="{{ route('operatore.registraPrenotazione')}}">
                                            @csrf
                                            <input type="hidden" name="dataID" value="{{ $result['data'] }}">
                                            <input type="hidden" name="patientID" value="{{ $dataView['idPaziente'] }}">
                                            <input type="hidden" name="centroVaccinaleID" value="{{ $result['centro_vaccinale_id'] }}">
                                            <input type="submit" class="btn btn-primary" value="Prenota">
                                        </form>    
                                    </td>    
                                </tr>
                            @endforeach
                            </tbody>
                            </table>
                        </div>
                    @endif                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection