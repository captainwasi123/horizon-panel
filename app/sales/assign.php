<?php

namespace App\sales;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\leads\lead;
use App\User;

class assign extends Model
{
    protected $table = 'tbl_sales_assign_info';

    public static function addAssign($leadid, $userid){
    	$a = new assign;
    	$a->lead_id = $leadid;
    	$a->assign_to = $userid;
    	$a->created_by = Auth::id();
    	$a->status = '0';
    	$a->save();
    }


    public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }
    public function assignUser(){
        return $this->belongsTo(User::class, 'assign_to');
    }
    public function lead(){
        return $this->belongsTo(lead::class, 'lead_id');
    }
}
