<!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
          with font-awesome or any other icon font library -->
    <li class="nav-item has-treeview menu-open">
      <a href="{{ route('dashboard') }}" class="nav-link active">
        <i class="nav-icon fas fa-home"></i>
        <p>
          Home
        </p>
      </a>
    </li>

    <!-- Booking -->
    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-tag"></i>
        <p>
          Ruang Meeting
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>

      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('bookpostmo.index.today') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Postmo</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('bookfaried.index.today') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Faried</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('bookfounder.index.today') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Founder</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('bookinterior.index.today') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Interior</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('bookbulat.index.today') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>R.Bulat</p>
          </a>
        </li>
      </ul>
    </li>

    <!-- Logout -->
    <li class="nav-item has-treeview menu-open">
      <a href="{{ route('AuthAdmin.logout') }}" class="nav-link"
         onclick="event.preventDefault();
         document.getElementById('logout-form').submit();">
         <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>
          Logout
        </p>
      </a>

      <form id="logout-form" action="{{ route('AuthAdmin.logout') }}" method="POST" style="display: none;">
          @csrf
      </form>

    </li>



  </ul>
</nav>
<!-- /.sidebar-menu -->
