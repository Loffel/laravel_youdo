<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Proposal;
use App\Task;
use App\Message;

class MessengerController extends Controller
{
    public function index(){
        return view('messenger.index');
    }

    public function getContacts(){
        $contacts = array();
        if(Auth::user()->type == 2){
            $tasks = Auth::user()->proposals->filter(function($proposal){
                return $proposal->status > 0;
            })->pluck('task_id');

            $tasks = Task::whereIn('id', $tasks)->get()->unique('user_id');

            foreach($tasks as $task){
                array_push($contacts, $task->user);
            }
        }
        else{
            $proposals = Auth::user()->tasks->reject(function($task){
                return $task->proposal_id === NULL;
            })->pluck('proposal_id');

            $proposals = Proposal::whereIn('id', $proposals)->get()->unique('user_id');

            foreach($proposals as $proposal){
                array_push($contacts, $proposal->user);
            }
        }

        return response()->json($contacts);
    }

    public function getMessages($id){
        $messages = Message::where('from_id', $id)->orWhere('to_id', $id)->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request){
        $message = Message::create([
            'from_id' => Auth::id(),
            'to_id' => $request->contact_id,
            'text' => $request->text
        ]);

        if(app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName() != "messenger.index") return redirect()->back()->with('success', 'Сообщение успешно отправлено!');

        return response()->json($message);
    }
}
