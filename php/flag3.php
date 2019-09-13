<?php
session_start();
?>

<html>
<head>
    <title>Comparing strings #LikeABoss</title>
    <meta name="h4xx0r" content="AGAIN? N00B">
</head>
<body>

<?php
require_once("util.php");
?>
<? if (isset($_SESSION["name"])): ?>
<?
if (isset($_GET["username"]) && isset($_GET["password"])) {
    if ($_GET["username"] !== 'admin') {
        echo "Nope.";
    } elseif (strcmp($_GET["password"], 'M*ZKBvV&gDdx4!nK%D3VvpEv@p!uBmgZK#Bx') == 0) {
        printFlag($_SESSION["name"], "flag3");
    } else {
        echo "Keep guessing lol.<br>";
    }
} ?>

    <form action="flag3.php" title="" method="get">
        <input type="text" id="username" name="username" value="admin" hidden>
        <div>
            <label class="title">Password</label>
            <input type="text" id="password" name="password" >
        </div>
        <div>
            <input type="submit" id="submitButton"  name="submitButton" value="Submit">
        </div>
 </form>

<? else: ?>
Please log in first <a href="index.php">link</a>
<? endif; ?>

</body>
</html>