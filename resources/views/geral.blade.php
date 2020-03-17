@extends('layouts.app')

@section('content')
  <div class="container">
  
  <div class="box">
    <div class="content">
    <h2>Valor á receber</h2>
    <p>R$ {{$alldebt}} De Dividas acumuladas dos clientes</p>
      </div>
  </div>
  
    <div class="box">
      <div class="content">
    <h2>Cliente com mais dividas</h2>
    <p>@if($mvp_client->isNotEmpty()) {{$mvp_client[0]->name}}: R$ {{$mvp_client[0]->divida_total}}  @else Sem Detalhes de clientes disponivel! @endif </p>
        </div>
  </div>
  
    <div class="box">
      <div class="content">
        <h2>Cliente com mais compras</h2>
        <p>@if($high_client_buys->isNotEmpty()) {{$high_client_buys[0]->name}} Com {{$high_buys[0]->quant}} Produtos comprados<br> Divida de {{$high_client_buys[0]->divida_total}} @else Sem Detalhes de clientes disponivel! @endif</p>
      </div>
  </div>

  <div class="box">
      <div class="content">
        <h2>Produtos mais comprado é:</h2>
        <p>@if($most_purchased_product != '')  {{$most_purchased_product[0]->product}} Com {{$most_purchased_product_count}} Compras registradas! @else Sem compras registradas! @endif</p>
      </div>
  </div>
  
</div>
<style>
@import url('https://fonts.googleapis.com/css?family=Lato:300,400,700');

* {
  margin: 0;
  padding: 0;
}

.container {
  position: relative;
  width: 90%;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  grid-gap: 70px;
}

.container .box::before {
  content: '';
  position: absolute;
  height: 100%;
  width: 100%;
  background: #fff;
  z-index: -1;
  top: -2px;
  left: -2px;
  right: -2px;
  bottom: -2px;
  transform: skew(2deg, 3deg);
  transition: .5s;
}

.container .box:hover:before {
  transform: skew(-2deg, -3deg);
}

.container .box {
  position: relative;
  color: #fff;
  height: 220px;
/*   border: 1px solid #fff; */
  display: flex;
  align-content: center;
  align-items: center;
  background-color: #001628;
}

.container .box:nth-child(1):before {
  background: linear-gradient(to right, #00c3ff, #ffff1c);
}

.container .box:nth-child(2):before {
  background: linear-gradient(to right, #ef32d9, #89fffd);
}

.container .box:nth-child(3):before {
  background: linear-gradient(to right, #e96443, #904e95);
}


.content {
  padding: 0 40px;
  position: relative;
}


.content h2 {
  font-weight: 700;
  font-size: 30px;
  margin-bottom: 30px;
}

.content p {
  letter-spacing: 1px;
  font-size: 18px;
}
</style>

<script>

</script>
@endsection

