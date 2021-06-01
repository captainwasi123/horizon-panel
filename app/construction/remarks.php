<?php

namespace App\construction;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\User;

class remarks extends Model
{
    protected $table = 'tbl_requisition_remarks';

     public static function addRemarks($id, $remarks){
    	$r = new remarks;
    	$r->req_id = $id;
    	$r->remarks = $remarks;
    	$r->created_by = Auth::id();
    	$r->save();
    }

    public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }
}
