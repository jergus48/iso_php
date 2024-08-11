<?php
include ("database.php");
class User {
    private $db;
    public $empid;
    public $empname;
    private $pwd;
    private $dkey;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function loadUserById($empid) {
        $this->empid = $empid;
        $query = "SELECT empname, pwd FROM tbemp WHERE empid = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $this->empid);
        $stmt->execute();
        $stmt->bind_result($this->empname, $this->pwd);

        if ($stmt->fetch()) {
            return true;
        } else {
            return false;
        }

        $stmt->close();
    }
    public function loadUserByCode($code) {
        $this->dkey = $code;
        $query = "SELECT empname, empid, pwd FROM tbemp WHERE dkey = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $this->dkey);
        $stmt->execute();
        $stmt->bind_result($this->empname, $this->empid,$this->pwd);

        if ($stmt->fetch()) {
            return true;
        } else {
            return false;
        }

        $stmt->close();
    }
    public function getEmpid() {
        return $this->empid;
    }
    public function verifyPassword($password) {
        return $password === $this->pwd;
    }
    public function verifyCode($code) {
        return $code === $this->dkey;
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