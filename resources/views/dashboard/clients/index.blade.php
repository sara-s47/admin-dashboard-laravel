@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>Clients</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li class="active">Clients</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">Clients <small>{{ $clients->total() }}</small></h3>

                    <form action="{{ route('dashboard.clients.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                                @if (auth()->user()->hasPermission('cilents_create'))
                                    <a href="{{ route('dashboard.clients.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>Add</a>
                                @else
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>Add</a>
                                @endif
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($clients->count() > 0)

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Add Order</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            
                            <tbody>

                            @foreach ($clients as $index=>$client)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ is_array($client->phone) ? implode($client->phone, '-') : $client->phone }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>
                                        @if (auth()->user()->hasPermission('orders_create'))
                                            <a href="{{ route('dashboard.orders.create', $client->id) }}" class="btn btn-primary btn-sm">Add Order</a>
                                        @else
                                            <a href="#" class="btn btn-primary btn-sm disabled">Add Order</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if (auth()->user()->hasPermission('cilents_update'))
                                            <a href="{{ route('dashboard.clients.edit', $client->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> Edit</a>
                                        @endif
                                        @if (auth()->user()->hasPermission('cilents_delete'))
                                            <form action="{{ route('dashboard.clients.destroy', $client->id) }}" method="post" style="display: inline-block">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> Delete</button>
                                            </form><!-- end of form -->
                                        @else
                                            <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> Delete</button>
                                        @endif
                                    </td>
                                </tr>
                            
                            @endforeach
                            </tbody>

                        </table><!-- end of table -->
                        
                        {{ $clients->appends(request()->query())->links() }}
                        
                    @else
                        
                        <h2>No data found</h2>
                        
                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
