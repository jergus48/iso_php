<?php

date_default_timezone_set('Europe/Bratislava');


class Database {
    private $host = 'localhost:5000';
    private $user = 'Jergus Snahnican';
    private $pass = 'password';
    private $dbname = 'database';
    public $conn;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function prepare($query) {
        return $this->conn->prepare($query);
    }

    public function close() {
        $this->conn->close();
    }
}


