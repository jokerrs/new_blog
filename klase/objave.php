<?php

/**
 *
 */
class Articles
{
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    function getArticles()
    {
        return $this->conn->query("SELECT * FROM articles_authors");
    }

    function getArticle($article_id)
    {
        $getArticle = $this->conn->prepare("SELECT * FROM articles_authors WHERE id = ?");
        $getArticle->execute([$article_id]);
        return $getArticle;
    }

    function getArticleAuthor($article_author)
    {
        $getArticle = $this->conn->prepare("SELECT * FROM articles_authors WHERE author = ?");
        $getArticle->execute([$article_author]);
        return $getArticle;
    }

    function getSearchArticle($article_content)
    {
        $getArticle = $this->conn->prepare("SELECT * FROM articles WHERE content LIKE ?");
        $keyword_to_search = '%' . $article_content . '%';
        $getArticle->execute([$keyword_to_search]);
        return $getArticle;
    }

    function insertArticle($article_title, $article_content, $article_author, $article_image)
    {
        $insertArticle = $this->conn->prepare("INSERT INTO articles (`title`, `content`, `author`, `main_image`, `created_time`) VALUES (?, ?, ?, ?, ?)");
        if ($insertArticle->execute([$article_title, $article_content, $article_author, $article_image, date('Y-m-d H:i:s')])) {
            return true;
        }
        return false;
    }

    // Updating an article by ID
    function updateArticle($article_id, $article_title, $article_content, $article_image)
    {
        $updateArticle = $this->conn->prepare("UPDATE articles SET title=?, content=?, main_image=?, update_time=? WHERE id=? ");
        $updateArticle->execute([$article_title, $article_content, $article_image, date('Y-m-d H:i:s'), $article_id]);
        return true;
    }

    // Deleting an article
    function deleteArticle($article_id)
    {
        $deleteArticle = $this->conn->prepare("DELETE FROM articles WHERE id = ?");
        $deleteArticle->execute([$article_id]);
        return true;
    }

    function getArticlePagination($limit, $page)
    {
        $start_Article = ($page - 1) * $limit;
        $total_pages_pdo = $this->conn->query("SELECT count(id) as count FROM articles_authors");
        $total_rows = $total_pages_pdo->fetchColumn();
        $total_pages = ceil($total_rows / $limit);
        $Articles_return = $this->conn->prepare("SELECT * FROM articles_authors ORDER BY id DESC LIMIT :start_Article, :limit ");
        $Articles_return->bindParam(':start_Article', $start_Article, PDO::PARAM_INT);
        $Articles_return->bindParam(':limit', $limit, PDO::PARAM_INT);
        $Articles_return->execute();
        return array($total_pages, $Articles_return->fetchAll());
    }

    function getArticlePaginationAuthorPage($limit, $page, $article_author)
    {
        $start_Article = ($page - 1) * $limit;
        $total_pages_pdo = $this->conn->prepare("SELECT count(id) as count FROM articles_authors WHERE author_id = :article_author");
        $total_pages_pdo->bindParam(':article_author', $article_author, PDO::PARAM_INT);
        $total_pages_pdo->execute();
        $total_rows = $total_pages_pdo->fetchColumn();
        $total_pages = ceil($total_rows / $limit);
        $Articles_return = $this->conn->prepare("SELECT * FROM articles_authors WHERE author_id = :article_author ORDER BY id DESC LIMIT :start_Article, :limit");
        $Articles_return->bindParam(':article_author', $article_author, PDO::PARAM_INT);
        $Articles_return->bindParam(':start_Article', $start_Article, PDO::PARAM_INT);
        $Articles_return->bindParam(':limit', $limit, PDO::PARAM_INT);
        $Articles_return->execute();
        return array($total_pages, $Articles_return->fetchAll());
    }

    function getIsAuthor($author_id, $article_id)
    {
        $IsAuthor = $this->conn->prepare("SELECT author FROM articles WHERE id = ?");
        $IsAuthor->execute([$article_id]);
        foreach ($IsAuthor as $ress) {
            if ($ress['author'] === $author_id) {
                return true;
            }
            return false;
        }
    }
}