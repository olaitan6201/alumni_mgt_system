<?php
    include_once('../../config/query_init.php');

    $res = array(
        'status'    =>  0,
        'message'   =>  'Invalid response sent'
    );

    if(isset($_POST['page']))
    {

        if($_POST['page'] == 'admin')
        {
            $init->addModel('auth', '../../');

            $auth = new AuthModel;

            if($_POST['action'] == 'login')
            {
                $res = array(
                    'status'    => (0 || 1),
                    'message'   => 'Message text'
                );
            }

        }


    }
    
    echo json_encode($res);

?>