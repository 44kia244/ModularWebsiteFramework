<?php
$username = $_POST["username"];
$password = $_POST["password"];
$loginengine = new AuthenticationEngine();
if(!$loginengine->login($username,$password)) {
	header('Location: ' . $_SERVER['REQUEST_URI']);
}else{
	header('Location: ../mod_blogview/index.php'); //Redirect to blog main view BlogView(Vm)
}
?>