@extends('templates.default')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Event</h1>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                        @if(auth()->user()->isAdmin === 1)
                            <a href="{{ route('event/create') }}" class="btn btn-primary center-block">New
                                Event</a>
                        @endif
                    </div>
                   @if($event !== null)
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <h2 class="text-center">Sign up for - {{ $event->title }}</h2>
                            <form action="{{ route('event/vote/store') }}" method="post">
                                @csrf
                                <input type="hidden" name="event_id" value="{{ $event->id }}">
                                <button type="submit" class="btn btn-primary center-block">Sign up</button>
                            </form>
                        </div>
                    </div>
                    @else
                        <h2>No event yet</h2>
                    @endif
                       <div class="col-md-12">
                              <table class="table">
                                  <thead>
                                  <tr>
                                      <th scope="col">Name</th>
                                      <th scope="col" class="pull-right">Action</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($votes as $item)
                                  <tr>

                                          <td>{{ $item->name }}</td>
                                      <td>
                                          @if (auth()->user()->username ===  $item->name)
                                              <form action="{{ route('event/vote/delete') }}" method="post">
                                                  @csrf
                                                  <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                                                  <button type="submit" class="btn btn-danger pull-right">Delete
                                                  </button>
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
@endsection
