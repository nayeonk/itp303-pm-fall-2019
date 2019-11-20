<?php

// Must start_session() any page you want to set or get sessions - important that session_start is the first piece of code
session_start();

// Set a couple of session variables
// key/value pairs
// $_SESSION["logged_in"] = true;
// $_SESSION["username"] = "ttrojan";

// Dump out the session variables to see that it is set
var_dump($_SESSION);

// Show only the values of session variables
echo "<hr>";
echo "Am I logged in?: " . $_SESSION["logged_in"];
echo "<hr>";
echo "Username is: " . $_SESSION["username"];

// When no longer want to store the session variables, destroy

session_destroy();

?>