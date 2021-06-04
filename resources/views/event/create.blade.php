@extends('templates.default')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Create Event</h1>
                    </div>
                    <div class="card-body">
                        <div class="col-md-4 col-md-offset-3">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('event/store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    Title: <input type="text" name="title" class="form-control" placeholder="title">
                                </div>
                                <button type="submit" class="btn btn-primary center-block">Create Event</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
