<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\Status;

class HomeController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            $statuses = Status::notReply()->where(function($query) {
                return $query->where('user_id', Auth::user()->id)
                    ->orWhereIn('user_id', Auth::user()->friends()->pluck('id'));
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

            $posts = Post::all();

            return view('timeline.index', compact('statuses', 'posts'));
        }

        return view('home');
    }
}
