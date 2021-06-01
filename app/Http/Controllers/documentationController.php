<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\leads\lead;
use App\leads\status;
use App\leads\source;
use App\leads\remarks;
use App\sales\assign;
use App\documentation\DocDescription;
use App\documentation\DocInfo;
use App\User;
use Auth;

class documentationController extends Controller
{
    
    function leads(){
       if (Auth::check()) {
            $status = status::all();
            $source = source::all();
            $user = User::where('id', '!=', '1')->get();
            $userid = Auth::id();
            $databelt = lead::where('trash', null)
                        ->where('converted', '1')
                        ->orderBy('created_at', 'desc')->get();
            return view('documentation.leads', ['databelt' => $databelt, 'status' => $status, 'source' => $source, 'users' => $user, 'filter' => '0']);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }


    function leadsSubmit(Request $request){
       if (Auth::check()) {
            $data = $request->all();            
            $dformat = explode(' - ', $data['daterange']);
            $dto =  date('Y-m-d H:i:s', strtotime($dformat[1].' 23:59:59'));
            $dfrom = date('Y-m-d H:i:s', strtotime($dformat[0].' 00:00:01'));
            $status = status::all();
            $source = source::all();
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
                        ->when(!empty($data['user_by']), function ($q) use ($data) {
                            return $q->where('created_by', $data['user_by']);
                        })
                        ->where('converted_at', '>=', $dfrom)
                        ->where('converted_at', '<=', $dto)
                        ->where('converted', '1')
                        ->orderBy('created_at', 'desc')->get();
            return view('documentation.leads', ['databelt' => $databelt, 'status' => $status, 'source' => $source, 'users' => $user, 'filter' => '1', 'search_data' => $data]);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }

    function leadDetail($id){
       if (Auth::check()) {
       		$id = base64_decode($id);
       		$data = lead::find($id);
       		$DocDescrip = DocDescription::all();
       		$DocInfo = DocInfo::where('lead_id', $id)->get();
       		return view('documentation.details', ['data' => $data, 'DocDescrip' => $DocDescrip, 'DocInfo' => $DocInfo]);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }


    function updateDocument(Request $request){
       if (Auth::check()) {
            $data = $request->all();
            $filename = null;
            if($request->hasFile('filename')){
                $file = $request->file('filename');
                $filename = $file->getClientOriginalName();
                $id = DocInfo::addDocument($data['des_id'], $data['lead_id'], $filename, date('Y-m-d', strtotime($data['filedate'])));
                $file->move(base_path('/public/documents'), $id.'-'.$filename);
            }else{
                DocInfo::addDocument($data['des_id'], $data['lead_id'], $filename, date('Y-m-d', strtotime($data['filedate'])));
            }
            return redirect()->back()->with('success', 'Document added.');
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }
}
