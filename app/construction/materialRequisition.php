<?php

namespace App\construction;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\construction\materialItem;
use App\construction\remarks;
use App\construction\unit;
use App\leads\lead;
use App\User;

class materialRequisition extends Model
{
    protected $table = 'tbl_construction_material_requisition';

    public static function addRequest(array $data){
    	$r = new materialRequisition;
    	$r->item_id = $data['material'];
        $r->client_id = $data['client_id'];
    	$r->quantity = $data['qty'];
    	$r->unit_id = $data['unit_id'];
    	$r->need_date = empty($data['need_date']) ? null : $data['need_date'];
    	$r->priority = $data['priority'];
    	$r->remarks = empty($data['remarks']) ? null : $data['remarks'];
    	$r->status = '1';
    	$r->created_by = Auth::id();
    	$r->save();
    }

    public static function updateRequest(array $data){
    	$r = materialRequisition::find(base64_decode($data['request_id']));
    	$r->item_id = $data['material'];
        $r->client_id = $data['client_id'];
    	$r->quantity = $data['qty'];
    	$r->unit_id = $data['unit_id'];
    	$r->need_date = empty($data['need_date']) ? null : $data['need_date'];
    	$r->priority = $data['priority'];
    	$r->remarks = empty($data['remarks']) ? null : $data['remarks'];
    	$r->save();
    }

    public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }
    public function client(){
        return $this->belongsTo(lead::class, 'client_id');
    }
    public function Item(){
        return $this->belongsTo(materialItem::class, 'item_id');
    }
    public function Unit(){
        return $this->belongsTo(unit::class, 'unit_id');
    }

    public function reqRemarks(){
        return $this->hasMany(remarks::class, 'req_id', 'id')->orderBy('created_at', 'desc');
    }
}
