@extends('bootstrap-italia::page')


@section('bootstrapitalia_css')
    <style>
        #legend {
            margin-bottom: 20px;
        }

        .legend-item {
            width: 20px;
            height: 20px;
            display: inline-block;
            margin-right: 5px;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card border-dark mb-3">
                <div class="card-header border-dark mb-3 mx-auto">
                    <legend>{{ __('Prenotazione vaccino') }}</legend>
                </div>

                <div class="card-body">
                    <div class="row">
                        Seleziona una fascia oraria per&nbsp;&nbsp;<strong>{{ ucwords($dataView['patient']->name) . " " . ucwords($dataView['patient']->surname)}}</strong>
                    </div>
                    <div id="legend">
                        <div class="legend-item btn-success"></div> Fascia libera
                        <div class="legend-item btn-info"></div> Fascia non disponibile
                    </div>

                    @if (isset($dataView['fasce']))
                        <div class="row">&nbsp;</div>
                        <div class="row">
                            <table class="table">
                            <tbody>
                            @foreach($dataView['fasce']->chunk(3) as $fasce)
                                <tr>
                                @foreach($fasce as $fascia => $prenotazioni)
                                    <td class="text-center">
                                        <form method="post" action="{{ route('medico.prenota')}}">
                                            @csrf
                                            <input type="hidden" name="fascia" value="{{ $fascia }}">
                                            <input type="hidden" name="dataID" value="{{ $dataView['data'] }}">
                                            <input type="hidden" name="patientID" value="{{ $dataView['patient']->id }}">
                                            <input type="hidden" name="centroVaccinaleID" value="{{ $dataView['centroVaccinale'] }}">
                                            <button type="submit" class="btn btn-{{ $prenotazioni < 2 ? "success" : "info" }}" {{ $prenotazioni >= 2 ? "disabled" : "" }}><i class="bi bi-calendar-plus"></i>&nbsp;&nbsp;{{ $fascia }}</button>
                                        </form>
                                    </td>
                                @endforeach
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