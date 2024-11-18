<?php

require_once 'Database.php';

$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $title = trim($_POST["title"]);
    $title = filter_var($title, FILTER_SANITIZE_STRING);

    $content = trim($_POST["content"]);
    $content = filter_var($content, FILTER_SANITIZE_STRING);

    // Flag for validation status
    $isValid = true;

    // Title validation: Check if it matches the pattern
    if (!preg_match("/^[a-zA-Z0-9 ]*$/", $title)) {
        echo "Title can only contain letters, numbers, and spaces.<br>";
        $isValid = false;
    } else {
        echo "Title is valid.<br>";
    }

    // Input validation: Check if title and content are non-empty
    if (empty($title) || empty($content)) {
        echo "Both title and content are required!<br>";
        $isValid = false;
    } else {
        echo "Input is valid.<br>";
    }

    // Title length validation: Check if length is within the allowed range
    if (strlen($title) < 5 || strlen($title) > 100) {
        echo "Title must be between 5 and 100 characters.<br>";
        $isValid = false;
    } else {
        echo "Title length is valid.<br>";
    }

    // If all validations pass, create the post
    if ($isValid) {
        $db->createPost($title, $content);
        echo "Post created successfully!";
    }
}
?>
