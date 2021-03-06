<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    protected $fillable = ['name','user_id'];
}
