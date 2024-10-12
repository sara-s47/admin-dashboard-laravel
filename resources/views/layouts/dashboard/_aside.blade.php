<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset(auth()->user()->image_path) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{auth()->user()->first_name }} {{auth()->user()->last_name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>


        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-th"></i><span>  Dashboard</span></a></li>

            @if (auth()->user()->isAbleTo('categories_read'))
                <li><a href="{{ route('dashboard.categories.index') }}"><i class="fa-solid fa-list"></i></i><span>   Categories</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('products_read'))
                <li><a href="{{ route('dashboard.products.index') }}"><i class="fa-brands fa-product-hunt"></i><span>    Products</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('cilents_read'))
                <li><a href="{{ route('dashboard.clients.index') }}"><i class="fa-solid fa-users"></i><span>   Clients</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('orders_read'))
                <li><a href="{{ route('dashboard.orders.index') }}"><i class="fa-solid fa-motorcycle"></i><span>    Orders</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('users_read'))
                <li><a href="{{ route('dashboard.users.index') }}"><i class="fa-solid fa-user-tie"></i><span>     Users</span></a></li>
            @endif
        </ul>
    </section>
</aside>