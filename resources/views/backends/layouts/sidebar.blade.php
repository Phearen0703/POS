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
                        <p>{{__('Home Page')}}</p>
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
                        {{__('Prodcut Management')}}
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                    <li class="nav-item"> <a href="{{route('admin.product.category')}}" class="nav-link {{request()->route()->getName()=='admin.product.category' ? 'active' : ''}}"> <i class="nav-icon bi bi-house "></i>
                        <p>{{__('Product Category')}}</p>
                    </a> </li>
                    <li class="nav-item"> <a href="{{route('admin.product')}}" class="nav-link {{request()->route()->getName()=='admin.product' ? 'active' : ''}}"> <i class="nav-icon bi bi-house "></i>
                        <p>{{__('Product Page')}}</p>
                    </a> </li>
                    </ul>
                </li>



                @php
                        $settingManagement = [
                            'admin.role',
                            'admin.role.create',
                            'admin.user',
                            'admin.user.create'

                            ]
                    @endphp

                <li class="nav-item {{in_array(request()->route()->getName(),$settingManagement) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{in_array(request()->route()->getName(),$settingManagement) ? 'active' : ''}}"> <i class="bi bi-gear"></i></i>
                        <p>
                        {{__('Setting')}}
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                    <li class="nav-item"> <a href="{{route('admin.role')}}" class="nav-link {{
                            request()->route()->getName()=='admin.role' ||
                            request()->route()->getName()=='admin.role.create'  ? 'active' : ''
                            }}"> <i class="bi bi-arrow-right-square-fill"></i></i>
                        <p>{{__('Role')}}</p>
                    </a> </li>
                    </ul>
                    <ul class="nav nav-treeview">

                    <li class="nav-item"> <a href="{{route('admin.user')}}" class="nav-link {{
                            request()->route()->getName()=='admin.user' ||
                            request()->route()->getName()=='admin.user.create'  ? 'active' : ''
                            }}"> <i class="bi bi-arrow-right-square-fill"></i></i>
                        <p>{{__('User')}}</p>
                    </a> </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>