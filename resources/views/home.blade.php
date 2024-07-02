@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                @can('owner-permission',Auth::user())
                <a href ="{{ url('hotel') }}" class ="btn btn-info">Welcome</a>
                @endcan
                @can('staff-permission',Auth::user())
                <a href ="{{ url('hotel') }}" class ="btn btn-info">Welcome</a>
                @endcan
                @can('pembeli-permission',Auth::user())
                <a href ="{{ url('laralux') }}" class ="btn btn-info">Welcome</a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
