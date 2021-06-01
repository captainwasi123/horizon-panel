<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\construction\materialItem;
use App\construction\materialRequisition;
use App\construction\gworkflow;
use App\construction\unit;
use App\leads\lead;
use App\leads\status;
use App\leads\source;
use App\construction\remarks;
use App\setting\workflow;
use App\User;

class constructionController extends Controller
{
    function requisition(){
    	if(Auth::check()){
    		$data = materialRequisition::where('created_by', Auth::id())->orderBy('status')->get();
    		return view('construction.requisition', ['databelt' => $data]);
    	}else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }

    function addRequisition(){
    	if(Auth::check()){
    		$items = materialItem::orderBy('item')->get();
    		$units = unit::orderBy('unit')->get();
            $leads = lead::where('converted', '1')->orderBy('created_at')->get();
    		return view('construction.addRequest', ['items' => $items, 'units' => $units, 'leads' => $leads]);
    	}else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }

    function insertRequisition(Request $request){
    	if(Auth::check()){
    		$data = $request->all();
    		materialRequisition::addRequest($data);
    		
    		return redirect()->back()->with('success', 'Requisition Created.');
    	}else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }

    function editRequisition($id){
    	if(Auth::check()){
    		$id = base64_decode($id);
    		$data = materialRequisition::find($id);
    		$items = materialItem::orderBy('item')->get();
    		$units = unit::orderBy('unit')->get();
            $leads = lead::where('converted', '1')->orderBy('created_at')->get();
    		return view('construction.editRequest', ['items' => $items, 'units' => $units, 'data' => $data, 'leads' => $leads]);
    	}else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }

    function updateRequisition(Request $request){
    	if(Auth::check()){
    		$data = $request->all();
    		materialRequisition::updateRequest($data);
    		
    		return redirect()->back()->with('success', 'Requisition Updated.');
    	}else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }


    function workflow(){
       if (Auth::check()) {
            $status = status::all();
            $source = source::all();
            $user = User::where('id', '!=', '1')->get();
            $databelt = lead::where('trash', null)
                        ->where('converted', '1')
                        ->where('plot_no', '!=', null)
                        ->orderBy('created_at', 'desc')->get();
            return view('construction.workflow', ['databelt' => $databelt, 'status' => $status, 'users' => $user, 'source' => $source]);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }

    function workflowSubmit(Request $request){
       if (Auth::check()) {
            $data = $request->all();            
            $databelt = lead::where('trash', null)
                        ->when(!empty($data['cust_name']), function ($q) use ($data) {
                            return $q->where('name', 'like', '%' . $data['cust_name'] . '%');
                        })
                        ->when(!empty($data['precent']), function ($q) use ($data) {
                            return $q->where('precent',  'like', '%' . $data['precent'] . '%');
                        })
                        ->when(!empty($data['plot_no']), function ($q) use ($data) {
                            return $q->where('plot_no',  'like', '%' . $data['plot_no'] . '%');
                        })
                        ->where('converted', '1')
                        ->where('plot_no', '!=', null)
                        ->orderBy('created_at', 'desc')->get();
            return view('construction.workflow', ['databelt' => $databelt, 'search_data' => $data]);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }

    function workflowDetail($id){
       if (Auth::check()) {
            $id = base64_decode($id);
            $data = Lead::find($id);
            $flows = workflow::all();
            return view('construction.flow', ['data' => $data, 'flows' => $flows]);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }

    function workflowDelete($id){
       if (Auth::check()) {
            $id = base64_decode($id);
            gworkflow::where('lead_id', $id)->delete();
            return redirect()->back()->with('success', 'workflow Deleted.');
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }

    function workflowGenerate(Request $request){
       if (Auth::check()) {
            $data = $request->all();
            $lead_id = base64_decode($data['lead_id']);
            $weeks = 0;
            $date = date_create($data['start_date']);
            $layout = workflow::find($data['layout_id']);
            foreach ($layout->details as $key => $value) {
                date_add($date,date_interval_create_from_date_string($value->weeks." weeks"));
                $weeks +=$value->weeks;

                $gf = new gworkflow;
                $gf->lead_id = $lead_id;
                $gf->item_id = $value->item_id;
                $gf->finish_date = date_format($date,"Y-m-d");
                $gf->week = $weeks;
                $gf->save();

            }

            return redirect()->back()->with('success', 'workflow Generated.');
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }

    function insertRemarks(Request $request){
        if (Auth::check()) {
            $data = $request->all();
            $id = base64_decode($data['req_id']);
            remarks::addRemarks($id, $data['remarks']);

            return redirect()->back()->with('success', 'Remarks Added.');
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }
}
