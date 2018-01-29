<?php

namespace Framework;

class Route {

    public static function view($template = null, $data = array(), $headers = true){

        extract($data);


        if($template){

            //Changing main.folder.file to main/folder/file.php
            $template = str_replace('.','/',$template);
            $template = BASE_DIR.'/views/' . $template . '.php';


            if(file_exists($template)){

                if($headers){
                    include_once BASE_DIR.'/views/inc/header.inc.php';
                }

                include_once $template;

                if($headers) {
                    include_once BASE_DIR . '/views/inc/footer.inc.php';
                }


            } else {
                $debug = debug_backtrace();
                if(isset($debug[0])){
                    die("Failed to include file <strong>" . $template . "</strong>"
                        ." at file <strong>". $debug[0]["file"] ."</strong>"
                        ." in line " . $debug[0]["line"] .".");
                }
                Redirect::trigger(404);
            }
        }

    }

    public static function viewInclude($template){

        //Changing main.folder.file to main/folder/file.php
        $template = str_replace('.','/',$template);
        $template = BASE_DIR.'/views/' . $template . '.php';

        if(file_exists($template)){
            include_once $template;

        } else {
            $debug = debug_backtrace();
            if(isset($debug[0])){
                die("Failed to include file <strong>" . $template . "</strong>"
                    ." at file <strong>". $debug[0]["file"] ."</strong>"
                    ." in line " . $debug[0]["line"] .".");
            }
            Redirect::trigger(404);
        }

    }

    public static function get($method, $data = []){

        $method = explode("@", $method);

        $_method = $method[0];
        $_controller = "Controllers\\" . $method[1];

        $object = new $_controller;
        if(method_exists($_controller,$_method)){
            call_user_func_array(array($object, $_method), $data);
        } else {
            Redirect::trigger(500);
        }
    }


}