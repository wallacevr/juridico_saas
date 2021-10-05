<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = ['title', 'slug', 'status', 'is_parent', 'parent_id', 'url'];

    protected $attributes = [
        'status' => false,
        'is_parent' => false,
    ];

    public static function getMainCategoriesWithChildrens()
    {
        return Category::orderBy('id', 'ASC')->where('is_parent', 0)->with('allChildren')->paginate(5);
    }

    public static function getMainCategoryWithChildrens($categoryId)
    {
        return Category::where('id', $categoryId)->with('allChildren')->first();
    }

    public function parent()
    {
        return $this->belongsTo('App\Category');
    }

    public function children()
    {
        return $this->hasMany('App\Category', 'parent_id');
    }

    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    public function root()
    {
        return $this->parent
        ? $this->parent->root()
        : $this;
    }
}
