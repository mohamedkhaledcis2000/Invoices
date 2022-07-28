<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $fillable = ['name','description','section_id'];
    use HasFactory;

    public function section(){
        return $this->belongsTo(Sections::class,'section_id');
    }
}
