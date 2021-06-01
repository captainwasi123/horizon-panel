<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\construction\materialItem;
use App\construction\materialRequisition;

class supplyChainController extends Controller
{
    function requisition(){
    	if(Auth::check()){
    		$data = materialRequisition::orderBy('created_at', 'desc')->get();
    		return view('supplyChain.requisition', ['databelt' => $data]);
    	}else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }

    function requisitionChangeStatus($status, $id){
    	if(Auth::check()){
    		$id = base64_decode($id);
    		$data = materialRequisition::find($id);
    		$data->status = $status;
    		$data->save();

    		return redirect()->back()->with('success', 'Status Updated.');
    	}else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }
}
