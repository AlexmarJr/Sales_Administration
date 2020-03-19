@extends('layouts.app')

@section('content')
<style>

</style>

<form action="{{route('store_clients')}}" method="post" autocomplete="off" enctype="multipart/form-data">
@csrf
<div class="w-100 p-3" >
@include('flash::message')
<div class="modal fade bd-example-modal-lg" id="storage_modal" tabindex="-1" role="dialog" aria-labelledby="storage_modal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="storage_modal_title">@if(isset($head)) Editar Produto @else Adicionar Produto @endif</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row"> 
            <div class="col-sm-7">
                <label style="color: lightblack;font-size: 20px;">Nome:</label>
                <input name="name" type="text" class="form-control" placeholder="Nome" maxlength="60" style="text-transform: uppercase" required>
            </div>

            <div class="col-sm-5">
                <label style="color: lightblack;font-size: 20px;">Telefone:</label>
                <input name="telefone" type="phone" class="form-control" placeholder="Ex: 99999-9999" maxlength="13">
            </div>

            <div class="col-sm-7">
                <label style="color: lightblack;font-size: 20px;">E-Mail:</label>
                <input name="email" type="email" class="form-control" placeholder="E-Mail" maxlength="40">
            </div>

            <div class="col-sm-5">
                <label style="color: lightblack;font-size: 20px;">WhatsApp:</label>
                <input name="whatsapp" type="phone" placeholder="Ex: 99999-9999" class="form-control" maxlength="13">
            </div>
        </div>
        <hr>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-success">Adicionar</button>
      </div>
    </div>
  </div>
</div>
        </form>

        
        <div class="container col-md-10">
            <div class="card">
                <div class="card-header" style="text-align: center">
                    <div class="card-header">
                        <h2>Clientes</h2> 
                    </div>
                    <button id="btn" type="button" style="float: right;position: relative;" data-toggle="modal" data-target="#storage_modal" class="btn btn-success">Adicionar Cliente</button>
                    
                    <form action="{{route('search_clients')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <input name="search" class="form-control" placeholder="Procurar Cliente" style="width: 35vh; float: left; text-transform: uppercase;"> 
                        <button type="submit" style="float: left; margin-left: 10px" class="btn btn-primary">Procurar</button>
                    </form>
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
                            <td><a href="{{route('client_details', $value->id)}}" class="btn btn-primary">Abrir</a>  <a href="{{route('delete', $value->id)}}" class="btn btn-danger" onclick="return confirm('Voce tem certeza que quer apagar?')">Excluir</a></td>
                           
                        </tr>
                        @endforeach
                        </table>
                </div>  
            </div>
        </div>
    </div>
</div>


@endsection
