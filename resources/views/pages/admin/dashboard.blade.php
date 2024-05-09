@extends('layouts.base-admin')


@section('title')
    Classement des universités
@endsection


@section('dashboard-page-active')
    active
@endsection


@section('main')
    <div class="row ps-3">
        <div class="col-auto border border-2 rounded p-4">
            <div class="row justify-content-center fs-4">
                Nombre d'utilisateurs
            </div>
            <div class="row justify-content-center h1">
                {{ $statistics['users_number'] + $statistics['deleted_users_number'] }}
            </div>
        </div>
        {{-- <div class="col-auto border border-2 rounded p-4 ms-3">
            <div class="row justify-content-center fs-4">
                Nombre d'utilisateurs supprimés
            </div>
            <div class="row justify-content-center h1">
                {{ $statistics['deleted_users_number'] }}
            </div>
        </div> --}}
        <div class="col-auto border border-2 rounded p-4 ms-3">
            <div class="row justify-content-center fs-4">
                Nombre d'universités
            </div>
            <div class="row justify-content-center h1">
                {{ $statistics['universities_number'] }}
            </div>
        </div>
    </div>
@endsection
