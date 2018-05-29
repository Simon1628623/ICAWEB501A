<!doctype html>
<?php
session_start();
?>


<!--
Filename: ICAWEB501A_1628623.php
Author: Simon
Date Created: 4th April 2014
Last Updated: 16 April 2014
-->

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="HTML,CSS, PHP, Joker, Poker, Game">
<meta name="author" content="Simon Dunkley">
<meta charset="UTF-8">
<title>
 Assignment 1: PHP - ICAWEB501A_1628623
</title>
<link rel="stylesheet" type="text/css" href="design.css">
</head>

<body>
<div id="base">
<header>
<h1> 
<img src="pictures/banner1.png" alt="Banner">
</h1>
</header>
<section id="content">
<!-- php goes here -->
<?php
//includes the functions code
include "includes/functions.php";

//checking if name is not set
if (!isset($_SESSION['session_name']))
	{
	//if name not set and player presses submit it will submit what they entered
	if (isset($_POST['submit']))
		{
		$_SESSION['session_name'] = $_POST['name'];
		$_SESSION['credits'] = 100;
		$name = $_SESSION['session_name'];
		reFresh();
		}
	//if submit not pressed displays welcome screen
	else{
		?>
		<hr style="height:14pt; visibility:hidden;" />
		<h2> Welcome to Gambling 101!</h2>
		<hr style="height:145pt; visibility:hidden;" />
		Please enter your name
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<input type="text" name="name">
		<input type="submit" name="submit" value="submit">
		</form>
		<?php
		}
	}

//starts the game function
else {Game();}
?>
</section>
<footer>
<p>&copy; Simon 2014</p>
</footer>
</div>
</body>
</html>