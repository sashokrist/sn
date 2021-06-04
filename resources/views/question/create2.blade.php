@extends('templates.default')

@section('content')
    <body>
    <div class="container">
        <div class="table-responsive">
            <form method="post" id="dynamic_form">
                <span id="result"></span>
                <div class="form-group">
                    Question: <input type="text" name="question[question]" class="form-control" placeholder="question">
                    @error('question.question')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <span id="result"></span>
                <div class="form-group">
                    Answer: <input type="text" name="answers[][answer]" placeholder="choice 1">

                    <label for="fileElem" class="forupload">
                        <strong><i class="far fa-image"></i></strong>
                    </label>
                    @error('answers.0.answer')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <table class="table table-bordered table-striped" id="user_table">

                    <tbody>

                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="2" align="right">&nbsp;</td>
                        <td>
                            @csrf
                            <input type="submit" name="save" id="save" class="btn btn-primary" value="Save" />
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
    </body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){

            var count = 1;

            dynamic_field(count);

            function dynamic_field(number)
            {
                html = '<tr>';
                // html += '<td><input type="text" name="first_name[]" class="form-control" /></td>';
               // html += '<td><input type="text" name="question[question]" class="form-control" placeholder="question"></td>';
                html += '<td>Answer: <input type="text" name="answers[][answer]" placeholder="answer"></td>';
               // html += '<td>Answer: <input type="text" name="answers[][answer]" placeholder="answer"></td>';
               // html += '<td><input type="text" name="last_name[]" class="form-control" /></td>';
                if(number > 1)
                {
                    html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
                    $('tbody').append(html);
                }
                else
                {
                    html += '<td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
                    $('tbody').html(html);
                }
            }

            $(document).on('click', '#add', function(){
                count++;
                dynamic_field(count);
            });

            $(document).on('click', '.remove', function(){
                count--;
                $(this).closest("tr").remove();
            });

            $('#dynamic_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url:'/questionnaires/{{ $questionnaire->id }}/questions',
                    method:'post',
                    data:$(this).serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#save').attr('disabled','disabled');
                    },
                    success:function(data)
                    {
                        if(data.error)
                        {
                            var error_html = '';
                            for(var count = 0; count < data.error.length; count++)
                            {
                                error_html += '<p>'+data.error[count]+'</p>';
                            }
                            $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
                        }
                        else
                        {
                            location.href = '/questionnaires/{{ $questionnaire->id }}';
                           dynamic_field(1);
                            $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
                        }
                        $('#save').attr('disabled', false);
                    }
                })
            });

        });
    </script>


@endsection
