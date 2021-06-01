<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\logAction;
use App\User;
use App\leads\lead;
use Auth;

class userLog extends Model
{

    protected $table = 'tbl_user_log_info';

    public static function addLog($lead_id, $action){
    	$l = new userLog;
    	$l->lead_id = $lead_id;
    	$l->user_id = Auth::id();
    	$l->action_id = $action;
    	$l->save();
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lead(){
        return $this->belongsTo(lead::class, 'lead_id');
    }

    public function action(){
        return $this->belongsTo(logAction::class, 'action_id');
    }
}
