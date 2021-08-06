<?php
    include_once('../../config/query_init.php');
    // $res = $_POST;
    if(isset($_POST['page']))
    {

        $res = array(
            'status'    =>  0,
            'message'   =>  'Invalid response sent'
        );
        

        if($_POST['page'] == 'admin')
        {
            $init->addModel('auth', '../../');

            $auth = new AuthModel;

            if($_POST['action'] == 'login')
            {
                $authUser = $auth->userAuth($_POST);
                if(is_array($authUser) && isset($authUser['status']) && empty($authUser['status'])){
                    $res = $authUser;
                }else{
                    if($authUser->type == 'admin') :
                        if(password_verify($_POST['pass'], $authUser->password)){
                            $init->set_session('alumni_admin', $authUser->unique_id);
                            $res = array(
                                'status'    =>  1,
                                'message'   =>  'Authentication successful'
                            );
                        }else{
                            $res = array(
                                'status'    =>  0,
                                'message'   =>  'Incorrect password entry'
                            );
                        }
                    else :
                        $res = array(
                            'status'    =>  0,
                            'message'   =>  'Invalid login credentials'
                        );
                    endif;
                }
            }

            if($_POST['action'] == 'update')
            {
                $authUser = $auth->Auth('unique_id', $_POST['unique_id']);
                
                if(password_verify($_POST['password'], $authUser->password)){
                    $res = $auth->updateProfile($_POST);
                }else{
                    $res = array(
                        'status'    =>  0,
                        'message'   =>  'Incorrect password entry'
                    );
                }
            }

            if($_POST['action'] == 'change_pass')
            {
                if(trim($_POST['cpass']) == trim($_POST['password']))
                {
                    $res = array(
                        'status'    =>  0,
                        'message'   =>  'Current and new passwords are the same'
                    );
                }else{
                    $authUser = $auth->Auth('unique_id', $_POST['unique_id']);
                    
                    if(password_verify($_POST['cpass'], $authUser->password)){
                        $res = $auth->changePass($_POST);
                    }else{
                        $res = array(
                            'status'    =>  0,
                            'message'   =>  'Incorrect password entry'
                        );
                    }
                }
                // $res = $_POST;
            }
        }

        if($_POST['page'] == 'user')
        {
            $init->addModel('auth', '../../');

            $auth = new AuthModel;

            if($_POST['action'] == 'login')
            {
                $authUser = $auth->userAuth($_POST);
                if(is_array($authUser) && isset($authUser['status']) && empty($authUser['status'])){
                    $res = $authUser;
                }else{
                    if($authUser->type == 'user') :
                        if(password_verify($_POST['pass'], $authUser->password)){
                            $init->set_session('blog_user', $authUser->unique_id);
                            $res = array(
                                'status'    =>  1,
                                'message'   =>  'Authentication successful'
                            );
                        }else{
                            $res = array(
                                'status'    =>  0,
                                'message'   =>  'Incorrect password entry'
                            );
                        }
                    else :
                        $res = array(
                            'status'    =>  0,
                            'message'   =>  'Invalid login credentials'
                        );
                    endif;
                }
            }


            if($_POST['action'] == 'register')
            {
                if($_POST['pass'] !== $_POST['cpass'])
                {
                    $res = array(
                        'status'    =>  0,
                        'message'   =>  'Password confirmation wrong'
                    );
                }else{
                    $checkExists = $crud->checkData('users', 'username', [$_POST['user']], '=', '');
                    if($checkExists['status'] == 0)
                    {
                        $res = $checkExists;
                    }else{
                        $checkExists = $crud->checkData('users', 'email', [$_POST['email']], '=', '');
                        if($checkExists['status'] == 0)
                        {
                            $res = $checkExists;
                        }else{
                            $res = $auth->registerUser($_POST);
                        }
                    }
                }
            }
        }

        echo json_encode($res);
    }
    elseif(isset($_POST['mode']))
    {
        $init->set_session('screenMode', $_POST['mode']);
        $res = array('success'=>true, 'mode'=>$_POST['mode']);
        echo json_encode($res);
    }else{
        $res = array(
            'status'    =>  0,
            'message'   =>  'Invalid page response sent'
        );
        echo json_encode($res);
    }

?>