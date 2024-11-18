<?php

require_once 'Database.php';

$db = new Database();

// Get posts based on the selected amount
$posts = $db->getPosts();

foreach ($posts as $post) {
    echo "<h2>" . htmlspecialchars($post['title']) . "</h2>";
    echo "<p>" . htmlspecialchars($post['content']) . "</p>";
    echo "<a href='edit_post.php?id=" . $post['id'] . "'>Edit</a> | ";
    echo "<a href='delete_post.php?id=" . $post['id'] . "'>Delete</a>";
    echo "<hr>";
}
?>

<form action="process_form.php" method="POST">
    <input name="title" placeholder="title" required>
    <input name="content" placeholder="content" required>
    <button type="submit">Submit</button>
</form>
