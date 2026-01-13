@extends('bootstrap-italia::page')

@section('content')

    <style>
        /* Aggiungi qui il tuo CSS personalizzato */
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination li a, .pagination li span {
            display: block;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid #ddd;
            color: #007bff;
        }

        .pagination li a:hover {
            background-color: #ddd;
        }

        .pagination li.active span {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }

        .pagination li.disabled span {
            color: #ccc;
            pointer-events: none;
        }
    </style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card border-dark mb-3">
                <div class="card-header border-dark mb-3 mx-auto">
                    <legend>{{ __('Prenotazione vaccino') }}</legend>
                </div>

                <div class="card-body">
                    <div class="row">
                        Seleziona una data oppure un centro vaccinale in cui prenotare il prossimo vaccino per&nbsp;&nbsp;<strong>{{ ucwords($dataView['patient']->name) . " " . ucwords($dataView['patient']->surname)}}</strong><br />
                        &Egrave; possibile cercare una data fino a un massimo di 6 mesi da oggi.
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <form action="{{ route("modifica") }}" method="post">
                                @csrf
                                <input type="hidden" name="patientID" value="{{ $dataView['patient']->id }}">
                                <label for="dataDisponibilita" class="form-label">Data</label><br />
                                <div class="row">
                                    <div class="col-7">
                                    <select name="mese" class="form-control">
                                        {{ $currentMonth = date('m')}}
                                            <option value="01" {{ $currentMonth == '01' ? 'selected' : '' }}>Gennaio</option>
                                            <option value="02" {{ $currentMonth == '02' ? 'selected' : '' }}>Febbraio</option>
                                            <option value="03" {{ $currentMonth == '03' ? 'selected' : '' }}>Marzo</option>
                                            <option value="04" {{ $currentMonth == '04' ? 'selected' : '' }}>Aprile</option>
                                            <option value="05" {{ $currentMonth == '05' ? 'selected' : '' }}>Maggio</option>
                                            <option value="06" {{ $currentMonth == '06' ? 'selected' : '' }}>Giugno</option>
                                            <option value="07" {{ $currentMonth == '07' ? 'selected' : '' }}>Luglio</option>
                                            <option value="08" {{ $currentMonth == '08' ? 'selected' : '' }}>Agosto</option>
                                            <option value="09" {{ $currentMonth == '09' ? 'selected' : '' }}>Settembre</option>
                                            <option value="10" {{ $currentMonth == '10' ? 'selected' : '' }}>Ottobre</option>
                                            <option value="11" {{ $currentMonth == '11' ? 'selected' : '' }}>Novembre</option>
                                            <option value="12" {{ $currentMonth == '12' ? 'selected' : '' }}>Dicembre</option>
                                        </select>
                                    </div>
                                    <div class="col-5">
                                        <select name="anno" class="form-control">
                                            <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                                            <option value="{{ date('Y')+1 }}">{{ date('Y')+1 }}</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success" name="perData"><i class="bi bi-search"></i>&nbsp;&nbsp;Cerca</button>
                            </form>
                        </div>
                        <div class="col-3">&nbsp;</div>
                        <div class="col-3">
                            <form action="{{ route("modifica") }}" method="post">
                                @csrf
                                <input type="hidden" name="patientID" value="{{ $dataView['patient']->id }}">
                                <label for="centroVaccinale" class="form-label">Centro vaccinale </label>
                                <select name="centroVaccinale" class="form-control" required>
                                {{ $eta = (new \App\Models\Patient())->eta($dataView['patient']->tax_id)}}
                                    @foreach(App\Models\CentroVaccinale::all() as $centroVaccinale)
                                        @if($eta > 7)
                                            @if($centroVaccinale->descrizione != "Siracusa (pediatrico)")
                                                <option value="{{ $centroVaccinale->id }}">{{ $centroVaccinale->descrizione }}
                                                </option>
                                            @endif
                                        @else
                                            @if($centroVaccinale->descrizione != "Siracusa (adulti)")
                                                <option value="{{ $centroVaccinale->id }}">{{ $centroVaccinale->descrizione }}
                                                </option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-success" name="perCentroVaccinale"><i class="bi bi-search"></i>&nbsp;&nbsp;Cerca</button>
                            </form>
                        </div>
                        <div class="col-3">&nbsp;</div>
                    </div>

                
                    @if (isset($dataView['result']))
                        <div class="row">&nbsp;</div>
                        <form method="GET" action="{{ url('/modifica') }}">
                            <!-- Aggiungi qui i tuoi campi di input per eventuali filtri o criteri di ricerca -->
                            <input type="hidden" name="patientID" value="{{ request()->patientID }}">
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
                                    <td>{{ date('d/m/Y', strtotime( $result['data'])) }}</td>
                                    <td>
                                    <form method="post" action="{{ route('scegliFasciaView')}}">
                                        @csrf
                                        <input type="hidden" name="dataID" value="{{$result['data']}}">
                                        <input type="hidden" name="patientID" value="{{$dataView['patient']->id}}">
                                        <input type="hidden" name="centroVaccinaleID" value="{{$result['centro_vaccinale_id']}}">
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-calendar-plus"></i>&nbsp;&nbsp;Prenota</button>
                                    </form>
                                    </td>
                                    <td>
                                      
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