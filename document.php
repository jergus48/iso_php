<?php
include_once (" functions.php");

class Document{
    public $db;
    private $session;
    private $empid;
    public $username;

    public $documentData;

    public function __construct() {
        $this->db = new Database();
        $this->session = new SessionManager();
        $this->empid = $this->getEmpid();
        $this->username = $this->get_username($this->empid);
        $this->documentData = $this->prepareData();
    }

    public function run() {
        $this->renderForm();
    }

    private function prepareData() {
        if (isset($_GET['id'])) {
            $isodocerkid = $_GET['id'];
            $query = "SELECT empid, isodocid, dateink FROM tbiso_doc_erk WHERE isodocerkid = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i", $isodocerkid);
            $stmt->execute();
            $stmt->bind_result($empid, $isodocid, $dateink);
            $stmt->fetch();
            $stmt->close();
          

            $documentData = array(
                'isodocerkid' => $isodocerkid,
                'isodocid' => $isodocid,
                'dateink' => $dateink,
                'empid' => $this->empid,
                'files_tbiso_doc' => $this->get_tbiso_doc_file_variables($isodocid)
            );

            return $documentData;
        }
        return null;
    }

    public function get_tbiso_doc_file_variables($isodocid) {
        $query_tbiso_doc_file = "SELECT * FROM tbiso_doc_file WHERE isodocid = ?";
        $stmt_tbiso_doc = $this->db->prepare($query_tbiso_doc_file);
        $stmt_tbiso_doc->bind_param("i", $isodocid);
        $stmt_tbiso_doc->execute();
        $result_tbiso_doc = $stmt_tbiso_doc->get_result();
        $files = [];
        while ($row = $result_tbiso_doc->fetch_assoc()) {
            $files[] = $row;
        }
        $stmt_tbiso_doc->close();
        return $files;
    }

    private function renderForm() {
        $name = $this->username;
        $isodocname = $this->get_tbiso_doc_name();
        include('template/document.php');
    }

    private function get_username() {
        $query = "SELECT empname FROM tbemp WHERE empid = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $this->empid);
        $stmt->execute();
        $stmt->bind_result($empname);
        $stmt->fetch();
        $name = $empname;
        $stmt->close();
        return $name;
    }

    private function getEmpid() {
        if ($this->session->get('empid')) {
            return $this->session->get('empid');
        } else {
            $this->session->redirect('/');
        }
    }

    public function get_tbiso_doc_name() {
        $isodocid = $this->documentData['isodocid'];
        $query_tbiso_doc = "SELECT isodocname FROM tbiso_doc WHERE isodocid = ?";
        $stmt_tbiso_doc_name = $this->db->prepare($query_tbiso_doc);
        $stmt_tbiso_doc_name->bind_param("i", $isodocid);
        $stmt_tbiso_doc_name->execute();
        $stmt_tbiso_doc_name->bind_result($isodocname);
        $stmt_tbiso_doc_name->fetch();
        $stmt_tbiso_doc_name->close();
        return $isodocname;
    }

    public function __destruct() {
        $this->db->close();
    }
}

$view = new Document();
$view->run();
