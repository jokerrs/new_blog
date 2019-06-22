<?php
	
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once ("../../konfiguracija.php");
include_once ("../../klase/objave.php");

$objave = new Articles($conn);

$rezultat = $objave->getArticles();
$broj = $rezultat->rowCount();

if($broj > 0){
	$objave_arr = array();
	$objave_arr['records'] = array();

	while ($row = $rezultat->fetch(PDO::FETCH_ASSOC)) {
		
		extract($row);

		$objava = array(
			"id" => $id,
			"title" => $title,
			"content" => $content,
			"author_id" => $author_id,
			"author" => $author,
			"created_time" => gmdate("F j Y, g:iA", strtotime($created_time))
		);

		array_push($objave_arr['records'], $objava);
	}

 http_response_code(200);
 echo json_encode($objave_arr);
}else{
    http_response_code(404);
	echo json_encode(
        array("message" => "Ni jedana objava nije nadjena.")
    );
}