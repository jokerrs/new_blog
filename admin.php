 <?php    

 	// Pocetak sesije
    session_start();
	// Konekcija sa bazom podataka (MySql)
    require_once ("./konfiguracija.php");
    // Klasa korisnici.php
    require_once ("./klase/korisnici.php");

    if(!isset($_SESSION['uid'])){
    			header('Location: login.php');;
    }else{
    	$getUserDataBysession = new Users($conn);
    	$UserData = $getUserDataBysession->getUser($_SESSION['uid']);
    	foreach ($UserData as $User_data_value) {
    		$username = $User_data_value['username'];
    		$name = $User_data_value['name'];
    		$lastname = $User_data_value['lastname'];
    	}

    	echo "Dobrodosao ".$name." ".$lastname;
    }