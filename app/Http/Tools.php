<?php

use App\Category;

class Tools{
    public static function getAllCategory(){
        return Category::getMainCategoryWithChildrens(1)->children;
    }    
}
?>