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
        $sql = "SELECT id, category, Summary.total FROM categories ";
        $sql .= "JOIN (SELECT COUNT(*) AS total, category_id FROM pages GROUP BY category_id) Summary ";
        $sql .= "WHERE categories.id = Summary.category_id ORDER BY category";

        try {
            $stmt = $this->conn->query($sql);

            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $data = array("error" => false, "items" => $categories);
        
        } catch (PDOException $ex) {
            $data = array("error" => true, "message" => $ex->getMessage());
        }

        return $data;
    }
    
    public function getArticlesByCategory($id) {
        $sql = "SELECT category, pages.id, title, description FROM categories ";
        $sql .= "JOIN pages ON category_id = categories.id ";
        $sql .= "WHERE category_id = :id ORDER BY date_created DESC";

        try {
            $stmt = $this->conn->prepare($sql);
            
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);

            $stmt->execute();

            $pages = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $data = array("error" => false, "items" => $pages);
        
        } catch (PDOException $ex) {
            $data = array("error" => true, "message" => $ex->getMessage());
        }

        return $data;
    }

    public function getArticle($id) {
        $sql = "SELECT id, title, description, content FROM pages WHERE id = :id";

        try {
            $stmt = $this->conn->prepare($sql);
            
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);

            $stmt->execute();

            $page = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $data = array("error" => false, "items" => $page);
        
        } catch (PDOException $ex) {
            $data = array("error" => true, "message" => $ex->getMessage());
        }

        return $data;
    }
}