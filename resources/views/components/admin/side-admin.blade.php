<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-light-primary">
    <!-- Brand Logo -->
    <a href="{{ route('admin.index') }}" class="brand-link">
        <img src="{{ asset('static/img/logo.png') }}" alt="." class="brand-image image-cirlce" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                {{-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
            </div>
            <div class="info">
                @auth
                    <a href="#" class="d-block">
                        @auth
                            Admin: <Strong>{{ auth()->user()->name }}</Strong>
                        @endauth
                    </a>
                @endauth
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview {{ Request::routeIs('admin.index') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::routeIs('admin.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt "></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.index') }}" class="nav-link">
                                <i
                                    class="far fa-circle nav-icon {{ Request::routeIs('admin.index') ? 'text-danger' : '' }}"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{ Request::routeIs('admin.users.index') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::routeIs('admin.users.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Users
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">
                                {{ Request::routeIs('admin.users.index') ? $users->count() : '0' }}</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ Request::routeIs('admin.users.index') ? '' : route('admin.users.index') }}"
                                class="nav-link">
                                <i
                                    class="far fa-circle nav-icon {{ Request::routeIs('admin.users.index') ? 'text-danger' : '' }} "></i>
                                <p>All Users</p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item has-treeview {{ Request::routeIs('admin.bookings.index', 0) ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Request::routeIs('admin.bookings.index', 0) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Bookings
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">
                                {{-- {{ Request::routeIs('admin.bookings.index',0) ?  $bookings->count() : '0' }}</span> --}}
                        </p>
                    </a>
                    <ul class="nav nav-treeview">


                        <li class="nav-item">
                            <a href="{{ route('admin.bookings.index', 0) }}" class="nav-link">
                                <i
                                    class="far fa-circle nav-icon {{ Request::routeIs('admin.bookings.index', 0) ? 'text-danger' : '' }} "></i>
                                <p>New Bookings </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.bookings.index', 1) }}" class="nav-link">
                                <i
                                    class="far fa-circle nav-icon {{ Request::routeIs('admin.bookings.index', 1) ? 'text-danger' : '' }} "></i>
                                <p>Finished Bookings </p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item has-treeview {{ Request::routeIs('admin.updates.index') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::routeIs('admin.updates.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Updates
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">
                                {{ Request::routeIs('admin.updates.index') ? $users->count() : '' }}</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ Request::routeIs('admin.updates.index') ? '' : route('admin.updates.index') }}"
                                class="nav-link">
                                <i
                                    class="far fa-circle nav-icon {{ Request::routeIs('admin.updates.index') ? 'text-danger' : '' }} "></i>
                                <p>All</p>
                            </a>
                        </li>

                    </ul>
                </li>
                {{--


          <li class="nav-item has-treeview {{ Request::routeIs('admin.subscribers.index') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::routeIs('admin.subscribers.index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
               Subsribers
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">
                  {{ Request::routeIs('admin.subscribers.index') ?  $users->count() : '0' }}</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{Request::routeIs('admin.subscribers.index') ?  '' : route("admin.subscribers.index")}}" class="nav-link">
                  <i class="far fa-circle nav-icon {{ Request::routeIs('admin.subscribers.index') ? 'text-danger' : '' }} "></i>
                  <p>All</p>
                </a>
              </li>
             
            </ul>
          </li> --}}

                {{-- <li class="nav-item has-treeview {{ Request::routeIs('admin.subscribers.index') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::routeIs('admin.subscribers.index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
               Contacts
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">
                  {{ Request::routeIs('admin.subscribers.index') ?  $users->count() : '0' }}</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{Request::routeIs('admin.subscribers.index') ?  '' : route("admin.subscribers.index")}}" class="nav-link">
                  <i class="far fa-circle nav-icon {{ Request::routeIs('admin.subscribers.index') ? 'text-danger' : '' }} "></i>
                  <p>All</p>
                </a>
              </li>
             
            </ul>
          </li> --}}




            </ul>
        </nav>
    </div>
</aside>
