<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title','description','unit','price','total',


    ];
    public function images(){
        return $this->hasMany(Image::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);

    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');

    }
    public function tags(){
        return $this->belongsToMany(Tag::class);

    }
    public function hasUnit(){
        return $this->belongsTo(Unit::class,'unit','id');

    }
    public function jsonOptions(){
        return json_decode($this->options);
    }

}
