@extends('layouts.base-admin')


@section('title')
    Critères de classement
@endsection


@section('criterion-page-active')
    active
@endsection


@section('main')
    <div class="row">
        <div class="col">
            <div class="px-4">
                <div class="row border rounded p-3 ps-4 mb-2">

                    <div class="col-9">
                        @if (isset($criterion))
                            <form method="POST" action="{{ route('admin.criterion.update', $criterion->id) }}">
                                @csrf
                                @method('PUT')
                                <label for="" class="form-label">Modifier le critere de notation</label>
                                <div class="row">
                                    <div class="col-9">
                                        <input type="text" class="form-control" name='designation'
                                            value="{{ $criterion->designation }}">
                                        <div id="nameError" class="form-text text-danger">
                                            @error('designation')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-outline-primary">Modifier</button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.criterion.store') }}">
                                @csrf
                                <label for="" class="form-label">Nouveau critere de notation</label>
                                <div class="row">
                                    <div class="col-9">
                                        <input type="text" class="form-control" name='designation'
                                            value="{{ old('designation') }}">
                                        <div id="nameError" class="form-text text-danger">
                                            @error('designation')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-outline-primary">Ajouter</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>

                </div>
                @foreach ($criteria as $criterion)
                    <div class="row border rounded p-3 ps-4 mb-2">
                        <div class="col-auto align-self-center">
                            <input type="checkbox" class="form-check" name="selected_criteria"
                                id="criterion{{ $criterion->id }}" value="{{ $criterion->id }}">
                        </div>
                        <div class="col-8">
                            <a class="nav-link link-primary fs-5"
                                href="{{ route('admin.criterion.edit', $criterion->id) }}">
                                {{ $criterion->designation }}
                            </a>
                        </div>
                        <div class="col-3">
                            <form method="POST" action="{{ route('admin.criterion.destroy', $criterion->id) }}">
                                @csrf
                                @method('DELETE')
                                
                                

                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modifierModal">
                                    Supprimer
                                </button>
                                
                                <div class="modal fade" id="modifierModal" tabindex="-1" aria-labelledby="modifierModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger-subtle">
                                                <h1 class="modal-title fs-5" id="modifierModalLabel">
                                                    Avertissement
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body bg-warning-subtle">
                                                Voulez vous supprimer le critère de notation ?
                                            </div>
                                            <div class="modal-footer bg-success-subtle">
                                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">
                                                    Non
                                                </button>
                                                <button type="submit" class="btn btn-danger">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
