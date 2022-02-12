<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $fillable = ['title', 'slug', 'status', 'is_parent', 'sort','parent_id', 'url'];

    protected $attributes = [
        'status' => false,
        'is_parent' => false,
    ];

    public static function getMainCategoriesWithChildrens()
    {
        return Menu::orderBy('sort', 'ASC')->where('is_parent', 1)->with('allChildren')->paginate(5);
    }

    public static function getMainMenuWithChildrens($menuId)
    {
        return self::find($menuId);
    }

    public function parent()
    {
        return $this->belongsTo('App\Menu');
    }

    public function children()
    {
        return $this->refresh()->hasMany('App\Menu', 'parent_id')->orderBy('sort', 'ASC');
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
