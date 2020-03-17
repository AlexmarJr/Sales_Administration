@extends('layouts.app')

@section('content')
<style>
</style>
<div class="container" >
    <div class="row justify-content-center" >
        <div class="col-md-8">
            <div class="card" >
            @include('flash::message')
                <div class="card-header" style="text-align: center">
                    <h2>Menu de Opções</h2>
                </div>

                <div class="card-body" >
                    
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header" style="text-align: center">
                                        <h4>Visão Geral</h4>
                                    </div>
                                    <div class="card-body">
                                        <a href="indexGeral"> <img src="img/geral.png" style="display: block;
                                                                            margin-left: auto;
                                                                            margin-right: auto;
                                                                            width: 70%;"> </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card">
                                    <div class="card-header" style="text-align: center">
                                        <h4>Clientes</h4>
                                    </div>
                                    <div class="card-body">
                                        <a href="clients"><img src="img/clientes.png" style="display: block;
                                                                            margin-left: auto;
                                                                            margin-right: auto;
                                                                            width: 70%;"> </a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col">
                                <div class="card">
                                    <div class="card-header" style="text-align: center">
                                        <h4></h4>
                                    </div>
                                    <div class="card-body">
                                        <a href=""><img src="img/soon.jfif" style="display: block;
                                                                            margin-left: auto;
                                                                            margin-right: auto;
                                                                            width: 70%;"> </a>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <hr>

                            <div class="col">
                                <div class="card">
                                    <div class="card-header" style="text-align: center">
                                        <h4></h4>
                                    </div>
                                    <div class="card-body">
                                        <a href=""><img src="img/soon.jfif" style="display: block;
                                                                            margin-left: auto;
                                                                            margin-right: auto;
                                                                            width: 70%;"> </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="card-header" style="text-align: center">
                                        <h4></h4>
                                    </div>
                                    <div class="card-body">
                                        <a href=""><img src="img/soon.jfif" style="display: block;
                                                                            margin-left: auto;
                                                                            margin-right: auto;
                                                                            width: 70%;"> </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="card-header" style="text-align: center">
                                        <h4></h4>
                                    </div>
                                    <div class="card-body">
                                        <a href=""><img src="img/soon.jfif" style="display: block;
                                                                            margin-left: auto;
                                                                            margin-right: auto;
                                                                            width: 70%;"> </a>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100"></div>
                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
