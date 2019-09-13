<?php
session_start();
?>
<html>
<head>
    <title>SQL Injection 1</title>
    <meta name="h4xx0r" content="INSPECT ELEMENT REALLYYYY???">
</head>
<body>

<?php
require_once("util.php");
$conn = new mysqli("db", "root", "my_secret_pw_shh", "mydb");

if ($conn->connect_error) {
    die("DB connection failed: " . $conn->connect_error);
}
?>


<? if (isset($_SESSION["name"])): ?>
<?
if (isset($_POST["username"]) && isset($_POST["password"])) {
    $sql = "SELECT * FROM mydb.flag1 WHERE username='".$_POST["username"]."' AND password='".$_POST["password"]."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        printFlag($_SESSION["name"], "flag1");
    } else {
        echo "N00B H4XX0R!";
    }
} 
?>
    <form action="flag1.php" title="" method="post">
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