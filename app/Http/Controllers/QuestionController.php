<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\SurveyResponse;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Questionnaire $questionnaire)
    {
        //dd($questionnaire);
        return view('question.create2', compact('questionnaire'));
    }

    public function store(Request $request, Questionnaire $questionnaire)
    {
    //dd($request->all());
       /* $files = [];
        if($request->hasfile('filenames'))
        {
            foreach($request->file('filenames') as $file)
            {
                $name = time().'.'.$file->extension();
                //  dd($name);
                $file->move(public_path('files'), $name);
                $files[] = $name;
            }
        }
        $filename = json_encode($files);*/
       // dd($filename);
        $validated = $request->validate(
            [
                'question.question' => 'required',
                'answers.*.answer' => 'required'
            ]
        );
        $question = $questionnaire->questions()->create($validated['question']);
     //dd($question->answers());
        $question->answers()->createMany($validated['answers']);
       // $question->answers()->createMany($files);
       /* $question->answers()->createMany([
          [ 'filename' => $filename]
         ]);*/

     /*   $rrr = $question->answers()->get();
        foreach ($rrr as $img){
            foreach ($files as $pic){
                $img->filename = $pic;
            }
        }
      $img->save();*/
        return response()->json([
                                    'success'  => 'Data Added successfully.'
                                ]);
       // return redirect('/questionnaires/' . $questionnaire->id);
        // return view('questionnaire.show', compact('questionnaire'));
    }

    public function destroy(Questionnaire $questionnaire, Question $question)
    {
            $question->answers()->delete();
            $question->delete();

            return redirect($questionnaire->path());
    }
}
