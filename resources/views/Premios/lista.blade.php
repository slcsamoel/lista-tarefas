@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card dash-area">
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <x-sidemenu/>
                <div class="container">

                    @if (isset($success))
                        <div class="alert alert-success" role="alert">
                            Um simples alerta success. Olha só!
                        </div>
                    @elseif(isset($error))
                        <div class="alert alert-warning" role="alert">
                            Um simples alerta warning. Olha só!
                        </div>
                    @endif

                    <div class="row" style="padding: 5px;">
                        <div class="col-md-6">
                        </div>

                        <div class="col-md-6">
                            <div class="page-title-menu float-right">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="premios-store" data-titulo="Novo Cadastro">Novo</button>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3 card-border">

                        <img src="{{ asset('assets/img/logo_omnia.png') }}" class="card-img-top" alt="...">

                        <div class="card-body card-list">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                    <div class="page-title-menu float-right">
                                        <a href="#">
                                            <button class="btn btn-primary"> Altera </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('premios-store') }}">
             @csrf
            <div class="form-group">
              <label for="inputName" class="col-form-label">Nome</label>
              <input type="text" class="form-control" name="nome" id="nome">
            </div>
            <div class="form-group">
              <label for="inputDescricao" class="col-form-label">Descrição</label>
              <textarea class="form-control" name="descricao" id="descricao"></textarea>
            </div>

            <img src="http://placehold.it/600x200" class="img-fluid" alt="..." name="imagem" id="imagem">
            <div class="form-group">
                <label for="inputImagem" class="col-form-label">imagem</label>
                <input type="file" class="form-control-file" name="inputImagem" onchange="readURL(this);">
            </div>
         </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary" >Salvar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection
