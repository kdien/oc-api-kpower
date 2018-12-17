<?php

class DbConnect {
    private $conn;

    public function __construct() {
        
    }

    function connect() {
        require_once dirname($_SERVER['DOCUMENT_ROOT']) . "/DBConn/2018_api_connect.php";

        $this->conn = new PDO("mysql:host=" . DB_HOST. ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);

        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $this->conn;
    }
}