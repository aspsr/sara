@extends('bootstrap-italia::page')

@section('bootstrapitalia_js')
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#centroVaccinaleScelta").change(function () {
            var selectedId = $(this).val();
            var url = '{{ route("selezionaCentro", ["centroVaccinale" => "_centroVaccinale"]) }}';
            url = url.replace('_centroVaccinale', selectedId);
            window.location.href = url;
        });
    });
</script>
@endsection

@section('content')

<head>
    <!--link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script-->
</head>


<div class="col-md-12 " style="text-align: center">
    <legend>Lista centri vaccinali</legend>
</div>

<div class="row">
    <div class="col-md-8 mt-5">
        <label for="birthday">Seleziona il centro vaccinale</label>
        <select name="centroVaccinaleScelta" id="centroVaccinaleScelta" class="form-control">
            <option value="">Scegli un centro vaccinale</option>
            @foreach (App\Models\CentroVaccinale::all() as $centroVaccinale)
                <option value="{{ $centroVaccinale->id }}">{{ $centroVaccinale->descrizione }}</option>
            @endforeach               
        </select>
    </div>
</div>


<div class="row">
    <div class="col-md-8 mt-5">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Centro Vaccinale</th>
                        <th scope="col">Data</th>
                        <th scope="col">Motivazione</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataView['centriVaccinali'] as $centro)
                        <tr>
                            <td> {{$centro->nome}} </td>
                            <td> {{date("d/m/Y", strtotime($centro->data))}} </td>
                            <td> {{$centro->motivazione}} </td>
                            <td>
                                <form method="post" action="{{ route('cancellaChiusura')}}">
                                    @csrf
                                    <input type="hidden" name="chiusuraID" value="{{ $centro->id }}">
                                    <button type="submit" class="btn btn-danger"><i
                                            class="bi bi-person-dash-fill"></i>&nbsp;&nbsp;Cancella</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $dataView['centriVaccinali']->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
</div>
@endsection