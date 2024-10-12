@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>Products</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{ route('dashboard.products.index') }}"> Products</a></li>
                <li class="active">Edit</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">Edit</h3>
                </div><!-- end of box header -->
                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.products.update', $product->id) }}" method="post" enctype="multipart/form-data">

                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label>Categories</label>
                            <select name="category_id" class="form-control">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $product->name }}">
                            </div>

                            <div class="form-group">
                                <label>description</label>
                                <textarea name="description" class="form-control ">{{  $product->description}}</textarea>
                            </div>

                        

                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control image">
                        </div>

                        <div class="form-group">
                            <img src="{{ $product->image_path }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                        </div>

                        <div class="form-group">
                            <label>Purchase Price</label>
                            <input type="number" name="purchase_price" step="0.01" class="form-control" value="{{ $product->purchase_price }}">
                        </div>

                        <div class="form-group">
                            <label>Sale Price</label>
                            <input type="number" name="sale_price" step="0.01" class="form-control" value="{{ $product->sale_price }}">
                        </div>

                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number" name="stock" class="form-control" value="{{ $product->stock}}">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Edit</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
