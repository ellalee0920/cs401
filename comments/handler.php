<?php
$name = $_POST['name'];
$comment = $_POST['comment'];

require_once 'Comments_Dao.php';
$dao = new Comments_Dao();
$dao->saveComment($name, $comment);

header('Location: http://cs401/comments');
exit;