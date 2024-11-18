<?php

require_once 'Database.php';

$db = new Database();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $postId = $_GET['id'];

    // Call the delete method in the Database class
    $db->deletePost($postId);

    // Redirect back to the main page after deletion
    header("Location: index.php");
    exit;
}
?>
