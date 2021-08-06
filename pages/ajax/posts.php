<?php
    include_once('../../config/query_init.php');

    $res = array(
        'status'    =>  0,
        'message'   =>  'Invalid response sent'
    );

    if(isset($_POST['page']))
    {

        if($_POST['page'] == 'post')
        {
            $init->addModel('posts', '../../');

            $post = new PostsModel;

            if($_POST['action'] == 'add')
            {
                $res = $post->add_post($_POST);
            }

        }


    }
    
    echo json_encode($res);

?>