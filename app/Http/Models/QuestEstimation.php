<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class QuestEstimation extends Model
{
    protected $table = "quest_estimation";
    public $timestamps = false;
    protected $primaryKey = 'quest_id';
}
