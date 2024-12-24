<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
$s=false;
if (isset($_GET['q'])){
	$s=true;
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
<?php
if ($s){
	echo "<title>".$_GET["q"]."</title>";
	echo '<meta property="og:title" content="'.$_GET["q"].' on yep" />';
}else{
	
	echo "<title>html yep search</title>";
	echo '<meta property="og:title" content="html yep search" />';
}
?>
		<meta property="og:type" content="website" />
		<meta charset="UTF-8"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="htmlified yep search">
		<link rel="stylesheet" href="/style.css">
		<link rel="icon" href="icon.svg" />
	</head>
	<body>
		<nav>
			<form action="./">
<?php
if ($s){
	echo '<input type="text" id="q" name="q" value="'.$_GET["q"].'" placeholder="search for something">';
}else{
	echo '<input type="text" id="q" name="q" value="" placeholder="search for something">';
}
?>
				<input type="submit" value="&#128269;">
			</form>
			<a href="yep.com"><img src="./icon.svg" alt="main yep website"></a>
		</nav>
		<br/>
		<br/>
<?php
if (isset($_GET['q'])){
	$q=$_GET['q'];
	$output = file_get_contents("https://api.yep.live/search?q=".urlencode($q));
	//echo $output;
	//echo "$q";
	$res = json_decode($output, true);
	//var_dump($res);
	foreach($res[1]["results"] as $entry){
		echo '<a href="'.$entry["url"].'">';
?>
<div class="result">
<h1>
<?php
		echo $entry["title"];
?>
</h1>
<p>
<?php
		echo $entry["snippet"];
?>
</p>
</div>
</a>
<?php
	}
}else{
	echo "welcome to the HTML yep search experience! please use the search bar to look for something.";
}
?>
<footer>
this project is not affiliated nor endorsed by yep or ahrefs. In fact, it is using an unprotected endpoint that's not supposed to exist, so who knows when it will stop working.
</footer>
</body>
</html>
