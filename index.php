<?php
include_once ("classes.php");
class UserList {
    private $db;
    private $session;
    private $users;

    public function __construct() {
        $this->db = new Database();
        $this->session = new SessionManager();
        $this->checkSession();
        $this->fetchUsers();
    }

    private function checkSession() {
        if ($this->session->get('empid')) {
            $this->session->redirect("/docs.php");
        }
    }

    private function fetchUsers() {
        $query = "SELECT empid, empname FROM tbemp";
        $result = $this->db->conn->query($query);
        if ($result->num_rows > 0) {
            $this->users = $result;
        } else {
            $this->users = null;
        }
    }

    public function render() {
        include_once("template/index.php");
    }

    public function closeConnection() {
        $this->db->close();
    }
}

$userList = new UserList();
$userList->render();
$userList->closeConnection();
?>
