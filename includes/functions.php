<?php session_start(); ?>
<?php
/*
file to hold all user functions
Filename: functions.php
Author: Simon
Date Created: 4th April 2014
Last Updated: 19th April 2014
*/


//displays credits
function DisCredit() 
	{
	echo " You now have " . $_SESSION['credits'] . " Credits";
	}

//refreshes page
function reFresh ()
	{
	$page = $_SERVER['PHP_SELF'];
	$sec = ".01";
	header("Refresh: $sec; url=$page");
	}






// main game function 
function Game()
{
$name = $_SESSION['session_name'];
echo " Welcome " . $name .", ";
DisCredit(); 
?>
<!-- button and if statement for if another player wants to play game on a computer that has kept the session for the previous player-->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<input type="submit" name="reset" value="Different Person?">
</form>
<?php

if ($_POST['reset'])
	{
	session_destroy();
	reFresh();
	}


// how many credits you are willing to bet
$input_Credits;

//the possible cards array
$cards=array("a"=>"Ace", "k"=>"King", "q"=>"Queen", "ja"=>"Jack", "ten"=>"10", "nine"=>"9", "eight"=>"8", "seven"=>"7", "six"=>"6", "five"=>"5", "four"=>"4", "three"=>"3", "two"=>"2"); 

// array with joker
$cards2=array("a"=>"Ace", "k"=>"King", "q"=>"Queen", "j"=>"Jack", "ten"=>"10", "nine"=>"9", "eight"=>"8", "seven"=>"7", "six"=>"6", "five"=>"5", "four"=>"4", "three"=>"3", "two"=>"2", "jk"=>"Joker");


//echo "Credits: ".$_SESSION['credits'];
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
	<input type="text" name="input_Credits">
	<input type="submit" name="Bet" value="Bet">
	<input type="submit" name="bet1" value="Bet 1">
	<input type="submit" name="bet5" value="Bet 5">
</form>

<?php
//makes sure you put in credits between 1 to 5
if (($_POST['input_Credits'] <= 5) && (1 <= $_POST['input_Credits']))
	{
	$input_Credits = $_POST['input_Credits'];
	echo "You are betting: ".$input_Credits . " Credits<br>";
	}
	
 //bets 1 credit
else if (isset($_POST['bet1']))
	{
	$input_Credits = 1;
	echo "You are betting: ".$input_Credits . " Credits<br>";
	}

//bets 5 credits	
else if (isset($_POST['bet5']))
	{
	$input_Credits = 5;
	echo "You are betting: ".$input_Credits . " Credits<br>";
	}

else 
	{echo "^^^please enter a number between 1 to 5^^^<br>";}

?>
<hr style="height:123pt; visibility:hidden;" />
<?php
//randomiser shuffles deck then picks first card
shuffle($cards);
$card1 = $cards[0];
echo '<img src="pictures/card'.$card1.'.png">';

shuffle($cards2);
$card2 = $cards2[0];
echo '<img src="pictures/card'.$card2.'.png">';

shuffle($cards2);
$card3 = $cards[0];
echo '<img src="pictures/card'.$card3.'.png">';

shuffle($cards2);
$card4 = $cards2[0];
echo '<img src="pictures/card'.$card4.'.png">';

shuffle($cards);
$card5 = $cards[0];
echo '<img src="pictures/card'.$card5.'.png">';

//shuffled deck in a array
$result=array($card1,$card2,$card3,$card4,$card5);

// counts how many unique values exist
$final = count(array_unique($result));

//if joker card played removes a unique value to reward player
if (($card2 == Joker) || ($card3 == Joker) || ($card4 == Joker))
	{
	$final = $final - 1;
	}

?>
<hr style="height:70pt; visibility:hidden;" />
<?php
//tells if jackpot, 5 of a kind
if($final == 1)
	{
	echo "<br>JACKPOT!?!?!??!?!?<br>";
	$_SESSION['credits'] = $_SESSION['credits'] + $input_Credits * 1000;
	echo "You Won ". $input_Credits * 1000 . " Credits!";
	DisCredit();
	}

//consecutive from card1, 4 of a kind
else if(($card1 == $card2)&&($card2 == $card3)&&($card3 == $card4))
	{
	echo "Consecutive 4 of a Kind<br>";
	$_SESSION['credits'] = $_SESSION['credits'] + $input_Credits * 100;
	echo "You Won ". $input_Credits * 100 . " Credits!";
	DisCredit();
	}

//consecutive from card1, 3 of a kind
else if(($card1 == $card2)&&($card2 == $card3))
	{
	echo "Consecutive 3 of a Kind<br>";
	$_SESSION['credits'] = $_SESSION['credits'] + $input_Credits * 50;
	echo "You Won ". $input_Credits * 50 . " Credits!";
	DisCredit();
	}

//consecutive from card1, 2 of a kind
else if($card1 == $card2)
	{
	echo "Consecutive 2 of a Kind<br>";
	$_SESSION['credits'] = $_SESSION['credits'] + $input_Credits * 20;
	echo "You Won ". $input_Credits * 20 . " Credits!";
	DisCredit();
	}

//more unique value counters for non consecutive 
//4 of a kind
else if($final == 2)
	{
	echo "<br>Scattered 4 of a Kind<br>";
	$_SESSION['credits'] = $_SESSION['credits'] + $input_Credits * 10;
	echo "You Won ". $input_Credits * 10 . " Credits!";
	DisCredit();
	}

//3 of a kind
else if($final == 3)
	{
	echo "<br>Scattered 3 of a Kind or 2 Double of a Kind<br>";
	$_SESSION['credits'] = $_SESSION['credits'] + $input_Credits * 5;
	echo "You Won ". $input_Credits * 5 . " Credits!";
	DisCredit();
	}

//2 of a kind
else if ($final == 4)
	{
	echo "<br>Scattered Double of a Kind<br>";
	$_SESSION['credits'] = $_SESSION['credits'] + $input_Credits * 2;
	echo "You Won ". $input_Credits * 2 . " Credits!";
	DisCredit();
	}

// if you don't win anything displays lost money, takes money away then displays how many credits are left
else 
	{
	echo "Bad luck try again? <br> You lost ". $input_Credits ." Credits<br>";
	$_SESSION['credits'] =  $_SESSION['credits'] - $input_Credits;
	DisCredit();
	}
?>

<!-- Buttons for leaving the game with current money and resetting game -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
	<input type="submit" name="walkAway" value="walkAway">
	<input type="submit" name="Reset" value="Reset">
</form>
<?php

//option to walk away with the cash
if ($_POST['walkAway'])
	{
	echo "you decided to leave the game with " . $_SESSION['credits'] . " Credits";
	session_destroy();
	$page = $_SERVER['PHP_SELF'];
	$sec = "10";
	header("Refresh: $sec; url=$page");
	}

//Resets session
else if ($_POST['Reset'])
	{
	session_destroy();
	echo "<br>You reset the game";
	reFresh();
	}

if ($_SESSION['credits'] <= 0)
	{
	echo "GAME OVER <br> GAME WILL AUTOMATICALLY RESET";
	session_destroy();
	$page = $_SERVER['PHP_SELF'];
	$sec = "5";
	header("Refresh: $sec; url=$page");
	}
?>
</div>
<div id="rules">
<!-- Rules, Scoreboard and how to play  -->
<hr>
<h2>How to Play</h2> <br>
1. You must enter a value between 1 to 5 and press the Bet Button.<br>
2. Depending on the cards depends on your reward for betting. <br>
3. It will tell you the result and display your new value of credits. <br>



<br><h2>Rules</h2> 
<br>- If you get down to 0 Credits its game over and you have to restart.
<br>- You can walk away with what credits you own with the WalkAway button it will reset the game aswell.
<br>- If you want to restart press the Reset Button above the rules.
<br>- If you get a joker it only counts for Scattered prizes. 
<br>- Consecutive results only for if the card begins at the first slot and does not include jokers.
<p><br><h2> Rewards Chart </h2><br>
<table style="width:500px" align ="center">
<tr>
  <td></td>
  <td>Scattered</td>
  <td>Consecutive from wheel 1</td> 
</tr>
<tr>
  <td>2 of a kind</td>
  <td>Wager X 2</td> 
  <td>Wager X 20</td>
</tr>
<tr>
  <td>3 of a kind</td>
  <td>Wager X 5</td> 
  <td>Wager X 50</td>
</tr>
<tr>
  <td>4 of a kind</td>
  <td>Wager X 10</td> 
  <td>Wager X 100</td>
</tr>
<tr>
  <td>5 of a kind</td>
  <td>Wager X 1000</td>
  <td>Wager X 1000</td>
</tr>
</table>
</div>
<?php
} // end of game function 
?>