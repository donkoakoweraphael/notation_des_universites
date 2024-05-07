@extends('layouts.base-auth')


@section('special-css')
    <link rel="stylesheet" href="{{ asset('css/opacity.css') }}">
@endsection

@section('university-page-active')
    btn-secondary
@endsection


@section('content')
    @php
        $authUser = Auth::user();
    @endphp
    <div class="p-4"></div>
    <div class="bg-image" style="background-image: url({{ asset('storage/' . $university->image_path) }}); height: 75vh;">
        <div style="height: 20vw"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <strong>
                        <h1 class="display-1 fst-italic" style="color: white;">
                            {{ $university->name }}
                        </h1>
                    </strong>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <a class="btn btn-outline-primary" href="{{ route('admin.university.edit', [$university->id]) }}">
                        Editer la page
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="p-4 p-md-5 mb-4 text-bg-dark">
            <div class="col-md-6 px-0">
                <h1 class="display-4">A propos</h1>
            </div>
            <div class="col-12 px-0">
                <p class="lead my-3">
                    {{ $university->informationSections->where('title', '=', 'Description')->first()->content }}
                </p>

                <p class="lead my-3">
                    Email : <a class="link-info" href="mailto:{{ $university->email }}"
                        target="_blank">{{ $university->email }}</a>
                </p>
                <p class="lead my-3">
                    Site web : <a class="link-info" href="{{ $university->web_site }}"
                        target="_blank">{{ $university->web_site }}</a>
                </p>
                <p class="lead my-3">
                    Téléphone : <a class="link-info" href="tel:+{{ $university->phone_number }}"
                        target="_blank">{{ $university->phone_number }}</a>
                </p>
            </div>
        </div>

        <br class="py-5">

        <hr class="featurette-divider">
        @foreach ($university->informationSections->where('title', '!=', 'Description') as $infoSect)
            <div class="container-fluid">
                <div class="row featurette">
                    <div class="col-md-7 @if ($loop->odd) order-md-2 @endif">
                        <h2 class="featurette-heading fw-normal lh-1">{{ $infoSect->title }}</h2>
                        <p class="lead">{{ $infoSect->content }}</p>
                    </div>
                    <div class="col-md-5 @if ($loop->odd) order-md-1 @endif">
                        @if ($infoSect->image_path)
                        <img src="{{ asset('storage/' . $infoSect->image_path) }}" alt="" style="width: 100%">
                            @else
                            <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" style="width: 100%; height: 100%;" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: x" preserveAspectRatio="xMidYMid slice" focusable="false"><title></title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">x</text></svg>
                        @endif
                    </div>
                </div>
            </div>
            <hr class="featurette-divider">
        @endforeach
    </div>

    <br class="py-5 my-5">

    {{-- liste des commentaires --}}
@endsection
