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
        $tasks = null;

        $user = auth()->user();

        if($user->type == 1){
            $tasksCount = $user->tasks->count();
            
            $tasks = $user->tasks->sortByDesc('created_at')->take(5);
        }else{
            $tasksCount = $user->proposals->whereIn('status', array(3, 4))->count();

            $tasks = array();
            foreach($user->proposals as $proposal){
                $task = $proposal->task;
                if($proposal->status == 4)
                    array_push($tasks, $task);
            }
            $tasks = collect($tasks);
            $tasks = $tasks->sortByDesc('created_at')->take(5);
        }
        
        $tasks = $tasks->map(function($task) use($user){
            $task->pay = $user->type == 1 ? $task->payment:$task->payout;

            return $task;
        });

        $reviewsCount = $user->reviews()->count();

        return view('home', array('tasksCount' => $tasksCount, 'reviewsCount' => $reviewsCount, 'tasks' => $tasks));
    }

    public function welcome(){
        $tasks = \App\Task::where('proposal_id', NULL)->orderBy('created_at', 'DESC')->limit(5)->get();
        $posts = \App\Post::orderBy('created_at', 'DESC')->limit(3)->get();
        $tasksCount = \App\Task::all()->count();
        $executorsCount = \App\User::where('type', 2)->count();
        $clientsCount = \App\User::where('type', 1)->count();

        return view('welcome', array('tasks' => $tasks, 'posts' => $posts, 'tasksCount' => $tasksCount, 'executorsCount' => $executorsCount, 'clientsCount' => $clientsCount));
    }

    public function markOne($id){
        auth()->user()->unreadNotifications->where('id', $id)->markAsRead();

        return response()->json(array(
            "message" => "ok"
        ));
    }

    public function markAll(){
        auth()->user()->unreadNotifications->markAsRead();

        return response()->json(array(
            "message" => "ok"
        ));
    }

    public function contacts(){
        return view('contacts');
    }
}
