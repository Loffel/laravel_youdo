<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewProposal;
use App\Proposal;
use App\Task;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function dashboard(){
        $proposals = auth()->user()->proposals()->paginate(4);

        return view('proposals.dashboard', array('proposals' => $proposals));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = Task::find($request->task_id);
        $proposalExists = Proposal::where('user_id', Auth::user()->id)->where('task_id', $request->task_id)->first();

        if($task == NULL || $proposalExists) return redirect()->back();

        $proposal = Proposal::create(array(
            'description' => $request->description,
            'price' => $request->price,
            'user_id' => Auth::user()->id,
            'task_id' => $request->task_id
        ));

        $task->user->notify(new NewProposal($task, $proposal));

        return redirect()->route('tasks.show', $request->task_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $proposal = Proposal::find($request->proposal_id);

        if($proposal != NULL){
            if($proposal->user_id == auth()->user()->id){
                $proposal->update(array(
                    'description' => $request->description,
                    'price' => $request->price
                ));
                return redirect()->back()->with('success', 'Предложение успешно изменено!');
            }
        }
        return redirect()->back()->with('error', 'Произошла ошибка!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Proposal $proposal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proposal $proposal)
    {
        if($proposal != NULL){
            if($proposal->user_id == auth()->user()->id){
                $proposal->delete();
                return redirect()->back()->with('success', 'Предложение успешно удалено!');
            }
        }

        return redirect()->back()->with('error', 'Произошла ошибка!');
    }
}
