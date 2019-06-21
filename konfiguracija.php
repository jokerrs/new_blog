<?php
$lik_sajta = "localhost/novi_projekat/"; // Ubacena varijabla radi bolje migracije na drugu serversku konfiguraciju, takodje i u slucaju promena domena
$password = "Nemanjabg44";
$username = "root";
$dbhost = "localhost";
$dbname = "zadatak1";

	try { // Konekcija za bazom PDO
		    $conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $username, $password);
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}	
