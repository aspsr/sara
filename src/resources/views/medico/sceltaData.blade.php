@extends('bootstrap-italia::page')

@section('content')

@php
$userCentriVaccinali = Auth::user()->centriVaccinali(Auth::user()->id)->pluck("id")->toArray();
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card border-dark mb-3">
                <div class="card-header border-dark mb-3 mx-auto">
                    <legend>{{ __('Prenotazione vaccino') }}</legend>
                </div>

                <div class="card-body">
                    <div class="row">
                        Seleziona una data oppure un centro vaccinale in cui prenotare il successivo vaccino.<br />
                        &Egrave; possibile cercare una data fino a un massimo di&nbsp;<u>6 mesi</u>&nbsp;da oggi.
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <form action="{{ route("medico.listaDisponibilita") }}" method="post">
                                @csrf
                                <input type="hidden" name="idPaziente" value="{{ $dataView['idPaziente'] }}">
                                <label for="dataDisponibilita" class="form-label">Data</label><br />
                                <div class="row">
                                    <div class="col-8">
                                        <select name="mese" class="form-control">
                                            <option value="01">Gennaio</option>
                                            <option value="02">Febbraio</option>
                                            <option value="03">Marzo</option>
                                            <option value="04">Aprile</option>
                                            <option value="05">Maggio</option>
                                            <option value="06">Giugno</option>
                                            <option value="07">Luglio</option>
                                            <option value="08">Agosto</option>
                                            <option value="09">Settembre</option>
                                            <option value="10">Ottobre</option>
                                            <option value="11">Novembre</option>
                                            <option value="12">Dicembre</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <select name="anno" class="form-control">
                                            <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                                            <option value="{{ date('Y')+1 }}">{{ date('Y')+1 }}</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success"><i class="bi bi-search"></i>&nbsp;&nbsp;Cerca</button>
                            </form>
                        </div>
                        <div class="col-3">&nbsp;</div>
                        <div class="col-3">
                            <form action="{{ route("medico.listaDisponibilita") }}" method="post">
                                @csrf
                                <input type="hidden" name="idPaziente" value="{{ $dataView['idPaziente'] }}">
                                <label for="centroVaccinale" class="form-label">Centro vaccinale </label>
                                <select name="centroVaccinale" class="form-control" required>
                                @foreach(App\Models\CentroVaccinale::all() as $centroVaccinale)
                                    <option value="{{ $centroVaccinale->id }}" {{ in_array( $centroVaccinale->id, $userCentriVaccinali ) ? "selected" : "" }}>{{ $centroVaccinale->descrizione }}</option>
                                @endforeach
                                </select>
                                <button type="submit" class="btn btn-success"><i class="bi bi-search"></i>&nbsp;&nbsp;Cerca</button>
                            </form>
                        </div>
                        <div class="col-3">&nbsp;</div>
                    </div>

                
                    @if (isset($dataView['result']))
                        <div class="row">&nbsp;</div>
                        <form method="GET" action="{{ url('/medico/sceltaData') }}">
                            <input type="hidden" name="idPaziente" value="{{ $dataView['idPaziente'] }}">
                            <input type="hidden" name="anno" value="{{ request()->anno }}">
                            <input type="hidden" name="mese" value="{{ request()->mese }}">
                            <input type="hidden" name="centroVaccinale" value="{{ request()->centroVaccinale }}">
                            <!--button type="submit">Filtra</button-->
                        </form>
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
                                        <form method="post" action="{{ route('medico.scegliFasciaView')}}">
                                            @csrf
                                            <input type="hidden" name="dataID" value="{{$result['data']}}">
                                            <input type="hidden" name="patientID" value="{{ $dataView['idPaziente'] }}">
                                            <input type="hidden" name="centroVaccinaleID"
                                                value="{{$result['centro_vaccinale_id']}}">
                                            <button type="submit" class="btn btn-primary"><i class="bi bi-calendar-plus"></i>&nbsp;&nbsp;Prenota</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            </table>
                        </div>
                        {{ $dataView['result']->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
                    @endif                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection