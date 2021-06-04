<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use App\Models\User;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

        public function index()
        {
            $questionnaires = Questionnaire::all();
            return view('questionnaire.index', compact('questionnaires'));
        }

    public function create()
    {
        return view('questionnaire.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'title' => 'required|min:3',
                'purpose' => 'required',
            ]
        );

        $questionnaire = auth()->user()->questionnaries()->create($validated);
       // dd($questionnaire);

        return redirect('/questionnaires/' . $questionnaire->id);
        //return view('questionnaire.show', compact('questionnaire'));
    }

    public function show(Questionnaire $questionnaire)
    {
        $questionnaire->load('questions.answers.response');
  // dd($questionnaire);
        return view('questionnaire.show', compact('questionnaire'));
    }
}
