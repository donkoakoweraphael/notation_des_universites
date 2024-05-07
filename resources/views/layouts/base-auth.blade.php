@extends('layouts.base')


@section('body')
    
@yield('sidebar')

@include('components.navbar')

<div class="container-fluid">
    @yield('content')
</div>
@endsection
