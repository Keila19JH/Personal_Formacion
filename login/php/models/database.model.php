<?php 

    class Database {

        var $numberRows;
        var $last_id;

        private $host;
        private $dbName;
        private $username;
        private $password;

        public function __construct($host, $dbName, $username, $password){

            $this->host = $host;
            $this->dbName = $dbName;
            $this->username = $username;
            $this->password = $password;
            
        }

        function getConnections(){

            $connection = mysqli_connect($this->host,  $this->username, $this->password, $this->dbName);

            if(!$connection){
                printf("Could not connect to database");
                exit();
            }
            $connection->set_charset("utf8");
            return $connection;

        }

        function closeConnection($param){
            mysqli_close($param);
        }

        //query to get All data
        function getRows($params){

            $all = array();
            $this->numberRows;
            $onConnection = $this->getConnections();

            if( $resultado = mysqli_query($onConnection, $params) ){

                $this->numberRows = $resultado->num_rows;

                while($fila = $resultado->fetch_array() ){
                    $all[]=$fila;
                }

                $this->closeConnection($onConnection);
                return $all;

            }

        }

        //Query to search an simple data
        function getSimple($params){

            $onConnection = $this->getConnections();
            $rows = mysqli_query($onConnection, $params);
            $records = $rows->fetch_array();

            $this->closeConnection($onConnection);

            return $records[0];
        
        }

        //Basic Querys
        function ShotSimple($param){
            $oconn = $this->GetConnections();
            mysqli_query($oconn,$param);
            $this->last_id = $oconn->insert_id;
            $this->closeConnection($oconn);
        }



    }


?>