<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
// Models
use App\Http\Models\Quest;
use App\Http\Models\Source;
use App\Http\Models\Relation;
use App\Http\Models\QuestDetail;
use App\Http\Models\QuestEstimation;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('home');
    }

    public function list(Request $request) {

        $data   = array(
            'quest'     => null,
            'source'    => Source::get(),
            'relation'  => Relation::get()
            );

        $filter = array(
            'source'        => null,
            'relation'      => null,
            'page'          => null
            );

        $query = DB::table('quest')
                ->select("quest.quest_id","quest_name","source_name","relation_name","adult","child","infant","invitation","is_come","prediction")
                ->join('source','source.source_id','=','quest.source_id')
                ->join('relation','relation.relation_id','=','quest.relation_id')
                ->join('quest_detail','quest_detail.quest_id','=','quest.quest_id')
                ->join('quest_estimation','quest_estimation.quest_id','=','quest.quest_id');

                $query->where('status',1);

                if($request->input('page')) {
                    $filter['page'] = $request->input('page');
                }
                if($request->input('source')) {
                $query->where('quest.source_id',$request->input('source'));
                $filter['source'] = $request->input('source');
                }

                if($request->input('relation')) {
                $query->where('quest.relation_id',$request->input('relation'));
                $filter['relation'] = $request->input('relation');
                }

        //dd($filter);
        $quest = $query->paginate(20);
            if($quest !== null) {
            $data['quest'] = $quest;
            }                     
        return view('list',compact('data','filter'));
    }

    protected function add() {
        $data   = array(
            'quest'     => null,
            'source'    => Source::get(),
            'relation'  => Relation::get()
            );


        return view('add',compact('data'));
    }


    protected function create(Request $request) {
        //dd($request->input());

        $quest_name = ucwords(strtolower(trim($request->input('quest'))));
        DB::beginTransaction();
        try {
            $quest = new Quest;
            $quest->quest_name  = $quest_name;
            $quest->invitation  = $request->input('invitation') == "on"  ? 1 : 0;
            $quest->source_id   = $request->input('source');
            $quest->relation_id = $request->input('relation');
            $quest->is_come     = $request->input('is_come');
            $quest->save();

            $quest_id = Quest::where('quest_name',$quest_name)
                        ->pluck('quest_id')->first();

            $quest_detail = new QuestDetail;
            $quest_detail->quest_id = $quest_id;
            $quest_detail->adult    = $request->input('adult');
            $quest_detail->child    = $request->input('child');
            $quest_detail->infant   = $request->input('infant');
            $quest_detail->save();

            $quest_estimation = new QuestEstimation;
            $quest_estimation->quest_id     = $quest_id;
            $quest_estimation->prediction   = $request->input('prediction');
            $quest_estimation->ammount      = NULL;
            $quest_estimation->save();


            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
            dd($e);
        }

        if ($success) {
            session()->flash('add',"Quest ID $quest_id has been added");
            return redirect()->route('list');
        }

    }

    protected function edit($id) {
        $data   = array(
            'quest'     => null,
            'source'    => Source::get(),
            'relation'  => Relation::get()
            );

        $data['quest'] = Quest::where('quest.quest_id',$id)
                ->select("quest.quest_id","quest_name","quest.source_id","quest.relation_id","adult","child","infant","invitation","is_come","prediction")
                ->join('source','source.source_id','=','quest.source_id')
                ->join('relation','relation.relation_id','=','quest.relation_id')
                ->join('quest_detail','quest_detail.quest_id','=','quest.quest_id')
                ->join('quest_estimation','quest_estimation.quest_id','=','quest.quest_id')
                ->first();
        return view('edit',compact('data','id'));
    }

    protected function update(Request $request) {
        //dd($request->input());
        $quest_id = $request->input('id');
        $quest_name = ucwords(strtolower(trim($request->input('quest'))));
        DB::beginTransaction();
        try {
            $quest = Quest::find($quest_id);
            $quest->quest_name  = $quest_name;
            $quest->invitation  = $request->input('invitation') == "on"  ? 1 : 0;
            $quest->source_id   = $request->input('source');
            $quest->relation_id = $request->input('relation');
            $quest->is_come     = $request->input('is_come');
            $quest->save();

            $quest_detail = QuestDetail::find($quest_id);
            $quest_detail->quest_id = $quest_id;
            $quest_detail->adult    = $request->input('adult');
            $quest_detail->child    = $request->input('child');
            $quest_detail->infant   = $request->input('infant');
            $quest_detail->save();

            $quest_estimation = QuestEstimation::find($quest_id);
            $quest_estimation->quest_id     = $quest_id;
            $quest_estimation->prediction   = $request->input('prediction');
            $quest_estimation->ammount      = NULL;
            $quest_estimation->save();


            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
            dd($e);
        }

        if ($success) {
            session()->flash('update',"Quest ID $quest_id has been updated");
            return redirect()->route('list');
        }

    }

    protected function delete($id){
         DB::beginTransaction();
        try {
            $quest = Quest::find($id);
            $quest->status  = 0;
            $quest->save();

            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
            dd($e);
        }

        if ($success) {
            session()->flash('delete',"Quest ID $id has been deleted");
            return redirect()->route('list');
        }
    }
}
