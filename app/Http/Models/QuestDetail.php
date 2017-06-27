<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class QuestDetail extends Model
{
    protected $table = "quest_detail";
    public $timestamps = false;
    protected $primaryKey = 'quest_id';
}
