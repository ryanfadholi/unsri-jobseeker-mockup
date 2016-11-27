<?php
/* 
	Nama 	:	Muhammad Ryan Fadholi
	NIM 	:	09021181419006
*/
require_once( __DIR__. '/../models/jobseeker.php');
require_once( __DIR__. '/../daos/dao.php');

class CRUDController {
	var $email;
	var $action;
	var $out;

	var $name;
	var $ktp_id;
	var $gender;
	var $birthplace;
	var $birthdate;
	var $address;
	
	public function __construct ($email = NULL) {

		$this->dao = new Dao("pweb");

		if(is_array($email)){
			return;
		}
		if(isset($email)){
			$this->email = $email;
			return;
		}
		
		if(isset($_POST['email'])){
			$this->email=$_POST['email'];
		}

		if(isset($_POST['act'])){
			$this->action=$_POST['act'];
		}

		if(isset($_POST['name'])){
			$this->name=$_POST['name'];
		}

		if(isset($_POST['ktp_id'])){
			$this->ktp_id=$_POST['ktp_id'];
		}
		if(isset($_POST['address'])){
			$this->address=$_POST['address'];
		}
		if(isset($_POST['gender'])){
			$this->gender=$_POST['gender'];
		}
		if(isset($_POST['birthplace'])){
			$this->birthplace=$_POST['birthplace'];
		}
		if(isset($_POST['birthdate'])){
			$this->birthdate=$_POST['birthdate'];
		}
	}
	
	public function run() {
		switch($this->action) {
			case "delete":
				$this->delete($_POST['email']);
				break;
			case "getuserbyemail" :
				$this->getuserbyemail($this->email);
				break;
			case "update":
				$this->update();
				break;
			break;
		}
	}
	
	function delete($email) {
   	$this->out = $this->dao->delete($email);
      return $this->out;
    }

	function register() {
		$jobseeker = new Jobseeker($this->name, $this->ktp_id, $this->gender, $this->birthplace, $this->birthdate, $this->address, $this->email);	
		$this->out = $jobseeker->dao->insert("jobseeker_registration", $jobseeker->getValuesArray());
		echo $this->out;
	}

	function update(){
		$jobseeker = new Jobseeker($this->name, $this->ktp_id, $this->gender, $this->birthplace, $this->birthdate, $this->address, $this->email);
		$this->out = $jobseeker->dao->update($jobseeker->getValuesArray());
		echo $this->out;
	}

	function getuserbyemail($email, $shouldEchoResult = true) {
		$this->out = $this->dao->getuserbyemail($email);

		//Check if it's a PHP or AJAX request from the parameter flag.
		if($shouldEchoResult){
			 echo json_encode($this->out);
		} else {
			return $this->out;
		}
	}

	function search($search_query, $shouldEchoResult = true){
		$this->out = $this->dao->search($search_query);

		//Check if it's a PHP or AJAX request from the parameter flag.
		if($shouldEchoResult){
			 echo json_encode($this->out);
		} else {
			return $this->out;
		}
	}

	function viewall($start, $rows, $shouldEchoResult = true){
		$this->out = $this->dao->viewall($start,$rows);

		//Check if it's a PHP or AJAX request from the parameter flag.
		if($shouldEchoResult){
			 echo json_encode($this->out);
		} else {
			return $this->out;
		}
	}
}

if(isset($_GET['isajaxcall'])){
	$isajaxcall	= $_GET['isajaxcall'];
} else {
	$isajaxcall = true;
}

if($isajaxcall){
	$crudcon = new CRUDController();
	$crudcon->run();
}

?>