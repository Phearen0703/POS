<div class="app-wrapper">
    <!--begin::Header-->
    <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Start Navbar Links-->
            <ul class="navbar-nav">
                <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i
                            class="bi bi-list"></i> </a> </li>
            </ul>
            <!--end::Start Navbar Links-->
            <!--begin::End Navbar Links-->
            <ul class="navbar-nav ms-auto">
                <!--begin::Navbar Search-->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if (session()->has('language'))
                            {{session()->get('language') == 'en' ? 'English' : 'Khmer'}}
                            @else
                                English
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{route('change_language','km')}}">Khmer</a></li>
                        <li><a class="dropdown-item" href="{{route('change_language','en')}}">English</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle"
                        data-bs-toggle="dropdown"> <img src="{{asset("adminlte/dist/assets/img/user2-160x160.jpg")}}"
                            class="user-image rounded-circle shadow" alt="User Image"> <span
                            class="d-none d-md-inline">{{userAuth()->name}}</span> </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                        <!--begin::User Image-->
                        <li class="user-header text-bg-primary"> <img
                                src="{{asset(path: 'adminlte/dist/assets/img/user2-160x160.jpg')}}"
                                class="rounded-circle shadow" alt="User Image">
                            <p>
                                Alexander Pierce - Web Developer
                                <small>Member since Nov. 2023</small>
                            </p>
                        </li>
                        <!--end::User Image-->
                        <!--begin::Menu Body-->
                        <li class="user-body">
                            <!--begin::Row-->
                            <div class="row">
                                <div class="col-4 text-center"> <a href="#">Followers</a> </div>
                                <div class="col-4 text-center"> <a href="#">Sales</a> </div>
                                <div class="col-4 text-center"> <a href="#">Friends</a> </div>
                            </div>
                            <!--end::Row-->
                        </li>
                        <!--end::Menu Body-->
                        <!--begin::Menu Footer-->
                        <li class="user-footer">
                             <a href="#" class="btn btn-default btn-flat">Profile</a>

                             <a class="btn btn-default btn-flat float-end" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                 <!-- <a href="#"
                                class="btn btn-default btn-flat float-end">Sign out</a> -->
                         </li>
                        <!--end::Menu Footer-->

                    </ul>
                </li>

                <!--end::User Menu Dropdown-->
            </ul>
            <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
    </nav>
    <!--end::Header-->
    <!--begin::Sidebar-->