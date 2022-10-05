<?php

namespace App\Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRelation extends Model
{
    use HasFactory;

    protected $table = 'product_relations';

    protected $fillable = [
        'id',
        'name',
        'slug',
        'parent_id',
        'type',
        'status',
    ];

    public function sub()
    {
        return $this->hasMany(ProductRelation::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(ProductRelation::class, 'parent_id');
    }
}
