@extends('layouts.app')

@section('content')
<form action="{{route('payment')}}" method="post" autocomplete="off" enctype="multipart/form-data">
@csrf
<input type="hidden" value="{{$head->id}}" name="id_sale">
<input type="hidden" value="{{$head->id_client}}" name="id_client">
<div class="container" >
    <div class="row justify-content-center" >
        <div class="col-md-8">
            <div class="card" >
            @include('flash::message')
                <div class="card-header" style="text-align: center">
                    <h2>Detalhes da Compra</h2>
                </div>

                <div class="card-body" >
                    <div class="row">
                        <div class="col">
                            <label>Valor Inicial<input class="form-control" value="{{$head->original_price}}" readonly></input></label>
                        </div>
                        <div class="col">
                            <label>Valor Faltante<input class="form-control" name="missing_value" value="{{$head->current_price}}" readonly></input></label>
                        </div>
                        <div class="col">
                            <label>Ultimo Pagamento<input class="form-control" value="{{$head->latest_paiment}}" placeholder="Sem Pagamento" readonly></input></label>
                        </div>
                    </div>
                    <div>
                    <label>Descrição da Venda</label>
                    <textarea class="form-control" rows="3" name="description">{{$head->description}}</textarea>
                    </div>
                    <hr>
                    <div class="card-header" style="text-align: center">
                    <h2>Registrar pagamento</h2>
                    </div>
                    <div class="card-body" >
                        <div class="row">
                            <div class="col">
                               
                                <label>Valor</label>
                                <input type="text" id="dinheiro" name="value_paid" class="dinheiro form-control" style="width: 43vh" maxlength="40" >
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-success float-right" style="position: relative; top: 30px">Registrar Pagamento</button>
                            </div> 
                        </div>
                    <div>
                    <hr>
                    <div class="card-header" style="text-align: center">
                        <h2>Divida Quitada</h2>
                        <small>Essa Opção não podera ser desfeita!</small>
                    </div>

                    <div class="card-body" >
                        <div class="row justify-content-center">
                            <a class="btn btn-danger" href="{{route('payoff', $head->id)}}" style="position: relative; top: 15px">Quitar Divida</a>
                        </div>
                    <div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<script>
$('.dinheiro').mask('###0.00', {reverse: true});
</script>
@endsection
