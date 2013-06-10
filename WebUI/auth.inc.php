<?
# Simple HTTP authentication
# Must run before any content has been echoed to the screen.
$user="mine";
$pass="ninja";
if (!isset($_SERVER['PHP_AUTH_USER'])) {
	header('WWW-Authenticate: Basic realm="Mine: Ninja"');
	header('HTTP/1.0 401 Unauthorized');
	echo 'Sorry - no Anubis for you.';
	exit;
} else
{
	if($_SERVER['PHP_AUTH_USER'] != $user or
	   $_SERVER['PHP_AUTH_PW'] != $pass) {
	    echo 'Wrong Credentials!';
	    exit;
	}
}
?>
