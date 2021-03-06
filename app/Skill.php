<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    public function XpTable()
    {
        return $this->belongsTo("App\XpTb");
    }

    public function Competences()
    {
        return $this->hasMany('App\Competence');
    }
}
