@extends('layouts.base-admin-university')


@section('university-list-page-active')
    active
@endsection


@section('main')
    <div class="row">
        <div class="col">
            <div class="px-4">
                @foreach ($universities as $university)
                    <div class="row border rounded p-3 ps-4 mb-2">
                        <div class="col-auto align-self-center">
                            <input type="checkbox" class="form-check" name="selected_universities"
                                id="university{{ $university->id }}" value="{{ $university->id }}">
                        </div>
                        <div class="col-auto">
                            <a class="nav-link link-primary fs-5"
                                href="{{ route('admin.university.edit', $university->id) }}">{{ $university->name }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
