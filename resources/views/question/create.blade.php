@extends('templates.default')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Create new question</h1>
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
                        <form action="/questionnaires/{{ $questionnaire->id }}/questions" method="post" enctype="multipart/form-data" >
                            @csrf
                            <div class="form-group">
                                Question: <input type="text" name="question[question]" class="form-control" placeholder="question">
                                @error('question.question')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <fieldset>
                                    <legend>Choices</legend>
                                    <div class="form-group">
                                        Choice 1: <input type="text" name="answers[][answer]" placeholder="choice 1">

                                        <label for="fileElem" class="forupload">
                                            <strong><i class="far fa-image"></i></strong>
                                        </label>
                                        @error('answers.0.answer')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        Choice 2: <input type="text" name="answers[][answer]" placeholder="choice 2">

                                        <label for="fileElem" class="forupload">
                                            <strong><i class="far fa-image"></i></strong>
                                        </label>
                                        @error('answers.1.answer')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </fieldset>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Question</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>


@endsection
