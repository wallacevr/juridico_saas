<?php

use App\Menu;

class Tools{
    public static function getAllMenu(){
        return Menu::getMainMenuWithChildrens(1)->children;
    }    
}
?>