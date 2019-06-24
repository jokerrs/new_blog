<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
if(isset($_SESSION['uid'])){
	include_once ("../../konfiguracija.php");
	include_once ("../../klase/objave.php");
	$objave = new Articles($conn);
	$data = json_decode(file_get_contents("php://input"));
	if(!empty($data->delete)){
		$delete = $data->delete;
		if($objave->deleteArticle($delete)){
			http_response_code(200);
		}else{
	        http_response_code(503);
	    }
	}else{
		http_response_code(400);
	}
}else{
		http_response_code(403.3);
}