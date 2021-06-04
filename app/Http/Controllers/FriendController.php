<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();

        return view('friends.index')
            ->with('friends', $friends)
            ->with('requests', $requests);
    }

    public function getAdd($username)
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            return redirect()
                ->route('home')
                ->with('info', 'That user could not be found');
        }

        if (auth()->user()->id === $user->id) {
            return redirect()->route('home');
        }

        if (auth()->user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())) {
            return redirect()
                ->route('profile.index', ['username' => $user->username])
                ->with('info', 'Friend request already pending.');
        }

        if (auth()->user()->isFriendsWith($user)) {
            return redirect()
                ->route('profile.index', ['username' => $user->username])
                ->with('info', 'You are already friends.');
        }

        auth()->user()->addFriend($user);

        return redirect()
            ->route('profile.index', ['username' => $username])
            ->with('info', 'Friend request sent.');
    }

    public function getAccept($username)
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            return redirect()
                ->route('home')
                ->with('info', 'That user could not be found');
        }

        if (!auth()->user()->hasFriendRequestReceived($user)) {
            return redirect()->route('home');
        }

        Auth::user()->acceptFriendRequest($user);

        return redirect()
            ->route('profile.index', ['username' => $username])
            ->with('info', 'Friend request accepted.');
    }
}
