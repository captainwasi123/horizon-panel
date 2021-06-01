<?php

namespace App\documentation;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\User;

class DocInfo extends Model
{
    protected $table = 'tbl_documentation_detail_info';

    public static function addDocument($doctype, $lead_id, $filename, $filedate){
    	$d = new DocInfo;
    	$d->lead_id = $lead_id;
    	$d->des_id = $doctype;
    	$d->file_name = $filename;
    	$d->file_date = $filedate;
    	$d->created_by = Auth::id();
    	$d->save();

    	return $d->id;
    }

    public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }
}
