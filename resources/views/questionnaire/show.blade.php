@extends('templates.default')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            @if($errors->any())
                <div class="alert alert-danger">
                    <h4>{{$errors->first()}}</h4>
                </div>
            @endif
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Questionnaire: {{ $questionnaire->title }}</h1>
                    </div>
                    <div class="card-body">
                         <h3 class="text-center">Purpose: {{ $questionnaire->purpose }}</h3><br>
                        <hr>
                        @if(auth()->user()->isAdmin === 1)
                            <a href="/questionnaires/{{ $questionnaire->id }}/questions/create" class="btn btn-primary">Add
                                Question</a><hr>
                        @endif
                    </div>
                </div>
                @if($questionnaire->questions->isEmpty())
                    <h3>No questions for this survey yet</h3>
                @endif
                @foreach($questionnaire->questions as $question)

                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">{{ $question->question }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Answer</th>
                                    <th scope="col" class="pull-right">Total votes</th>
                                </tr>
                                </thead>
                                @foreach($question->answers as $answer)
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div>
                                               <strong>{{ $answer->answer }}</strong>
                                            </div>
                                        </td>
                                        <td>
                                            @if($question->response->count())
                                                <div class="pull-right">
                                               <strong>{{ (int) ($answer->response->count() * 100 / $question->response->count()) }} %</strong>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            @if(auth()->user()->isAdmin === 1)
                                <form action="/questionnaires/{{ $questionnaire->id }}/questions/{{ $question->id }}"
                                      method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete question</button>
                                    <hr>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
                @if(!$questionnaire->questions->isEmpty())
                    <a href="/surveys/{{ $questionnaire->id }}-{{ Str::slug($questionnaire->title) }}"
                       class="btn btn-primary center-block">Take Survey</a>
                @endif

            </div>
        </div>
@endsection
