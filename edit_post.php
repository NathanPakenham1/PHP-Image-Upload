<?php

require_once 'Database.php';

$db = new Database();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $postId = $_GET['id'];

    // Fetch the post data from the database
    $posts = $db->getPosts();
    $post = null;

    // Find the post with the given ID
    foreach ($posts as $p) {
        if ($p['id'] == $postId) {
            $post = $p;
            break;
        }
    }

    // If post not found, redirect to the homepage
    if (!$post) {
        header("Location: index.php");
        exit;
    }
}
?>

<!-- Display the edit form -->
<form action="process_edit.php" method="POST">
    <input type="hidden" name="id" value="<?= $post['id']; ?>"> <!-- Pass the post ID -->
    <input name="title" placeholder="Title" value="<?= htmlspecialchars($post['title']); ?>" required>
    <textarea name="content" placeholder="Content" required><?= htmlspecialchars($post['content']); ?></textarea>
    <button type="submit">Update</button>
</form>
