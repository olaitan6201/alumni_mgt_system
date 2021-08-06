<?php
    /**
     * 
     * ---------------LIST OF FUNCTIONS
     * 
     * ---------ADD A MODEL CLASS------------------
     *-- addModel($name, $path)
     * 
     * 
     * ----------------ADD A CONTROLLER CLASS-----------------------
     * --addController($name, $path)
     * 
     * ----------------REPLACE THE LAST EXISTING STR IN A STR--------------
     * --str_lreplace($search, $replace, $subject)
     * 
     * 
     * ---------------ADD AN AUTH FILE---------------------------------
     * --Auth($name, $path)
     * 
     * 
     * ------------------GENERATE VIEW--------------------------------
     * --view($url)
     * 
     * 
     * -----------------FETCH SESSION [status, value]----------------------
     * --session($name)
     * 
     * 
     * ----------------SET SESSION --------------------------------
     * --set_session($name, $value)
     * 
     * 
     * ----------------UNSET SESSION------------------
     * --unset_session($name)
     * 
     * 
     * --------------GO TO A PARTICULAR FILE------------------
     * --navigate($route)
     * 
     * 
     * 
     * 
     * 
     */
    class Core
    {

        function __construct()
        {
            session_start();
            date_default_timezone_set('Africa/Lagos');
        }
        
        function addModel($name, $path)
        {
            require_once($path.'models/'.$name.'.model.php');
        }

        function addController($name, $path)
        {
            require_once($path.'controller/'.$name.'.controller.php');
        }

        function str_lreplace($search, $replace, $subject)
        {
            $pos = strrpos($subject, $search);
            if($pos !== false){
                $subject = substr_replace($subject, $replace, $pos,  strlen($search));
            }

            return $subject;
        }


        function Auth($name, $path){
            require_once($path.'auth/'.$name.'.auth.php');
        }

        function view($url)
        {
            require_once('public/'.$url.'.php');
        }

        function session($name)
        {
            if(isset($_SESSION[$name]) && !empty($_SESSION[$name])){
                $res = array(
                    'status'  =>  true,
                    'value' =>  $_SESSION[$name]
                );
            }else{
                $res = array(
                    'status'  =>  false
                );
            }

            return json_decode(json_encode($res), false);
        }


        function set_session($name, $value)
        {
            if(!isset($_SESSION[$name]) || empty($_SESSION[$name]) || $_SESSION[$name]!==$value)
            {
                $_SESSION[$name] = $value;
            }
        }


        function unset_session($name)
        {
            if(isset($_SESSION[$name]))
            {
                $_SESSION[$name] = '';
            }
        }

        function navigate($route)
        {
            header('location: '.$route);
        }
    }
?>