<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion shadow" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="{{ asset('assets/backend/img/logo-top.png') }}" alt="" class="logo">
        </div>
        <div class="sidebar-brand-text mx-3"> {{ $appName }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    
    <li class="nav-item">
        <a class="nav-link collapsed panel-heading-two" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-users"></i>
            <span>Category</span>
        </a>
        <div id="collapseTwo"
            class="collapse
        {{ Request::is('admin/category') || Request::is('admin/category/*') ? 'collapse show' : '' }}
        "
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded ">
                <a class="collapse-item text-dark @if (request()->path() == 'admin/category') bg-info @endif"
                    href="{{ route('category.create') }}">Add Category</a>
                <a class="collapse-item text-dark @if (request()->path() == 'admin/category') bg-info @endif"
                    href="{{ route('category.index') }}">Manage Category</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link collapsed panel-heading-two" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-users"></i>
            <span>Product</span>
        </a>
        <div id="collapseTwo"
            class="collapse
        {{ Request::is('admin/category') || Request::is('admin/category/*') ? 'collapse show' : '' }}
        "
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded ">
                <a class="collapse-item text-dark @if (request()->path() == 'admin/product') bg-info @endif"
                    href="{{ route('product.create') }}">Add Product</a>
                <a class="collapse-item text-dark @if (request()->path() == 'admin/product') bg-info @endif"
                    href="{{ route('product.index') }}">Manage Product</a>
            </div>
        </div>
    </li>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
