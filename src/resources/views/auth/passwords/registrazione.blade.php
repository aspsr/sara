@extends('bootstrap-italia::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Aggiungi persona') }}</div>

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

                    <form method="POST" action="{{ route('aggiungi') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="tax_id" class="col-md-4 col-form-label text-md-end">{{ __('Codice Fiscale') }}</label>
                            

                            <div class="col-md-6">
                                <input id="tax_id"  maxlength="16" type="text" pattern="^[a-zA-Z]{6}[0-9]{2}[a-zA-Z][0-9]{2}[a-zA-Z][0-9]{3}[a-zA-Z]$" class="form-control @error('tax_id') is-invalid @enderror" name="tax_id" value="{{ old('tax_id') }}" required autocomplete="tax_id">
                                <input type ="hidden" name="codicefiscaleID" value = 'cf'>
                               
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="health_insurance_card" class="col-md-4 col-form-label text-md-end">{{ __('Ultime 8 cifre tessera sanitaria') }}</label>

                            <div class="col-md-6">
                                <input id="health_insurance_card" maxlength="8" type="text" class="form-control @error('health_insurance_card') is-invalid @enderror" name="health_insurance_card" value="{{ old('health_insurance_card') }}" required autocomplete="health_insurance_card">          
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                <i class="bi bi-floppy"></i>&nbsp;&nbsp;{{ __('Salva') }}
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