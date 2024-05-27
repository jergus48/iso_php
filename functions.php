<?php
include ("database.php");
class User {
    private $db;
    public $empid;
    public $empname;
    private $pin;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function loadUserById($empid) {
        $this->empid = $empid;
        $query = "SELECT empname, pin FROM tbemp WHERE empid = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $this->empid);
        $stmt->execute();
        $stmt->bind_result($this->empname, $this->pin);

        if ($stmt->fetch()) {
            return true;
        } else {
            return false;
        }

        $stmt->close();
    }

    public function verifyPassword($password) {
        return $password === $this->pin;
    }
}


class SessionManager {
    public function __construct() {
        session_start();
    }

    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function get($key) {
        return $_SESSION[$key] ?? null;
    }

    public function redirect($url) {
        header("Location: $url");
        exit();
    }
}