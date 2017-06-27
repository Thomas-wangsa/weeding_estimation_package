<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Quest;
use App\Http\Models\Source;
use App\Http\Models\Relation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use DB;
use Excel;

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
                ->select("quest_name","source_name","relation_name","adult","child","infant","invitation","is_come","prediction")
                ->join('source','source.source_id','=','quest.source_id')
                ->join('relation','relation.relation_id','=','quest.relation_id')
                ->join('quest_detail','quest_detail.quest_id','=','quest.quest_id')
                ->join('quest_estimation','quest_estimation.quest_id','=','quest.quest_id');

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
        $csv = $request->input('csv');
        Storage::put($csv, 'export');
        dd($request->input());
        
        return storage_path('exports') . '/files.csv';
        
        Excel::load('files.csv', function($reader) {
            dd($reader);
    // reader methods

        });
    }
}
