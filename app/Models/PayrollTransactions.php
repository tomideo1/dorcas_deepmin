<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollTransactions extends Model
{
    protected $fillable = [
      'uuid',
      'status',
      'remarks',
      'amount',
      'amount_type',
      'end_date',
      'company_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function company(){
        return $this->belongsTo(Company::class);

    }

//    public function runs(){
//        return $this->belongsTo(Run::class);
//    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }


}