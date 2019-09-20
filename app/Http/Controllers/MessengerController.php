<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Proposal;
use App\Task;
use App\Message;
use App\Events\NewMessage;

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
            
            $contactsID = collect($contacts)->pluck('id');
            $otherMessages = Message::where('to_id', auth()->user()->id)->whereNotIn('from_id', $contactsID)->get()->unique('from_id');
            foreach($otherMessages as $message){
                array_push($contacts, $message->from);
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

            $contactsID = collect($contacts)->pluck('id');
            $otherMessages = Message::where('from_id', auth()->user()->id)->whereNotIn('to_id', $contactsID)->get()->unique('to_id');
            foreach($otherMessages as $message){
                array_push($contacts, $message->to);
            }
        }

        $unreadContacts = Message::select(\DB::raw('from_id, count(from_id) as messages_count'))
                                    ->where('to_id', auth()->user()->id)
                                    ->where('read', false)
                                    ->groupBy('from_id')
                                    ->get();

        $contacts = collect($contacts);
        $contacts = $contacts->map(function($contact) use ($unreadContacts){
            $contactUnread = $unreadContacts->where('from_id', $contact->id)->first();


            $lastMessage = Message::select(\DB::raw('MAX(id)'))
                                    ->where(array(
                                        array('to_id', auth()->user()->id),
                                        array('from_id', $contact->id)))
                                    ->orWhere(array(
                                        array('to_id', $contact->id),
                                        array('from_id', auth()->user()->id)))
                                    ->get();

            $lastMessage = Message::whereIn('id', $lastMessage)->first();

            $contact->lastMessage = $lastMessage ? $lastMessage : 0;

            if($lastMessage) $contact->lastMessage->diffForHumans = $lastMessage->created_at->diffForHumans();

            $contact->avatar = $contact->getAvatar();
            $contact->online = $contact->isOnline();
            // $contact->diffForHumans = $lastMessage ? $lastMessage->created_at->diffForHumans() : "";

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $contact;
        });

        return response()->json($contacts);
    }

    public function getMessages($id){
        Message::where('from_id', $id)->where('to_id', auth()->user()->id)->update(['read' => true]);

        $messages = Message::where(function($q) use($id) {
            $q->where('from_id', auth()->user()->id);
            $q->where('to_id', $id);
        })->orWhere(function($q) use($id) {
            $q->where('from_id', $id);
            $q->where('to_id', auth()->user()->id);
        })->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request){
        $message = Message::create([
            'from_id' => Auth::id(),
            'to_id' => $request->contact_id,
            'text' => $request->text
        ]);

        $message->diffForHumans = $message->created_at->diffForHumans();
        
        broadcast(new NewMessage($message));

        if(app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName() != "messenger.index") return redirect()->back()->with('success', 'Сообщение успешно отправлено!');

        return response()->json($message);
    }
}
