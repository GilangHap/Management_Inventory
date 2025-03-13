<?php
class Koneksi {
    private static $instance = null;
    public $db;

    private function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=inventaris', 'root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Koneksi();
        }
        return self::$instance->db;
    }
}
?>
