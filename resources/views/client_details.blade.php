@extends('layouts.app')

@section('content')
<?php $error = true; ?>
@if ($head->id_user ==  Auth::id() ) 
<div>
@include('flash::message')
    <div class="row justify-content-center" styke="overflow: hidden;" >
        <div class="col-md-6">
            <div class="card" >
                <div class="card-header" style="text-align: center">
                    <h3>Novo Registro de Compra</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                        <form action="{{route('store_sales')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_client" value="{{$head->id}}">
                            <label>Produto</label>
                            <input name="product" style=" text-transform: uppercase;" class="form-control" maxlength="40" required>
                        </div>

                        <div class="col">
                            <label>Preço</label>
                            <input type="text" id="dinheiro" name="original_price" class="dinheiro form-control" style="display:inline-block" maxlength="40" required>
                        </div>
                    </div>
                    <div>
                        <label>Descrição</label>
                        <textarea name="description" class="form-control" rows="3" style=" resize: none;"> </textarea>
                        <button type="submit" class="btn btn-success" style="float: right; margin-top: 2vh; padding: 15px">Registrar Compra</button> 
                    </div>
                    
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-5">
        
            <div class="card" >
            <form action="{{route('store_clients')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="card-header" style="text-align: center">
                    <h3>Cliente: &nbsp<i><input style="text-transform: uppercase" type="hidden" value="{{$head->name}}" maxlength="60" id="name_input" name="name">
                    <u style="text-transform: uppercase" id="name_show">{{$head->name}}</u></i> | 
                    <a onclick="editing()" > <img src="/img/edit.png" width="50"> Editar </a></h3>
                </div>
                
                <div class="card-body">
                    <input name="id" type="hidden" value="{{$id}}">
                    <div class="row">
                        <div class="col">
                            <label>E-Mail</label>
                            <input name="email" class="form-control" value='{{$head->email}}' maxlength="40">
                        </div>

                        <div class="col">
                            <label>Telefone</label>
                            <input name="telefone" class="form-control" value='{{$head->telefone}}' maxlength="13">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label>WhatsApp</label>
                            <input name="whatsapp" class="form-control" value='{{$head->whatsapp}}' maxlength="13">
                        </div>

                        <div class="col">
                            <label>Divida Total</label>
                            <input name="divida_total" class="form-control" value='{{$head->divida_total}}'maxlength="20" readonly>
                        </div>
                    </div>
                    </form>
                    <button type="submit" class="btn btn-warning" style="float: right; margin-top: 30px; padding: 15px; margin-bottom: 32px">Atualizar Dados</button>
                </div>
            </div>
    </div>
</div>
<hr style="border: 1px solid black;">
               

<div class="col-md-12" style="padding: 15px">
    <div class="card">
        <div class="card-header">
            <h3 style="text-align:center">Historico de compras ativos: &nbsp<i><u>{{$head->name}}</u></i></h3>
        </div>

        <div class="card-body">
            <table class="table" >
                <tr>
                    <th scope="col">Data</th>
                    <th scope="col">Produto</th>
                    <th scope="col">Preço Inicial</th>
                    <th scope="col">Pendente</th>
                    <th scope="col">Ações</th>
                </tr>
                @foreach($sales as $value)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d')}} / {{ \Carbon\Carbon::parse($value->created_at)->format('F')}}</td>
                    <td style=" text-transform: uppercase;">{{$value->product}}</td>
                    <td>{{$value->original_price}}<span> R$</span></td>
                    <td>{{$value->current_price}}<span> R$</span></td>
                    <td><a href="{{route('sales_details', $value->id)}}" class="btn btn-primary">Abrir</a>  <a href="{{route('delete_sales', $value->id)}}" class="btn btn-danger" >Excluir</a></td> 

                </tr>
                            @endforeach
            </table>
        </div>
    </div>
    </div>
</div>
@else
<script> 
window.location.href = '{{route("clients")}}'; </script>
@endif
    
<script>

$('.dinheiro').mask('###0.00', {reverse: true});

function editing(){
    if($("#name_input").attr('type') == 'hidden'){
        $("#name_input").attr('type', 'form-control');
        $("#name_show").css("display", "none");
    }
    else{
        $("#name_input").attr('type', 'hidden');
        $("#name_show").css("display", "inline");
    }
}

</script>
@endsection
