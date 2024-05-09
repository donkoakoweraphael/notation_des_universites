@extends('layouts.base-auth')


@section('title')
    Profil utilisateur
@endsection

@section('profile-page-active')
    btn-secondary
@endsection


@section('content')
    <div class="p-5"></div>
    <div class="row">
        <div class="col-md-auto ">
            <div class="row justify-content-center border pt-4 pb-4">
                <div class="col-auto">
                    <div style="height: 308px; width: 308px; border-radius: 154px; padding: 2px;" class="bg-dark">
                        <div style="height: 304px; width: 304px; border-radius: 152px; padding: 2px;" class="bg-light">
                            <img src="@if ($user->image_path) {{ asset('storage/' . $user->image_path) }} @else {{ asset('storage/' . $user::$default_image_path) }} @endif"
                                alt="Photo de profil" style="height: 300px; width: 300px; border-radius: 100%">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <ul>
                        @if ($user->is_admin)
                            <li>Administrateur</li>
                        @endif
                        <li>{{ $user->last_name }} {{ $user->first_name }}</li>
                        <li>{{ $user->email }}</li>
                        @if ($user->sex)
                            <li>{{ $user->calcSex() }}</li>
                        @endif
                        @if ($user->age)
                            <li>{{ $user->calcAge() }} ans</li>
                        @endif
                        <li>Vous avez noté {{ $user->ratings->count() }} fois</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col p-5">

            <div class="row justify-content-center">
                <div class="col">
                    <div class="m-0 p-3 border rounded-top">
                        <h3>
                            Modifier vos informations personnelles
                        </h3>
                    </div>
                    <div class="m-0 p-3 border">
                        <form method="POST" action="{{ route('user.update-profile') }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="lastNameInput" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="lastNameInput" name="last_name"
                                    value="{{ $user->last_name }}" aria-describedby="lastNameError">
                                <div id="lastNameError" class="form-text text-danger">
                                    @error('last_name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="firstNameInput" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="firstNameInput" name="first_name"
                                    value="{{ $user->first_name }}" aria-describedby="firstNameError">
                                <div id="firstNameError" class="form-text text-danger">
                                    @error('first_name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="emailInput" class="form-label">Addresse email</label>
                                <input type="email" class="form-control" id="emailInput" name="email"
                                    aria-describedby="emailError" value="{{ $user->email }}" autocomplete="username">
                                <div id="emailError" class="form-text text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-auto">Sexe</div>
                                <div class="col-auto">
                                    <label for="sexFemininRadio" class="form-label">Feminin</label>
                                    <input type="radio" class="form-radio" id="sexFemininRadio" name="sex"
                                        value="F" @checked($user->sex == 'F')>
                                </div>
                                <div class="col-auto">
                                    <label for="sexMasculinRadio" class="form-label">Masculin</label>
                                    <input type="radio" class="form-radio" id="sexMasculinRadio" name="sex"
                                        value="M" @checked($user->sex == 'M')>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="birthDateInput" class="form-label">Date de naissance</label>
                                <input type="date" class="form-control" id="birthDateInput" name="birth_date"
                                    aria-describedby="birthDateError" value="{{ $user->birth_date }}">
                                <div id="birthDateError" class="form-text text-danger">
                                    @error('birth_date')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-outline-success">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="p-4"></div>

            <div class="row justify-content-center">
                <div class="col">
                    <div class="m-0 p-3 border rounded-top">
                        <h3>
                            Changer l'image de votre profil
                        </h3>
                    </div>
                    <div class="m-0 p-3 border">
                        <form method="POST" action="{{ route('user.update-profile-image') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="imageInput" class="form-label">Image de profil</label>

                                <input id="imageInput" type="file" accept="image/png, image/jpeg" class="form-control"
                                    name="image_path">
                                <div id="imageError" class="form-text text-danger">
                                    @error('image_path')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-outline-success">Changer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="p-4"></div>

            <div class="row justify-content-center">
                <div class="col">
                    <div class="m-0 p-3 border rounded-top">
                        <h3>
                            Historique de notations
                        </h3>
                    </div>
                    <div class="m-0 p-3 border">
                        <ul>
                            @foreach ($ratings as $rating)
                                <li>
                                    (<strong>{{ $rating->created_at }}</strong>)
                                    Vous avez donné
                                    <strong>{{ $rating->score }}</strong>
                                    à l'université
                                    <strong>{{ $rating->university->name }}</strong>
                                    @if ($rating->criterion)
                                        pour le critère
                                        <strong>{{ $rating->criterion->designation }}</strong>
                                    @else
                                        pour un critère qui n'est plus pris encompte
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="p-4"></div>

            {{-- <div class="row justify-content-center">
                <div class="col">
                    <div class="m-0 p-3 border rounded-top">
                        <h3>
                            Mettre à jour votre mot de passe
                        </h3>
                    </div>
                    <div class="m-0 p-3 border">
                        <form method="POST" action="{{ route('user.update-password') }}">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="currentPasswordInput" class="form-label">Ancien mot de passe</label>
                                <input type="password" class="form-control" name="current_password" id="currentPasswordInput"
                                    value="{{ old('current_password') }}" aria-describedby="currentPasswordError" autocomplete="current-password">
                                <div id="currentPasswordError" class="form-text text-danger">
                                    @error('current_password')
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
                            <div class="mt-3">
                                <button type="submit" class="btn btn-outline-success">Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="p-4"></div>             --}}
        </div>
    </div>
@endsection
