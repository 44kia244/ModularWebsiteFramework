<?php
$username = $_POST["username"];
$password = $_POST["password"];
$loginengine = new AuthenticationEngine();

if(!$loginengine->login($username,$password)) {
	header('Location: /?mod=mod_login&loginfail=1');
}else{
	header('Location: /?mod=mod_login&view=index.html'); //Redirect to blog main view BlogView(Vm)
}
?>