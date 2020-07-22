<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['C_Name', 'C_Description', 'category_id'];
    // public function Categories()
    // {
    //     return $this->hasMany($this);
    // }
    public function MainCategory()
    {
        return $this->hasMany('App\Category', 'category_id');
    }
    public function SubCategory()
    {
        return $this->hasMany('App\Category', 'category_id')->with('MainCategory');
    }
    public function SubParent()
    {
        return $this->hasMany('App\Category','category_id')->with('SubCategory');
    }
}
