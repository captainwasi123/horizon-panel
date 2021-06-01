<?php

namespace App\construction;

use Illuminate\Database\Eloquent\Model;
use App\setting\workflowItem;

class gworkflow extends Model
{
    protected $table = 'tbl_construction_workflow_info';


    public function item(){
        return $this->belongsTo(workflowItem::class, 'item_id');
    }
}
