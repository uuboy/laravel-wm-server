<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = ['user_id','repository_id','method','model','model_name','last_updater_id'];

}
