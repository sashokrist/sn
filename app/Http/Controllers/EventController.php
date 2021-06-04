<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Vote;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $event = Event::all()->last();
     // dd($event->id);
        $votes = Vote::where('event_id', $event->id)->get();
      //dd($votes);
        return view('event.index', compact('event', 'votes'));
    }

    public function create()
    {
        return view('event.create');
    }

    public function store(Request $request)
    {
        $event = new Event();
        $event->title = $request->title;
        $event->save();

        return redirect()->route('event/index')->with('message','New event was created successfully!');
    }

    public function show()
    {

    }
}
