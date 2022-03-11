<?php

namespace App\Model;
use App\Model\Category;
// use App\Model\SubCategory;
use App\Model\writer;
use App\Model\Publication;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function category(){
        return $this->belongsTo(category::class,'category_id'); 
    }
    // public function subCategory(){
    //     return $this->belongsTo(SubCategory::class,'sub_category_id');
    // }
    public function writer(){
        return $this->belongsTo(writer::class,'writer_id');
    }
    public function publication(){
        return $this->belongsTo(Publication::class,'publication_id');
    }
}
