<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">

    <div class="sidebar-brand">
        <a href="./index.html" class="brand-link">
            <img src="{{asset('adminlte/dist/assets/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">AdminLTE 4</span>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                <li class="nav-item"> <a href="{{route('admin.home')}}" class="nav-link {{request()->route()->getName()=='admin.home' ? 'active' : ''}}"> <i class="nav-icon bi bi-house "></i>
                        <p>Home page</p>
                    </a> </li>

                    @php
                        $productmanagements = [
                            'admin.product.category',
                            'admin.product'
                            ]
                    @endphp

                <li class="nav-item {{in_array(request()->route()->getName(),$productmanagements) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{in_array(request()->route()->getName(),$productmanagements) ? 'active' : ''}}"> <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                           Prodcut Management
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                    <li class="nav-item"> <a href="{{route('admin.product.category')}}" class="nav-link {{request()->route()->getName()=='admin.product.category' ? 'active' : ''}}"> <i class="nav-icon bi bi-house "></i>
                        <p>Product Category</p>
                    </a> </li>
                    <li class="nav-item"> <a href="{{route('admin.product')}}" class="nav-link {{request()->route()->getName()=='admin.product' ? 'active' : ''}}"> <i class="nav-icon bi bi-house "></i>
                        <p>Product Page</p>
                    </a> </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>