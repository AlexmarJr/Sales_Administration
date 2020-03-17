@extends('layouts.app')

@section('content')
<div>
    <h1 style="text-align: center; color: white">Por que usar Control.Me?<h1>
    <hr style="border: 1px solid black;">
</div>

<div class="row">
  <div class="col-sm-3 grow" style="background-color: black">
    <h2  style="text-align: center; color: white; font-style: oblique;">Saia do papel!</h2>
        <hr style="border: 1px solid white;">
    <pre style="color: white; font-size: 12px">
    Cansado de ficar procurando informações de um cliente, com 
    medo de perder essas informações que tem no seu caderno?, 
    use a solução da Control.Me, digitaliza todas informações
    e não tenha medo de perde-la
    </pre>
  </div>

  <div class="col-sm-1">
  </div>

  <div class="col-sm-3 grow" style="background-color: black">
    <h2  style="text-align: center; color: white; font-style: oblique;">Organização!</h2>
        <hr style="border: 1px solid white;">
    <pre style="color: white; font-size: 12px">
    Tenha um visão geral de suas economias, organize seus gastos 
    e saiba sua situação atual e nos futuros meses, ache seus 
    clientes rapidamente e salve tempo!
    </pre>
  </div>

  <div class="col-sm-1">
  </div>

  <div class="col-sm-3 grow" style="background-color: black">
    <h2  style="text-align: center; color: white; font-style: oblique;">Segurança!</h2>
        <hr style="border: 1px solid white;">
    <pre style="color: white; font-size: 12px">
    Suas informações estão aseguradas por umas das mais atuais
    criptografias do Laravel 6!, alem disso, o sistema fara backup 
    do banco todos os dias, pra assegurar seus dados, voçe tambem 
    podera baixar suas informações via em uma planilha Excel!.
    </pre>
  </div>



  <div class="col-sm-3 grow pad" style="background-color: black">
    <h2  style="text-align: center; color: white; font-style: oblique;">Comming Soon!</h2>
        <hr style="border: 1px solid white;">
    <pre style="color: white; font-size: 12px">
    Lorem ipsum dolor sit amet. Et voluptatem enim aut dolorem esse vel reiciendis
    pariatur nam omnis quam sit rerum galisum vel reprehenderit voluptatem.
    Nam excepturi unde et autem quidem qui corrupti quam aut laudantium deserunt 
    rem ipsum nisi qui commodi voluptatem id mollitia commodi.
    </pre>
  </div>

  <div class="col-sm-1">
  </div>

  <div class="col-sm-3 grow pad" style="background-color: black">
    <h2  style="text-align: center; color: white; font-style: oblique;">Comming Soon!</h2>
        <hr style="border: 1px solid white;">
    <pre style="color: white; font-size: 12px">
    Lorem ipsum dolor sit amet. Et voluptatem enim aut dolorem esse vel 
    reiciendis pariatur nam omnis quam sit rerum galisum vel reprehenderit 
    voluptatem.Nam excepturi unde et autem quidem qui corrupti quam aut 
    laudantium deserunt rem ipsum nisi qui commodi voluptatem id mollitia commodi.
    </pre>
  </div>

  <div class="col-sm-1">
  </div>

  <div class="col-sm-3 grow pad" style="background-color: black">
    <h2  style="text-align: center; color: white; font-style: oblique;">Comming Soon!</h2>
        <hr style="border: 1px solid white;">
    <pre style="color: white; font-size: 12px">
    Lorem ipsum dolor sit amet. Et voluptatem enim aut dolorem esse vel reiciendis
    pariatur nam omnis quam sit rerum galisum vel reprehenderit voluptatem.
    Nam excepturi unde et autem quidem qui corrupti quam aut laudantium deserunt 
    rem ipsum nisi qui commodi voluptatem id mollitia commodi.
    </pre>
  </div>
</div>

<footer class="page-footer" style="position: absolute;
                bottom: 0;
                width: 100%;
                background-color: white;
                opacity: 0.6;">

  <div class="container">

    <div class="row">

      <div class="col-md-12 py-0">
        <div class="mb-5" align="center">

          <!-- Facebook -->
          <a class="fb-ic" style="margin-right: 35px" href="https://www.facebook.com/alexmar.ramos">
            <img src="img/facebook.png" width=100>
          </a>
          
          <!--Linkedin -->
          <a class="li-ic" style="margin-right: 50px" href="https://www.linkedin.com/in/alexmar-noronha-1b4596160/">
            <img src="img/linkedin.png" width=50>
          </a>
          
          <!--Instagram-->
          <a class="ins-ic" style="margin-right: 50px" href="https://www.instagram.com/alex_rn_jr/?hl=pt-br">
            <img src="img/insta.png" width=50>  
          </a>
          
          <!--GitHub-->
          <a class="pin-ic" style="margin-right: 50px" href="https://github.com/AlexmarJr/Sales_Administration">
            <img src="img/github.png"  width=150>
          </a>
        </div>
      </div>

    </div>

  </div>

  <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href=""> Codigo fonte no GitHub</a>
  </div>

</footer>

<style>
.grow {
  padding: 5px 5px 5px 5px;
  border-radius: 10px;
  height: 49px;
  width: 22%;
  margin: 5px 1% 5px 1%;
  float: left;
  position: relative;
  transition: height 0.5s;
  -webkit-transition: height 0.5s;
  text-align: center;
  overflow: hidden;
  opacity:0.8
}
.pad{
    margin-top: 150px
}
.grow:hover {
  height: 155px;
  }
</style>
@endsection
