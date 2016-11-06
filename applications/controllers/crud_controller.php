<?php
/* 
	Nama 	:	Muhammad Ryan Fadholi
	NIM 	:	09021181419006
*/
require_once("../models/jobseeker.php");
require_once("../daos/dao.php");

class CRUDController {
	var $email;
	var $action;
	var $out;
	
	public function __construct() {
		$this->email =$_POST['email'];
		$this->action=$_POST['act'];
		$this->dao = new Dao("pweb");
	}
	
	public function run() {
		switch($this->action) {
			case "getuserbyemail" :
				$this->getuserbyemail($this->email);
			break;
		}
	}
	
	function register() {
		$jobseeker = new Jobseeker($this->nama, $this->ktp_id, $this->gender, $this->birthplace, $this->birthdate, $this->address, $this->email);
		$this->out = $jobseeker->dao->insert("jobseeker_registration", $jobseeker->getValuesForInsert());
		echo $this->out;
	}

	function getuserbyemail($email) {
		$this->out = $this->dao->getuserbyemail($email);
		echo json_encode($this->out);
	}
}
$crudcon = new CRUDController();
$crudcon->run();
//*/
?>