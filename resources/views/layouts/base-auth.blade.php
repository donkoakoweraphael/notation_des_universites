@extends('layouts.base')


@section('body')
    
@yield('sidebar')

@include('components.navbar')

<div class="container-fluid p-0">
    @yield('content')
</div>
@endsection
