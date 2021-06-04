@extends('templates.default')

@section('content')
<div class="col-md-12 text-center" >
    <a href="{{ route('auth.signin') }}" class="btn btn-primary">Sign in</a>
    <a href="{{ route('auth.signup') }}" class="btn btn-primary">Sign up</a>
</div>

@stop
