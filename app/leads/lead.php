<?php

namespace App\leads;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\leads\status;
use App\leads\source;
use App\leads\remarks;
use App\leads\category;
use App\sales\assign;
use App\planning\plan;
use App\construction\gworkflow;
use App\User;

class lead extends Model
{
    protected $table = 'tbl_leads_info';

    public static function addLead(array $data){
    	$l = new lead;
        $l->cat_id = $data['category'];
    	$l->name = $data['name'];
    	$l->phone = $data['phone'];
    	$l->other_phone = $data['other_phone'];
    	$l->email = $data['email'];
    	$l->cnic = $data['cnic'];
    	$l->address = $data['address'];
    	$l->status = $data['status'];
    	$l->source = $data['source'];
        $l->plot_no = $data['plot_no'];
        $l->plot_size = $data['plot_size'];
        $l->precent = $data['precent'];
    	$l->created_by = Auth::id();
    	$l->save();

        return $l->id;

    }

    public static function updateLead(array $data){
        $l = lead::find(base64_decode($data['lead_id']));
        $l->cat_id = $data['category'];
        $l->name = $data['name'];
        $l->phone = $data['phone'];
    	$l->other_phone = $data['other_phone'];
        $l->email = $data['email'];
        $l->cnic = $data['cnic'];
        $l->address = $data['address'];
        $l->status = $data['status'];
        $l->source = $data['source'];
        $l->plot_no = $data['plot_no'];
        $l->plot_size = $data['plot_size'];
        $l->precent = $data['precent'];
        $l->save();

    }


    public function category(){
        return $this->belongsTo(category::class, 'cat_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }
    public function assign(){
        return $this->belongsTo(assign::class, 'id', 'lead_id');
    }
    public function leadStatus(){
        return $this->belongsTo(status::class, 'status');
    }
    public function leadSource(){
        return $this->belongsTo(source::class, 'source');
    }
    public function leadRemarks(){
        return $this->hasMany(remarks::class, 'lead_id', 'id')->orderBy('created_at', 'desc');
    }
    public function leadPlan(){
        return $this->hasMany(plan::class, 'lead_id', 'id');
    }
    public function workflow(){
        return $this->hasMany(gworkflow::class, 'lead_id', 'id');
    }
}
