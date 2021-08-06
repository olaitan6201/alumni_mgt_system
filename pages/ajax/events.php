<?php
    include_once('../../config/query_init.php');

    $res = array(
        'status'    =>  0,
        'message'   =>  'Invalid response sent'
    );

    if(isset($_POST['page']))
    {

        if($_POST['page'] == 'events')
        {
            $init->addModel('events', '../../');

            $event = new EventsModel;

            if($_POST['action'] == 'add')
            {
                $res = $event->add_event($_POST);
            }

            if($_POST['action'] == 'update')
            {
                $res = $event->update_event($_POST);
            }

            if($_POST['action'] == 'delete')
            {
                $res = $event->delete_event($_POST);
            }

        }


    }
    
    echo json_encode($res);

?>