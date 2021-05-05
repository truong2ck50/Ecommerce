<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [''];
    protected $table = 'products';

    const HOT = 1;
    const STATUS_PUBLIC = 1;
    const STATUS_PRIVATE = 0;

    public function category()
    {
        return $this->belongsTo(Category::class, 'pro_category_id');
    }

    public function keywords()
    {
        return $this->belongsToMany(Keyword::class, 'products_keywords', 'pk_product_id', 'pk_keyword_id');
    }

    public $status = [
        self::STATUS_PUBLIC => [
            'name'  => 'Public',
            'class' => 'danger'
        ],
        self::STATUS_PRIVATE => [
            'name'  => 'Private',
            'class' => 'muted'
        ]
    ];

    public function getStatus() 
    {
        return Arr::get($this->status, $this->pro_active, []);
    }
}
