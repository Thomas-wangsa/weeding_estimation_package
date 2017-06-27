<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    protected $table = "quest";
    public $timestamps = false;
    protected $primaryKey = 'quest_id';
}
