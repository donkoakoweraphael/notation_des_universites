@extends('layouts.base-guest')


@section('title')
    Authentification
@endsection


@section('notification-message')

    @error('top_info')
        @if ($message == 'compte supprimé')
            Désolé, il semblerait que le compte auquel vous souhaitez vous connecter ait été supprimé pour des raisons de
            confidentialité.
            Voici le message laissé par l'administrateur de la plateforme :
            @error('deletion_reasons')
                {{ $message }}
            @else
                ---
            @enderror
            <br>
            Vous pouvez cliquer sur
            <a class="alert-link" href="{{ route('register') }}">
                s'enregister
            </a>
            pour en créer un nouveau.
        @endif
        @if ($message == 'compte n\'existe pas')
            Le compte auquel vous essayez de vous connecter n'existe pas.
            Vous pouvez cliquer sur
            <a class="alert-link" href="{{ route('register') }}">
                s'enregister
            </a>
            pour en créer un.
        @endif
    @else
        Si vous n'avez pas encore de compte, cliquez sur
        <a class="alert-link" href="{{ route('register') }}">
            s'enregister
        </a>
        pour en créer un.
    @enderror
@endsection


@section('content')
    <form method="POST" action="{{ route('login.store') }}">
        @csrf
        <div class="row border border-2">
            <div class="col-md-7 p-5 border-end border-3">

                <div class="mb-3">
                    <label for="emailInput" class="form-label">Addresse email</label>
                    <input type="email" class="form-control" id="emailInput" name="email" aria-describedby="emailError"
                        value="{{ old('email') }}" autocomplete="username">
                    <div id="emailError" class="form-text text-danger">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="passwordInput" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" name="password" id="passwordInput"
                        value="{{ old('password') }}" aria-describedby="passwordError" autocomplete="new-password">
                    <div id="passwordError" class="form-text text-danger">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-5 p-0">
                <div style="padding-top: 100px; padding-bottom: 100px; padding-left: 50px;">
                    <button style="font-size: 40px;" type="submit" class="btn border border-5 p-5 rounded-5"
                        style="color: #808080">
                        S'authentifier
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
