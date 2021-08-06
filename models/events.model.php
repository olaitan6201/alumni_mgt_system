<?php
    class EventsModel
    {
        private $crud;
        
        function __construct()
        {
            $this->crud = new Crud;
        }


        ///Other functions
        public function fetch_events()
        {
            return $this->crud->fetchData(
                'multi', 'events', '', '', '', '', '', '', 'id', 'DESC', $lim = 0
            );
        }

        public function fetch_event($uid)
        {
            return $this->crud->fetchData(
                'single', 'events', '', '', '', '', 'unique_id', $uid, 'id', 'DESC', $lim = 0
            );
        }

        public function add_event($req)
        {
            $cols = 'event_title, event_date, event_time, event_location';
            $colsArr = explode(', ', $cols);
            $values = [];

            for($i =0; $i<(count($colsArr)); $i++)
            {
                $values[] = $req[$colsArr[$i]];
            }

            return $this->crud->insertData('events', $cols, $values, true);
        }

        public function update_event($req)
        {
            $cols = 'event_title, event_date, event_time, event_location';
            $colsArr = explode(', ', $cols);
            $values = [];

            for($i =0; $i<(count($colsArr)); $i++)
            {
                $values[] = $req[$colsArr[$i]];
            }

            return $this->crud->updateData('events', $cols, $values, 'unique_id', $req['id']);
        }


        public function delete_event($req)
        {
            $cols = explode(', ', $req['cols']);
            $vals = explode(', ', $req['vals']);

            if(count($cols) !== count($vals))
            {
                $res = array(
                    'status'    => 0,
                    'message'   =>  'Unable to handle delete request'
                );
            }else{
                for($i=0; $i<count($cols); $i++) :
                    $res = $this->crud->deleteData('events', $cols[$i], $vals[$i], '=', '');
                endfor;
            }
            
            return $res;
        }
    }
?>