<?php

namespace App\setting;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\setting\workflowDetail;
use App\User;

class workflow extends Model
{
    protected $table = 'tbl_setting_workflow_info';

    public static function addflow(array $data){
    	$f = new workflow;
    	$f->title = $data['title'];
    	$f->created_by = Auth::id();
    	$f->save();
    	$id = $f->id;
    	$c = count($data['description']);
    	for ($i=0; $i < $c; $i++) { 
    		$fd = new workflowDetail;
    		$fd->flow_id = $id;
    		$fd->item_id = $data['description'][$i];
    		$fd->weeks = $data['weeks'][$i];
    		$fd->save();
    	}
    }

    public static function updateflow(array $data, $id){
    	$f = workflow::find($id);
    	$f->title = $data['title'];
    	$f->save();
    	$c = count($data['description']);
    	for ($i=0; $i < $c; $i++) { 
    		$fd = new workflowDetail;
    		$fd->flow_id = $id;
    		$fd->item_id = $data['description'][$i];
    		$fd->weeks = $data['weeks'][$i];
    		$fd->save();
    	}
    }

    public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }
    public function details(){
        return $this->hasMany(workflowDetail::class, 'flow_id', 'id');
    }
    public function weekSum()
	{
	  return $this->hasMany(workflowDetail::class, 'flow_id', 'id')
	    ->selectRaw('SUM(weeks) as total')
	    ->groupBy('flow_id');
	}
}
