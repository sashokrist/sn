@extends('templates.default')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Create new Poll</h1>
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
                        <form action="{{ route('poll/store') }}" method="post" enctype="multipart/form-data" >
                            @csrf
                            <div class="form-group">
                                Question: <input type="text" name="question" class="form-control" placeholder="question">
                                @error('question.question')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <fieldset>
                                    <legend>Choices</legend>
                                    <div class="form-group">
                                        Choice 1: <input type="text" name="answers[]" placeholder="choice 1">
                                    </div>
                                    <div class="form-group">
                                        Choice 2: <input type="text" name="answers[]" placeholder="choice 2">
                                    </div>
                                </fieldset>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Poll</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>


@endsection
