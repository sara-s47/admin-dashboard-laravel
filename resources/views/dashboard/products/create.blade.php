@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>Products</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="{{ route('dashboard.products.index') }}">Products</a></li>
                <li class="active">Add</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">Add</h3>
                </div><!-- end of box header -->
                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">

                        @csrf
                        @method('post')

                        <div class="form-group">
                            <label>Categories</label>
                            <select name="category_id" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        

                        
                            <div class="form-group">
                                <label>name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name')}}">
                            </div>

                            <div class="form-group">
                                <label>description</label>
                                <textarea name="description" class="form-control ">{{ old('description') }}</textarea>
                            </div>

                        

                        <div class="form-group">
                            <label>image</label>
                            <input type="file" name="image" class="form-control image">
                        </div>

                        <div class="form-group">
                            <img src="{{ asset('uploads/product_images/default.png') }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                        </div>

                        <div class="form-group">
                            <label>purchase price</label>
                            <input type="number" name="purchase_price" step="0.01" class="form-control" value="{{ old('purchase_price') }}">
                        </div>

                        <div class="form-group">
                            <label>sale price</label>
                            <input type="number" name="sale_price" step="0.01" class="form-control" value="{{ old('sale_price') }}">
                        </div>

                        <div class="form-group">
                            <label>stock</label>
                            <input type="number" name="stock" class="form-control" value="{{ old('stock') }}">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
