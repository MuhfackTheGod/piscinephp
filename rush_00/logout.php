<?PHP 
require_once "func.php";

session_destroy();
header("Location: index.php");