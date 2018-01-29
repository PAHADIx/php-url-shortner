<?php

    namespace Controllers;

    use Framework\DB;
    use Framework\Redirect;
    use Framework\Route;


    class HomeController{

        public static function index(){
            if(isset($_REQUEST["url"])){
                $url = $_REQUEST["url"];
                if(self::isURLValid($url)){
                    $fields = ["link" => $url];
                    DB::insert("links", $fields);
                    $shortLink = DOMAIN . self::intToString(DB::lastInsertedId());
                    Route::view("pages.created", ["shortLink" => $shortLink]);
                } else {
                    Route::view("pages.index", ["message" => "Invalid URL. Please retry. eg: http://example.com", "url" => $url]);
                }
            } else {
                Route::view("pages.index");
            }
        }
      
        public static function link($link){
            $linkId = self::stringToInt($link);
            $url = DB::get("links",["id" => $linkId], 1);
            if(count($url) === 0){
                Route::view("pages.invalid");
            } else {
                $actualLink = $url[0]->link;
                Redirect::to($actualLink);
            }

        }

        public static function intToString($int){
            return base_convert($int, 10, 36);
        }

        public static function stringToInt($string){
            return base_convert($string, 36, 10);
        }

        public static function isURLValid($url){
            return !(filter_var($url, FILTER_VALIDATE_URL) === FALSE);
        }



    }