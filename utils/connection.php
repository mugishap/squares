<?php

class Connection{
private $host;
private $user;
private $pass;
private $db;
private $connection;

    public function __construct(){
        $this->host = "127.0.0.1";
        $this->user = "root";
        $this->pass = "";
        $this->db = "squares";
    }

    public function connect(){
        $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if($this->connection->connect_error){
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function close(){
        $this->connection->close();
    }

}

?>