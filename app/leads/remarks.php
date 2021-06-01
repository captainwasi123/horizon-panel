<?php

namespace App\leads;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\User;

class remarks extends Model
{
    protected $table = 'tbl_lead_remarks_info';

    public static function addRemarks($id, $remarks, $status){
    	$r = new remarks;
    	$r->lead_id = $id;
    	$r->remarks = $remarks;
        $r->status = $status;
    	$r->created_by = Auth::id();
    	$r->save();
    }

    public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }
}
