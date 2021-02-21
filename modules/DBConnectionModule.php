<?php
include_once('Environment.php');

class DBconnectionModule{
    public $connection;
    public function __construct(){
        //Timezone
        date_default_timezone_set(TIME_ZONE);

        //DB connection query
        $this->connection = new mysqli(HOST, USER, PASSWORD, DB_NAME);
        if(mysqli_connect_error()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            die();
        }
    }
}
?>