<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class EstimationBudget extends Model
{
    protected $table = "estimation_budget";
    public $timestamps = false;
    protected $primaryKey = 'estimation_id';
}
