<?php

include_once ("functions.php");
class Docs{
    public $db;
    private $session;
    private $empid;
    public $username;
    public $documentData = array();

    public function __construct() {
        $this->db = new Database();
        $this->session = new SessionManager();
        $this->user = new User($this->db);
        $this->empid = $this->getEmpid();
        $this->username = $this->get_username($this->empid,$this->db);
        $this->prepareDocumentData();
    }

    public function run() {
        $this->renderForm();
        
    }

    public function get_tbisodocerk_variables(){
        $empid=$this->empid;
        $query = "SELECT isodocerkid, isodocid, dateink FROM tbiso_doc_erk WHERE empid = ?";
        $stmt = $this->db->prepare( $query);
    
        // Bind the empid parameter
        $stmt->bind_param( "i", $empid);
    
        // Execute the query
        $stmt->execute();
    
        // Bind the result variables
        $stmt->bind_result( $isodocerkid, $isodocid, $dateink);
    
        // Fetch the results into an array
        $results = array();
        while ($stmt->fetch()) {
            $results[] = array('isodocerkid' => $isodocerkid, 'isodocid' => $isodocid, 'dateink' => $dateink);
        }
    
        // Close the statement for tbiso_doc_erk
        $stmt->close();
    
        return $results;
    }
    public function get_tbisodoc_variables($isodocid){
        $query_tbiso_doc = "SELECT * FROM tbiso_doc WHERE isodocid = ?";
        $stmt_tbiso_doc = $this->db->prepare( $query_tbiso_doc);
        $stmt_tbiso_doc->bind_param( "i", $isodocid);
        $stmt_tbiso_doc->execute();
        $result_tbiso_doc = $stmt_tbiso_doc->get_result();
        $stmt_tbiso_doc->close();
        return $result_tbiso_doc;
    }
    private function renderForm() {
        $name = $this->username;
   
        include('template/docs.php');
    }
    private function get_username(){

        $query = "SELECT empname FROM tbemp WHERE empid = ?";
        $stmt = $this->db->prepare( $query);
        $stmt->bind_param( "i", $this->empid); 
        $stmt->execute();
        $stmt->bind_result( $empname);
        
    
        if ($stmt->fetch()) {
            $name = $empname;
        }
        $stmt->close();
        return $name;
    }
    private function prepareDocumentData()
    {
        $results = $this->get_tbisodocerk_variables();
        foreach ($results as $result) {
            $isodocerkid = $result['isodocerkid'];
            $dateink = $result['dateink'] ? $result['dateink'] : "oboznamit sa";
            $documentData[] = array('isodocerkid' => $isodocerkid, 'dateink' => $dateink);

            $result_tbiso_doc = $this->get_tbisodoc_variables($result['isodocid']);
            while ($row_tbiso_doc = mysqli_fetch_assoc($result_tbiso_doc)) {
                $documentData[count($documentData) - 1]['row'] = $row_tbiso_doc;
            }
        }
        $this->documentData = $documentData;
    }
    private function getEmpid(){
        if ($this->session->get('empid')) {
            return $this->session->get('empid');
        }
        else {
            $this->session->redirect('/');
        }
    }
    public function __destruct() {
        $this->db->close();
    }
}

$view = new Docs();
$view->run();

