<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/home">
        <i class=" fas fa-building"></i><span>Inicio</span>
    </a>
    @can('ver-usuario')
    <a class="nav-link" href="/cuentas">
        <i class=" fas fa-users"></i><span>Cuentas</span>
    </a>
    @endcan
    @can('ver-rol')
    <a class="nav-link" href="/clientes">
        <i class=" fas fa-user-lock"></i><span>Clientes</span>
    </a>
    @endcan
    
</li>
