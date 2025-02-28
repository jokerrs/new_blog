<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once ("../../konfiguracija.php");
include_once ("../../klase/objave.php");
$objave = new Articles($conn);
$rezultat = $objave->getArticles();
$broj = $rezultat->rowCount();
if($broj > 0) {
    echo json_encode(array("message" => "Ni jedana objava nije nadjena."));
    http_response_code(404) and die();
}
	$objave_arr = array();
	$objave_arr['data'] = array();
	while ($row = $rezultat->fetch(PDO::FETCH_ASSOC)) {
		extract($row);
		$objava = array(
			"id" => $id,
			"title" => $title,
			"content" => stripslashes($content),
			"author_id" => $author_id,
			"author" => $author,
			"main_image" => $main_image,
			"created_time" => gmdate("F j Y, g:iA", strtotime($created_time)),
			"update_time" => gmdate("F j Y, g:iA", strtotime($update_time))

		);
		$objave_arr['data'][] = $objava;
	}
 http_response_code(200);
 echo json_encode($objave_arr, JSON_PRETTY_PRINT);
