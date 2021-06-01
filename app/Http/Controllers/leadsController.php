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
use App\User;
use App\userLog;

class leadsController extends Controller
{
    
    function index(){
       if (Auth::check()) {
            $status = status::all();
            $source = source::all();
            $databelt = lead::where('trash', null)
                        ->orderBy('created_at', 'desc')->paginate(25);
            return view('leads.list', ['databelt' => $databelt, 'status' => $status, 'source' => $source]);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }

    function totalQueries(){
       if (Auth::check()) {
            $status = status::all();
            $category = category::all();
            $user = User::where('id', '!=', '1')->get();
            $databelt = lead::where('trash', null)
                        ->where('lead_status', '1')
                        ->orderBy('created_at', 'desc')->get();
            return view('leads.totalQueries', ['databelt' => $databelt, 'status' => $status, 'category' => $category, 'users' => $user, 'filter' => '0']);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }


    function totalQueriesSubmit(Request $request){
       if (Auth::check()) {
            $data = $request->all();            
            $dformat = explode(' - ', $data['daterange']);
            $dto =  date('Y-m-d H:i:s', strtotime($dformat[1].' 23:59:59'));
            $dfrom = date('Y-m-d H:i:s', strtotime($dformat[0].' 00:00:01'));
            $status = status::all();
            $category = category::all();
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
                        ->where('created_at', '>=', $dfrom)
                        ->where('created_at', '<=', $dto)
                        ->where('lead_status', '1')
                        ->orderBy('created_at', 'desc')->get();
            return view('leads.totalQueries', ['databelt' => $databelt, 'status' => $status, 'category' => $category, 'users' => $user, 'filter' => '1', 'search_data' => $data]);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }

    function potentialQueries(){
       if (Auth::check()) {
            $status = status::all();
            $category = category::all();
            $user = User::where('role_id', '3')->get();
            $databelt = lead::where('trash', null)
                        ->where('lead_status', '2')
                        ->when(1>0, function ($q) {
                            return $q->where('visit_date', null)->orWhere('visit_hold', '1');
                        })
                        ->orderBy('created_at', 'desc')->get();
            return view('leads.potentialQueries', ['databelt' => $databelt, 'status' => $status, 'category' => $category, 'users' => $user, 'filter' => '0']);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }


    function potentialQueriesSubmit(Request $request){
       if (Auth::check()) {
            $data = $request->all();            
            $dformat = explode(' - ', $data['daterange']);
            $dto =  date('Y-m-d H:i:s', strtotime($dformat[1].' 23:59:59'));
            $dfrom = date('Y-m-d H:i:s', strtotime($dformat[0].' 00:00:01'));
            $status = status::all();
            $category = category::all();
            $user = User::where('role_id', '3')->get();
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
                        ->where('created_at', '>=', $dfrom)
                        ->where('created_at', '<=', $dto)
                        ->when(1>0, function ($q) {
                            return $q->where('visit_date', null)->orWhere('visit_hold', '1');
                        })
                        ->where('lead_status', '2')
                        ->orderBy('created_at', 'desc')->get();
            return view('leads.potentialQueries', ['databelt' => $databelt, 'status' => $status, 'category' => $category, 'users' => $user, 'filter' => '1', 'search_data' => $data]);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }

    function superpotentialQueries(){
       if (Auth::check()) {
            $status = status::all();
            $category = category::all();
            $user = User::where('role_id', '3')->get();
            $databelt = lead::where('trash', null)
                        ->where('lead_status', '2')
                        ->where('visit_date', '!=', null)
                        ->where('visit_hold', null)
                        ->orderBy('created_at', 'desc')->get();
            return view('leads.superPotentialQueries', ['databelt' => $databelt, 'status' => $status, 'category' => $category, 'users' => $user, 'filter' => '0']);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }


    function superpotentialQueriesSubmit(Request $request){
       if (Auth::check()) {
            $data = $request->all();            
            $dformat = explode(' - ', $data['daterange']);
            $dto =  date('Y-m-d H:i:s', strtotime($dformat[1].' 23:59:59'));
            $dfrom = date('Y-m-d H:i:s', strtotime($dformat[0].' 00:00:01'));
            $status = status::all();
            $category = category::all();
            $user = User::where('role_id', '3')->get();
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
                        ->where('created_at', '>=', $dfrom)
                        ->where('created_at', '<=', $dto)
                        ->where('visit_date', '!=', null)
                        ->where('visit_hold', null)
                        ->where('lead_status', '2')
                        ->orderBy('created_at', 'desc')->get();
            return view('leads.superPotentialQueries', ['databelt' => $databelt, 'status' => $status, 'category' => $category, 'users' => $user, 'filter' => '1', 'search_data' => $data]);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }


    function pendingLeads(){
       if (Auth::check()) {
            $status = status::all();
            $category = category::all();
            $user = User::where('role_id', '3')->get();
            $databelt = lead::where('trash', null)
                        ->where('lead_status', '6')
                        ->orderBy('created_at', 'desc')->get();
            return view('leads.pendingLead', ['databelt' => $databelt, 'status' => $status, 'category' => $category, 'users' => $user, 'filter' => '0']);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }


    function pendingLeadsSubmit(Request $request){
       if (Auth::check()) {
            $data = $request->all();            
            $dformat = explode(' - ', $data['daterange']);
            $dto =  date('Y-m-d H:i:s', strtotime($dformat[1].' 23:59:59'));
            $dfrom = date('Y-m-d H:i:s', strtotime($dformat[0].' 00:00:01'));
            $status = status::all();
            $category = category::all();
            $user = User::where('role_id', '3')->get();
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
                        ->where('created_at', '>=', $dfrom)
                        ->where('created_at', '<=', $dto)
                        ->where('lead_status', '6')
                        ->orderBy('created_at', 'desc')->get();
            return view('leads.pendingLead', ['databelt' => $databelt, 'status' => $status, 'category' => $category, 'users' => $user, 'filter' => '1', 'search_data' => $data]);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }

    function assignPerson(Request $request){
       if (Auth::check()) {
            $data = $request->all();
            $id = base64_decode($data['lead_id']);            
            assign::addAssign($id, $data['assign_to']);

            $data = lead::where('id', $id)->first();
            $data->lead_status = '3';
            $data->save();

            userLog::addLog($id, '3');

            return redirect()->back()->with('success', 'Lead successfully assigned to the person.');
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }

    function setVisitDate(Request $request){
       if (Auth::check()) {
            $data = $request->all();    
            $id = base64_decode($data['lead_id']); 
            $da = lead::where('id', $id)->first();
            $da->visit_date = $data['visit_date'];
            $da->visit_hold = empty($data['visit_hold']) ? null : $data['visit_hold'];
            $da->save();

            userLog::addLog($id, '8');

            return redirect()->back()->with('success', 'Visit Date Updated.');
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }

    function addLead(){
       if (Auth::check()) {
            $status = status::all();
            $source = source::all();
            $category = category::all();
            return view('leads.new', ['status' => $status, 'source' => $source, 'category' => $category]);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }

    function editLead($id){
       if (Auth::check()) {
            $id = base64_decode($id);
            $data = lead::where('id', $id)->first();
            $status = status::all();
            $source = source::all();
            $category = category::all();

            return view('leads.edit', ['data' => $data, 'status' => $status, 'source' => $source, 'category' => $category]);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }

    function convertLead($id){
       if (Auth::check()) {
            $id = base64_decode($id);
            $data = lead::where('id', $id)->first();
            $data->converted = '1';
            $data->converted_at = date('Y-m-d H:i:s');
            $data->lead_status = '5';
            $data->save();
            userLog::addLog($id, '10');
            return redirect()->back()->with('success', 'Lead Converted.');
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }

    function queryStatus($status, $id){
       if (Auth::check()) {
            $id = base64_decode($id);
            $rem = remarks::where('lead_id', $id)->where('created_by', Auth::id())->count();
            if($rem > 0){
                $action = 0;
                $data = lead::where('id', $id)->first();
                $data->lead_status = $status;
                $data->save();
                if($status == '6'){
                    assign::where('lead_id', $id)->delete();
                }

                switch ($status) {
                    case '2':
                        $action = '2';
                        break;

                    case '3':
                        $action = '3';
                        break;

                    case '4':
                        $action = '4';
                        break;

                    case '6':
                        $action = '5';
                        break;
                    
                    default:
                        # code...
                        break;
                }

                userLog::addLog($id, $action);

                return redirect()->back()->with('success', 'Status Changed.');
            }else{
                return redirect()->back()->with('error', 'Please Add Remarks First.');
            }
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }

    function insertLead(Request $request){
        if (Auth::check()) {
            $validated = $request->validate([
                'phone' => 'required|unique:tbl_leads_info'
            ]);
            $data = $request->all();

            $id = lead::addLead($data);
            userLog::addLog($id, '1');
            remarks::addRemarks($id, $data['remarks'], null);
            return redirect()->back()->with('success', 'New Lead Created.');
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }
    function updateLead(Request $request){
        if (Auth::check()) {
            $data = $request->all();

            lead::updateLead($data);
            $id = base64_decode($data['lead_id']); 
            userLog::addLog($id, '9');
            return redirect()->back()->with('success', 'Lead data updated.');
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }

    function insertRemarks(Request $request){
        if (Auth::check()) {
            $data = $request->all();
            $id = base64_decode($data['lead_id']);
            $status = empty($data['status']) ? null : $data['status'];
            remarks::addRemarks($id, $data['remarks'], $status);
            userLog::addLog($id, '7');
            return redirect()->back()->with('success', 'Remarks Added.');
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }

    function deleteLead($id){
       if (Auth::check()) {
            $id = base64_decode($id);
            Lead::where('id', $id)->update(['trash' => '1']);
            userLog::addLog($id, '6');
            return redirect()->back()->with('success', 'Lead is moved to trash.');
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }

    function loadRemarks($id){
       if (Auth::check()) {
            $data = Lead::find($id);
            return view('leads.remarksResponse', ['data' => $data]);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }


    function prePotential($id){
       if (Auth::check()) {
            $id = base64_decode($id);
            $data = lead::where('id', $id)->first();
            $data->visit_date = null;
            $data->visit_hold = null;
            $data->lead_status = '2';
            $data->save();
            userLog::addLog($id, '11');
            return redirect()->back()->with('success', 'Sent back to potential queries.');
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }
    
}
