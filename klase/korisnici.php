<?php

/**
 * Klasa koja ce nam DOOOOOOOOOSTAAAA pomoci prilikom rada sa korisnicima tj korisnikom 
 */
class Users{

	private $conn;	
	private $userid;
	private $username;
	private $password;
	private $novipassword;
	function __construct($conn){
		$this->conn = $conn;
	}

	function getUsers(){
	$getUsers = $this->conn->prepare("SELECT * FROM users");
	$getUsers->execute();
	return $getUsers;
	}


	function setUserLogin($username, $password){
		$this->username 	= $username;
		$this->password 	= $password;
	}

	function userLogin($username, $password){
		$userLogin = $this->conn->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
		$userLogin->execute([$username]);
		$userLogin_array = $userLogin->fetchAll();
		if($username == $userLogin_array[0]['username']){
			if(password_verify($password, $userLogin_array[0]['password'])){
				return true;
			}else{
				return false;
			}
		}
	}

		function setPromenaPassworda($userid, $password, $novipassword){
		$this->userid 		= $userid;
		$this->password 	= $password;
		$this->novipassword	= $novipassword;
	}

    function PromenaPassworda($userid, $password, $novipassword){

        if ($password !== $novipassword) {
            $PromenaPassworda = $this->conn->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
            $PromenaPassworda->execute([$userid]);
            $PromenaPassworda_array = $PromenaPassworda->fetchAll();
            if ($userid == $PromenaPassworda_array[0]['id']) {
                $options = [
                    'cost' => 10
                ];  // BCRYPT enkripcija
                $enc_novipassword = password_hash($novipassword, PASSWORD_BCRYPT, $options);
                if (password_verify($password, $PromenaPassworda_array[0]['password'])) {
                    $PromenaPassworda_update = $this->conn->prepare("UPDATE users SET password = ? WHERE id = ?");
                    $PromenaPassworda_update->execute([$enc_novipassword, $userid]);
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }
}