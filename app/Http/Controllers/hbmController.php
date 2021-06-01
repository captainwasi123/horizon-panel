<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hbm\queries;
use App\hbm\remarks;

class hbmController extends Controller
{
    //
    function queries(){
    	$data = queries::where('status', '1')->orderBy('created_by', 'desc')->get();

    	return view('hbm.queries', ['databelt' => $data]);
    }
    function queriesSubmit(Request $request){
    	$data = $request->all();
    	$databelt = queries::where('status', '1')
    			->when(!empty($data['cust_name']), function ($q) use ($data) {
                    return $q->where('name', 'like', '%' . $data['cust_name'] . '%');
                })
                ->when(!empty($data['phone']), function ($q) use ($data) {
                    return $q->where('phone', 'like', '%' . $data['phone'] . '%');
                })
    			->orderBy('created_by', 'desc')->get();

    	return view('hbm.queries', ['databelt' => $databelt, 'search_data' => $data]);
    }
    function sales(){
    	$data = queries::where('status', '2')->orderBy('created_by', 'desc')->get();

    	return view('hbm.sales', ['databelt' => $data]);
    }
    function salesSubmit(Request $request){
    	$data = $request->all();
    	$databelt = queries::where('status', '2')
    			->when(!empty($data['cust_name']), function ($q) use ($data) {
                    return $q->where('name', 'like', '%' . $data['cust_name'] . '%');
                })
                ->when(!empty($data['phone']), function ($q) use ($data) {
                    return $q->where('phone', 'like', '%' . $data['phone'] . '%');
                })
    			->orderBy('created_by', 'desc')->get();

    	return view('hbm.sales', ['databelt' => $databelt, 'search_data' => $data]);
    }

    function queriesAdd(){

    	return view('hbm.newQuery');
    }

    function queriesInsert(Request $request){
    	$data = $request->all();
    	queries::addQuery($data);

    	return redirect()->back()->with('success', 'Query Added.');
    }

    function deleteQuery($id){
    	$id = base64_decode($id);

    	queries::destroy($id);
    	remarks::where('query_id', $id)->delete();

    	return redirect()->back()->with('success', 'Query Deleted.');
    }

    function saleQuery($id){
    	$id = base64_decode($id);
    	$q = queries::find($id);
    	$q->status = '2';
    	$q->save();

    	return redirect()->back()->with('success', 'Query sent to sale.');
    }

    function sendQuery($id){
    	$id = base64_decode($id);
    	$q = queries::find($id);
    	$q->status = '1';
    	$q->save();

    	return redirect()->back()->with('success', 'Query sent to sale.');
    }

    //Remarks
    function loadRemarks($id){
    	$data = queries::find($id);

     	return view('hbm.responseRemarks', ['data' => $data]);
    }

    function remarksInsert(Request $request){
    	$data = $request->all();

    	remarks::addRemarks($data);
    	return redirect()->back()->with('success', 'Remarks Added.');
    }
}
