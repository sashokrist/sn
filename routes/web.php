<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventSignUpController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\PollResultController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Status2Controller;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\VoteController;
use App\Models\Event;
use App\Models\EventSignUp;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
/**
 * Authentication
 */
Route::get('/login', [AuthController::class, 'getSignin'])->name('login');
Route::post('/signin', [AuthController::class, 'postSignin']);
Route::get('/signup', [AuthController::class, 'getSignup'])->name('auth.signup');
Route::post('/signup', [AuthController::class, 'postSignup']);
Route::get('/signin', [AuthController::class, 'getSignin'])->name('auth.signin');
Route::post('/signin', [AuthController::class, 'postSignin']);
Route::get('/signout', [AuthController::class, 'getSignout'])->name('auth.signout');
/**
 * Search
 */
Route::get('/search', [SearchController::class, 'getResults'])->name('search.results');
/**
 * User profile
 */
Route::get('/user/{username}', [ProfileController::class, 'getProfile'])->name('profile.index');
Route::get('/profile/edit', [ProfileController::class, 'getEdit'])->name('profile.edit');
Route::post('/profile/edit', [ProfileController::class, 'postEdit']);
/**
 * Friends
 */
Route::get('/friends', [FriendController::class, 'getIndex'])->name('friend.index');
Route::get('/friends/add/{username}', [FriendController::class, 'getAdd'])->name('friend.add');
Route::get('/friends/accept/{username}', [FriendController::class, 'getAccept'])->name('friend.accept');
/**
 * Statuses
 */
Route::post('/status', [StatusController::class, 'postStatus'])->name('status.post');
Route::post('/status/{statusId}/reply', [StatusController::class, 'postReply'])->name('status.reply');
Route::get('/status/{statusId}/like', [StatusController::class, 'getLike'])->name('status.like');
/**
 *Questionnaires
 */
Route::get('questionnaires/index', [QuestionnaireController::class, 'index'])->name('questionnaires/index');
Route::get('/questionnaires/create', [QuestionnaireController::class, 'create'])->name('questionnaires/create');
Route::post('/questionnaires', [QuestionnaireController::class, 'store'])->name('questionnaires');
Route::get('/questionnaires/{questionnaire}', [QuestionnaireController::class, 'show']);
Route::get('/questionnaires/{questionnaire}/questions/create', [QuestionController::class, 'create']);
Route::post('/questionnaires/{questionnaire}/questions', [QuestionController::class, 'store']);
Route::delete('/questionnaires/{questionnaire}/questions/{question}', [QuestionController::class, 'destroy']);
Route::get('/surveys/{questionnaire}-{slug}', [SurveyController::class, 'show']);
Route::post('/surveys/{questionnaire}-{slug}', [SurveyController::class, 'store']);
/**
 * Events
 */
Route::get('event', [EventController::class, 'index'])->name('event/index');
Route::get('event/create', [EventController::class, 'create'])->name('event/create');
Route::post('event/store', [EventController::class, 'store'])->name('event/store');
Route::get('event/vote', [VoteController::class, 'index'])->name('event/vote');
Route::post('event/vote/store', [VoteController::class, 'store'])->name('event/vote/store');
Route::post('event/vote/delete', [VoteController::class, 'destroy'])->name('event/vote/delete');
/**
 * Poll
 */
Route::get('/poll', [PollController::class, 'index'])->name('poll');
Route::get('/poll/create', [PollController::class, 'create'])->name('poll/create');
Route::post('/poll/store', [PollController::class, 'store'])->name('poll/store');
Route::post('/poll/result/store', [PollResultController::class, 'store'])->name('poll/result/store');




