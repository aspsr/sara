@extends('bootstrap-italia::page')

@section('content')

<head>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>



<div class="row mb-3">
    <div class="col-md-6 offset-md-5">
        <legend>Prenota per {{ $patient->name }}</legend>
    </div>
</div>


<div class="col-md-6 offset-md-4">
    
</div>

<br>



<div class="row col">
    <div class="col-md-6">
        <label for="defaultSelect">Prenota per centro vaccinale</label>
        <select id="defaultSelect">
            <option selected="" value="">Centro Vaccinale</option>
            <option value="0" selected="selected">Augusta </option>
            <option value="Value 2">Avola</option>
            <option value="Value 3">Canicattini bagni</option>
            <option value="Value 4">Carlentini e Franconte</option>
            <option value="Value 5">Ferla</option>
        </select>
    </div>
    <div class="col-md-6">
        <input type="submit" class="btn btn-primary btn-sm" value="Prenota per centro vaccinale">
    </div>

</div>


<br>
<br>
<br>
<br>

<form method="get" action="{{ route('prenota')}}">
<input type ="hidden" name="patientID" value = "{{ $patient->id}}">
    <div class="row col">
        <div class="col-md-6 ">
            <div class="form-group">
                <label class="active" for="dateStandard">Prenota in base alla data</label>
                <input id="data_vax" type="date" class="form-control @error('data_vax') is-invalid @enderror"
                    name="data_vax" value="{{ old('data_vax') }}" required autocomplete="data_vax" min="{{ date('Y-m-d') }}">
            </div>

        </div>
        <div class="col-md-6 ">
            <button type="submit" class="btn btn-primary">
              {{ __('prenota') }}
            </button>
        </div>
    </div>
</form>





<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">



@endsection