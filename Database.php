<?php

class Database
{
    private $host = 'localhost';
    private $user = 'root';
    private $pass = 'root';
    private $db = 'nathantest4';
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getPosts()
    {
        $sql = 'SELECT * FROM posts ORDER BY created_at';
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            return [];
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function createPost($title, $content)
    {
        $sql = 'INSERT INTO posts (title, content) VALUES (?, ?)';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $title, $content);
        $stmt->execute();
    }



    public function deletePost($id)
    {
        $sql = 'DELETE FROM posts WHERE id = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    public function updatePost($id, $title, $content)
    {
        $sql = 'UPDATE posts SET title = ?, content = ? WHERE id = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $title, $content, $id);
        $stmt->execute();
    }
}

?>