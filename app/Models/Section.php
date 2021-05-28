<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates=['deleted_at'];
    protected $fillable =['section','slug','status'];
    public function categories(){
        return $this->hasMany(Category::class,'section_id')->where(['parent_id'=>'ROOT','status'=>1])->with('subcategories');
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
    
}

