<?php
/* 
	name 	:	Muhammad Ryan Fadholi 
	NIM 	:	09021281419050
*/

require_once("../daos/dao.php");

class JobSeeker {
	// attributes
	var $name;
	var $ktp_id;
	var $gender;
	var $birthplace;
	var $birthdate;
	var $address;
	var $email;
	var $dao;
	
	// method
	public function __construct($_name=NULL, $_ktp_id=NULL, $_gender=NULL, $_birthplace=NULL, $_birthdate=NULL, $_address=NULL, $_email=NULL) {
		$this->setName($_name);
		$this->setKtpId($_ktp_id);
		$this->setGender($_gender);
		$this->setBirthplace($_birthplace);
		$this->setBirthdate($_birthdate);
		$this->setAddress($_address);
		$this->setEmail($_email);
		$this->dao = new Dao("pweb");
	}
	
	//setter
	public function setName($input) {
		$this->name = $input;
	}
	
	public function setKtpId($input) {
		$this->ktp_id = $input;
	}
	
	public function setGender($input) {
		$this->gender = $input;
	}
	
	public function setBirthplace($input) {
		$this->birthplace = $input;
	}
	
	public function setBirthdate($input) {
		$this->birthdate = $input;
	}
	
	public function setAddress($input) {
		$this->address = $input;
	}
	
	public function setEmail($input) {
		$this->email = $input;
	}
	
	//getter
	public function getValuesForInsert() {
		return "('$this->name', '$this->ktp_id', '$this->gender', '$this->birthplace', '$this->birthdate', '$this->address', '$this->email')";
	}
	public function getValuesArray() {
		return array('name' => $this->name, 'ktp_id' => $this->ktp_id, 'gender' => $this->gender, 'birthplace' => $this->birthplace,
		'birthdate' => $this->birthdate, 'address' => $this->address, 'email' => $this->email);
	}
}
?>