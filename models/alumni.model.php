<?php
    class AlumniModel
    {
        private $crud;
        
        function __construct()
        {
            $this->crud = new Crud;
        }


        ///Other functions
        public function add_alumni($req)
        {
            $checkEmail = $this->crud->checkData('alumnis', 'email', [$req['email']], '=', '');
            $checkPhone = $this->crud->checkData('alumnis', 'phone', [$req['phone']], '=', '');

            if($checkEmail['status'] == 1 && $checkPhone['status'] == 1)
            {
                $upload = $this->crud->uploadFile($_FILES['photo'], hexdec(uniqid()), '../uploads/', 'jpg, jpeg, png, gif', '5mb');

                if(isset($upload['status']) && $upload['status'] == 0)
                {
                    $res = $upload;
                }else{
                    $img = $upload;

                    $cols = 'name, nname, email, phone, session, post, photo';

                    $colsArr = explode(', ', $cols);
                    $values = [];

                    for($i = 0; $i<(count($colsArr)-1); $i++)
                    {
                        $values[] = $req[$colsArr[$i]];
                    }

                    $values[] = $img;

                    $res = $this->crud->insertData('alumnis', $cols, $values, true);
                }
            }else{
                $res = $checkData;
            }

            return $res;
        }



        public function update_alumni($req)
        {
            $old_img = $this->fetch_alumni($req['id'])->photo;

            $cols = 'name, nname, email, phone, session, post, photo';

            $upload = $this->crud->uploadFile($_FILES['photo'], hexdec(uniqid()), '../uploads/', 'jpg, jpeg, png, gif', '5mb');
            // exit($upload);
            if(!isset($upload['status']))
            {
                if(!empty($upload)){
                    $img = $upload; 

                    unlink('../uploads/'.$old_img);
                }else{
                    $img = $old_img;
                }

                $colsArr = explode(', ', $cols);

                $values = [];

                for($i = 0; $i<(count($colsArr)-1); $i++)
                {
                    $values[] = $req[$colsArr[$i]];
                }

                $values[] = $img;

                $res = $this->crud->updateData('alumnis', $cols, $values, 'unique_id', $req['id']);
            }else{
                
                $res = $upload;

            }
            // exit($img);
            return $res;
        }


        public function fetch_alumnis()
        {
            return $this->crud->fetchData(
                'multi', 'alumnis', '', '', '', '', '', '', 'id', 'DESC', $lim = 0
            );
        }


        public function fetch_alumni($uid)
        {
            return $this->crud->fetchData(
                'single', 'alumnis', '', '', '', '', 'unique_id', $uid, 'id', 'DESC', $lim = 0
            );
        }


        public function add_speech($req)
        {
            $cols = 'session, post, text';

            $colsArr = explode(', ', $cols);
            $values = [];

            for($i = 0; $i<(count($colsArr)); $i++)
            {
                $values[] = $req[$colsArr[$i]];
            }

            return $this->crud->insertData('speech', $cols, $values, false);
        }

        public function fetch_speechs()
        {
            return $this->crud->fetchData(
                'multi', 'speech', '', '', '', '', '', '', 'id', 'DESC', $lim = 0
            );
        }
    }
?>