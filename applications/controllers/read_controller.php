<?php
/* 
	Nama 	:	Muhammad Ryan Fadholi
	NIM 	:	09021181419006
*/
require_once("../models/jobseeker.php");

class ReadController {
	var $JobSeeker;
	
	public function __construct($email) {
		if(!is_array($email)){	
			$this->JobSeeker = getJobseekerByEmail($email);
		}
	}
	
	public function run() {
		switch($this->action) {
			case "getuserbyemail" :
				$this->getuserbyemail($this->email);
				break;
			case "searchall" :
				$this->getuserbyemail($this->email);
				break;
			break;
		}
	}

	public function getObject() {
		return $this->JobSeeker;
	}

	public function getObjectAsArray() {
		return (array) $this->JobSeeker;
	}

	public function getObjectAsJSON() {
		return json_encode($this->JobSeeker);
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

//*/
?>