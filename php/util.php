<?
function printFlag($username, $challenge) {
    $flag = hash('ripemd160', $username.$challenge."youWontGuessThis");
    echo "<div id=flag>flag{".$flag."}</div>";
}

function checkFlag($flag, $username, $challenge) {
    return $flag === 'flag{'.hash('ripemd160', $username.$challenge."youWontGuessThis").'}';
}
?>