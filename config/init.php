<?php
    include_once('config.php');
    include_once('core.php');

    $init = new Core;

    ///Database Controller
    $init->addController('db', '../');
    $db = new Database;

    ////Crud operations controller
    $init->addController('crud', '../');
    $crud = new Crud;

    ////Auth Model
    $init->addModel('auth', '../');
    $auth = new AuthModel;

    ////Posts Model
    $init->addModel('posts', '../');
    $posts = new PostsModel;

    ///Sessions Model
    $init->addModel('sessions', '../');
    $sessions = new SessionsModel;

    ///Alumni Model
    $init->addModel('alumni', '../');
    $alumnis = new AlumniModel;

    ///Events Model
    $init->addModel('events', '../');
    $events = new EventsModel;




    if($page == 'admin'){
        $init->set_session('screenMode', 'off');
    }else{
        if(!$init->session('screenMode')->status){
			$init->set_session('screenMode', 'on');
		}
    }

?>