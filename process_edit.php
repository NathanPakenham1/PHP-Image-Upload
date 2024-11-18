<?php

require_once 'Database.php';

$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postId = $_POST['id'];
    $title = trim($_POST["title"]);
    $title = filter_var($title, FILTER_SANITIZE_STRING);

    $content = trim($_POST["content"]);
    $content = filter_var($content, FILTER_SANITIZE_STRING);

    // Validate inputs
    if (!preg_match("/^[a-zA-Z0-9 ]*$/", $title)) {
        echo "Title can only contain letters, numbers, and spaces.";
    } elseif (empty($title) || empty($content)) {
        echo "Both title and content are required!";
    } elseif (strlen($title) < 5 || strlen($title) > 100) {
        echo "Title must be between 5 and 100 characters.";
    } else {
        // Update the post in the database
        $db->updatePost($postId, $title, $content);
        echo "Post updated successfully!";
        header("Location: index.php"); // Redirect after successful update
        exit;
    }
}
?>
