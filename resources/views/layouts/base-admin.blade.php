@extends('layouts.base-auth')

@section('special-css')
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sidebars/">
@endsection

@section('admin-page-active')
    btn-secondary
@endsection


@section('sidebar')
    @include('components.admin.sidebar')
@endsection


@section('content')
    <div class="row">
        <div class="col-auto">
            <div style="width: 280px"></div>
        </div>
        <div class="col">
            <div class="p-5"></div>
            @yield('main')
        </div>
        <div class="bg-dark text-white col-auto border-start" style="height: 2000px">
            <div class="pt-5 pb-5"></div>
            @yield('toolbar')
        </div>
    </div>
@endsection
