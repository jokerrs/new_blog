<?php

/**
 * 
 */ 
class Articles{
	private $conn;
	private $article_id;
	private $article_author;
	private $article_content;
	private $article_title;
	private $limit;
	private $page;


	function __construct($conn){ 
           $this->conn 		           = $conn;
    }

    function getArticles(){
    	$getArticles = $this->conn->prepare("SELECT * FROM articles_authors");
    	$getArticles->execute();
    	return $getArticles;
    }

	function setArticle($article_id){
		$this->article_id = $article_id;
	}
	

	function getArticle($article_id){
		$getArticle = $this->conn->prepare("SELECT * FROM articles_authors WHERE id = ?");
		$getArticle->execute([$article_id]);
		return $getArticle;
	}

	function setArticleAuthor($article_author){
		$this->article_author       = $article_author;
	}


	function getArticleAuthor($article_author){
		$getArticle = $this->conn->prepare("SELECT * FROM articles_authors WHERE author = ?");
		$getArticle->execute([$article_author]);
		return $getArticle;
	}

	function setSearchArticle($article_content){
		$this->article_content      = $article_content;
	}

	function getSearchArticle($article_content){
		$getArticle = $this->conn->prepare("SELECT * FROM articles WHERE content LIKE ?");
		$keyword_to_search = '%' . $article_content . '%';
		$getArticle->execute([$keyword_to_search]);
		return $getArticle;
	}

	function setInsertArticle($article_title, $article_content, $article_author){
		$this->article_title        = $article_title;
		$this->article_content 	    = $article_content;
		$this->article_author	    = $article_author;
	}


	function insertArticle($article_title, $article_content, $article_author, $article_image){
		$insertArticle = $this->conn->prepare("INSERT INTO articles (`title`, `content`, `author`, `main_image`, `created_time`) VALUES (?, ?, ?, ?, ?)");
		if($insertArticle->execute([$article_title, $article_content, $article_author, $article_image, date('Y-m-d H:i:s')])){ 
			return true;
		}else{
			return false;
		}
	}

	function setupdateArticle($article_id, $article_title, $article_content, $article_author){
		$this->article_title 	= $article_title;
		$this->article_content 	= $article_content;
		$this->article_author	= $article_author;
		$this->article_id       = $article_id;
	}

		// Updating an article by ID
	function updateArticle($article_id, $article_title, $article_content, $article_author){
		$updateArticle = $this->conn->prepare("UPDATE articles SET title=?, content=?, author=?, update_time=? WHERE id=? ");
		$updateArticle->execute([$article_title, $article_content, $article_author, date('Y-m-d H:i:s'), $article_id]); 
		return true;
	}

		// Deleting an article
	function deleteArticle($article_id){
		$deleteArticle = $this->conn->prepare("DELETE FROM articles WHERE id = ?");
		$deleteArticle->execute([$article_id]);
		return true;
	}

	function setArticlePagination($limit, $page){
		$this->limit 	 = $limit;
		$this->page 	 = $page;
	}

	function getArticlePagination($limit, $page){
		$start_Article = ($page-1) * $limit;
		$total_pages_pdo = $this->conn->prepare("SELECT count(id) as count FROM articles_authors");
		$total_pages_pdo->execute();
		$total_rows = $total_pages_pdo->fetchColumn();
		$total_pages = ceil($total_rows / $limit);
		$Articles_return = $this->conn->prepare("SELECT * FROM articles_authors LIMIT :start_Article, :limit");
		$Articles_return->bindParam(':start_Article', $start_Article, PDO::PARAM_INT);
		$Articles_return->bindParam(':limit', $limit, PDO::PARAM_INT);
		$Articles_return->execute();
		return  array( $total_pages, $Articles_return->fetchAll());

	} 
}