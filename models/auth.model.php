<?php
    class AuthModel
    {
        private $crud;
        
        function __construct()
        {
            $this->crud = new Crud;
        }


        ///Other functions

        function Auth($ref, $val){
            return $this->crud->fetchData('single', 'users', '', '', '', '', $ref, $val, '', 'ASC', $lim = 1);
        }

        function userAuth($req)
        {
            $userInfo = $this->Auth('email', $req['user']);

            if(!empty($userInfo)){
                $res = $userInfo;
            }else{
                $userInfo = $this->Auth('username', $req['user']);

                if(!empty($userInfo)){
                    $res = $userInfo;
                }else{
                    $res = array(
                        'status'    =>  0,
                        'message'   =>  'User does not exist'
                    );
                }
            }

            return $res;
        }


        function updateProfile($req)
        {
            $cols = 'username, email';

            $values = [];

            foreach(explode(', ', $cols) as $col)
            {
                $values[] = $req[$col];
            }

            return $this->crud->updateData('users', $cols, $values, 'unique_id', $req['unique_id']);
        }

        function changePass($req)
        {
            $cols = 'password';

            $values = [];

            foreach(explode(', ', $cols) as $col)
            {
                $values[] = password_hash($req[$col], PASSWORD_DEFAULT);
            }

            return $this->crud->updateData('users', $cols, $values, 'unique_id', $req['unique_id']);
        }



        public function registerUser($req)
        {
            $cols = 'name, username, email, password';

            $values = array(
                $req['name'], $req['user'],
                $req['email'], password_hash($req['pass'], PASSWORD_DEFAULT)
            );

            return $this->crud->insertData('users', $cols, $values, true);
        }
    }
?>