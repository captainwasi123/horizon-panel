<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\setting\workflowItem;
use App\setting\workflow;
use App\setting\workflowDetail;
use App\team;
use DB;

class settingController extends Controller
{
    function workflow(){
    	if(Auth::check()){
    		$data = workflow::with(['details' => function($query){
                          $query->select(DB::raw('sum(weeks) as weeksum'));
                       }])->get();
    		return view('setting.workflow', ['databelt' => $data]);
    	}else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }
    function addWorkflow(){
    	if(Auth::check()){
    		$item = workflowItem::all();
    		return view('setting.addWorkflow', ['items' => $item]);
    	}else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }
    function insertWorkflow(Request $request){
    	if(Auth::check()){
    		$data = $request->all();
    		workflow::addflow($data);
    		
    		return redirect('/setting/workflow')->with('success', 'Layout Generated.');
    	}else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }
    function editWorkflow($id){
    	if(Auth::check()){
    		$id = base64_decode($id);
    		$data = workflow::find($id);
    		$item = workflowItem::all();
    		return view('setting.editWorkflow', ['items' => $item, 'data' => $data]);
    	}else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }
    function updateWorkflow(Request $request){
    	if(Auth::check()){
    		$data = $request->all();
    		$id = base64_decode($data['workflow_id']);
    		workflowDetail::where('flow_id', $id)->delete();
    		workflow::updateflow($data, $id);
    		
    		return redirect('/setting/workflow')->with('success', 'Layout Updated.');
    	}else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }


    //Team
    function team(){
        if(Auth::check()){
            $data = team::orderBy('name')->get();
            return view('users.team', ['databelt' => $data]);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }
    function addTeam(Request $request){
        if(Auth::check()){
            $data = $request->all();
            team::addTeam($data['name']);

            return redirect()->back()->with('success', 'Team Added.');
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }
}
