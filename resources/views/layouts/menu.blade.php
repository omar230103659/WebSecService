<nav class="navbar navbar-expand-sm bg-light">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('products_list') }}">Products</a>
            </li>
            
            @auth
                @if(auth()->user()->hasRole('manager'))
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Product Management
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('products_edit') }}">Add Product</a></li>
                        <li><a class="dropdown-item" href="{{ route('products_list') }}">View Products</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Inventory
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('manager.inventory.index') }}">Manage Inventory</a></li>
                        <li><a class="dropdown-item" href="{{ route('manager.reports.sales') }}">View Reports</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Orders
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('manager.orders.index') }}">View Orders</a></li>
                        <li><a class="dropdown-item" href="{{ route('manager.orders.create') }}">Create Order</a></li>
                    </ul>
                </li>
                @endif

                @if(auth()->user()->hasRole('support'))
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Support
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('support.tickets.index') }}">View Tickets</a></li>
                        <li><a class="dropdown-item" href="{{ route('support.orders.index') }}">View Orders</a></li>
                        <li><a class="dropdown-item" href="{{ route('support.orders.create') }}">Create Order</a></li>
                    </ul>
                </li>
                @endif

                @if(auth()->user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('credits.admin') }}">All Credits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users') }}">Users</a>
                </li>
                @endif

                @if(auth()->user()->isCustomer())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('credits.index') }}">My Credit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('purchase_history') }}">My Purchases</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.favorites.list') }}">My Favorites</a>
                </li>
                @endif

                @if(auth()->user()->isEmployee() || auth()->user()->hasPermissionTo('view_customers') || auth()->user()->hasPermissionTo('manage_customers'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('employee.manage_customers') }}"><i class="fa fa-users"></i> Manage Customers</a>
                </li>
                @endif
            @endauth
        </ul>

        <ul class="navbar-nav">
            @auth
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile') }}">
                    {{ auth()->user()->name }}
                    @if(auth()->user()->isCustomer())
                        <span class="badge bg-success">${{ number_format(auth()->user()->getCreditAmount(), 2) }}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('do_logout') }}">Logout</a>
            </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
            @endauth
        </ul>
    </div>
</nav>
