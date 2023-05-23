
<header class="app-header" style="background-color: #12589e">
    <a class="app-header__logo" style="background-color: #12589e" href="/home">Despesas GA</a>
    <!-- Sidebar toggle button -->
    <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu -->
    <ul class="app-nav" style="color: #000000">
        <!-- User Menu -->
        <li class="dropdown">
            <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
                <i class="fa fa-user fa-lg"></i>
            </a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalCreditos">
                        <i class="fa fa-user fa-lg"></i> Créditos
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out fa-lg"></i>
                        {{ __('Sair') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</header>

<!-- Modal de Créditos -->
<div class="modal fade" id="modalCreditos" tabindex="-1" role="dialog" aria-labelledby="modalCreditosLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreditosLabel">Créditos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align: center;">
                <p>Olá! Agradecemos por utilizar nossos serviços.</p>
                <p>Todos os direitos autorais são destinados ao Grupo GB Software.</p>
            </div>
        </div>
    </div>
</div>

