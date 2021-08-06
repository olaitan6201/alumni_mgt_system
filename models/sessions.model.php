<?php
    class SessionsModel
    {
        private $crud;
        
        function __construct()
        {
            $this->crud = new Crud;
        }


        ///Other functions

        public function add_session($req)
        {
            $cols = 'session_name, session_desc';
            $values = [$req['name'], $req['descr']];

            return $this->crud->insertData('sessions', $cols, $values, true);
        }


        public function fetch_sessions()
        {
            return $this->crud->fetchData(
                'multi', 'sessions', '', '', '', '', '', '', 'id', 'DESC', $lim = 0
            );
        }

        public function fetch_session($uid)
        {
            return $this->crud->fetchData(
                'single', 'sessions', '', '', '', '', 'unique_id', $uid, 'id', 'DESC', $lim = 0
            );
        }
    }
?>