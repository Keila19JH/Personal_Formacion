<?php 

    class Database {

        var $numberRows;  //Almacena el número de filas devueltas en una consulta.
        var $last_id;

        private $host;
        private $dbName;
        private $username;
        private $password;

        //Recibe parámetros necesarios para conectarse a la BD 
        public function __construct($host, $dbName, $username, $password){
            // Y los asigna a las propiedades de la clase Database
            $this->host = $host;
            $this->dbName = $dbName;
            $this->username = $username;
            $this->password = $password;
            
        }
        //Establece la conexión con la BD
        function getConnections(){

            $connection = mysqli_connect($this->host,  $this->username, $this->password, $this->dbName);

            if(!$connection){
                printf("Could not connect to database");
                exit();
            }
            $connection->set_charset("utf8");
            return $connection;

        }
        //Cierra la conexión con la BD
        function closeConnection($param){
            mysqli_close($param);
        }

        //query to get All data
        function getRows($params){

            $all = array();
            $this->numberRows; //Asigna el número de filas encontradas
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
            
            //Devuelve un único valor al ejecutar una consulta SELECT COUNT(*)
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

        // Función para realizar un insert
        function insertData($table, $data) {
            $columns = implode(", ", array_keys($data));
            $values = "'" . implode("', '", array_map(array($this, 'escapeString'), array_values($data))) . "'";
            $query = "INSERT INTO $table ($columns) VALUES ($values)";

            $onConnection = $this->getConnections();
            if (mysqli_query($onConnection, $query)) {
                $this->last_id = $onConnection->insert_id;
                $this->closeConnection($onConnection);
                return $this->last_id;
            } else {
                $error_message = mysqli_error($onConnection);
                $this->closeConnection($onConnection);
                return "Error en la inserción: $error_message";
            }
        }

        // Función para realizar un update
        function updateData($table, $data, $whereColumn, $whereValue) {
            $updateValues = '';
            foreach ($data as $key => $value) {
                $updateValues .= "$key = '" . $this->escapeString($value) . "', ";
            }
            $updateValues = rtrim($updateValues, ', ');
        
            $query = "UPDATE $table SET $updateValues WHERE $whereColumn = '" . $this->escapeString($whereValue) . "'";
        
            $onConnection = $this->getConnections();
            
            if (mysqli_query($onConnection, $query)) {
                $rowsAffected = mysqli_affected_rows($onConnection);
                $this->closeConnection($onConnection);
                return $rowsAffected;
            } else {
                $error_message = mysqli_error($onConnection);
                $this->closeConnection($onConnection);
                return "Error en la actualización: $error_message";
            }
        }

        function deleteData( $table, $whereColumn, $whereValue){
            
            $whereValue = $this-> escapeString( $whereValue );
            $query = "DELETE FROM $table WHERE $whereColumn = '$whereValue'";
            $onConnection = $this->getConnections();
            $result = mysqli_query( $onConnection, $query );

            if( $result ){
                
                return mysqli_affected_rows( $onConnection );

            }else{
                return "Error al eliminar: ". mysqli_error( $onConnection );
            }

            $this -> closeConnection( $onConnection );

        }

    
        // Función para escapar cadenas y evitar inyección SQL
        function escapeString($value) {
            $onConnection = $this->getConnections();
            $escaped_value = mysqli_real_escape_string($onConnection, $value);
            $this->closeConnection($onConnection);
            //Abre y cierra una conexión temporalmente para realizar el escape.
            return $escaped_value;
        }

        function deleteRow($params) {
            $onConnection = $this->getConnections();

            // Ejecutar la consulta de eliminación
            mysqli_query($onConnection, $params);

            // Cerrar la conexión
            $this->closeConnection($onConnection);
        }

    }

?>
