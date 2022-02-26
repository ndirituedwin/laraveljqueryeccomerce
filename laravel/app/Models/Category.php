<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Builder\Function_;

class Category extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates=['deleted_at'];
    protected $fillable=[
        'admin_id',
        'parent_id',
        'section_id',
        'categoryname',
        'slug',
        'categoryimage',
        'categorydiscount',
        'description',
        'url',
        'metatitle',
        'metadescription',
        'metakeywords',
        'status',
    ];
    public function section(){
        return $this->belongsTo(Section::class)->select('id','section');
    }
    public function parentcategory(){
        return $this->belongsTo('App\Models\Category','parent_id')->select('id','categoryname');
    }
    public function subcategories(){
        return $this->hasMany(Category::class,'parent_id')->where('status',1);
    }
   
    public function products(){
        return $this->hasMany(Category::class);
    }
    public static function catdetails($slug){
          $catdetails=Category::Select('id','parent_id','categoryname','slug','description')->with(['subcategories'=>function($query){
              $query->select('id','categoryname','parent_id','slug','description')->where('status',1);
          }])->where('slug',$slug)->first()->toArray();
  //        dd($categorydetails);
  if($catdetails['parent_id']==0){
      //only show main category
       $breadcrumbs='<a href="'.url($catdetails['slug']).'">'.$catdetails['categoryname'].'</a>';
  }else{
      $parentcategory=Category::select('categoryname','slug')->where('id',$catdetails['parent_id'])->first()->toArray();
     //  dd($parentcategory);
      $breadcrumbs='<a href="'.url($parentcategory['slug']).'">'.$parentcategory['categoryname'].'</a>&nbsp;&nbsp;<a href="'.url($catdetails['slug']).'">'.$catdetails['categoryname'].'</a>';

  }
  $catIds=array();
  $catIds[]=$catdetails['id'];
  foreach($catdetails['subcategories'] as $key=> $subcat){
      $catIds[]=$subcat['id'];
  }
  return array('catIds'=>$catIds,'catdetails'=>$catdetails,'breadcrumbs'=>$breadcrumbs);
        }
}
