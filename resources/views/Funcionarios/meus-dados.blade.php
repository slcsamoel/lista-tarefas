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

                <div class="row align-items-start"> <!-- Formulario Dados -->
                    <form class="row g-3" style="margin-left: 1px;  margin-right: 1px; ">
                        <div class="col-12">
                          <label for="inputEmail4" class="form-label">Email</label>
                          <input type="text" class="form-control" id="inputEmail4" name="email" value="{{ $funcionario->email }}" readonly >
                        </div>
                        <div class="col-12">
                          <label for="inputAddress" class="form-label">Nome</label>
                          <input type="text" class="form-control" id="inputAddress"  value="{{ $funcionario->name }}" >
                        </div>
                        <div class="col-md-4">
                          <label for="inputCity" class="form-label">Data Admisão</label>
                          <input type="text" class="form-control" id="inputCity" value="{{ date('d/m/Y', strtotime($funcionario->data_admisao)) }}" readonly>
                        </div>
                        <div class="col-md-4">
                          <label for="inputZip" class="form-label">Data Nascimento</label>
                          <input type="text" class="form-control" id="inputZip"  maxlength="10" onkeypress="mascaraData(this)"  value="{{ date('d/m/Y', strtotime($funcionario->data_nascimento)) }}" >
                        </div>

                        <div class="col-md-4">
                          <button type="submit" class="form-control btn btn-primary" style="margin-top: 30px;" >Alterar</button>
                        </div>
                    </form>
                </div>

                <div class="row align-items-center"> <!-- Tabela de movimentações -->

                      <div class="badge bg-primary text-center" style="width: 8rem; margin-top: 28px; margin-left: 14px; color:white;">
                          Movimentações na Conta
                      </div>
                      <div class="badge bg-primary text-wrap" style="width: 8rem; margin-top: 28px; margin-left: 394px; color:white;">
                            Saldo Pontos : {{ $funcionario->saldo }}
                      </div>
                    <table class="table" style="margin-left: 14px;  margin-right: 15px; margin-top: 2px; ">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Data</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Movimentação</th>
                            <th scope="col">Valor</th>
                          </tr>
                        </thead>
                        <tbody>
                         @foreach ($movimentacoes as $movimentacao)
                            <tr>
                                <th scope="row">{{ $movimentacao->id }}</th>
                                <td> {{ date('d/m/Y H\hi', strtotime($movimentacao->created_at)) }}</td>
                                <td>{{ $movimentacao->descricao }}</td>
                                <td>
                                    @if($movimentacao->tipo_movimentacao == 1)
                                        Entrada
                                    @else
                                        Sair
                                    @endif
                                </td>
                                <td>{{ $movimentacao->valor }}</td>
                            </tr>
                         @endforeach
                        </tbody>
                      </table>
                </div>

                <div class="row align-items-end"> <!-- Tabela de Resgates -->

                    <div class="badge bg-primary text-center" style="width: 8rem; margin-top: 28px; margin-left: 14px; color:white;">
                        Resgates
                    </div>

                    <table class="table" style="margin-left: 14px;  margin-right: 15px; margin-top: 2px; ">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Data</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Tipo de Resgate</th>
                            <th scope="col">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                         @foreach ( $resgates as $resgate )
                            <tr>
                                <th scope="row">{{ $resgate->id }}</th>
                                <td>{{ date('d/m/Y H\hi', strtotime($movimentacao->created_at)) }}</td>
                                <td>{{  $resgate->descricao }}</td>
                                <td>
                                    @if($resgate->campanha->tipo_resgate == 1)
                                        Normal
                                    @else
                                        Especial
                                    @endif
                                </td>
                                <td>{{  $resgate->status }}</td>
                            </tr>
                         @endforeach
                        </tbody>
                      </table>
                </div>

             </div>

            </div>
        </div>
    </div>
</div>
@endsection
