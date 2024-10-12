@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>Edit Orders</h1>
            

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{ route('dashboard.clients.index') }}">Clients</a></li>
                <li class="active">Edit Order</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">

                <div class="col-md-6">

                    <div class="box box-primary">

                        <div class="box-header">

                            <h3 class="box-title" style="margin-bottom: 10px">Categories</h3>

                        </div><!-- end of box header -->

                        <div class="box-body">

                            @foreach ($categories as $category)

                                <div class="panel-group">

                                    <div class="panel panel-info">

                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" href="#{{ str_replace(' ', '-', $category->name) }}">{{ $category->name }}</a>
                                            </h4>
                                        </div>

                                        <div id="{{ str_replace(' ', '-', $category->name) }}" class="panel-collapse collapse">

                                            <div class="panel-body">

                                                @if ($category->products->count() > 0)

                                                    <table class="table table-hover">
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Stock</th>
                                                            <th>Price</th>
                                                            <th>Add</th>
                                                        </tr>

                                                        @foreach ($category->products as $product)
                                                            <tr>
                                                                <td>{{ $product->name }}</td>
                                                                <td>{{ $product->stock }}</td>
                                                                <td>{{ $product->sale_price }}</td>
                                                                <td>
                                                                    <a href=""
                                                                       id="product-{{ $product->id }}"
                                                                       data-name="{{ $product->name }}"
                                                                       data-id="{{ $product->id }}"
                                                                       data-price="{{ $product->sale_price }}"
                                                                       class="btn {{ in_array($product->id, $order->products->pluck('id')->toArray()) ? 'btn-default disabled' : 'btn-success add-product-btn' }} btn-sm">
                                                                        <i class="fa fa-plus"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </table><!-- end of table -->

                                                @else
                                                    <h5>No Records</h5>
                                                @endif

                                            </div><!-- end of panel body -->

                                        </div><!-- end of panel collapse -->

                                    </div><!-- end of panel primary -->

                                </div><!-- end of panel group -->

                            @endforeach

                        </div><!-- end of box body -->

                    </div><!-- end of box -->

                </div><!-- end of col -->

                <div class="col-md-6">

                    <div class="box box-primary">

                        <div class="box-header">

                            <h3 class="box-title">Orders</h3>

                        </div><!-- end of box header -->

                        <div class="box-body">

                            @include('partials._errors')

                            <form action="{{ route('dashboard.orders.update', [ 'client' => $client->id, 'order' => $order->id]) }}" method="post">

                                @csrf
                                @method('put')

                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                    </thead>

                                    <tbody class="order-list">

                                    @foreach ($order->products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td><input type="number" name="products[{{ $product->id }}][quantity]" data-price="{{ number_format($product->sale_price, 2) }}" class="form-control input-sm product-quantity" min="1" value="{{ $product->pivot->quantity }}"></td>
                                            <td class="product-price">{{ number_format($product->sale_price * $product->pivot->quantity, 2) }}</td>
                                            <td>
                                                <button class="btn btn-danger btn-sm remove-product-btn" data-id="{{ $product->id }}"><span class="fa fa-trash"></span></button>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>

                                </table><!-- end of table -->

                                <h4>Total : <span class="total-price">{{ number_format($order->total_price, 2) }}</span></h4>

                                <button class="btn btn-primary btn-block" id="form-btn"><i class="fa fa-edit"></i> Order</button>

                            </form><!-- end of form -->

                        </div><!-- end of box body -->

                    </div><!-- end of box -->

                    @if ($client->orders->count() > 0)

                        {{-- <div class="box box-primary">

                            <div class="box-header">

                                <h3 class="box-title" style="margin-bottom: 10px">Previous Order
                                    {{-- <small>{{ $order->total() }}</small> --}}
                                </h3>

                            </div><!-- end of box header -->

                            {{-- <div class="box-body"> --}}

                                {{-- @foreach ($order as $item)

                                    <div class="panel-group">

                                        <div class="panel panel-success">

                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" href="#{{ $item->created_at->format('d-m-Y-s') }}">{{ $item->created_at->toFormattedDateString() }}</a>
                                                </h4>
                                            </div>

                                            <div id="{{ $item->created_at->format('d-m-Y-s') }}" class="panel-collapse collapse">

                                                <div class="panel-body">

                                                    <ul class="list-group">
                                                        @foreach ($item->products as $product)
                                                            <li class="list-group-item">{{ $product->name }}</li>
                                                        @endforeach
                                                    </ul>

                                                </div><!-- end of panel body -->

                                            </div><!-- end of panel collapse -->

                                        </div><!-- end of panel primary -->

                                    </div><!-- end of panel group -->

                                @endforeach --}}

                                {{-- {{ $orders->links() }} --}}

                            {{-- </div><!-- end of box body --> --}}

                        {{-- </div> --}} 

                    @endif

                </div><!-- end of col -->

            </div><!-- end of row -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
