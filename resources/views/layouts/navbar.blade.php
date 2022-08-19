<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
   with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link {{ setActive('home') }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('products.index') }}"
                class="nav-link {{ setActive('products.index') }}">
                <i class="nav-icon fas fa-box"></i>
                <p>Produk</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('categories.index') }}"
                class="nav-link {{ setActive('categories.index') }}">
                <i class="nav-icon fas fa-folder"></i>
                <p>Kategori</p>
            </a>
        </li>

        @if (Auth::user()->level == 1)
            <li class="nav-item">
                <a href="{{ route('users.index') }}"
                    class="nav-link {{ setActive('users.index') }}">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Akun</p>
                </a>
            </li>
        @endif

        <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-power-off text-danger"></i>
                <p class="text">Logout</p>
            </a>
        </li>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </ul>
</nav>
<!-- /.sidebar-menu -->
