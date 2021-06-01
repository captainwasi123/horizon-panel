<?php

namespace App\planning;

use Illuminate\Database\Eloquent\Model;
use App\sales\quotationDescription;
use Auth;
use App\User;

class plan extends Model
{
    protected $table = 'tbl_lead_installment_plan';

    public static function addPlan(array $data){
    	$p = new plan;
    	$p->lead_id = base64_decode($data['lead_id']);
    	$p->description = $data['description'];
    	$p->amount = $data['amount'];
    	$p->multiplier = $data['multiplier'];
    	$p->totalAmount = $data['amount'] * $data['multiplier'];
    	$p->created_by = Auth::id();
    	$p->save();
    }

    public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }
    public function descrip(){
        return $this->belongsTo(quotationDescription::class, 'description');
    }
}
