@extends('layouts.base-admin-university')


@section('users-page-active')
    active
@endsection


@section('main')
    <div class="row">
        <div class="col">
            <div class="px-4">
                @foreach ($users as $user)
                    <div class="row border rounded p-3 ps-4 mb-2">
                        <div class="col-auto align-self-center">
                            <input type="checkbox" class="form-check" name="selected_users"
                                id="university{{ $user->id }}" value="{{ $user->id }}">
                        </div>
                        <div class="col-auto">
                            <span class="nav-link link-primary fs-5">
                                {{ $user->last_name }} {{ $user->first_name }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
