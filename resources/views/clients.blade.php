@extends('layouts.app')

@section('content')
<style>

</style>
<form action="{{route('store_clients')}}" method="post" autocomplete="off" enctype="multipart/form-data">
@csrf
<div class="w-100 p-3" >
@include('flash::message')
    <div class="row">
        <div class="col-md-3" style="float: left">
            <div class="card">
                <div class="card-header" style="text-align: center;">
                    <h3>Novo Cliente</h3>
                </div>

                <div class="card-body" >
                    <label style="color: lightblack;
                                font-size: 20px;">Nome:</label>
                    <input name="name" type="text" class="form-control" placeholder="Nome" maxlength="60" style="text-transform: uppercase" required>
                    <hr>

                    <label style="color: lightblack;
                                font-size: 20px;">Telefone:</label>
                    <input name="telefone" type="phone" class="form-control" placeholder="Ex: 99999-9999" maxlength="13">
                    <hr>

                    <label style="color: lightblack;
                                font-size: 20px;">WhatsApp:</label>
                    <input name="whatsapp" type="phone" placeholder="Ex: 99999-9999" class="form-control" maxlength="13">
                    <hr>
                    <label style="color: lightblack;
                                font-size: 20px;">E-Mail:</label>
                    <input name="email" type="email" class="form-control" placeholder="E-Mail" maxlength="40">
                    <hr style="border: 1px solid green;">
                    <button type="submit" class="btn btn-success float-right" style="padding: 15px 50px 15px;">Salvar</button>
                </div>
            </div>
        </div>
        </form>

        
        <div class="col-md-9" style="float: right">
            <div class="card">
                <div class="card-header" style="text-align: center">
                <form action="{{route('search_clients')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                    <input name="search" class="form-control" placeholder="Procurar Cliente" style="width: 35vh; float: left; text-transform: uppercase;"> 
                    <button  type="submit" style="float: left; margin-left: 15px" class="btn btn-primary">Procurar</button>
                </form>
                    <h2>Clientes</h2>
                </div>

                <div class="card-body" style=" height: 65vh;   
                                                padding:1px; 
                                                overflow: auto;">
                    <table class="table" style="overflow:auto;">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Divida Total</th>
                            <th scope="col">Ações</th>
                        </tr>
                        @foreach($clients as $value)
                        <tr>
                            <td scope="row">{{$value->id}}</td>
                            <td style=" text-transform: uppercase;">{{$value->name}}</td>
                            <td>{{$value->divida_total}} <span> R$</span></td>
                            <td><a href="{{route('client_details', $value->id)}}" class="btn btn-primary">Abrir</a>  <a href="{{route('delete', $value->id)}}" class="btn btn-danger">Excluir</a></td>
                           
                        </tr>
                        @endforeach
                        </table>
                </div>  
            </div>
        </div>
    </div>
</div>


@endsection
