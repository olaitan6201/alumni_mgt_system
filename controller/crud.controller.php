<?php
    /*
    ---
    ---------------------------------------------------------FUNCTIONS LIST--------------------------------------------------------------
    ---
    ---
    ---* insertData($tblName='', $cols='', $values = [], $enable_uid=false)             --- Returns $res[]
    ----------
    ----------
    ---
    ---* updateData($tblName='', $cols='', $values = [], $refId='', $refVal='')         --- Returns $res[]
    ----------
    ----------
    ---
    ---* fetchData($type='single', $tblName='', $joins='', $tblRef='', $joinsRef='', $joinsRefType='', $fId='', $fVal, 
    -        $orderRef='', $orderType='ASC', $lim = 0)                                  --- Returns $res[], data_fetched[PDO::FETCH_OBJ]
    ----------
    ----------
    ---
    ---* checkData($tblName='', $checkIds='', $checkVals=[], $checkOpera='=', $checkDelim='')            ---Returns $res[]
    ----------
    ----------
    ---
    ---* uploadFile($ref, $new_name, $target, $mimes='', $maxSize)                      --- Returns $res[], $new_name, ""
    ----------
    ----------
    ---
    ---* fetchDataSum($tblName='', $ref='', $fId='', $fVal, $fOpera)                    --- Returns data_fetched[PDO::FETCH_OBJ]
    ----------
    ----------
    ---
    ---* fetchDataCount($tblName='', $ref='', $fId='', $fVal, $fOpera)                  --- Returns data_fetched[PDO::FETCH_OBJ]
    ----------
    ----------
    ---
    ---*deleteData($tblName='', $fIds='', $fVals='', $fOperas='', $fDelims='')          --- Returns $res[]
    ----------
    ----------
    ---
    ---
    ---
    ---
    */
    class CRUD{
        private $db;

        function __construct()
        {
            $this->db = new Database;
        }


        // Insert Data to Database
        public function insertData($tblName='', $cols='', $values = [], $enable_uid=false)
        {
            $cols = explode(', ', $cols);

            if(!is_array($values)){
                $res = array(
                    'status'    =>  0,
                    'message'   =>  'Values are expected as an array params'
                );
            }
            elseif(count($cols) !== count($values))
            {
                $res = array(
                    'status'    =>  0,
                    'message'   =>  'Number of Data and values supplied does not match'
                );
            }else{
                $stmt = "INSERT into ".$tblName." set ";
                $uid = uniqid();
                if($enable_uid) $stmt.= 'unique_id = "'.$uid.'", ';

                for($i=0; $i<=(count($cols)-1); $i++)
                {
                    if($i < (count($cols)-1)) :
                        $stmt.= $cols[$i].' = "'.$values[$i].'", ';
                    else :
                        $stmt.= $cols[$i].' = "'.$values[$i].'"';
                    endif;
                }
                // exit($stmt);
                $this->db->query = $stmt;

                if($this->db->execute())
                {
                    $res = array(
                        'status'    =>  1,
                        'message'   =>  'Data added successfully',
                        'uid'       =>  $uid
                    );   
                }else{
                    $res = array(
                        'status'    =>  0,
                        'message'   =>  'Unable to add data, check your connection'
                    );
                }
            }

            return $res;
        }

        //Update Data in Database
        public function updateData($tblName='', $cols='', $values = [], $refId='', $refVal='')
        {
            $cols = explode(', ', $cols);

            if(!is_array($values)){
                $res = array(
                    'status'    =>  0,
                    'message'   =>  'Values are expected as an array params'
                );
            }
            elseif(count($cols) !== count($values))
            {
                $res = array(
                    'status'    =>  0,
                    'message'   =>  'Number of Data and values supplied does not match'
                );
            }else{
                $stmt = "UPDATE ".$tblName." set ";

                for($i=0; $i<=(count($cols)-1); $i++)
                {
                    if($i < (count($cols)-1)) :
                        $stmt.= $cols[$i].' = "'.$values[$i].'", ';
                    else :
                        $stmt.= $cols[$i].' = "'.$values[$i].'" ';
                    endif;
                }

                $stmt.= 'where '.$refId.' = "'.$refVal.'"';
                // exit($stmt);
                $this->db->query = $stmt;

                if($this->db->execute())
                {
                    $res = array(
                        'status'    =>  1,
                        'message'   =>  'Data updated successfully'
                    );   
                }else{
                    $res = array(
                        'status'    =>  0,
                        'message'   =>  'Unable to update data, check your connection'
                    );
                }
            }

            return $res;   
        }


        ///Fetch Data From Database
        public function fetchData(
            $type='single', $tblName='', 
            $joins='', $tblRef='', $joinsRef='', $joinsRefType='', 
            $fId='', $fVal, 
            $orderRef='', $orderType='ASC', $lim = 0
        ){
            $res = '';
            if(strpos($tblRef, ',')){
                $res = array(
                    'status'    =>  0,
                    'message'   =>  'Table join ref expects one param'
                );
            }
            elseif(
                ($joinsRefType == 'single' AND strpos(',', $joinsRef) == true) 
                OR 
                ($joinsRefType == 'multi' AND strpos(',', $joinsRef) == false)
            ){
                $res = array(
                    'status'    =>  0,
                    'message'   =>  'Joins params does not match with type'
                );
            }else{
                $stmt = 'SELECT * from '.$tblName.' ';
                
                if(!empty($joins)){
                    $joins = explode(', ', $joins);

                    if($joinsRefType == 'single')
                    {
                        for($i=0; $i<=(count($joins)-1); $i++)
                        {
                            $stmt.= 'INNER JOIN '.$joins[$i].' on '.$tblName.'.'.$tblRef.' = '.$joins[$i].'.'.$joinsRef.' ';
                        }
                    }
                    elseif($joinsRefType == 'multi')
                    {
                        $joinsRef = explode(', ', $joinsRef);

                        for($i=0; $i<=(count($joins)-1); $i++)
                        {
                            $stmt.= 'INNER JOIN '.$joins[$i].' on '.$tblName.'.'.$tblRef.' = '.$joins[$i].'.'.$joinsRef.' ';
                        }
                    }
                }

                if(!empty($fId)) $stmt.='WHERE '.$tblName.'.`'.$fId.'` = "'.$fVal.'" ';

                if(!empty($orderRef)) $stmt.='ORDER BY '.$tblName.'.'.$orderRef.' '.$orderType.' ';

                if($lim !== 0) $stmt.='LIMIT '.$lim;

            }

            // exit($stmt);
            $this->db->query = $stmt;
            if(empty($res)) :
                if($type == 'single') : return $this->db->fetch();
                elseif($type == 'multi') : return $this->db->fetchAll();
                else : return ['status'=>0, 'message'=>'Fetch type can only be single or multi'];
                endif;
            else :
                return $res;
            endif;
        }



        ///Check Data in Database
        public function checkData($tblName='', $checkIds='', $checkVals=[], $checkOpera='=', $checkDelim='')
        {

            $checkIds = explode(', ', $checkIds);

            if(!is_array($checkVals)){
                $res = array(
                    'status'    =>  0,
                    'message'   =>  'Check Values are expected as an array params'
                );
            }
            elseif(count($checkIds) !== count($checkVals))
            {
                $res = array(
                    'status'    =>  0,
                    'message'   =>  'Number of Check IDs and Check Values supplied does not match'
                );
            }else{
                $stmt = 'SELECT * from '.$tblName.' where ';

                for($i=0; $i<=(count($checkIds) -1); $i++)
                {
                    if($i < (count($checkIds) -1))
                    {
                        $stmt .= $checkIds[$i].' '.$checkOpera.' "'.$checkVals[$i].'" '.$checkDelim.' ';
                    }else{
                        $stmt.= $checkIds[$i].' '.$checkOpera.' "'.$checkVals[$i].'"';
                    }
                }

                $this->db->query = $stmt;

                if($this->db->rowCount() > 0)
                {
                    $res = array(
                        'status'    =>  0,
                        'message'   =>  'Data already exist'
                    );
                }else{
                    $res = array(
                        'status'    =>  1,
                        'message'   =>  'Data not found'
                    );
                }
            }

            return $res;
        }

        public function uploadFile($ref, $new_name, $target, $mimes='', $maxSize)
        {
            if(!empty($ref['name']))
            {
                $mimes = explode(', ', $mimes);

                $extension = pathinfo($ref['name'], PATHINFO_EXTENSION);

                $isType = false;
                $isSize = false;

                $fileSize = trim(str_replace('mb', '', strtolower($maxSize)));
                
                if(in_array($extension, $mimes)){
                    $isType = true;
                }

                if(!strpos(strtolower($maxSize), 'mb')){
                    $res = array(
                        'status'    =>  0,
                        'message'   =>  'Max file size is expected in MB'
                    );
                }
                elseif($ref['size'] > (intval($fileSize)*1024*1024)){
                    $res = array(
                        'status'    =>  0,
                        'message'   =>  'Invalid file size'
                    );                    
                }
                elseif(!$isType)
                {
                    $res = array(
                        'status'    =>  0,
                        'message'   =>  'Invalid file format'
                    );
                }
                else{
                    $new_name = $new_name . '.' . $extension;
    
                    $_source_path = $ref['tmp_name'];
    
                    $target_path = $target . $new_name;
    
                    move_uploaded_file($_source_path, $target_path);
                    
                    $res = $new_name;
                }
            }else{
                $res = '';
            }

            return $res;
        }


        public function fetchDataSum($tblName='', $ref='', $fId='', $fVal, $fOpera)
        {
            $stmt = 'SELECT sum('.$ref.') as data_sum from '.$tblName.' ';

            if(!empty($fId)) $stmt.='where '.$fId.' '.$fOpera.' "'.$fVal.'"';


            $this->db->query = $stmt;

            return $this->db->fetch();
        }

        public function fetchDataCount($tblName='', $ref='', $fId='', $fVal, $fOpera)
        {
            $stmt = 'SELECT count('.$ref.') as data_count from '.$tblName.' ';

            if(!empty($fId)) $stmt.='where '.$fId.' '.$fOpera.' "'.$fVal.'"';

            $this->db->query = $stmt;

            return $this->db->fetch();
        }


        function deleteData($tblName='', $fIds='', $fVals='', $fOperas='', $fDelims='')
        {
            if(!is_string($fIds))
            {
                $res = array(
                    'status'    =>  0,
                    'message'   => 'Table reference ids are expected as a string'
                );
            }
            elseif(!is_string($fVals))
            {
                $res = array(
                    'status'    =>  0,
                    'message'   => 'Table reference values are expected as an array'
                );
            }
            else{
                $ref = explode(', ', $fIds);
                $fVals = explode(', ', $fVals);
                $opera = explode(', ', $fOperas);
                $delim = explode(', ', $fDelims);

                if(count($ref) !== count($fVals))
                {
                    $res = array(
                        'status'    =>  0,
                        'message'   => 'Number of Table reference ids and values does not match'
                    );
                }else{
                    $stmt = 'DELETE from '.$tblName.' where ';

                    for($i=0; $i<=(count($ref)-1); $i++)
                    {
                        if($i < (count($ref)-1))
                        {
                            if(count($opera) == 1)
                            {
                                $stmt .= $ref[$i].' '.$opera[0].' "'.$fVals[$i].'" '.$delim[0].' ';
                            }else{
                                $stmt .= $ref[$i].' '.$opera[$i].' "'.$fVals[$i].'" '.$delim[$i].' ';
                            }
                        }else{
                            if(count($opera) == 1)
                            {
                                $stmt .= $ref[$i].' '.$opera[0].' "'.$fVals[$i].'"';
                            }else{
                                $stmt .= $ref[$i].' '.$opera[$i].' "'.$fVals[$i].'"';
                            }
                        }
                    }
                    // exit($stmt);
                    $this->db->query = $stmt;

                    if($this->db->execute()){
                        $res = array(
                            'status'    =>  1,
                            'message'   =>  'Data deleted successfully'
                        );
                    }else{
                        $res = array(
                            'status'    =>  0,
                            'message'   =>  'Unable to delete selected data'
                        );
                    }
                }
    
            }
            return $res;
        }
    }
?>