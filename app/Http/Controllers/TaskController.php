<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Task;
use App\Proposal;

class TaskController extends Controller
{

    public function __construct(){
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $minPrice = 0;
        $maxPrice = Task::max('price');

        $tasks = Task::query();

        $filters = array();

        if($request->has('min_price')){
            $tasks->where('price', '>=', $request->min_price);
            $filters['min_price'] = $request->min_price;
        }

        if($request->has('max_price')){
            $tasks->where('price', '<=', $request->max_price);
            $filters['max_price'] = $request->max_price;
        }

        if($request->has('sort')){
            $tasks->orderBy('created_at', $request->sort);
            $filters['sort'] = $request->sort;
        }else $tasks->orderBy('created_at', 'desc');
        
        $tasks = $tasks->paginate(5)->appends($filters);

        return view('tasks.index', array('tasks' => $tasks, 'maxPrice' => $maxPrice, 'minPrice' => $minPrice, 'filters' => $filters));
    }

    public function dashboard(){
        if(auth()->user()->type == 1)
            $tasks = auth()->user()->tasks()->paginate(4);
        else {
            $proposals = auth()->user()->proposals()->whereBetween('status', array(1, 6))->get();

            $tasks = Task::whereIn('proposal_id', $proposals)->get();
        }

        return view('tasks.dashboard', array('tasks' => $tasks));
    }

    public function proposals($id){
        $task = auth()->user()->tasks->where('id', $id)->first();

        if(!isset($task)) return redirect()->back();

        return view('tasks.proposals', array('task' => $task));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->type != 1) 
            return redirect()->back();

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
        $proposalPrice = Proposal::findOrFail($prop_id)->price;
        return view('tasks.select_proposal', array('task_id' => $task_id, 'prop_id' => $prop_id, 'proposalPrice' => $proposalPrice, 'taskTitle' => Task::find($task_id)->first()->title));
    }

    public function selectProposalStore(Request $request){
        $task = Task::findOrFail($request->task_id);
        $task->selectProposal($request->prop_id);

        return redirect()->route('tasks.show', $request->task_id);
    }
}
