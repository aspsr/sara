@extends('bootstrap-italia::page')

@section('content')
<div class="col-md-12 " style="text-align: center">
    <legend>Chiusura centri vaccinali</legend>
</div>

@if ($errors->any())
        <div class="alert alert-warning">
            <ul>
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </ul>
        </div>
    @endif
<form method="post" action="{{ route('operatore.aggiungiMotivazione')}}">
    @csrf
    <div class="col-md-6 offset-md-3">
        <div class="row">
            <div class="col-md-4 mt-3">
                <label for="data_inizio">Data inizio</label>
                <input type="date" id="data_inizio" name="data_inizio" value="{{ old('data_inizio') }}" required
                    min="{{ date('Y-m-d') }}">
            </div>
            <div class="col-md-4 mt-3">
                <label for="data_fine">Data fine</label>
                <input type="date" id="data_fine" name="data_fine" value="{{ old('data_fine') }}" required
                    min="{{ date('Y-m-d') }}">
            </div>
        </div>



        <div class="row">
            <div class="col-md-8 mt-5">
                <label for="birthday">Centro vaccinale</label>
                <select name="centroVaccinaleScelta" id="centroVaccinaleScelta" class="form-control"
                    value="{{ old('centroVaccinaleScelta') }}" required>
                    <option value="">Scegli un centro vaccinale</option>
                    @foreach (App\Models\CentroVaccinale::all() as $centroVaccinale)
                        <option value="{{ $centroVaccinale->id }}">{{ $centroVaccinale->descrizione }}</option>
                    @endforeach               
                </select>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12 mt-5">
                <label for="birthday">Motivazione</label>
                <textarea id="motivazione" name="motivazione" rows="5" cols="100" required
                    value="{{ old('centroVaccinaleScelta')}}"></textarea>
            </div>
        </div>


        <div class="col text-right">
            <button type="submit" class="btn btn-primary"> </i>&nbsp;&nbsp;Invio</button>
        </div>

    </div>
</form>


@endsection