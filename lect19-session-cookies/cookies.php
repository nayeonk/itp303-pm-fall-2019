<?php 

// Syntax to create a cookie
// setCookie(name, value, expire, path, domain, security);

$expiration = time() + 10000;
setCookie("username", "john_doe", $expiration);
setCookie("age", "18", $expiration);

// Get the cookie information and display it anywherel
echo "<hr>";
echo "This user's username is: " . $_COOKIE["username"] . " and his age is " . $_COOKIE["age"];



?>