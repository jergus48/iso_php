<?php
include_once ("functions.php");
class Login{
    private $db;
    private $session;
    private $user;

    public function __construct() {
        $this->db = new Database();
        $this->session = new SessionManager();
        $this->user = new User($this->db);
    }

    public function run() {
        if ($this->session->get('empid')) {
            $this->session->redirect('/docs.php/');
        }

        if (isset($_GET['user'])) {
            $empid = $_GET['user'];
            if ($this->user->loadUserById($empid)) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->handlePostRequest($empid);
                } else {
                    $this->renderForm();
                }
            } else {
                echo "Employee not found.";
            }
        } else {
            echo "No user provided in the URL.";
        }
    }

    private function handlePostRequest($empid) {
        $password = $_POST['password'];
        if ($this->user->verifyPassword($password)) {
            $this->session->set('empid', $empid);
            $this->session->redirect('/docs.php/');
        } else {
            echo "<script>alert('Nesprávne heslo');</script>";
            $this->renderForm();
        }
    }

    private function renderForm() {
        $name = $this->user->empname;
        include('template/login.php');
    }

    public function __destruct() {
        $this->db->close();
    }
}

$view = new Login();
$view->run();

