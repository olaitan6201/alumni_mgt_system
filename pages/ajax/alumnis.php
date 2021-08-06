<?php
    include_once('../../config/query_init.php');

    $res = array(
        'status'    =>  0,
        'message'   =>  'Invalid response sent'
    );


    if(isset($_POST['page']))
    {

        if($_POST['page'] == 'alumni')
        {
            $init->addModel('alumni', '../../');

            $alumni = new AlumniModel;

            if($_POST['action'] == 'add')
            {
                $res = $alumni->add_alumni($_POST);
            }

            if($_POST['action'] == 'update')
            {
                $res = $alumni->update_alumni($_POST);
            }

            if($_POST['action'] == 'add_speech')
            {
                $res = $alumni->add_speech($_POST);
            }

        }


    }
    
    echo json_encode($res);

?>