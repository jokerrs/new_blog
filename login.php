<?php
	
	// Konekcija sa bazom podataka (MySql)
    require_once ("./konfiguracija.php");
    // Klasa korisnici.php
    require_once ("./klase/korisnici.php");
    // Pocetak sesije
    session_start();


    $test = new Users($conn);
    $test1 = $test->getUser(1);
    foreach ($test1 as $test12) {
    	echo "<pre>";
    	print_r($test12);
    	echo "</pre>";
    }