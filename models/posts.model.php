<?php
    class PostsModel
    {
        private $crud;
        
        function __construct()
        {
            $this->crud = new Crud;
        }


        ///Other functions

        public function add_post($req)
        {
            $cols = 'post_name, post_desc';
            $values = [$req['name'], $req['descr']];

            return $this->crud->insertData('posts', $cols, $values, true);
        }


        public function fetch_posts()
        {
            return $this->crud->fetchData(
                'multi', 'posts', '', '', '', '', '', '', 'id', 'DESC', $lim = 0
            );
        }

        public function fetch_post($uid)
        {
            return $this->crud->fetchData(
                'single', 'posts', '', '', '', '', 'unique_id', $uid, 'id', 'DESC', $lim = 0
            );
        }
    }
?>