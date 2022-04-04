<div class="sidemenu">
    <ul>
        <li  @if(request()->route()->getName() == 'index' ||  request()->route()->getName() == 'home' ) class="active" @endif >
            <a @if(request()->route()->getName() == 'index' ||  request()->route()->getName() == 'home' ) class="active" @endif href="#">Campanhas</a>
        </li>
        @if(Auth::user()->tipo_acesso == 2)
          <li>
               <a href="#">Participantes</a>
          </li>
        @else
          <li @if (request()->route()->getName() == 'funcionario')
            class="active"
          @endif >
               <a  @if (request()->route()->getName() == 'funcionario') class="active" @endif href="{{ route('funcionario' , [ 'id' => Auth::user()->id ]) }}">Meus Dados</a>
          </li>
        @endif
        <li @if (request()->route()->getName() == 'premios') class="active" @endif >
            <a @if (request()->route()->getName() == 'premios') class="active" @endif  href="{{ route('premios') }}">Catálogo de Prêmios</a>
        </li>
        <li><a href="#">Solicitações de Resgates</a></li>
    </ul>
</div>
