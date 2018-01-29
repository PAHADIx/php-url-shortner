<?php

namespace Framework;


class Redirect
{
    static function to($location){
        if(strpos($location,'http') === false){
            header('Location:'.BASE_URL.$location);
        } else {
            header('Location:'.$location);
        }
    }

    static function trigger($num){
        die($num.' page not found');
    }
}