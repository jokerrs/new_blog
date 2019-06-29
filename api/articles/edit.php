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
	if(!empty($data->title) && !empty($data->content) && !empty($data->author_id)){
		if(!empty($data->main_image)){
			$title = $data->title;
			$content = $data->content;
			$author_id = $data->author_id;
			$article_id = $data->article_id;
			$main_image = $data->main_image;
			if($objave->getIsAuthor($author_id, $article_id)){
				if($objave->updateArticle($article_id, $title, addslashes($content), $main_image)){
					http_response_code(200);
				}else{
			        http_response_code(503);
			    }
			}else{
				http_response_code(403)
			}
		}else{
		        http_response_code(404);
		}
	}else{
		http_response_code(400);
	}
}else{
		http_response_code(403.3);
}

