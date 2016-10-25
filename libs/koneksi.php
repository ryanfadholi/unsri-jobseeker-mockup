<?php 

class Koneksi{
	var $link;
	var $host;
	var $user;
	var $password;
	var $database;

	public function __construct(){
		$this->host="localhost";
		$this->user="root";
		$this->password="";
		$this->database="pweb";
	}

	public function Connect(){
		$this->link = mysqli_connect($this->host,$this->user,$this->password);

		if(!$this->link){
			die("gagal sambung ke server db");
		}
		else{
			if(!mysqli_select_db($this->link, $this->database)){
				die("gagal sambung ke database");
			}
		}
	}

	public function Disconnect(){
		@mysqli_close();
	}
}

?>