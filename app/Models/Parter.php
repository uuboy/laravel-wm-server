<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parter extends Model
{

    protected $fillable = ['user_id','repository_id'];

    public function user()
    {

        return $this->belongsTo(User::class);
    }

    public function repository()
    {

        return $this->belongsTo(Repository::class);

    }



}
