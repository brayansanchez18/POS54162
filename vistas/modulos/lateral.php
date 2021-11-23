<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?=$frontend?>" class="brand-link">
    <img src="vistas/img/plantilla/icono.png" alt="POS BS web" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">POS BSweb</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="vistas/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="ml-2">
        <div class="info">
          <a class="d-block">Alexander Pierce</a>
        </div>
        <br>
        <div class="info">
          <a href="salir" class="d-block"><button class="btn btn-danger">Salir</button></a>
        </div>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="<?=$frontend?>" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Inicio</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="categorias" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>Categorias</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="productos" class="nav-link">
            <i class="nav-icon fas fa-boxes"></i>
            <p>Productos</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="clientes" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Clientes</p>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" style="cursor:pointer;">
            <i class="nav-icon fas fa-dollar-sign"></i>
            <p>
              Ventas
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="crear-venta" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Crear Venta</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="administrar-ventas" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Administrar Ventas</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="perfiles" class="nav-link">
            <i class="nav-icon fas fa-key"></i>
            <p>Perfiles</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>