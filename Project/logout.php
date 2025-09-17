// logout.php
<?php
session_start();
session_unset();
session_destroy();
header("Location: index.php");
setcookie('logged_in', '', time() - 3600, '/');

exit();
?>