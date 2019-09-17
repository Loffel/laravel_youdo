<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Task;
use App\Proposal;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->type == 1){

            $filteredProposals = array();
            foreach(auth()->user()->tasks as $task){
                $proposal = $task->getSelectedProposal();
                
                if(isset($proposal)) {
                    if($proposal->status >= 3)
                    array_push($filteredProposals, $proposal->id);
                }
            }

            $items = auth()->user()->tasks()->whereIn('proposal_id', $filteredProposals)->paginate(4);
        }
        else {
            $items = auth()->user()->proposals()->where('status', '>=', 3)->paginate(4);
        }

        foreach($items as $item){
            if(auth()->user()->type == 1){
                $item->userName = auth()->user()->name;
                $item->userURL = route('profile.show', auth()->user()->id);
                $item->taskID = $item->id;
                $item->taskURL = route('tasks.show', $item->taskID);
                $item->taskTitle = $item->title;
            }else{
                $item->userName = $item->task->user->name;
                $item->userURL = route('profile.show', $item->task->user->id);
                $item->taskID = $item->task->id;
                $item->taskURL = route('tasks.show', $item->task->id);
                $item->taskTitle = $item->task->title;
            }
        }
        
        return view('reviews.index', array('items' => $items));
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

        $statusMessage = array();

        if($task !== NULL){
            $newReview = array(
                'courtesy' => $request->courtesy,
                'punctuality' => $request->punctuality,
                'adequacy' => $request->adequacy,
                'comment' => $request->comment
            );

            if(auth()->user()->type == 1){
                $newReview['proposal_id'] = null;
                $newReview['task_id'] = $task->id;
            }else{
                $newReview['proposal_id'] = auth()->user()->proposals->where('task_id', $task->id)->first()->id;
                $newReview['task_id'] = null;
            }

            $review = Review::create($newReview);

            return redirect()->back()->with('success', 'Отзыв успешно опубликован!');
        }else{
            return redirect()->back()->with('error', 'Произошла ошибка!');
        }
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
        $review = Review::find($request->review_id);

        if($review != NULL){
            if( (auth()->user()->type == 1 && Task::find($review->task_id)->user_id == auth()->user()->id) ||
            (auth()->user()->type == 2 && Proposal::find($review->proposal_id)->user_id == auth()->user()->id) ){
                $review->update(array(
                    'courtesy' => $request->courtesy,
                    'punctuality' => $request->punctuality,
                    'adequacy' => $request->adequacy,
                    'comment' => $request->comment
                ));
                return redirect()->back()->with('success', 'Отзыв успешно изменен!');
            }
            
        }

        return redirect()->back()->with('error', 'Произошла ошибка!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
