<?php
    include_once('../../config/query_init.php');

    $res = array(
        'status'    =>  0,
        'message'   =>  'Invalid response sent'
    );

    if(isset($_POST['page']))
    {

        if($_POST['page'] == 'session')
        {
            $init->addModel('sessions', '../../');

            $session = new SessionsModel;

            if($_POST['action'] == 'add')
            {
                $res = $session->add_session($_POST);
            }

        }


    }
    
    echo json_encode($res);

?>