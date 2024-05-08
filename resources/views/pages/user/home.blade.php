@extends('layouts.base-auth')


@section('title')
    Classement des universités
@endsection


@section('university-page-active')
    btn-secondary
@endsection


@section('content')
    <hr class="my-5">
    <div class="row">
        <div class="col-12 col-md-4 col-lg-3">
            <div class="flex-shrink-0 p-3 bg-light">
                <form {{-- class="visually-hidden" --}}>
                    <div class="container-fluid visually-hidden">
                        <span class="fs-6 fw-semibold">Rechercher</span>
                        <div class="row">
                            <div class="col p-0 m-0">
                                <input type="" name="" class="form-control">
                            </div>
                            <div class="col-auto p-0 m-0">
                                <button type="submit" class="btn btn-outline-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    {{-- </form> --}}

                    <hr class="my-4">

                    <span class="fs-6 fw-semibold">Critères de classement</span>
                    <div class="ms-4">
                        {{-- <form action="" method="get"> --}}

                        <ul class="list-unstyled ps-0">
                            @foreach ($criteria as $criterion)
                                <li class="mb-1">
                                    <input id="critCheck{{ $criterion->id }}" type="checkbox" name="c[]"
                                        value="{{ $criterion->id }}"  @checked(isset($_GET['c']) && in_array($criterion->id,$_GET['c'])) class="">
                                    <label for="critCheck{{ $criterion->id }}" class="">{{ $criterion->designation }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>

                        <button type="submit" class="btn btn-outline-secondary">Classer</button>
                </form>
            </div>

            <hr class="my-4">

            {{-- <span class="fs-6 fw-semibold">Page 1 sur 1</span>
            @for ($i = 1; $i <= 4; $i++)
                <a href="&p={{ $i }}">{{ $i }}<a>
            @endfor --}}
        </div>
    </div>
    <div class="col">
        {{-- <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3"> --}}
        <div class="row">
            @foreach ($classifiedUniversities as $university)
                <div class="col-12 col-sm-6 col-xl-4 my-2">
                    <div class="card shadow-sm">
                        @if ($university->image_path)
                            <img src="{{ asset('storage/' . $university->image_path) }}" width="100%" height="225"
                                alt="">
                        @else
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                                preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title></title>
                                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                                    dy=".3em"></text>
                            </svg>
                        @endif
                        <div class="card-body">
                            <p class="card-text">
                                <strong>
                                    {{ $university->name }}
                                </strong>
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <span>{{ $university->mean_score }} / {{ $university->max_note }}</span>
                                    <span class="ms-2">({{ $university->nombre_avis }} avis)</span>
                                    <a class="ms-2 btn btn-outline-info" href="{{ route('user.university.read', $university->id) }}">Consulter</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </div>
@endsection
