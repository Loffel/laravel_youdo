<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Task;
use App\Proposal;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::paginate(5);

        return view('tasks.index', array('tasks' => $tasks));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = Task::create(array(
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'date_end' => $request->date_end,
            'user_id' => Auth::user()->id
        ));

        return redirect()->route('tasks.show', $task->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        $userProposal = NULL;

        if(Auth::check())
            $userProposal = Proposal::where('task_id', $id)->where('user_id', Auth::user()->id)->first();
        
        return view('tasks.show', array('task' => $task, 'userProposal' => $userProposal));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);

        if(Auth::user()->id != $task->user_id) redirect()->back();

        $dateEndString = $task->date_end->toDateTimeString();
        $dateEndString = str_replace(' ', 'T', $dateEndString);

        return view('tasks.edit', array('task' => $task, 'dateEndString' => $dateEndString));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $requestData['date_end'] = \Carbon\Carbon::parse($request->date_end)->format('Y-m-d h:m:s');

        Task::findOrFail($id)->update($requestData);

        return redirect()->route('tasks.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::findOrFail($id)->delete();

        return redirect()->route('tasks.index');
    }

    public function selectProposalView($task_id, $prop_id){
        $taskPrice = Task::findOrFail($task_id)->price;
        return view('tasks.select_proposal', array('task_id' => $task_id, 'prop_id' => $prop_id, 'taskPrice' => $taskPrice));
    }

    public function selectProposalStore(Request $request){
        $task = Task::findOrFail($request->task_id);
        $task->selectProposal($request->prop_id);

        return redirect()->route('tasks.show', $request->task_id);
    }
}
