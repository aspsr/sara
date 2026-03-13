@extends('bootstrap-italia::page')

@section("bootstrapitalia_css")
    <style>
        .card {
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: .4rem;
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h4 style="text-align:center"> Accesso riservato al personale medico</h4>
        <div class="row justify-content-center">
            <p>Accesso riservato al personale medico.<br />Inserisci le tue <strong>credenziali di dominio</strong> per entrare nel sistema.</p>

            <div class="col-md-8">
                <div class="card" style="border-box">
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('authenticate') }}">
                            @csrf
                            <div class="form-group">
                                <label class="active" for="input-text-lg">Utente</label>
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                                    name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>


                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="active" for="input-text-lg">Password</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block"
                                        style="display:flex; align-items:center; justify-content:center;">
                                        <i class="bi bi-door-open"></i>&nbsp;&nbsp;{{ __('Entra') }}
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
