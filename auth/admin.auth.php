<?php
    global $init;

    if($init->session('alumni_admin')->status){
        $init->navigate('../admin/dashboard');
    }
?>