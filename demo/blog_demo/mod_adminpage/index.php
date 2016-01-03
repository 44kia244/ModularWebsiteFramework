<?php
	$Authen = new ExtendedAuthenticationEngine();
	$E = new BlogEngine();
	if(!$Authen->isLoggedIn()) header("Location: .");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Welcome To My Blog</title>
		<meta charset="UTF-8">
		<style>
			<?php MWF_ViewLoader::Load("mod_core_design", "base_css");?>
		</style>
	</head>
	<body>
		<?php MWF_ViewLoader::Load("mod_core_design", "headerbar"); ?>
		<?php if($Authen->isAuthorized(1)) echo '<p><a href="?mod=mod_adminpage&view=add_entry">Create new blog entry</a></p>'; ?>
		<hr>
<?php
	if(!isset($_GET["page"])) $page = 1;
	else $page = $_GET["page"];
	
	if(!isset($_GET["per_page"])) $per_page = 30;
	else $per_page = $_GET["per_page"];
	
	$start = ($page-1) * $per_page;
	
	if($Authen->isAuthorized(4)) $res = $E->getPostRange($start, $per_page);
	else $res = $E->getOwnPostRange($start, $per_page);
	
	echo '<table style="border: 1px solid black; width: 100%; border-collapse: collapse;">';
	for($i=0;$i<count($res);$i++) {
		echo '<tr style="border: 1px solid black;">';
		echo "<td style=\"text-align: center\">" . $res[$i]["POST_ID"] . "</td>";
		echo "<td>" . $res[$i]["POST_TITLE"] . "</td>";
		if($Authen->isAuthorized(2)) echo "<td style=\"text-align: center\"><a href=\"?mod=mod_adminpage&view=edit_entry&POST_ID=" . $res[$i]["POST_ID"] . "\">Edit</a></td>";
		if($Authen->isAuthorized(3)) echo "<td style=\"text-align: center\"><a href=\"?mod=mod_adminpage&view=delete_entry&POST_ID=" . $res[$i]["POST_ID"] . "\">Delete</a></td>";
		echo "</tr>";
	}
	echo "</table>";
?>
	</body>
</html>