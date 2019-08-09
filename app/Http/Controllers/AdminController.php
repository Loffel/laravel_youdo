<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Proposal;
use App\Task;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware(function($request, $next){
            if(Auth::user()->is_admin) return $next($request);
            else return redirect(route('home'));
        });
    }

    public function index(){
        $unactive = User::where('is_verified', 0)->get();
        $proposals = Proposal::all();
        $tasks = Task::all();
        $users = User::all()->count();
        $completedTasks = 0;

        //status = 4
        foreach($tasks as $task){
            $proposal = $task->getSelectedProposal();

            if($proposal != NULL){
                if($proposal->status == 4) ++$completedTasks;
            }
        }
        $tasks = $tasks->count();

        return view('admin.index', array('unactive' => $unactive, 'proposals' => $proposals, 'tasks' => $tasks, 'completedTasks' => $completedTasks, 'users' => $users));
    }

    public function activateUser($user_id){
        $user = User::find($user_id);
        $user->is_verified = 1;
        $user->save();

        return redirect()->back();
    }
}
