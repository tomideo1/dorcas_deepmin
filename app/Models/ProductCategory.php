<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{

    protected $fillable = [
        'uuid',
        'company_id',
        'name',
        'slug',
        'description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_category');
    }
}
