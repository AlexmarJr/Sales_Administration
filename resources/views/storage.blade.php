@extends('layouts.app')

@section('content')

<style>
.header-label{
    position: absolute;
    right: ;
}
</style>
<div class="container" >
@include('flash::message')

@if(isset($head))
    <script>$(document).ready(function(){
    $("#storage_modal").modal('show');
    });</script> 
@endif

    <div class="row">
        <div class="col-md-12" style="float: right">
            <div class="card">
                <h3 class="card-header" style="text-align: center">Estoque</h3><p>@if(isset($head)) <a class="btn btn-warning float-right" href="{{route('storage_home')}}">Voltar</a> @endif
                <div class="card-header">
                    <form action="{{route('search_product')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                        <input name="search" class="form-control" placeholder="Procurar Produto" style="width: 35vh; float: left; text-transform: uppercase;"> 
                        <button type="submit" style="float: left; padding: 5px" class="btn btn-primary">Procurar</button>
                    </form>
                    <button id="btn" type="button" style="float: right;position: relative;" data-toggle="modal" data-target="#storage_modal" class="btn btn-success">Adicionar</button>
                </div>
                <div class="card-body" style="height: 65vh;   
                                                padding:1px; 
                                                overflow: auto;">
                <table class="table" style="overflow:auto;">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Produto</th>
                        <th scope="col">Valor de Compra</th>
                        <th scope="col">Valor de Venda</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Ações</th>
                    </tr>

                    @foreach($storage as $value)
                    <tr>
                        <td>{{$value->id}}</td>
                        <td style=" text-transform: uppercase;">{{$value->name_product}}</td>
                        <td>{{$value->buy_price}}<span> R$</span></td>
                        <td>{{$value->sell_price}}<span> R$</span></td>
                        <td>{{$value->quantity}}</td>
                        <td><a href="{{route('edit_storage', $value->id)}}" class="btn btn-primary">Abrir</a>  <a href="{{route('delete_store', $value->id)}}" class="btn btn-danger" >Excluir</a></td> 
                    </tr>
                    @endforeach

                </table>
                </div>  
            </div>
        </div>
    </div>
</div>

<form action="{{route('store_storage')}}" method="post" autocomplete="off" enctype="multipart/form-data">
@csrf
@if(isset($head))
  <input type="hidden" name="id" value="{{$head->id}}">
@endif
<!-- Modal -->
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
        <div class="form">
            <label>Produto</label>
            <input class="form-control" name="name_product" placeholder="Nome do Produto" @if(isset($head)) value="{{$head->name_product}}" @endif style="text-transform: uppercase">
        </div>
        <hr>
        <div class="row"> 
            <div class="col-sm-5">
                <label>Valor de compra do Produto</label>
                <input class="dinheiro form-control" name="buy_price" id="dinheiro" placeholder="Preço de compra" @if(isset($head)) value="{{$head->buy_price}}" @endif>
            </div>
            <div class="col-sm-5">
                <label>Valor de venda do Produto</label>
                <input class="dinheiro form-control" name="sell_price" id="dinheiro" placeholder="Preço de venda" @if(isset($head)) value="{{$head->sell_price}}" @endif>
            </div>
            <div class="col-sm-2">
                <label>Quantidade</label>
                <input class="form-control" name="quantity" type="number" min="0" placeholder="Quantidade" @if(isset($head)) value="{{$head->quantity}}" @endif>
            </div>
        </div>
        <hr>
        <div>
            <label>Descrição</label>
            <textarea class="form-control" name="description" rows="4">@if(isset($head)){{$head->description}}@endif</textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-success">Adicionar</button>
      </div>
    </div>
  </div>
</div>

</form>


<script>
$('.dinheiro').mask('###0.00', {reverse: true});
</script>

@endsection