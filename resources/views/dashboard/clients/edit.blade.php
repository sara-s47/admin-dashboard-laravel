@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>Clientts</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> Dashoard</a></li>
                <li><a href="{{ route('dashboard.clients.index') }}"> Clients</a></li>
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

                    <form action="{{ route('dashboard.clients.update', $client->id) }}" method="post">

                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $client->name }}">
                        </div>

                        @for ($i = 0; $i < 2; $i++)
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone[]" class="form-control" value="{{ $client->phone[$i] ?? '' }}">
                            </div>
                        @endfor

                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="email" class="form-control">{{ $client->email }}</textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
