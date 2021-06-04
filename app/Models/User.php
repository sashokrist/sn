<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Inani\Larapoll\Traits\Voter;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;
   // use Voter;

    protected $table = 'users';

    protected $fillable = [

        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'location',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getName()
    {
        if ($this->first_name && $this->last_name) {
            return "{$this->first_name} {$this->last_name}";
        }

        if ($this->first_name) {
            return $this->first_name;
        }

        return null;
    }

    public function getNameOrUsername()
    {
        return $this->getName() ?: $this->username;
    }

    public function getFirstNameOrUsername()
    {
        return $this->first_name ?: $this->username;
    }

    public function getAvatarUrl()
    {
        return "https://www.gravatar.com/avatar/{{ md5($this->email) }}?d=mm&s=40";
    }

    public function statuses()
    {
        return $this->hasMany(Status::class, 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'user_id');
    }

    public function friendsOfMine()
    {
        return $this->belongsToMany(__CLASS__, 'friends', 'user_id', 'friend_id');
    }

    public function friendOf()
    {
        return $this->belongsToMany(__CLASS__, 'friends', 'friend_id', 'user_id');
    }

    public function friends()
    {
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()->merge(
            $this->friendOf()->wherePivot('accepted', true)->get()
        );
    }

    public function friendRequests()
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    public function friendRequestsPending()
    {
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestPending(User $user)
    {
        return (bool)$this->friendRequestsPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestReceived(User $user)
    {
        return (bool)$this->friendRequests()->where('id', $user->id)->count();
    }

    public function addFriend(User $user)
    {
        $this->friendOf()->attach($user->id);
    }

    public function acceptFriendRequest(User $user)
    {
        $this->friendRequests()->where('id', $user->id)->first()->pivot->update(
            [
                'accepted' => true,
            ]
        );
    }

    public function isFriendsWith(User $user)
    {
        return (bool)$this->friends()->where('id', $user->id)->count();
    }

    public function hasLikedStatus(Status $status)
    {
        return (bool)$status->likes->where('user_id', $this->id)->count();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function questionnaries()
    {
        return $this->hasMany(Questionnaire::class);
    }

    public function isAdmin()
    {
        $admin = self::where('isAdmin', 1)->first();
        return true;
    }

    public function response()
    {
        return $this->hasMany(SurveyResponse::class, 'user_id');
    }

    public function surveys()
    {
        return $this->hasMany(Survey::class, 'email');
    }

    public function eventSign()
    {
        return $this->hasMany(EventSignUp::class, 'user_id');
    }
}
