<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollRun extends Model
{
    protected $fillable = [
        'uuid',
        'title',
        'status',
        'run',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function transactions(){
        return $this->hasMany(PayrollTransactions::class);
    }

    public function runHistories(){
        return $this->hasMany(PayrollRunHistories::class,'run_id');
    }



}