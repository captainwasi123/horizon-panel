<?php

namespace App\hbm;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\hbm\remarks;
use App\User;

class queries extends Model
{
    //

    protected $table = 'tbl_hbm_queries_info';

    public static function addQuery(array $data){
    	$q = new queries;
    	$q->name = $data['name'];
    	$q->phone = $data['phone'];
    	$q->address = $data['address'];
    	$q->requirements = $data['remarks'];
    	$q->status = '1';
    	$q->created_by = Auth::id();
    	$q->save();
    }


    public function user(){
    	return $this->belongsTo(User::class, 'created_by');
    }

    public function remarks(){
    	return $this->hasMany(remarks::class, 'query_id', 'id')->orderBy('created_at', 'desc');
    }
}
