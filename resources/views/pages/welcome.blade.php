@extends('layouts.base')


@section('title')
    Welcome
@endsection


@section('body')
    <div style="height: 200px; background-color:darkslateblue;"></div>
    <div style="height: 50px;"></div>
    <div class="row">
        <div class="container">
            <h1 style="font-size: 64px;" class="text-center">Bienvenue sur la platefome de notation des universités</h1>
            <div style="height: 50px;"></div>
            <div class="row">
                <div class="col p-5">
                    <div class="row justify-content-center">
                        <div style="width: 400px;" class="bg-success rounded-5 shadow-lg">
                            <a href="{{ route('login') }}" class="btn btn-link text-light fs-2">
                                <div style="height: 300px;" class="row text-center">
                                    <div class="col align-self-center">
                                        Cliquez ici pour vous authentifier
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col p-5">
                    <div class="row justify-content-center">
                        <div style="width: 400px;" class="bg-danger rounded-5 shadow-lg">
                            <a href="{{ route('register') }}" class="btn btn-link text-light fs-2">
                                <div style="height: 300px;" class="row text-center">
                                    <div class="col align-self-center">
                                        Cliquez ici pour vous enregistrer
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
