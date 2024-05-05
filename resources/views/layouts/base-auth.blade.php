@extends('layouts.base')


@section('body')
    @php
        $authUser = Auth::user();
    @endphp

    @include('components.navbar')
    <div style="height: 70px;"></div>
    
    <div class="container-fluid">
        @yield('content')
    </div>
@endsection
