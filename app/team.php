<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class team extends Model
{
    //
    protected $table = 'tbl_user_team_info';

    public static function addTeam($name){
        $t = new team;
        $t->name = $name;
        $t->save();
    }
}
