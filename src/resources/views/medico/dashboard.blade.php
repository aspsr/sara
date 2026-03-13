@extends('bootstrap-italia::page')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card border-dark mb-3">
                <div class="card-header border-dark mb-3 mx-auto text-center">
                <legend>
                        {{ __('Benvenuto dr./ssa ' . ucfirst(strtolower(Auth::user()->name)) . ' ' . ucfirst(strtolower(Auth::user()->surname))) }}
                    </legend>
                </div>

                <!-- Mostra il centro vaccinale selezionato -->
                <div class="container text-center">
                    <!-- Displaying selected vaccination center -->
                    <div id="centroVaccinaleDisplay" class="p-3">
                        @if (session('centroVaccinaleId'))
                            <p>Centro Vaccinale Selezionato: <strong>{{ (new \App\Models\CentroVaccinale)->find(session('centroVaccinaleId'))->descrizione }}</strong></p>
                        @else
                            <p>Stai visualizzando tutti i centri vaccinali</p>
                        @endif
                    </div>

                    <!-- Displaying selected date -->
                    <div class="p-3">
                        <p>Lista dei pazienti di: <strong>{{ date("d/m/Y", strtotime($dataView['data_selezionata'])) }}</strong></p>
                    </div>
                </div>

                <!-- Form for selecting vaccination center and date -->
                    <div class="container">
                        <div class="card-body">
                            <form method="post" action="{{ route('caricaPazientiPerData') }}" class="d-flex justify-content-between align-items-center">
                                @csrf
                                <div class="row w-100">
                                    <div class="col-md-6">
                                        <!-- Dropdown for selecting vaccination center -->
                                        <select name="centroVaccinaleScelta" id="centroVaccinaleScelta" class="form-control">
                                            <option value="">Tutti i centri vaccinali</option>
                                            @foreach ((new \App\Models\Patient)->centriVaccinali(Auth::user()->id) as $centroVaccinale)
                                                <option value="{{ $centroVaccinale->id }}" 
                                                    {{ session('centroVaccinaleId') == $centroVaccinale->id ? 'selected' : '' }}>
                                                    {{ $centroVaccinale->descrizione }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- Date picker -->
                                        <input type="date" id="scegliData" name="scegliData" class="form-control" value="{{ $dataView['data_selezionata'] }}">
                                    </div>
                                    <div class="col-md-2 text-md-right mt-3 mt-md-0">
                                        <!-- Search button -->
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="bi bi-search"></i> Cerca
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nominativo</th>
                                    <th scope="col">Codice fiscale</th>
                                    <th scope="col">Centro vaccinale</th>
                                    <th scope="col">Cellulare</th>
                                    <th scope="col"></th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataView['pazienti'] as $paziente)
                                    <tr>
                                        <td>{{ $paziente->name }} {{ $paziente->surname }}</td>
                                        <td>{{ $paziente->tax_id }}</td>
                                        <td>{{ $paziente->nome_centro_vaccinale }}</td>
                                        <td>{{$paziente->phone}}</td>
                                        <td>
                                            <div class="row">
                                                <form action="{{ route('medico.impostaPresenza') }}" method="post"
                                                    class="p-1">
                                                    @csrf
                                                    <input type="hidden" name="idPaziente" value="{{ $paziente->id }}">
                                                    <input type="hidden" name="idPrenotazione"
                                                        value="{{ $paziente->prenotazione_id }}">
                                                    <input type="hidden" name="presentato" value="0">
                                                    <button type="submit" class="btn btn-danger" {{ $paziente->stato != -1 ? "disabled" : "" }}><i
                                                            class="bi bi-person-dash-fill"></i>&nbsp;&nbsp;Assente</button>
                                                </form>
                                                <form action="{{ route('medico.impostaPresenza') }}" method="post"
                                                    class="p-1">
                                                    @csrf
                                                    <input type="hidden" name="idPaziente" value="{{ $paziente->id }}">
                                                    <input type="hidden" name="idPrenotazione"
                                                        value="{{ $paziente->prenotazione_id }}">
                                                    <input type="hidden" name="presentato" value="1">
                                                    @if ($dataView['data_selezionata'] > now())
                                                        <button type="submit" class="btn btn-success" disabled>
                                                            <i class="bi bi-person-check-fill"></i>&nbsp;&nbsp;Presente
                                                        </button>
                                                    @else
                                                    <button type="submit" class="btn btn-success" {{ $paziente->stato != -1 ? "disabled" : "" }}><i
                                                            class="bi bi-person-check-fill"></i>&nbsp;&nbsp;Presente</button>
                                                    @endif
                                                </form>
                                                <a href="{{ route('medico.sceltaData', ["idPaziente" => $paziente->id]) }}"
                                                    class="btn btn-primary {{ $paziente->stato == -1 ? "disabled" : "" }}"><i
                                                        class="bi bi-calendar-plus"></i>&nbsp;&nbsp;Prenota</a>
                                            </div>
                                        </td>
                                   
                                        <td>
                                            @if ($paziente->data_ultimo_inoltro_msg != null)
                                                <i class="bi bi-calendar2-check"></i>
                                            @endif
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
</div>
@endsection


@section('bootstrapitalia_js')
<script>
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#centroVaccinaleScelta").change(function () {
    var selectedId = $(this).val(); // Ottieni l'ID selezionato
    var selectedDate = $('#scegliData').val(); // Ottieni la data selezionata

    // Reindirizza con l'ID del centro vaccinale e la data selezionata nella query string
    var url = '{{ route("scegliCentro") }}' + '?centroVaccinale=' + selectedId + '&data=' + selectedDate;
});

});


</script>


@endsection