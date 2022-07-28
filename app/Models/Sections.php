<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sections extends Model
{
    protected $fillable = ['name','description','created_by'];
    use HasFactory;

//    relation one to many for sections and products
    public function products(){
        return $this->hasMany(Product::class,'section_id');
    }
}
