@extends('templates.default')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Questionnaires</h1>
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
                        <hr>
                        @if(auth()->user()->isAdmin === 1)
                            <a href="{{ route('questionnaires/create') }}" class="btn btn-primary center-block">New
                                Questionnaire</a>
                        @endif
                        <hr>
                        <div class="col-md-12">
                            <ul class="list-group">
                                @foreach($questionnaires as $questionnaire)
                                    <li class="list-group-item">
                                        <a href="{{ $questionnaire->path() }}"><h2>{{ $questionnaire->title }}</h2></a>
                                        <a href="{{ $questionnaire->path() }}"><h4>{{ $questionnaire->purpose }}</h4>
                                        </a>
                                        <div class="mt-2">
                                            <small>Share URL</small>
                                            <p>
                                                <a href="{{ $questionnaire->publicPath() }}">{{ $questionnaire->publicPath() }} </a>
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
