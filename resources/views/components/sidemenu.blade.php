<div class="sidemenu">
    <ul>
        <li  @if(request()->route()->getName() == 'index' ||  request()->route()->getName() == 'home' ) class="active" @endif >
            <a @if(request()->route()->getName() == 'index' ||  request()->route()->getName() == 'home' ) class="active" @endif href="{{route('home')}}">atividades cadastradas</a>
        </li>
    </ul>
</div>
