<?php
    class Database
    {
        protected $dbHost;
        protected $dbName;
        protected $dbPass;
        protected $dbUser;

        var $connect;
        var $query;
        var $data;
        var $statement;
        var $filedata;

        var $error;

        function __construct(){
            $this->dbHost = DB_HOST;
            $this->dbName = DB_NAME;
            $this->dbPass = DB_PASS;
            $this->dbUser = DB_USER;

            $con = 'mysql:host='.$this->dbHost . ';dbname=' . $this->dbName;

            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            try{
                $this->connect = new PDO($con, $this->dbUser, $this->dbPass, $options);
            // $this->connect = new \PDO("mysql:host=$this->dbHost; dbname=$this->dbName", "$this->dbUser", "$this->dbPass");
            }catch(PDOException $e){
                $this->error = $e->getMessage();
                exit($this->error);
            }
        }

        public function execute(){            
            $this->statement = $this->connect->prepare($this->query);
            return $this->statement->execute($this->data);
        }

        public function fetchAll(){
            $this->execute();
            return $this->statement->fetchAll(PDO::FETCH_OBJ);
        }

        public function fetch(){
            $this->execute();
            return $this->statement->fetch(PDO::FETCH_OBJ);
        }

        public function rowCount(){
            $this->execute();
            return $this->statement->rowCount();
        }

        public function verifyInput($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    }
?>