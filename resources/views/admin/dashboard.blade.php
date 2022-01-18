@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Hello <br> <strong>{{ auth()->user()->name }}</strong>, <br>Welcome  in Dashboard</h1>
    <div class="row">
        <div class="col-lg-4">
            <div class="badge badge-info justify-content-center align-item-center">
                <a href="{{ route("urls.index") }}">
                    Total Urls : 10 <br>
                    
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
