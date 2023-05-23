
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div>
        <p class="app-sidebar__user-name" style="text-align: center; color: white;">{{ Auth::user()->name }}</p>
    </div>
    <ul class="app-menu">

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                    class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Cadastros</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="/reembolso"><i class="icon fa fa-circle-o"></i> Reembolso / Adiantamento</a></li>
            </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                class="app-menu__icon fa fa-archive"></i><span class="app-menu__label">Buscar</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="/Buscar/buscarReembolsos"><i class="icon fa fa-circle-o"></i> Reembolso</a></li>

            </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                    class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Relatorios</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="/Relatorio/relatorioDetalhado"><i class="icon fa fa-circle-o"></i> Relatorios Detalhados</a></li>
            </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
            class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Administrativo</span><i
            class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="/Buscar/buscarUsuarios"><i class="icon fa fa-circle-o"></i> Usuarios</a></li>
                <li><a class="treeview-item" href="/Buscar/buscarCentroCusto"><i class="icon fa fa-circle-o"></i> Centro de Custo</a></li>
                <li><a class="treeview-item" href="/Buscar/buscarGastos"><i class="icon fa fa-circle-o"></i> Natureza Operação</a></li>
                <li><a class="treeview-item" href="/Buscar/buscarAdministrativa"><i class="icon fa fa-circle-o"></i> Buscar<br>Administrativa</a></li>
                <li><a class="treeview-item" href="/Administrativo/graficosAdministrativo"><i class="icon fa fa-circle-o"></i> Graficos<br>Administrativo</a></li>
            </ul>
        </li>
    </ul>
</aside>
