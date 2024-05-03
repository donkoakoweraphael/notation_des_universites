@extends('layouts.base-guest')


@section('title')
    Enregistrement
@endsection


@section('notification-message')
    @error('top_info')
        Le compte que vous essayez de créer existe déjà. Cliquez sur
        <a class="alert-link" href="{{ route('login') }}">
            s'authentifier
        </a>
        pour vous connecter à celui-ci.
    @else
        Si vous avez déja un compte, cliquez sur
        <a class="alert-link" href="{{ route('login') }}">
            s'authentifier
        </a>
        pour vous connecter à celui-ci.
    @enderror
@endsection


@section('content')
    <form method="POST" action="{{ route('register.store') }}">
        @csrf
        <div class="row border border-2 mb-5">
            <div class="col-md-7 p-5 border-end border-3">
                <div class="mb-3">
                    <label for="firstNameInput" class="form-label">Votre prénom</label>
                    <input type="text" class="form-control" id="firstNameInput" name="first_name"
                        value="{{ old('first_name') }}" aria-describedby="firstNameError">
                    <div id="firstNameError" class="form-text text-danger">
                        @error('first_name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
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
                <div class="mb-3">
                    <label for="passwordConfirmationInput" class="form-label">Comfirmez le mot de passe</label>
                    <input type="password" class="form-control" name="password_confirmation" id="passwordConfirmationInput"
                        value="{{ old('password') }}" aria-describedby="passwordConfirmationError"
                        autocomplete="new-password">
                    <div id="passwordConfirmationError" class="form-text text-danger">
                        @error('password_confirmation')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-5 p-0">
                <div style="padding-top: 100px; padding-bottom: 100px; padding-left: 50px;">
                    <button style="font-size: 40px;" type="submit" class="btn border border-5 p-5 rounded-4"
                        style="color: #808080;">
                        S'enregistrer
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
