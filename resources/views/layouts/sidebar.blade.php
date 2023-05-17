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
                <li><a class="treeview-item" href="/reembolso"><i class="icon fa fa-circle-o"></i> Reembolso</a></li>
                <li><a class="treeview-item" href="/usuario"><i class="icon fa fa-circle-o"></i> Usuarios</a></li>
                <li><a class="treeview-item" href="/centrocusto"><i class="icon fa fa-circle-o"></i> Centro de Custo</a></li>
                <li><a class="treeview-item" href="/gastos"><i class="icon fa fa-circle-o"></i> Tipos de Gastos</a></li>
            </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                class="app-menu__icon fa fa-archive"></i><span class="app-menu__label">Buscar</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i> Reembolso</a></li>
                <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i> Reembolso <br>(Cartao Coporativo)</a></li>
                <li><a class="treeview-item" href="/Buscar/buscarCentroCusto"><i class="icon fa fa-circle-o"></i> Centro de Custo</a></li>
                <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i> Tipo de Gastos</a></li>
            </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                    class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Relatorios</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i> Graficos</a></li>
            </ul>
        </li>
    </ul>
</aside>
