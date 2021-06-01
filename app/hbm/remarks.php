<?php

namespace App\hbm;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\User;

class remarks extends Model
{
    //
    protected $table = 'tbl_hbm_query_remarks_info';

    public static function addRemarks(array $data){
    	$r = new remarks;
    	$r->query_id = base64_decode($data['query_id']);
    	$r->remarks = $data['remarks'];
    	$r->created_by = Auth::id();
    	$r->save();
    }


    public function user(){
    	return $this->belongsTo(User::class, 'created_by');
    }
}
