@extends('layouts.base-admin-university')


@section('settings-page-active')
    active
@endsection


@section('main')
    <div class="row">
        <div class="col">
            <div class="px-4">
                @foreach ($settings as $setting)
                    <form action="{{ route('admin.setting.edit', $setting->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        @if ($setting->key == 'max_note_to_display')
                            <div class="row border rounded p-3 ps-4 mb-2">
                                <div class="col-7">
                                    <span class="nav-link link-primary fs-5">
                                        {{ $setting->name }}
                                    </span>
                                </div>
                                <div class="col-3">
                                    <input type="number" min="1" name="max_note_to_display" class="form-control"
                                        value="{{ $setting->value }}">
                                    <div class="form-text text-danger">
                                        @error('max_note_to_display')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-outline-success">Enregistrer</button>
                                </div>
                            </div>
                        @endif

                        @if ($setting->key == 'number_of_digits_after_decimal_point')
                            <div class="row border rounded p-3 ps-4 mb-2">
                                <div class="col-7">
                                    <span class="nav-link link-primary fs-5">
                                        {{ $setting->name }}
                                    </span>
                                </div>
                                <div class="col-3">
                                    <input type="number" min="1" name="number_of_digits_after_decimal_point"
                                        class="form-control" value="{{ $setting->value }}">
                                    <div class="form-text text-danger">
                                        @error('number_of_digits_after_decimal_point')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-outline-success">Enregistrer</button>
                                </div>
                            </div>
                        @endif
                    </form>
                @endforeach
            </div>
        </div>
    </div>
@endsection
