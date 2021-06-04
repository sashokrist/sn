<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
      // dd($request->all());
        $eventid = $request->event_id;
        $userVote = Vote::where('event_id', $eventid)->where('user_id', auth()->user()->id)->first();
        if ($userVote === null){
            $vote = new Vote();
            $vote->user_id = auth()->user()->id;
            $vote->name = auth()->user()->username;
            $vote->event_id = $request->event_id;
            $vote->save();
            return redirect()->back()->with('message','You sign up successfully!');
        } else {
            return redirect()->back()->withErrors(['You already sign up']);
        }
    }

    public function destroy(Request $request)
    {
        $deleteVote = Vote::where('user_id', $request->user_id)->first();
        $deleteVote->delete();
        return redirect()->back()->with('success','You deleted your vote successfully!');
    }
}
