<?php
require_once '../app/core/QueryBuilder.php';

class Model {
    protected $db;
    protected $queryBuilder; // Declare the property explicitly

    public function __construct() {
        try {
            $this->db = new PDO(DB_DSN, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
        $this->queryBuilder = new QueryBuilder($this->db);
    }

    public function queryBuilder() {
        return $this->queryBuilder;
    }
}