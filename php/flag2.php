<?php
session_start();
?>

<html>
<head>
    <title>SQL Injection 2</title>
    <meta name="h4xx0r" content="N00B">
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
    $sql = "SELECT * FROM mydb.flag2 WHERE username='".$_POST["username"]."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_row();
        if ($row[1] === $_POST["password"]) {
          printFlag($_SESSION["name"], "flag2");
        } else {
          echo "Wrong password for user ".$row[0];
        }
    } else {
        echo "N00B H4XX0R!";
    }
} 
?>

    <form action="flag2.php" title="" method="post">
        <div>
          <label class="title">Username</label>
          <input type="text" id="username" name="username" >
        </div>
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