<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    protected $table = "relation";
    public $timestamps = false;
    protected $primaryKey = 'relation_id';
}
