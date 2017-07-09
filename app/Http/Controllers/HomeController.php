<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
// Models
use App\Http\Models\Quest;
use App\Http\Models\Source;
use App\Http\Models\Relation;
use App\Http\Models\QuestDetail;
use App\Http\Models\QuestEstimation;
use App\Http\Models\EstimationBudget;
use App\Http\Models\EstimationBudgetDetail;

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
            'relation'  => Relation::get(),
            'count'     => null
            );

        $filter = array(
            'source'        => null,
            'relation'      => null,
            'is_come'       => null,
            'invitation'    => null,
            'deleted'       => null,
            'page'          => null
            );

        $query = DB::table('quest')
                ->join('source','source.source_id','=','quest.source_id')
                ->join('relation','relation.relation_id','=','quest.relation_id')
                ->join('quest_detail','quest_detail.quest_id','=','quest.quest_id')
                ->join('quest_estimation','quest_estimation.quest_id','=','quest.quest_id');

                //$query->where('status',1);

                
                if($request->input('source')) {
                $query->where('quest.source_id',$request->input('source'));
                $filter['source'] = $request->input('source');
                }

                if($request->input('relation')) {
                $query->where('quest.relation_id',$request->input('relation'));
                $filter['relation'] = $request->input('relation');
                }

                if($request->input('is_come')) {
                $query->where('quest.is_come',$request->input('is_come'));
                $filter['is_come'] = $request->input('is_come');   
                }

                if($request->input('invitation')) {
                $query->where('quest.invitation',$request->input('invitation'));
                $filter['invitation'] = $request->input('invitation');   
                } else {
                $query->where('quest.invitation',0);   
                }

                if($request->input('deleted')) {
                $query->where('quest.status',0);
                $filter['deleted'] = 1;   
                } else {
                $query->where('quest.status',1);   
                }

                if($request->input('page')) {
                    $filter['page'] = $request->input('page');
                }

        //dd($filter);
        $count = $query->count();
            if($count > 0) {
                $data['count'] = $count;
            }
        $quest = $query->select("quest.quest_id","quest_name","source_name","relation_name","adult","child","infant","invitation","is_come","prediction")
            ->orderBy('quest_name')->paginate(20);
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

    protected function delete($id,$status){
        if($status == 1) {
            $status_update = 0;
        } else {
            $status_update = 1;
        }
        DB::beginTransaction();
        try {
            $quest = Quest::find($id);
            $quest->status  = $status_update;
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

    protected function upload($files) {
        Excel::load($files, function($reader) {
            DB::beginTransaction();
            try {
                foreach($reader->get() as $key=>$val) {
                $quest = new Quest;
                $quest->quest_name  = $val->name;
                $quest->invitation  = $val->invitation == null ? '0' : $val->invitation;
                $quest->source_id   = $val->source;
                $quest->relation_id = $val->relation;
                $quest->is_come     = $val->is_come;
                $quest->save();

                $quest_id = Quest::where('quest_name',$val->name)
                        ->pluck('quest_id')->first();

                $quest_detail = new QuestDetail;
                $quest_detail->quest_id = $quest_id;
                $quest_detail->adult    = $val->adult == null ? '2' : $val->adult;
                $quest_detail->child    = $val->child == null ? '0' : $val->child;
                $quest_detail->infant   = $val->infant == null ? '0' : $val->infant ;
                $quest_detail->save();

                $quest_estimation = new QuestEstimation;
                $quest_estimation->quest_id     = $quest_id;
                $quest_estimation->prediction   = $val->prediction;
                $quest_estimation->ammount      = NULL;
                $quest_estimation->save();
                }
            DB::commit();
            $success = true;
            return redirect()->route('list');
            } catch (\Exception $e) {
                $success = false;
                DB::rollback();
                dd($e);
            }
            
        });
    }


    protected function cost() {
        $data = array(
            'detail'     => null
            );

        $total_cost = EstimationBudgetDetail::sum('prediction');
            if($total_cost > 0 & $total_cost!=null) {
                $data['cost']['prediction'] = $total_cost;
            }
        $total_paid = EstimationBudgetDetail::sum('paid');
            if($total_paid > 0 & $total_paid!=null) {
                $data['cost']['paid'] = $total_paid;
            }
        $estimation_budget = EstimationBudget::get();
        foreach($estimation_budget as $key=>$val) :
            $data['detail'][$key]['estimation_id'] = $val->estimation_id;
            $data['detail'][$key]['budget_name'] = $val->budget_name;
            $data['detail'][$key]['budget_prediction'] = EstimationBudgetDetail::where('estimation_id',$val->estimation_id)->sum('prediction');
        endforeach;

            // if($estimation_budget != null) {
            //     $data['detail'] = $estimation_budget;
            // }
        //dd($data['detail']);
        return view('cost',compact('data'));
    }

    protected function detail(Request $request) {
        $id = $request->id;
        $detail    =  EstimationBudgetDetail::where('estimation_id',$id)->get();
            foreach($detail as $key=>$val) :
                $detail[$key]['prediction'] = number_format($val->prediction);
                $detail[$key]['paid'] = number_format($val->paid);
            endforeach;
        $response = array(
            'budget_name'   => EstimationBudget::where('estimation_id',$id)->pluck('budget_name')->first(),
            'detail'        => $detail
            );

        return $response;
    }


    protected function prediction() {
        $data = array(
            'total_quest'       => Quest::count(),
            'total_invitation'  => Quest::where('invitation',1)->count()
            ); 
        $n = 0;
        for($i=1;$i<=3;$i++) {
            switch($n) :
                case 0 : $is_come = "High";break;
                case 1 : $is_come = "Medium";break;
                case 2 : $is_come = "Low";break;
                default: $is_come = "Undefined";break;  
            endswitch;
            $data['is_come'][$n]['n'] = $i;
            $data['is_come'][$n]['is_come'] = $is_come;
            $data['is_come'][$n]['quest'] = Quest::where('is_come',$i)->count();
            $data['is_come'][$n]['adult'] = Quest::where('quest.is_come',$i)
                    ->join('quest_detail','quest_detail.quest_id','=','quest.quest_id')
                    ->sum('adult');
            $data['is_come'][$n]['child'] = Quest::where('quest.is_come',$i)
                    ->join('quest_detail','quest_detail.quest_id','=','quest.quest_id')
                    ->sum('child');
            $data['is_come'][$n]['infant'] = Quest::where('quest.is_come',$i)
                    ->join('quest_detail','quest_detail.quest_id','=','quest.quest_id')
                    ->sum('infant');
            $data['is_come'][$n]['total'] = $data['is_come'][$n]['adult'] + ($data['is_come'][$n]['child'] * 80/100) + ($data['is_come'][$n]['infant'] * 25/100);
            $n++;
        }

        //dd($data);
        return view('prediction',compact('data'));
    }


    protected function ajax(Request $request) {
        $is_come = $request->id;
        $quest = Quest::where('is_come',$is_come)
                ->where('quest.status',1)
                ->join('quest_detail','quest_detail.quest_id','=','quest.quest_id')
                ->join('quest_estimation','quest_estimation.quest_id','=','quest.quest_id')
                ->join('source','source.source_id','=','quest.source_id')
                ->join('relation','relation.relation_id','=','quest.relation_id')
                ->select('quest_name','invitation','source_name','relation_name','adult','child','infant','prediction')
                ->orderBy('quest_name')
                ->get();
        $response = array(
            'quest_total'   => Quest::where('is_come',$is_come)
                                ->where('quest.status',1)->count(),
            'quest'        => $quest
            );

        return $response;

    }
}
