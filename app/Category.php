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
        return Category::orderBy('sort', 'ASC')->where('is_parent', 1)->with('allChildren')->paginate(5);
    }

    public static function getMainCategoryWithChildrens($categoryId)
    {
        return self::find($categoryId);
    }

    public function parent()
    {
        return $this->belongsTo('App\Category');
    }

    public function children()
    {
        return $this->refresh()->hasMany('App\Category', 'parent_id')->orderBy('sort', 'ASC');
    }

    public function allChildren()
    {
        return $this->children()->with('allChildren')->orderBy('sort', 'ASC');
    }

    public function root()
    {
        return $this->parent
        ? $this->parent->root()
        : $this;
    }
}
