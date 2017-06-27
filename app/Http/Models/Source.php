<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $table = "source";
    public $timestamps = false;
    protected $primaryKey = 'source_id';
}
