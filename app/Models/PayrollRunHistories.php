<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollRunHistories extends Model
{
    protected $fillable = [
        'employee_id','status','status_data'
    ];

    public function runs(){
        return $this->belongsTo(PayrollRun::class,'run_id');
    }



}