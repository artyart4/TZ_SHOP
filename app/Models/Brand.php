<?php

namespace App\Models;

use App\Http\Models\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    use HasSlug;
    protected $fillable = [
        'slug',
        'thumbnail',
        'title',
    ];

    protected static function boot()
    {
        parent::boot();


    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
