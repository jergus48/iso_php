<?php
include_once ("functions.php");
class System{
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $code = $_POST['code'];
            $code = $this->convertSlovakKeyboardToNumbers($code);
            if ($this->user->loadUserByCode($code)) {
                $this->handlePostRequest($code);
            }
            else {
                echo "<script>alert('uživateľ sa nenašiel, skuste to znova');</script>";
                $this->renderForm();
            }
        }
        else {
                $this->renderForm();
            }

        
    
    }
    private function handlePostRequest($code) {
        if ($this->user->verifyCode($code)) {
            $empid=$this->user->getEmpid();
            $this->session->set('empid', $empid);
            $this->session->redirect('/docs.php/');
        } else {
            echo "<script>alert('Nesprávny kod');</script>";
            $this->renderForm();
        }
    }
    private function convertSlovakKeyboardToNumbers($code) {
        $code = mb_strtolower($code, 'UTF-8');
        $conversionMap = [
            'é' => '0',
            '+' => '1', 
            'ľ' => '2',
            'š' => '3',
            'č' => '4',
            'ť' => '5',
            'ž' => '6',
            'ý' => '7',
            'á' => '8',
            'í' => '9',
        ];
        
        return strtr($code, $conversionMap);
    }

    private function renderForm() {
        $name = $this->user->empname;
        include('template/system.php');
    }

    public function __destruct() {
        $this->db->close();
    }
}

$view = new System();
$view->run();

