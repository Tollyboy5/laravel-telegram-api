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

                    <div class="d-flex justify-content-around flex-wrap">
                        <div class="card col-sm-4">
                            <a href="person"><img src="{{ asset('avatar/avatar-1577909_640.png') }}" alt="Avatar" style="width:100%"></a>
                            {{-- <img src="{{ asset('avatar/avatar-1577909_640.png') }}" class="rounded-circle" height="45" alt="Black and White Portrait of a Man" loading="lazy"/> --}}
                            <div class="container">
                              <h4><b>John Doe</b></h4> 
                              <p>Architect & Engineer</p> 
                            </div>
                        </div>
                        <div class="card col-sm-4">
                            <a href="person"><img src="{{ asset('avatar/avatar-1577909_640.png') }}" alt="Avatar" style="width:100%"></a>
                            <div class="container">
                              <h4><b>John Doe</b></h4> 
                              <p>Architect & Engineer</p> 
                            </div>
                        </div>
                        <div class="card col-sm-4">
                            <a href="person"><img src="{{ asset('avatar/avatar-1577909_640.png') }}" alt="Avatar" style="width:100%"></a>
                            <div class="container">
                              <h4><b>John Doe</b></h4> 
                              <p>Architect & Engineer</p> 
                            </div>
                        </div>
                        <div class="card col-sm-4">
                            <a href="person"><img src="{{ asset('avatar/avatar-1577909_640.png') }}" alt="Avatar" style="width:100%"></a>
                            <div class="container">
                              <h4><b>John Doe</b></h4> 
                              <p>Architect & Engineer</p> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
