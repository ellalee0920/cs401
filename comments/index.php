<?php
session_start();

//echo "<pre>" . print_r($_SESSION,1) . "</pre>";

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
  header('Location: http://cs401/comments/login.php');
  exit;
}

require_once 'Comments_Dao.php';
$dao = new Comments_Dao();
$comments = $dao->getComments();
?>


<html>
  <head>
    <link href="comments.css" type="text/css" rel="stylesheet" />
  </head>
  <body>
    <h1>Comments</h1><a href="logout.php">Logout</a>
    <h2>Leave a Comment</h2>

<?php if (isset($_SESSION['messages'])) {
  foreach ($_SESSION['messages'] as $message) {?>
      <div class="message <?php echo isset($_SESSION['validated']) ? $_SESSION['validated'] : '';?>"><?php
      echo $message; ?></div>
<?php  }
 unset($_SESSION['messages']);
?> </div>
<?php } ?>

    <form method="post" action="handler.php">
			Name:<br>
      <input type="text" name="name" value="<?php echo isset($_SESSION['presets']['name']) ? $_SESSION['presets']['name'] : ''; ?>"><br>
			Comment:<br>
			<input type="text" name="comment" value="<?php echo isset($_SESSION['presets']['comment']) ? $_SESSION['presets']['comment'] : ''; ?>">
      <input type="submit" value="Submit">
    </form>

    <table>
<?php

    foreach ($comments as $comment) {
      echo "<tr><td>" . htmlentities($comment['name']) . "</td><td>{$comment['comment']}</td><td>{$comment['date_entered']}</td><td><a href='http://cs401/comments/delete.php?id={$comment['id']}'/>X</a></td></tr>";
    }
?>
    </table>

  </body>
</html>
