<?php

namespace App\Models;

use App\Models\Category;
use App\Utils\CanBeRated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use CanBeRated;

    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
