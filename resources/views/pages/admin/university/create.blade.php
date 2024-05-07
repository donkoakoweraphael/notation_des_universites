@extends('layouts.base-admin-university')


@section('new-university-page-active')
    active
@endsection

@section('main')
    <div class="row justify-content-center">
        <div class="col">
            <div class="m-0 p-3 border rounded-top">
                <h3>
                    Entrer les renseignements sur l'université
                </h3>
            </div>
            <div class="m-0 p-3 border">
                <form method="POST" action="{{ route('admin.university.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nameInput" class="form-label">Nom de l'université</label>
                        <input type="text" class="form-control" id="nameInput" name="name" value="{{ old('name') }}"
                            aria-describedby="nameError">
                        <div id="nameError" class="form-text text-danger">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="imageInput" class="form-label">Image</label>
                        <input id="imageInput" type="file" accept="image/png, image/jpeg" class="form-control"
                            name="image_path" aria-describedby="imageError">
                        <div id="imageError" class="form-text text-danger">
                            @error('image_path')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="descriptionTextArea" class="form-label">Description</label>
                        <textarea name="description" id="descriptionTextArea" class="form-control" rows="10"
                            aria-describedby="descriptionError">{{ old('description') }}</textarea>
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
@endsection
