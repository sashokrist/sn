@extends('templates.default')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="card-header">
                        <h1 class="text-center">Poll Results</h1>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">User</th>
                                <th scope="col">Answer</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($results as $result)
                                <tr>
                                    <td>{{ $result->user->username }}</td>
                                    <td>{{ $result->answer }}</td>
                                    <td>
                                        @if (auth()->user()->username ===  $result->user->username)
                                            <form action="" method="post">
                                                @csrf
                                                <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                                                <button type="submit" class="btn btn-danger pull-right">Delete</button>
                                            </form>
                                        @else
                                            <button type="submit" class="btn btn-danger pull-right" disabled>Delete
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
