<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;
use App\team;
use App\userLog;
use App\logAction;
use App\leads\lead;
use Session;

class authController extends Controller
{

    function loginView(){
        return view('login');
    }

    function dashboardView(){
        if(Auth::check()){
            $bahria = 0;
            if(Auth::user()->role_id >= 13 && Auth::user()->role_id <= 19){
                $bahria = 1;
            }
            $data = array();
            $from = date('Y-m-d');
            $to = date('Y-m-d', strtotime('+1 days', strtotime($from)));
            $data['totalQueries'] = lead::where('trash', null)->where('lead_status', '1')
                                        ->when($bahria == 1, function ($q) use ($data) {
                                            return $q->whereIn('cat_id', ['1', '2', '3']);
                                        })->count();
            $data['potentialQueries'] = lead::where('trash', null)->where('lead_status', '2')
                                        ->when($bahria == 1, function ($q) use ($data) {
                                            return $q->whereIn('cat_id', ['1', '2', '3']);
                                        })
                                        ->when(1>0, function ($q) {
                                            return $q->where('visit_date', null)->orWhere('visit_hold', '1');
                                        })->count();
            $data['superPotentialQueries'] = lead::where('trash', null)->where('lead_status', '2')
                                        ->when($bahria == 1, function ($q) use ($data) {
                                            return $q->whereIn('cat_id', ['1', '2', '3']);
                                        })
                                        ->where('visit_date', '!=', null)
                                        ->where('visit_hold', null)->count();
            $data['totalLeads'] = lead::where('trash', null)->where('lead_status', '3')
                                        ->when($bahria == 1, function ($q) use ($data) {
                                            return $q->whereIn('cat_id', ['1', '2', '3']);
                                        })
                                        ->count();
            $data['potentialLeads'] = lead::where('trash', null)->where('lead_status', '4')
                                        ->when($bahria == 1, function ($q) use ($data) {
                                            return $q->whereIn('cat_id', ['1', '2', '3']);
                                        })->count();
            $data['pendingLeads'] = lead::where('trash', null)->where('lead_status', '6')
                                        ->when($bahria == 1, function ($q) use ($data) {
                                            return $q->whereIn('cat_id', ['1', '2', '3']);
                                        })->count();
            $data['matureSale'] = lead::where('trash', null)->where('converted', '1')
                                        ->when($bahria == 1, function ($q) use ($data) {
                                            return $q->whereIn('cat_id', ['1', '2', '3']);
                                        })->count();
            $data['todayVisit'] = lead::where('trash', null)
                                        ->when($bahria == 1, function ($q) use ($data) {
                                            return $q->whereIn('cat_id', ['1', '2', '3']);
                                        })
                                        ->whereIn('lead_status', [2, 6])
                                        ->where('converted', null)
                                        ->where('visit_date', '>=', $from)
                                        ->where('visit_date', '<=', $to)
                                        ->orderBy('visit_date')
                                        ->get();
            $user = User::where('role_id', '3')->get();

            return view('index', ['data' => $data, 'users' => $user]);
        }else{
            return redirect('/login');
        }
    }
    
    function loginAttempt(Request $request){

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => '1'])) {
            
            return redirect()->intended('/');
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }

    function logout(){
        Auth::logout();
        if(Auth::check()){
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }

    function users(){
       if (Auth::check() && Auth::user()->role_id == '1') {
            $databelt = User::orderBy('status')->get();
            return view('users.userList', ['databelt' => $databelt]);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        } 
    }

    function addUser(){
       if (Auth::check() && Auth::user()->role_id == '1') {
            $role = DB::table('tbl_role')->orderBy('seq')->get();
            $team = team::orderBy('name')->get();
            return view('users.newUser', ['role' => $role, 'team' => $team]);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }

    function insertUser(Request $request){
        if (Auth::check()) {
            $validatedData = $request->validate([
                'password' => 'required|confirmed|min:6',
            ]);

            $data = $request->all();
            $user = new User;
            $user->fullname = $data['fullname'];
            $user->email = $data['email'];
            $user->username = null;
            $user->password = bcrypt($data['password']);
            $user->age = $data['age'];
            $user->cnic = $data['cnic'];
            $user->phone = $data['phone'];
            $user->role_id = $data['role'];
            $user->team_id = $data['team'];
            $user->status = '1';
            $user->remember_token = $data['_token'];

            $user->save();

            return redirect('/users/Add')->with('success', 'New user registered.');
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }

    function deleteUser($id){
        if (Auth::check() && Auth::user()->role_id == '1') {
            $id = base64_decode($id);
            User::destroy($id);
            return redirect('/users')->with('success', 'User Deleted.');
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }

    function editUser($id){
        if (Auth::check() && Auth::user()->role_id == '1') {
            $id = base64_decode($id);
            $databelt = User::find($id);
            $role = DB::table('tbl_role')->orderBy('seq')->get();
            $team = team::orderBy('name')->get();
            return view('users.editUser', ['databelt' => $databelt, 'role' => $role, 'team' => $team]);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }

    function updateUser(Request $request){
        if (Auth::check()) {

            $data = $request->all();
            $user = User::find($data['user_id']);
            $user->fullname = $data['fullname'];
            $user->email = $data['email'];
            $user->age = $data['age'];
            $user->cnic = $data['cnic'];
            $user->phone = $data['phone'];
            $user->role_id = $data['role'];
            $user->team_id = $data['team'];
            $user->remember_token = $data['_token'];

            $user->save();

            return redirect('/users')->with('success', 'User Update.');

        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }

    function inactiveUser($id){
        if (Auth::check() && Auth::user()->role_id == '1') {

            $id = base64_decode($id);
            $user = User::find($id);
            $user->status = '2';
            $user->save();

            return redirect('/users')->with('success', 'User In-Activated.');

        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }

    function activeUser($id){
        if (Auth::check() && Auth::user()->role_id == '1') {

            $id = base64_decode($id);
            $user = User::find($id);
            $user->status = '1';
            $user->save();

            return redirect('/users')->with('success', 'User Activated.');

        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }


    function userLog(){
        if (Auth::check() && Auth::user()->role_id == '1') {
            $dto =  date('Y-m-31 23:59:59');
            $dfrom = date('Y-m-1 00:00:01');
            $databelt = userLog::where('created_at', '>=', $dfrom)
                        ->where('created_at', '<=', $dto)
                        ->get();

            $user = User::where('status', '1')->get();
            $action = logAction::orderBy('seq')->get();
           
            return view('users.logs', ['databelt' => $databelt, 'users' => $user, 'actions' => $action]);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }

    function userLogSubmit(Request $request){
        if (Auth::check() && Auth::user()->role_id == '1') {
            $data = $request->all();
            $dto =  date('Y-m-d H:i:s', strtotime($data['date'].' 23:59:59'));
            $dfrom = date('Y-m-d H:i:s', strtotime($data['date'].' 00:00:01'));
            $databelt = userLog::where('created_at', '>=', $dfrom)
                        ->where('created_at', '<=', $dto)
                        ->when(!empty($data['action']), function ($q) use ($data) {
                            return $q->where('action_id', $data['action']);
                        })
                        ->when(!empty($data['user']), function ($q) use ($data) {
                            return $q->where('user_id', $data['user']);
                        })
                        ->get();

            $user = User::where('status', '1')->get();
            $action = logAction::orderBy('seq')->get();
           
            return view('users.logs', ['databelt' => $databelt, 'users' => $user, 'actions' => $action, 'search_data' => $data]);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }
}
