@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>Orders
                <small>{{ $orders->total() }} Orders</small>
                {{$orders}}
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Orders</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">

                <div class="col-md-8">

                    <div class="box box-primary">

                        <div class="box-header">

                            <h3 class="box-title" style="margin-bottom: 10px">Orders</h3>

                            <form action="{{ route('dashboard.orders.index') }}" method="get">

                                <div class="row">

                                    <div class="col-md-8">
                                        <input type="text" name="search" class="form-control" placeholder="Search"
                                            value="{{ request()->search }}">
                                    </div>

                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                            Search</button>
                                    </div>

                                </div><!-- end of row -->

                            </form><!-- end of form -->

                        </div><!-- end of box header -->

                        @if ($orders->count() > 0)
                            <div class="box-body table-responsive">

                                <table class="table table-hover">
                                    <tr>
                                        <th>Client Name</th>
                                        <th>Price</th>
                                        {{--                                        <th>@lang('site.status')</th> --}}
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>

                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->client->name }}</td>
                                            <td>{{$order->total_price}}</td>
                                            {{-- <td> --}}
                                            {{-- <button --}}
                                            {{-- data-status="@lang('site.' . $order->status)" --}}
                                            {{-- data-url="{{ route('dashboard.orders.update_status', $order->id) }}" --}}
                                            {{-- data-method="put" --}}
                                            {{-- data-available-status='["@lang('site.processing')", "@lang('site.finished') "]' --}}
                                            {{-- class="order-status-btn btn {{ $order->status == 'processing' ? 'btn-warning' : 'btn-success disabled' }} btn-sm" --}}
                                            {{-- > --}}
                                            {{-- @lang('site.' . $order->status) --}}
                                            {{-- </button> --}}
                                            {{-- </td> --}}
                                            <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                            <td>
                                                @if(auth()->user()->hasPermission('orders_read'))
                                                <button class="btn btn-primary btn-sm order-products"
                                                    data-url="{{ route('dashboard.mainorders.products', $order->id) }}"
                                                    data-method="GET">
                                                    <i class="fa fa-list"></i>
                                                    Show
                                                </button>
                                                @else
                                                <button class="btn btn-primary btn-sm order-products" disabled>
                                                    <i class="fa fa-list"></i>
                                                    Show
                                                </button>
                                                @endif

                                                @if (auth()->user()->hasPermission('orders_update'))
                                                
                                                    <a href="{{ route('dashboard.orders.edit', ['client' => $order->client->id, 'order' => $order->id]) }}"
                                                        class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                                                @else
                                                    <a href="#" disabled class="btn btn-warning btn-sm"><i
                                                            class="fa fa-edit"></i> Edit</a>
                                                @endif

                                                @if (auth()->user()->hasPermission('orders_delete'))
                                                    <form action="{{ route('dashboard.mainorders.destroy', $order->id) }}"
                                                        method="post" style="display: inline-block;">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger btn-sm delete"><i
                                                                class="fa fa-trash"></i> Delete</button>
                                                    </form>
                                                @else
                                                    <a href="#" class="btn btn-danger btn-sm" disabled><i
                                                            class="fa fa-trash"></i> Delete</a>
                                                @endif

                                            </td>

                                        </tr>
                                    @endforeach

                                </table><!-- end of table -->

                                {{ $orders->appends(request()->query())->links() }}

                            </div>
                        @else
                            <div class="box-body">
                                <h3>No Records</h3>
                            </div>
                        @endif

                    </div><!-- end of box -->

                </div><!-- end of col -->

                <div class="col-md-4">

                    <div class="box box-primary">

                        <div class="box-header">
                            <h3 class="box-title" style="margin-bottom: 10px">Show Products</h3>
                        </div><!-- end of box header -->

                        <div class="box-body">

                            <div style="display: none; flex-direction: column; align-items: center;" id="loading">
                                <div class="loader"></div>
                                <p style="margin-top: 10px">Loading</p>
                            </div>

                            <div id="order-product-list">

                            </div><!-- end of order product list -->

                        </div><!-- end of box body -->

                    </div><!-- end of box -->

                </div><!-- end of col -->

            </div><!-- end of row -->

        </section><!-- end of content section -->

    </div><!-- end of content wrapper -->

@endsection
