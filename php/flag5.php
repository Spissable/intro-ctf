<?php
session_start();
?>

<html>
<head>
    <title>Use password managers.</title>
    <meta name="h4xx0r" content="...">
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
    <? if (isset($_POST["submit"]) && $_POST["submit"] === "login"): ?>
        NEIN NEIN NEIN NEIN
    <? elseif (isset($_POST["submit"]) && $_POST["submit"] === "reset"): ?>
        <?
            $username = $conn->real_escape_string($_POST["username"]);
            $token = base64_encode($username.time());
            $sql = $conn->prepare("INSERT INTO mydb.flag5 (username, token) VALUES (?, ?) ON DUPLICATE KEY UPDATE token = VALUES(token)");
            $sql->bind_param("ss", $username, $token);
            $sql->execute();
        ?>
        <? if ($_SESSION["name"] === $_POST["username"]): ?>
            <? echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?token=".$token; ?>
        <? else: ?>
            The password reset link has been sent to the user
        <? endif; ?>
    <? elseif (isset($_GET["token"])): ?>
        <?
            $token = base64_decode($_GET["token"]);
            $username = substr($token, 0, strlen($token) - 10);
            if ($username === "admin") {
                $sql = $conn->prepare("SELECT * FROM mydb.flag5 WHERE username='admin' AND token=(?)");
                $sql->bind_param("s", $_GET["token"]);
                $sql->execute();
                $sql->store_result();
                if ($sql->num_rows > 0) {
                    printFlag($_SESSION["name"], "flag5");
                } else {
                    echo "Close but no cigar";
                }
            } else {
                echo "Only the cool kids get flags";
            }
        ?>
    <? endif; ?>

    <form action="flag5.php" title="" method="post">
        <div>
            <label class="title">Username</label>
            <input type="text" id="username" name="username" >
        </div>
        <div>
            <label class="title">Password</label>
            <input type="text" id="password" name="password" >
        </div>
        <div>
            <input type="submit" id="submit"  name="submit" value="login">
            <input type="submit" id="submit"  name="submit" value="reset">
        </div>
 </form>

<? else: ?>
Please log in first <a href="index.php">link</a>
<? endif; ?>

</body>
</html>