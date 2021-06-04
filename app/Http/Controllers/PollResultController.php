<?php

namespace App\Http\Controllers;

use App\Models\PollResult;
use Illuminate\Http\Request;

class PollResultController extends Controller
{
    public function store(Request $request)
    {
        //dd($request->all());
        foreach ($request->answer as $ans) {
            $pollResult = new PollResult();
            $pollResult->user_id = auth()->user()->id;
            $pollResult->poll_id = $request->poll_id;

            $pollResult->answer = $ans;
            $pollResult->save();
        }
        $results = PollResult::with('user')->get();
        // dd($results);
        // return redirect()->route('poll', compact('results'))->with('message','You have voted successfully!');
        return view('poll.result', compact('results'))->with('message', 'You have voted successfully!');
    }
}
