<?php
/* 
	Nama 	:	Muhammad Ryan Fadholi
	NIM 	:	09021181419006
*/
require_once("../models/jobseeker.php");

class RegistrationController {
	var $nama;
	var $ktp_id;
	var $gender;
	var $birthplace;
	var $birthdate;
	var $address;
	var $email;
	var $action;
	var $out;
	
	public function __construct() {
		$this->email=$_POST['email'];
		$this->nama=$_POST['name'];
		$this->ktp_id=$_POST['ktp_id'];
		$this->address=$_POST['address'];
		$this->gender=$_POST['gender'];
		$this->birthplace=$_POST['birthplace'];
		$this->birthdate=$_POST['birthdate'];
		$this->action=$_GET['action'];
	}
	
	public function run() {
		switch($this->action) {
			case "register" :
				$this->register();
			break;
		}
	}
	
	function register() {
		$jobseeker = new Jobseeker($this->nama, $this->ktp_id, $this->gender, $this->birthplace, $this->birthdate, $this->address, $this->email);
		$this->out = $jobseeker->dao->insert("jobseeker_registration", $jobseeker->getValuesArray());
		echo $this->out;
	}
}
$regcon = new RegistrationController();
$regcon->run();
//*/
?>