@extends('templates.default')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">{{ $questionnaire->title }}</h1>
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
                            @if($questionnaire->questions->isEmpty())
                                <h3>No questions for this survey yet</h3>
                            @endif
                        <form action="/surveys/{{ $questionnaire->id }}-{{ Str::slug($questionnaire->title) }}"
                              method="post">
                            @csrf
                            @foreach($questionnaire->questions as $key => $question)
                                <div class="card">
                                    <div class="card-header">
                                        <h1 class="text-center"><strong>{{ $key + 1 }} - </strong>{{ $question->question }}</h1>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group">
                                            @foreach($question->answers as $answer)
                                                <li class="list-group-item">
                                                    <label for="answer{{ $answer->id }}">
                                                        <input type="radio" name="responses[{{ $key }}][answer_id]"
                                                               id="answer{{ $answer->id }}"
                                                               {{ (old('responses.'.$key.'.answer_id') === $answer->id) ? 'checked' : '' }}
                                                               value="{{ $answer->id }}" class="ml-2">
                                                        {{ $answer->answer }}
                                                    </label>
                                                    <input type="hidden" name="responses[{{ $key }}][question_id]"
                                                           value="{{ $question->id }}">
                                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                            @if(!$questionnaire->questions->isEmpty())
                                <div class="card">
                                    <div class="card-header">
                                        <h1 class="text-center">Your Information</h1>
                                    </div>
                                    <input type="hidden" name="survey[email]" class="form-control" id="email"
                                           value="{{ Auth::user()->email }}">
                                    <input type="hidden" name="survey[name]" class="form-control" id="name"
                                           value="{{ Auth::user()->username }}">
                                </div>
                            <button type="submit" class="btn btn-primary">Complete Survey</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
