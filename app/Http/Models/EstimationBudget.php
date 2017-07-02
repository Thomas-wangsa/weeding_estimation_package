<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class EstimationBudget extends Model
{
    protected $table = "estimation_budget";
    public $timestamps = false;
    protected $primaryKey = 'estimation_id';


    public function budget_detail()
    {
        return $this->hasMany('App\Http\Models\EstimationBudgetDetail', 'estimation_id', 'estimation_id');
    }
}
