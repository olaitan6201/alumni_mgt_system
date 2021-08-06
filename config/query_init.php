<?php
    include_once('config.php');
    include_once('core.php');

    $init = new Core;

    $init->addController('db', '../../');
    $init->addController('crud', '../../');

    $db = new Database;
    $crud = new Crud;
?>