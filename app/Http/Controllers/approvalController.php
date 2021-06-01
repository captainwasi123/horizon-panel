<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\construction\materialItem;
use App\construction\materialRequisition;

class approvalController extends Controller
{
    function constRequisition(){
    	if(Auth::check()){
    		$data = materialRequisition::where('status', '5')->orderBy('created_at', 'desc')->get();
    		return view('approval.requisition', ['databelt' => $data]);
    	}else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }

}
