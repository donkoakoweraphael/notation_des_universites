@extends('layouts.base-admin-university')


@section('title')
    Edition d'universités
@endsection

@section('university-list-page-active')
@endsection


@section('edit-university-page-active')
    active
@endsection


@section('main')
    <div class="row justify-content-center">
        <div class="col">
            <div class="m-0 p-3 border rounded-top">
                <h3>
                    Modifier les renseignements sur l'université
                </h3>
            </div>
            <div class="m-0 p-3 border">
                <form method="POST" action="{{ route('admin.university.update', $university->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class=" col mb-3">
                            <div class="mb-3">
                                <label for="nameInput" class="form-label">Nom de l'université</label>
                                <input type="text" class="form-control" id="nameInput" name="name"
                                    value="{{ $university->name }}" aria-describedby="nameError">
                                <div id="nameError" class="form-text text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class=" col mb-3">
                            <div class="mb-3">
                                <label for="phoneNumberInput" class="form-label">Numero de téléphone</label>
                                <input type="tel" class="form-control" id="phoneNumberInput" name="phone_number"
                                    value="{{ $university->phone_number }}" aria-describedby="phoneNumberError">
                                <div id="phoneNumberError" class="form-text text-danger">
                                    @error('phone_number')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class=" col mb-3">
                            <div class="mb-3">
                                <label for="emailInput" class="form-label">Addresse email</label>
                                <input type="text" class="form-control" id="emailInput" name="email"
                                    aria-describedby="emailError" value="{{ $university->email }}" autocomplete="username">
                                <div id="emailError" class="form-text text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col mb-3">
                            <div class="mb-3">
                                <label for="imageInput" class="form-label">Image</label>
                                <input id="imageInput" type="file" accept="image/png, image/jpeg" class="form-control"
                                    name="image_path" aria-describedby="imageError">
                                <a href="{{ asset('storage/' . $university->image_path) }}" target="_blank" class="ps-3"
                                    style="font-size: 12px">
                                    {{ $university->image_path }}
                                </a>
                                <div id="imageError" class="form-text text-danger">
                                    @error('image_path')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class=" col mb-3">
                            <div class="mb-3">
                                <label for="webSiteInput" class="form-label">Addresse du site web</label>
                                <input type="text" class="form-control" id="webSiteInput" name="web_site"
                                    aria-describedby="webSiteError" value="{{ $university->web_site }}">
                                <div id="webSiteError" class="form-text text-danger">
                                    @error('web_site')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="descriptionTextArea" class="form-label">Description</label>
                        <textarea name="description" id="descriptionTextArea" class="form-control" rows="2"
                            aria-describedby="descriptionError">{{ $university->informationSections->where('title', '=', 'Description')->first()->content }}</textarea>
                        <div id="descriptionError" class="form-text text-danger">
                            @error('description')
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
                    Informations supplémentaires
                </h3>
            </div>
            <div class="m-0 p-3 border">

                @foreach ($university->informationSections->where('title', '!=', 'Description') as $info)
                    <div class="mx-4 p-4">
                        <div class="m-0 p-3 border rounded-top">
                            <h4>
                                Section {{ $info->title }}
                            </h4>
                        </div>
                        <div class="m-0 p-3 border">
                            <form method="POST"
                                action="{{ route('admin.university.information.update', [$info->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class=" col mb-3">
                                        <label for="{{ 'titleInput' . $info->id }}" class="form-label">
                                            Titre de la section
                                        </label>
                                        <input type="text" class="form-control" id="{{ 'titleInput' . $info->id }}"
                                            name="{{ 'title' . $info->id }}" value="{{ $info->title }}"
                                            aria-describedby="{{ 'titleError' . $info->id }}">
                                        <div id="{{ 'titleError' . $info->id }}" class="form-text text-danger">
                                            @error('title' . $info->id)
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="{{ 'sectionImageInput' . $info->id }}" class="form-label">
                                            Image de la section
                                        </label>
                                        <input id="{{ 'sectionImageInput' . $info->id }}" type="file"
                                            accept="image/png, image/jpeg" class="form-control"
                                            name="{{ 'section_image_path' . $info->id }}"
                                            aria-describedby="{{ 'sectionImageError' . $info->id }}">
                                        <a href="{{ asset('storage/' . $info->image_path) }}" target="_blank"
                                            class="ps-3" style="font-size: 12px">
                                            {{ $info->image_path }}
                                        </a>
                                        <div id="{{ 'sectionImageError' . $info->id }}" class="form-text text-danger">
                                            @error('section_image_path' . $info->id)
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="{{ 'contentTextArea' . $info->id }}" class="form-label">Contenu de la
                                        section</label>
                                    <textarea name="{{ 'content' . $info->id }}" id="{{ 'contentTextArea' . $info->id }}" class="form-control"
                                        rows="2" aria-describedby="{{ 'contentError' . $info->id }}">{{ $info->content }}</textarea>
                                    <div id="{{ 'contentError' . $info->id }}" class="form-text text-danger">
                                        @error('content' . $info->id)
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
                @endforeach

                {{-- partie d'ajout d'information à l'iniversité --}}
                <div id="supplementInformationForm" class="visually-hidden mx-4 p-4">
                    <div class="m-0 p-3 border rounded-top">
                        <h4>
                            Nouvelle section
                        </h4>
                    </div>
                    <div class="m-0 p-3 border">
                        <form method="POST" action="{{ route('admin.university.information.store', $university->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class=" col mb-3">
                                    <label for="titleInput" class="form-label">Titre de la section</label>
                                    <input type="text" class="form-control" id="titleInput" name="title"
                                        value="{{ old('title') }}" aria-describedby="titleError">
                                    <div id="titleError" class="form-text text-danger">
                                        @error('title')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col mb-3">
                                    <label for="sectionImageInput" class="form-label">Image de la section</label>
                                    <input id="sectionImageInput" type="file" accept="image/png, image/jpeg"
                                        class="form-control" name="section_image_path"
                                        aria-describedby="sectionImageError">
                                    <div id="sectionImageError" class="form-text text-danger">
                                        @error('section_image_path')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="contentTextArea" class="form-label">Contenu de la section</label>
                                <textarea name="content" id="contentTextArea" class="form-control" rows="2" aria-describedby="contentError">{{ old('content') }}</textarea>
                                <div id="contentError" class="form-text text-danger">
                                    @error('content')
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
                <div class="mt-3">
                    <button id='addInformationButton' class="btn btn-outline-primary"
                        onclick="
                    document.getElementById('supplementInformationForm').classList.remove('visually-hidden');
                    document.getElementById('addInformationButton').classList.add('visually-hidden');
                    ">Ajouter</button>
                </div>

            </div>

        </div>
    </div>

    <div class="p-4"></div>
@endsection


@section('toolbar')
    <a href="" class="btn btn-outline-info">Voir un apperçu</a>
@endsection
