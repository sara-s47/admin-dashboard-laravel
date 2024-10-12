@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>Products</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> Dashbaord</a></li>
                <li class="active">Products</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">Products <small>{{ $products->total() }}</small></h3>

                    <form action="{{ route('dashboard.products.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="search" value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <select name="category_id" class="form-control">
                                    <option value="">All Categories</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                                @if (auth()->user()->hasPermission('products_create') && $categories_count > 0)
                                    <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>
                                @else
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> Add</a>
                                @endif
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($products->count() > 0)

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Purchase price</th>
                                <th>Sale Price</th>
                                <th>Profit Percent %</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                            @foreach ($products as $index=>$product)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{!! $product->description !!}</td>
                                    <td>{{ ($product->category)->name }}</td>
                                    <td><img src="{{asset( $product->image )}}" style="width: 100px"  class="img-thumbnail" alt=""></td>
                                    <td>{{ $product->purchase_price }}</td>
                                    <td>{{ $product->sale_price }}</td>
                                    <td>{{ $product->profit_percent }} %</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>
                                        @if (auth()->user()->hasPermission('products_update'))
                                            <a href="{{ route('dashboard.products.edit', $product->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>Edit</a>
                                        @endif
                                        @if (auth()->user()->hasPermission('products_delete'))
                                            <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post" style="display: inline-block">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i>Delete</button>
                                            </form><!-- end of form -->
                                        @else
                                            <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i>Delete</button>
                                        @endif
                                    </td>
                                </tr>
                            
                            @endforeach
                            </tbody>

                        </table><!-- end of table -->
                        
                        {{ $products->appends(request()->query())->links() }}
                        
                    @else
                        
                        <h2>No Data Found</h2>
                        
                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
