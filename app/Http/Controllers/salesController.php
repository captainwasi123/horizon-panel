<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\leads\lead;
use App\leads\status;
use App\leads\source;
use App\leads\remarks;
use App\leads\category;
use App\sales\assign;
use App\sales\quotationDescription;
use App\planning\plan;
use App\User;

class salesController extends Controller
{
    
    function totalLeads(){
       if (Auth::check()) {
            $status = status::all();
            $category = category::all();
            $user = User::where('id', '!=', '1')->get();
            $userid = Auth::id();
            $databelt = lead::where('trash', null)
                        ->where('lead_status', '3')
                        ->orderBy('created_at', 'desc')->get();
            return view('sales.totalLeads', ['databelt' => $databelt, 'status' => $status, 'category' => $category, 'users' => $user, 'filter' => '0']);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }


    function totalLeadsSubmit(Request $request){
       if (Auth::check()) {
            $data = $request->all();            
            $status = status::all();
            $category = category::all();
            $userid = Auth::id();
            $user = User::where('id', '!=', '1')->get();
            $databelt = lead::where('trash', null)
                        ->when(!empty($data['cust_name']), function ($q) use ($data) {
                            return $q->where('name', 'like', '%' . $data['cust_name'] . '%');
                        })
                        ->when(!empty($data['category']), function ($q) use ($data) {
                            return $q->where('cat_id', $data['category']);
                        })
                        ->when(!empty($data['status']), function ($q) use ($data) {
                            return $q->where('status', $data['status']);
                        })
                        ->when(!empty($data['phone']), function ($q) use ($data) {
                            return $q->where('phone', 'like', '%' . $data['phone'] . '%');
                        })
                        ->when(Auth::user()->role_id != '1' ,function($query) use ($userid) {
                            return $query->whereHas('assign', function($query) use ($userid){
                                        $query->where('assign_to', $userid);  
                                    });
                        })
                        ->where('lead_status', '3')
                        ->orderBy('created_at', 'desc')->get();
            return view('sales.totalLeads', ['databelt' => $databelt, 'status' => $status, 'category' => $category, 'users' => $user, 'filter' => '1', 'search_data' => $data]);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }

    
    function potentialLeads(){
       if (Auth::check()) {
            $status = status::all();
            $category = category::all();
            $user = User::where('id', '!=', '1')->get();
            $userid = Auth::id();
            $databelt = lead::where('trash', null)
                        ->where('lead_status', '4')
                        ->orderBy('created_at', 'desc')->get();
            return view('sales.potentialLeads', ['databelt' => $databelt, 'status' => $status, 'category' => $category, 'users' => $user, 'filter' => '0']);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }


    function potentialLeadsSubmit(Request $request){
       if (Auth::check()) {
            $data = $request->all();            
            $status = status::all();
            $category = category::all();
            $userid = Auth::id();
            $user = User::where('id', '!=', '1')->get();
            $databelt = lead::where('trash', null)
                        ->when(!empty($data['cust_name']), function ($q) use ($data) {
                            return $q->where('name', 'like', '%' . $data['cust_name'] . '%');
                        })
                        ->when(!empty($data['source']), function ($q) use ($data) {
                            return $q->where('source', $data['source']);
                        })
                        ->when(!empty($data['status']), function ($q) use ($data) {
                            return $q->where('status', $data['status']);
                        })
                        ->when(!empty($data['phone']), function ($q) use ($data) {
                            return $q->where('phone', 'like', '%' . $data['phone'] . '%');
                        })
                        ->when(Auth::user()->role_id != '1' ,function($query) use ($userid) {
                            return $query->whereHas('assign', function($query) use ($userid){
                                        $query->where('assign_to', $userid);  
                                    });
                        })
                        ->where('lead_status', '4')
                        ->orderBy('created_at', 'desc')->get();
            return view('sales.potentialLeads', ['databelt' => $databelt, 'status' => $status, 'category' => $category, 'users' => $user, 'filter' => '1', 'search_data' => $data]);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }

    function potentialleadsTarget(Request $request){
       if (Auth::check()) {
            $data = $request->all();
            $id = base64_decode($data['lead_id']);
            $rem = remarks::where('lead_id', $id)->where('created_by', Auth::id())->count();
            if($rem > 0){
                $d = lead::where('id', $id)->first();
                $d->lead_status = '4';
                $d->target = $data['client_target'];
                $d->save();
                return redirect()->back()->with('success', 'Status Changed.');
            }else{
                return redirect()->back()->with('error', 'Please Add Remarks First.');
            }
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }

    function clientTarget(){
       if (Auth::check()) {
            $databelt = lead::where('trash', null)
                        ->where('lead_status', '4')
                        ->orderBy('created_at', 'desc')->get();
            return view('sales.clientTarget', ['databelt' => $databelt]);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }



    function quotationPlan($id){
        if(Auth::check()){
            $id = base64_decode($id);
            $data = Lead::find($id);
            $des = quotationDescription::all();
            return view('sales.plan', ['data' => $data, 'descrip' => $des]);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }

    function quotationPlanAdd(Request $request){
        if(Auth::check()){
            $data = $request->all();
            plan::addPlan($data);
            return redirect()->back()->with('success', 'Plan Added.');
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }

    function quotationPlanDelete($id){
        if(Auth::check()){
            $id = base64_decode($id);
            $data = plan::destroy($id);
            return redirect()->back()->with('success', 'Plan Deleted.');
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }


}
