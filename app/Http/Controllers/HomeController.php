<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tasksCount = 0;
        $reviewsCount = 0;

        $user = auth()->user();

        if($user->type == 1) $tasksCount = $user->tasks->count();
        else $tasksCount = $user->proposals->where('status', 4)->count();

        $reviewsCount = $user->reviews()->count();

        return view('home', array('tasksCount' => $tasksCount, 'reviewsCount' => $reviewsCount));
    }

    public function welcome(){
        $tasks = \App\Task::orderBy('created_at', 'DESC')->limit(5)->get();
        $posts = \App\Post::orderBy('created_at', 'DESC')->limit(3)->get();
        $tasksCount = \App\Task::all()->count();
        $executorsCount = \App\User::where('type', 1)->count();
        $clientsCount = \App\User::where('type', 2)->count();

        return view('welcome', array('tasks' => $tasks, 'posts' => $posts, 'tasksCount' => $tasksCount, 'executorsCount' => $executorsCount, 'clientsCount' => $clientsCount));
    }

    public function markOne($id){
        auth()->user()->unreadNotifications->where('id', $id)->markAsRead();

        return redirect()->back();
    }

    public function markAll(){
        auth()->user()->unreadNotifications->markAsRead();

        return redirect()->back();
    }
}
