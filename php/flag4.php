<?php
session_start();
?>

<html>
<head>
    <title>Hash me baby one more time</title>
    <meta name="h4xx0r" content="Hmmmm...">
</head>
<body>

<?php
require_once("util.php");
?>
<? if (isset($_SESSION["name"])): ?>
<?
$hash = hash("sha1", $_GET["password"]);
if (isset($_GET["password"])) {
  if ($hash == '0e76658526655756207688271159624026011393') {
    printFlag($_SESSION["name"], "flag4");
  } else {
    echo 'Input is not matching hash starting with: 0e76';
  }
}
?>

    <form action="flag4.php" title="" method="get">
        <div>
            <label class="title">Password</label>
            <input type="password" id="password" name="password" >
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
