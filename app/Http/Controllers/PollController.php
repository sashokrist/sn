<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\PollAnswer;
use App\Models\PollResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function index()
    {
        $poll = Poll::with('answer')->latest()->first();
       // dd($poll);
        return view('poll.index' , compact('poll'));
    }

    public function create()
    {
        return view('poll.create');
    }

    public function store(Request $request)
    {
       dd($request->all());
        $poll = new Poll();
        $poll->title = $request->question;
        $poll->save();

        $pollAnswer = Poll::latest()->first();
       // dd($pollAnswer->id);
        foreach($request->answers as $res){
            $result = new PollAnswer();
            $result->poll_id = $pollAnswer->id;
            $result->answer = $res;
            $result->save();
        }
        return redirect()->route('poll')->with('message', 'New poll was created successfully!');
    }
}
