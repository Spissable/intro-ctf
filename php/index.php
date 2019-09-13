<?php
session_start();
require_once("util.php");
?>

<html>
<head>
    <title>Intro CTF</title>
    <meta name="h4xx0r" content="INSPECT ELEMENT REALLYYYY???">
    <style>
    table {
        width:100%;
    }
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
        padding: 15px;
        text-align: left;
    }
    table#t01 tr:nth-child(even) {
        background-color: #eee;
    }
    table#t01 tr:nth-child(odd) {
        background-color: #fff;
    }
    table#t01 th {
        background-color: black;
        color: white;
    }
    form {
        display: flex;
        flex-flow: row wrap;
        align-items: center;
    }
    </style>
</head>
<body>
<h2>Intro CTF Challenges</h2>

<?php
$conn = new mysqli("db", "root", "my_secret_pw_shh", "mydb");

if ($conn->connect_error) {
    die("DB connection failed: " . $conn->connect_error);
}

if (isset($_POST["username"])) {
    $sql = $conn->prepare("SELECT * FROM mydb.users WHERE username=?");
    $username = $conn->real_escape_string($_POST["username"]);
    $sql->bind_param("s", $username);
    $sql->execute();
    $sql->store_result();
    if ($sql->num_rows > 0) {
        echo "Username already taken";
    } else {
        $sql = $conn->prepare("INSERT INTO mydb.users (username) VALUES (?)");
        $sql->bind_param("s", $username);
        $sql->execute();
        $_SESSION["name"] = $username;
    }
} 
?>

<? if (!isset($_SESSION["name"])): ?>
<form action="index.php" title="" method="post">
    <div>
        <label class="title">Username</label>
        <input type="text" id="username" name="username" >
    </div>
    <div>
        <input type="submit" id="submitButton"  name="submitButton" value="Submit">
    </div>
</form>
<? else: ?>
<?
    if (isset($_POST["flag"]) && isset($_POST["challenge"])) {
        if (checkFlag($_POST["flag"], $_SESSION["name"], $_POST["challenge"])) {
            $challenge = $conn->real_escape_string($_POST["challenge"]);
            $sql = $conn->prepare("UPDATE mydb.users SET `".$challenge."`=1 WHERE username=(?)");
            $sql->bind_param("s", $_SESSION["name"]);
            $sql->execute();
            echo $_POST["challenge"]." captured!";
        } else {
            echo "FAIL.";
        }
    }
?>
<form action="index.php" title="" method="post">
    <div>
        <label class="title"><a href="flag1.php">flag1</a></label>
        <input type="text" id="flag" name="flag" >
        <input type="hidden" id="challenge" name="challenge" value="flag1">
    </div>
    <div>
        <input type="submit" id="submitButton"  name="submitButton" value="Submit">
    </div>
</form>
<form action="index.php" title="" method="post">
    <div>
    <label class="title"><a href="flag2.php">flag2</a></label>
        <input type="text" id="flag" name="flag" >
        <input type="hidden" id="challenge" name="challenge" value="flag2">
    </div>
    <div>
        <input type="submit" id="submitButton"  name="submitButton" value="Submit">
    </div>
</form>
<form action="index.php" title="" method="post">
    <div>
    <label class="title"><a href="flag3.php">flag3</a></label>
        <input type="text" id="flag" name="flag" >
        <input type="hidden" id="challenge" name="challenge" value="flag3">
    </div>
    <div>
        <input type="submit" id="submitButton"  name="submitButton" value="Submit">
    </div>
</form>
<form action="index.php" title="" method="post">
    <div>
    <label class="title"><a href="flag4.php">flag4</a></label>
        <input type="text" id="flag" name="flag" >
        <input type="hidden" id="challenge" name="challenge" value="flag4">
    </div>
    <div>
        <input type="submit" id="submitButton"  name="submitButton" value="Submit">
    </div>
</form>
<form action="index.php" title="" method="post">
    <div>
    <label class="title"><a href="flag5.php">flag5</a></label>
        <input type="text" id="flag" name="flag" >
        <input type="hidden" id="challenge" name="challenge" value="flag5">
    </div>
    <div>
        <input type="submit" id="submitButton"  name="submitButton" value="Submit">
    </div>
</form>


<table style="width:100%">
<tr>
    <th>Username</th>
    <th>Flag 1</th>
    <th>Flag 2</th>
    <th>Flag 3</th>
    <th>Flag 4</th>
    <th>Flag 5</th>
</tr>
<? 
$sql = "SELECT * from mydb.users";
$result = $conn->query($sql);
while($row = $result->fetch_row()):
?>
  <tr>
    <td><? echo $row[0]; ?></td>
    <td><? echo $row[1] == 1 ? "\u{2705}": "\u{274C}" ?></td>
    <td><? echo $row[2] == 1 ? "\u{2705}": "\u{274C}" ?></td>
    <td><? echo $row[3] == 1 ? "\u{2705}": "\u{274C}" ?></td>
    <td><? echo $row[4] == 1 ? "\u{2705}": "\u{274C}" ?></td>
    <td><? echo $row[5] == 1 ? "\u{2705}": "\u{274C}" ?></td>
  </tr>
<? endwhile; ?>
</table> 

<? endif; ?>

</body>
</html>
