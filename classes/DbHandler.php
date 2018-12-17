<?php

class DbHandler {
    private $conn;

    public function __construct() {
        // require_once dirname(__FILE__) . "/DbConnect.php";
        require_once "DbConnect.php";
        
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    public function getCategoryList() {
        $sql = "SELECT * FROM categories";

        try {
            $stmt = $this->conn->query($sql);

            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $data = array("error" => false, "items" => $categories);
        
        } catch (PDOException $ex) {
            $data = array("error" => true, "message" => $ex->getMessage());
        }

        return $data;
    }
}