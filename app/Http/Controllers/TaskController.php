<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Task;
use App\Proposal;
use App\Notifications\ProposalStatusChanged;
use Intervention\Image\Facades\Image;
use Rct567\DomQuery\DomQuery;
use Illuminate\Support\Str;

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

        $tasks = Task::where('proposal_id', NULL);

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
            $sortParam = $request->sort;
            if(!in_array($sortParam, array('asc', 'desc'))) $sortParam = 'desc';

            $tasks->orderBy('created_at', $sortParam);
            $filters['sort'] = $sortParam;
        }else $tasks->orderBy('created_at', 'desc');
        
        $tasks = $tasks->paginate(5)->appends($filters);

        return view('tasks.index', array('tasks' => $tasks, 'maxPrice' => $maxPrice, 'minPrice' => $minPrice, 'filters' => $filters));
    }

    public function dashboard(){
        if(auth()->user()->type == 1)
            $tasks = auth()->user()->tasks()->orderBy('created_at', 'desc')->paginate(4);
        else {
            $proposals = auth()->user()->proposals()->whereBetween('status', array(1, 6))->pluck('id');
            $tasks = Task::whereIn('proposal_id', $proposals)->orderBy('created_at', 'desc')->get();
        }

        return view('tasks.dashboard', array('tasks' => $tasks));
    }

    public function close(Request $request, $id){
        $status = $request->status;
        $statusFreelancer = array(2, 5);
        $statusEmployer = array(3, 5);

        if(auth()->user()->type == 1) {
            $statusCheck = in_array($status, $statusEmployer);
            $task = auth()->user()->tasks->where('id', $id)->first();
        }else {
            $statusCheck = in_array($status, $statusFreelancer);
            $task = auth()->user()->proposals->where('task_id', $id)->first()->task;
        }

        if(!$status || !$task || !$statusCheck) return redirect()->back();

        $proposal = $task->getSelectedProposal();

        if($proposal->status < $status){
            $proposal->update(array(
                'status' => $status
            ));

            if($status == 2) $task->user->notify(new ProposalStatusChanged($task, $task->user));
            else $proposal->user->notify(new ProposalStatusChanged($task, $proposal->user));
        }
        return redirect()->route('tasks.show', $task->id);
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
        $notice = $this->getNoticeInfo(trim($request->notice));

        dd($notice);

        $title = "Первая часть заявки";

        if($request->title == 1) $title = "Жалоба в ФАС";

        $logoImage = NULL;
        if($request->hasFile('logo')){
            $logoImage = $request->file('logo')->store('images/task', 'public');
            $image = Image::make(public_path('storage/'.$logoImage));
            $image->save();
        }

        $task = Task::create(array(
            'title' => $title,
            'description' => $request->description,
            'price' => $request->price,
            'date_end' => $request->date_end,
            'user_id' => Auth::user()->id,
            'notice' => $this->getNoticeInfo(trim($request->notice)),
            'logo' => $logoImage
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

        if(Auth::check()){
            if(auth()->user()->type == 2)
                $userProposal = Proposal::where('task_id', $id)->where('user_id', Auth::user()->id)->first();
        }
        
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
        $title = "Первая часть заявки";

        if($request->title == 1) $title = "Жалоба в ФАС";

        $requestData = $request->all();
        $requestData['date_end'] = \Carbon\Carbon::parse($request->date_end)->format('Y-m-d h:m:s');
        $requestData['title'] = $title;
        $requestData['notice'] = $this->getNoticeInfo(trim($request->notice));

        $logoImage = NULL;
        if($request->hasFile('logo')){
            $logoImage = $request->file('logo')->store('images/task', 'public');
            $image = Image::make(public_path('storage/'.$logoImage));
            $image->save();
            $requestData['logo'] = $logoImage;
        }else unset($requestData['logo']);

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

        if(auth()->user()->tasks->where('id', $task_id)->first() == NULL || auth()->user()->type != 1) return redirect()->back();

        $proposalPrice = Proposal::findOrFail($prop_id)->price;
        return view('tasks.select_proposal', array('task_id' => $task_id, 'prop_id' => $prop_id, 'proposalPrice' => $proposalPrice, 'taskTitle' => Task::find($task_id)->first()->title));
    }

    public function selectProposalStore(Request $request){
        $task = Task::findOrFail($request->task_id);
        $task->selectProposal($request->prop_id);

        return redirect()->route('tasks.show', $request->task_id);
    }

    public function getNoticeInfo($id){
        $info = array();
        $client = new \GuzzleHttp\Client();
        $govURL = "http://zakupki.gov.ru/epz/order/notice/ok504/view/common-info.html?regNumber=$id";
       
        $response = $client->request('GET', $govURL, array(
            'headers' => array(
                'User-Agent' => 'FydwApp'
            )
        ));
        $html = $response->getBody()->getContents();

        $dom = new DomQuery($html);

        $infoLink = $dom->find('a.size14')->attr('href');

        $info['id'] = $id;
        if(isset($infoLink)){
            $info['link'] = $govURL;

            $infoLink = "http://zakupki.gov.ru/" . $infoLink;

            $response = $client->request('GET', $infoLink, array(
                'headers' => array(
                    'User-Agent' => 'FydwApp'
                )
            ));
            $html = $response->getBody()->getContents();

            $startPrice = explode(" ", $this->getDomValue($html, "Начальная (максимальная) цена контракта"))[0];
            $info['price'] = number_format($startPrice, 2, '.', ',');
            $info['object'] = Str::limit($this->getDomValue($html, "Наименование объекта закупки"), 158);
            $info['publishedBy'] = str_replace("Заказчик", '', $this->getDomValue($html, "Размещение осуществляет"));
            $info['endDate'] = $this->getDomValue($html, "Дата и время окончания подачи заявок");
            $info['auctionDate'] = $this->getDomValue($html, "Дата проведения аукциона в электронной форме");
        }

        return $info;
    }

    private function getDomValue($html, $text){
        $dom = new DomQuery($html);

        $elementText = $dom->find('p.parameter:contains('. $text .')')
                            ->parent()
                            ->next()
                            ->find("p.parameterValue")
                            ->text();

        return $elementText;
    }
}
